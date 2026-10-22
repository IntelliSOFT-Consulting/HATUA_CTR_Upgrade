<?php
/**
 * Pure-PHP QR Code encoder (ISO/IEC 18004, byte mode, versions 1-40).
 *
 * No extensions (GD/Imagick) or external services are required, and the code
 * stays compatible with PHP 5.6 so it runs on the production image.
 * Algorithm follows Project Nayuki's reference QR Code generator (MIT).
 *
 * Usage:
 *   App::uses('QrEncoder', 'Lib/QrCode');
 *   $svg = QrEncoder::svg('https://example.com/verify/1');
 */
class QrEncoder {

	const ECC_LOW = 'L';
	const ECC_MEDIUM = 'M';
	const ECC_QUARTILE = 'Q';
	const ECC_HIGH = 'H';

	/** Format bits for each error correction level. */
	protected static $_eccFormatBits = array('L' => 1, 'M' => 0, 'Q' => 3, 'H' => 2);

	/** Error correction codewords per block, indexed by [ecc][version]. */
	protected static $_eccCodewordsPerBlock = array(
		'L' => array(-1, 7, 10, 15, 20, 26, 18, 20, 24, 30, 18, 20, 24, 26, 30, 22, 24, 28, 30, 28, 28, 28, 28, 30, 30, 26, 28, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30),
		'M' => array(-1, 10, 16, 26, 18, 24, 16, 18, 22, 22, 26, 30, 22, 22, 24, 24, 28, 28, 26, 26, 26, 26, 28, 28, 28, 28, 28, 28, 28, 28, 28, 28, 28, 28, 28, 28, 28, 28, 28, 28, 28),
		'Q' => array(-1, 13, 22, 18, 26, 18, 24, 18, 22, 20, 24, 28, 26, 24, 20, 30, 24, 28, 28, 26, 30, 28, 30, 30, 30, 30, 28, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30),
		'H' => array(-1, 17, 28, 22, 16, 22, 28, 26, 26, 24, 28, 24, 28, 22, 24, 24, 30, 28, 28, 26, 28, 30, 24, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30),
	);

	/** Number of error correction blocks, indexed by [ecc][version]. */
	protected static $_numErrorCorrectionBlocks = array(
		'L' => array(-1, 1, 1, 1, 1, 1, 2, 2, 2, 2, 4, 4, 4, 4, 4, 6, 6, 6, 6, 7, 8, 8, 9, 9, 10, 12, 12, 12, 13, 14, 15, 16, 17, 18, 19, 19, 20, 21, 22, 24, 25),
		'M' => array(-1, 1, 1, 1, 2, 2, 4, 4, 4, 5, 5, 5, 8, 9, 9, 10, 10, 11, 13, 14, 16, 17, 17, 18, 20, 21, 23, 25, 26, 28, 29, 31, 33, 35, 37, 38, 40, 43, 45, 47, 49),
		'Q' => array(-1, 1, 1, 2, 2, 4, 4, 6, 6, 8, 8, 8, 10, 12, 16, 12, 17, 16, 18, 21, 20, 23, 23, 25, 27, 29, 34, 34, 35, 38, 40, 43, 45, 48, 51, 53, 56, 59, 62, 65, 68),
		'H' => array(-1, 1, 1, 2, 4, 4, 4, 5, 6, 8, 8, 11, 11, 16, 16, 18, 16, 19, 21, 25, 25, 25, 34, 30, 32, 35, 37, 40, 42, 45, 48, 51, 54, 57, 60, 63, 66, 70, 74, 77, 81),
	);

	protected $_version;
	protected $_size;
	protected $_ecc;
	protected $_modules = array();
	protected $_isFunction = array();

/**
 * Renders $text as a standalone SVG document.
 *
 * @param string $text Content to encode (treated as raw bytes, e.g. UTF-8).
 * @param array $options ecc (L|M|Q|H), scale (px per module), size (fixed px width/height,
 *   overrides scale), border (quiet zone modules), dark / light (fill colours).
 * @return string
 */
	public static function svg($text, $options = array()) {
		$options += array('ecc' => self::ECC_MEDIUM, 'scale' => 4, 'size' => null, 'border' => 4, 'dark' => '#000000', 'light' => '#ffffff');
		$matrix = self::matrix($text, $options['ecc']);
		$border = (int)$options['border'];
		$dim = count($matrix) + $border * 2;
		$px = $options['size'] ? (int)$options['size'] : $dim * (int)$options['scale'];

		$path = '';
		foreach ($matrix as $y => $row) {
			foreach ($row as $x => $dark) {
				if ($dark) {
					$path .= 'M' . ($x + $border) . ',' . ($y + $border) . 'h1v1h-1z';
				}
			}
		}

		return '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="' . $px . '" height="' . $px . '"'
			. ' viewBox="0 0 ' . $dim . ' ' . $dim . '" shape-rendering="crispEdges">'
			. '<rect width="100%" height="100%" fill="' . $options['light'] . '"/>'
			. '<path d="' . $path . '" fill="' . $options['dark'] . '"/>'
			. '</svg>';
	}

/**
 * Encodes $text and returns the module grid as rows of booleans (true = dark).
 *
 * @param string $text Content to encode.
 * @param string $ecc Error correction level (L|M|Q|H).
 * @return array
 * @throws InvalidArgumentException When the level is unknown or the text is too long.
 */
	public static function matrix($text, $ecc = self::ECC_MEDIUM) {
		if (!isset(self::$_eccFormatBits[$ecc])) {
			throw new InvalidArgumentException('Unknown QR error correction level: ' . $ecc);
		}
		$qr = new self();
		$qr->_encode((string)$text, $ecc);
		return $qr->_modules;
	}

	protected function _encode($text, $ecc) {
		$bytes = array_values(unpack('C*', $text) ?: array());
		$len = count($bytes);

		// Pick the smallest version whose data capacity fits the payload.
		for ($version = 1; ; $version++) {
			$countBits = $version <= 9 ? 8 : 16;
			$dataBits = 4 + $countBits + $len * 8;
			if ($dataBits <= self::_numDataCodewords($version, $ecc) * 8) {
				break;
			}
			if ($version >= 40) {
				throw new InvalidArgumentException('Data too long to fit in a QR code');
			}
		}

		// Build the bit stream: byte-mode indicator, character count, payload.
		$bits = array();
		self::_appendBits($bits, 0x4, 4);
		self::_appendBits($bits, $len, $countBits);
		foreach ($bytes as $b) {
			self::_appendBits($bits, $b, 8);
		}

		// Terminator, byte alignment and alternating pad bytes.
		$capacityBits = self::_numDataCodewords($version, $ecc) * 8;
		self::_appendBits($bits, 0, min(4, $capacityBits - count($bits)));
		self::_appendBits($bits, 0, (8 - count($bits) % 8) % 8);
		for ($pad = 0xEC; count($bits) < $capacityBits; $pad ^= 0xEC ^ 0x11) {
			self::_appendBits($bits, $pad, 8);
		}

		$dataCodewords = array_fill(0, count($bits) >> 3, 0);
		foreach ($bits as $i => $bit) {
			$dataCodewords[$i >> 3] |= $bit << (7 - ($i & 7));
		}

		$this->_version = $version;
		$this->_size = $version * 4 + 17;
		$this->_ecc = $ecc;
		$row = array_fill(0, $this->_size, false);
		$this->_modules = array_fill(0, $this->_size, $row);
		$this->_isFunction = array_fill(0, $this->_size, $row);

		$this->_drawFunctionPatterns();
		$this->_drawCodewords($this->_addEccAndInterleave($dataCodewords));

		// Choose the mask with the lowest penalty score.
		$bestMask = 0;
		$minPenalty = PHP_INT_MAX;
		for ($mask = 0; $mask < 8; $mask++) {
			$this->_applyMask($mask);
			$this->_drawFormatBits($mask);
			$penalty = $this->_penaltyScore();
			if ($penalty < $minPenalty) {
				$bestMask = $mask;
				$minPenalty = $penalty;
			}
			$this->_applyMask($mask); // XOR again to undo
		}
		$this->_applyMask($bestMask);
		$this->_drawFormatBits($bestMask);
	}

	protected static function _appendBits(&$bits, $value, $length) {
		for ($i = $length - 1; $i >= 0; $i--) {
			$bits[] = ($value >> $i) & 1;
		}
	}

	protected static function _numRawDataModules($version) {
		$result = (16 * $version + 128) * $version + 64;
		if ($version >= 2) {
			$numAlign = (int)floor($version / 7) + 2;
			$result -= (25 * $numAlign - 10) * $numAlign - 55;
			if ($version >= 7) {
				$result -= 36;
			}
		}
		return $result;
	}

	protected static function _numDataCodewords($version, $ecc) {
		return (self::_numRawDataModules($version) >> 3)
			- self::$_eccCodewordsPerBlock[$ecc][$version] * self::$_numErrorCorrectionBlocks[$ecc][$version];
	}

	protected function _setFunctionModule($x, $y, $dark) {
		$this->_modules[$y][$x] = (bool)$dark;
		$this->_isFunction[$y][$x] = true;
	}

	protected function _drawFunctionPatterns() {
		$size = $this->_size;
		for ($i = 0; $i < $size; $i++) {
			$this->_setFunctionModule(6, $i, $i % 2 == 0);
			$this->_setFunctionModule($i, 6, $i % 2 == 0);
		}

		$this->_drawFinderPattern(3, 3);
		$this->_drawFinderPattern($size - 4, 3);
		$this->_drawFinderPattern(3, $size - 4);

		$positions = $this->_alignmentPatternPositions();
		$num = count($positions);
		for ($i = 0; $i < $num; $i++) {
			for ($j = 0; $j < $num; $j++) {
				// Skip the three corners occupied by finder patterns.
				if (($i == 0 && $j == 0) || ($i == 0 && $j == $num - 1) || ($i == $num - 1 && $j == 0)) {
					continue;
				}
				$this->_drawAlignmentPattern($positions[$i], $positions[$j]);
			}
		}

		$this->_drawFormatBits(0); // placeholder, overwritten once the mask is chosen
		$this->_drawVersion();
	}

	protected function _drawFinderPattern($x, $y) {
		for ($dy = -4; $dy <= 4; $dy++) {
			for ($dx = -4; $dx <= 4; $dx++) {
				$dist = max(abs($dx), abs($dy));
				$xx = $x + $dx;
				$yy = $y + $dy;
				if ($xx >= 0 && $xx < $this->_size && $yy >= 0 && $yy < $this->_size) {
					$this->_setFunctionModule($xx, $yy, $dist != 2 && $dist != 4);
				}
			}
		}
	}

	protected function _drawAlignmentPattern($x, $y) {
		for ($dy = -2; $dy <= 2; $dy++) {
			for ($dx = -2; $dx <= 2; $dx++) {
				$this->_setFunctionModule($x + $dx, $y + $dy, max(abs($dx), abs($dy)) != 1);
			}
		}
	}

	protected function _alignmentPatternPositions() {
		if ($this->_version == 1) {
			return array();
		}
		$numAlign = (int)floor($this->_version / 7) + 2;
		$step = (int)floor(($this->_version * 8 + $numAlign * 3 + 5) / ($numAlign * 4 - 4)) * 2;
		$result = array();
		for ($i = 0, $pos = $this->_size - 7; $i < $numAlign - 1; $i++, $pos -= $step) {
			array_unshift($result, $pos);
		}
		array_unshift($result, 6);
		return $result;
	}

	protected function _drawFormatBits($mask) {
		$data = (self::$_eccFormatBits[$this->_ecc] << 3) | $mask;
		$rem = $data;
		for ($i = 0; $i < 10; $i++) {
			$rem = ($rem << 1) ^ (($rem >> 9) * 0x537);
		}
		$bits = (($data << 10) | $rem) ^ 0x5412;
		$size = $this->_size;

		// First copy, around the top-left finder.
		for ($i = 0; $i <= 5; $i++) {
			$this->_setFunctionModule(8, $i, ($bits >> $i) & 1);
		}
		$this->_setFunctionModule(8, 7, ($bits >> 6) & 1);
		$this->_setFunctionModule(8, 8, ($bits >> 7) & 1);
		$this->_setFunctionModule(7, 8, ($bits >> 8) & 1);
		for ($i = 9; $i < 15; $i++) {
			$this->_setFunctionModule(14 - $i, 8, ($bits >> $i) & 1);
		}

		// Second copy, split between the other two finders.
		for ($i = 0; $i < 8; $i++) {
			$this->_setFunctionModule($size - 1 - $i, 8, ($bits >> $i) & 1);
		}
		for ($i = 8; $i < 15; $i++) {
			$this->_setFunctionModule(8, $size - 15 + $i, ($bits >> $i) & 1);
		}
		$this->_setFunctionModule(8, $size - 8, true); // always-dark module
	}

	protected function _drawVersion() {
		if ($this->_version < 7) {
			return;
		}
		$rem = $this->_version;
		for ($i = 0; $i < 12; $i++) {
			$rem = ($rem << 1) ^ (($rem >> 11) * 0x1F25);
		}
		$bits = ($this->_version << 12) | $rem;
		for ($i = 0; $i < 18; $i++) {
			$bit = ($bits >> $i) & 1;
			$a = $this->_size - 11 + $i % 3;
			$b = (int)floor($i / 3);
			$this->_setFunctionModule($a, $b, $bit);
			$this->_setFunctionModule($b, $a, $bit);
		}
	}

	protected function _addEccAndInterleave($data) {
		$version = $this->_version;
		$numBlocks = self::$_numErrorCorrectionBlocks[$this->_ecc][$version];
		$blockEccLen = self::$_eccCodewordsPerBlock[$this->_ecc][$version];
		$rawCodewords = self::_numRawDataModules($version) >> 3;
		$numShortBlocks = $numBlocks - $rawCodewords % $numBlocks;
		$shortBlockLen = (int)floor($rawCodewords / $numBlocks);

		$divisor = self::_reedSolomonDivisor($blockEccLen);
		$blocks = array();
		for ($i = 0, $k = 0; $i < $numBlocks; $i++) {
			$dat = array_slice($data, $k, $shortBlockLen - $blockEccLen + ($i < $numShortBlocks ? 0 : 1));
			$k += count($dat);
			$ecc = self::_reedSolomonRemainder($dat, $divisor);
			if ($i < $numShortBlocks) {
				$dat[] = 0; // padding so all blocks are the same length; skipped below
			}
			$blocks[] = array_merge($dat, $ecc);
		}

		$result = array();
		$blockLen = count($blocks[0]);
		for ($i = 0; $i < $blockLen; $i++) {
			foreach ($blocks as $j => $block) {
				if ($i != $shortBlockLen - $blockEccLen || $j >= $numShortBlocks) {
					$result[] = $block[$i];
				}
			}
		}
		return $result;
	}

	protected static function _reedSolomonDivisor($degree) {
		$result = array_fill(0, $degree, 0);
		$result[$degree - 1] = 1;
		$root = 1;
		for ($i = 0; $i < $degree; $i++) {
			for ($j = 0; $j < $degree; $j++) {
				$result[$j] = self::_reedSolomonMultiply($result[$j], $root);
				if ($j + 1 < $degree) {
					$result[$j] ^= $result[$j + 1];
				}
			}
			$root = self::_reedSolomonMultiply($root, 0x02);
		}
		return $result;
	}

	protected static function _reedSolomonRemainder($data, $divisor) {
		$degree = count($divisor);
		$result = array_fill(0, $degree, 0);
		foreach ($data as $b) {
			$factor = $b ^ array_shift($result);
			$result[] = 0;
			for ($i = 0; $i < $degree; $i++) {
				$result[$i] ^= self::_reedSolomonMultiply($divisor[$i], $factor);
			}
		}
		return $result;
	}

	protected static function _reedSolomonMultiply($x, $y) {
		$z = 0;
		for ($i = 7; $i >= 0; $i--) {
			$z = (($z << 1) ^ (($z >> 7) * 0x11D)) & 0xFF;
			$z ^= (($y >> $i) & 1) * $x;
		}
		return $z;
	}

	protected function _drawCodewords($data) {
		$size = $this->_size;
		$totalBits = count($data) * 8;
		$i = 0;
		// Zig-zag through column pairs from the bottom-right, skipping the vertical timing column.
		for ($right = $size - 1; $right >= 1; $right -= 2) {
			if ($right == 6) {
				$right = 5;
			}
			$upward = (($right + 1) & 2) == 0;
			for ($vert = 0; $vert < $size; $vert++) {
				$y = $upward ? $size - 1 - $vert : $vert;
				for ($j = 0; $j < 2; $j++) {
					$x = $right - $j;
					if (!$this->_isFunction[$y][$x] && $i < $totalBits) {
						$this->_modules[$y][$x] = (($data[$i >> 3] >> (7 - ($i & 7))) & 1) == 1;
						$i++;
					}
				}
			}
		}
	}

	protected function _applyMask($mask) {
		for ($y = 0; $y < $this->_size; $y++) {
			for ($x = 0; $x < $this->_size; $x++) {
				if ($this->_isFunction[$y][$x]) {
					continue;
				}
				switch ($mask) {
					case 0: $invert = ($x + $y) % 2 == 0; break;
					case 1: $invert = $y % 2 == 0; break;
					case 2: $invert = $x % 3 == 0; break;
					case 3: $invert = ($x + $y) % 3 == 0; break;
					case 4: $invert = ((int)floor($x / 3) + (int)floor($y / 2)) % 2 == 0; break;
					case 5: $invert = $x * $y % 2 + $x * $y % 3 == 0; break;
					case 6: $invert = ($x * $y % 2 + $x * $y % 3) % 2 == 0; break;
					default: $invert = (($x + $y) % 2 + $x * $y % 3) % 2 == 0; break;
				}
				if ($invert) {
					$this->_modules[$y][$x] = !$this->_modules[$y][$x];
				}
			}
		}
	}

	protected function _penaltyScore() {
		$size = $this->_size;
		$m = $this->_modules;
		$result = 0;
		$finderA = '10111010000';
		$finderB = '00001011101';

		$lines = array();
		for ($y = 0; $y < $size; $y++) {
			$lines[] = $m[$y];
		}
		for ($x = 0; $x < $size; $x++) {
			$col = array();
			for ($y = 0; $y < $size; $y++) {
				$col[] = $m[$y][$x];
			}
			$lines[] = $col;
		}

		foreach ($lines as $line) {
			// N1: runs of five or more same-coloured modules.
			$run = 1;
			for ($i = 1; $i <= $size; $i++) {
				if ($i < $size && $line[$i] === $line[$i - 1]) {
					$run++;
					continue;
				}
				if ($run >= 5) {
					$result += 3 + ($run - 5);
				}
				$run = 1;
			}

			// N3: finder-like 1:1:3:1:1 patterns with a light margin.
			$str = '';
			foreach ($line as $dark) {
				$str .= $dark ? '1' : '0';
			}
			$result += 40 * (substr_count($str, $finderA) + substr_count($str, $finderB));
		}

		// N2: 2x2 blocks of the same colour.
		$dark = 0;
		for ($y = 0; $y < $size; $y++) {
			for ($x = 0; $x < $size; $x++) {
				if ($m[$y][$x]) {
					$dark++;
				}
				if ($x < $size - 1 && $y < $size - 1) {
					$c = $m[$y][$x];
					if ($c === $m[$y][$x + 1] && $c === $m[$y + 1][$x] && $c === $m[$y + 1][$x + 1]) {
						$result += 3;
					}
				}
			}
		}

		// N4: imbalance between dark and light modules.
		$total = $size * $size;
		$k = (int)ceil(abs($dark * 20 - $total * 10) / $total) - 1;
		$result += max(0, $k) * 10;

		return $result;
	}
}
