<div class="ctr-groups"> 
    <?php echo $Comment['Comment']["content"]; ?>
    <br>
    <?php
     if (!empty($Comment['Comment']['qrcode'])) {
        $decodedImage = base64_decode($Comment['Comment']['qrcode']);
        echo $decodedImage;
      }
    
    ?>
     
</div>