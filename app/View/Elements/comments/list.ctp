<!-- <div class="row"> -->
<!-- <div class="col-xs-12"> -->
<?php
foreach ($comments as $key => $comment) {
?>
 <a class="btn btn-link btn-comment" role="button" data-toggle="collapse" href="#comment<?php echo $comment['id'] ?>" aria-controls="comment<?php echo $comment['id'] ?>">
        <?php echo ($key + 1) . '.  ' . $comment['sender'] . ' <small><em>' . $comment['created'] . '</em></small> <br><small class="muted">' . $comment['category'] . '</small>' ?>
    </a>
  <div id="comment<?php echo $comment['id'] ?>" class="bs-example collapse show">
    <table class="table table-condensed">
      <tbody>
        <tr>
          <th>
            <p><strong>Sender</strong></p>
          </th>
          <td>
            <div>
              <p class="form-control-static"><?php echo $comment['sender'] ?></p>
            </div>
          </td>
        </tr>
        <tr>
          <th>
            <p><strong>Subject</strong>
          </th>
          <td>
            <p class="form-control-static"><?php echo $comment['subject'] ?></p>
          </td>
        </tr>
        <tr>
          <th>
            <p><strong> Content </strong>
          </th>
          <td>
            <p class="form-control-static"><?php echo $comment['content'] ?></p>
          </td>
  </div>
  <tr>
    <th>
      <p> <strong> File(s) </strong> </p>
    </th>
    <td>
      <?php
      if (isset($comment['Attachment'])) {
        foreach ($comment['Attachment'] as $key => $value) {
          echo '<p>';
          echo $this->Html->link(
            __($value['basename']),
            array(
              'controller' => 'comments',  'action' => 'comment_file_download', $value['id'],
              'admin' => false
            ),
            array('class' => 'btn btn-link')
          );
          // echo $this->Html->link($value['basename'], substr($value['file'], 24), ['fullBase' => true]);
          echo '</p>';
        }
      }

      ?>
    </td>
  </tr>
  <tr>
    <th><?php
        if ($redir === 'applicant' && $comment['user_id'] != $this->Session->read('Auth.User.id')) {

          if ($show) {
            echo $this->Html->link(
              __('<i class="icon-download-alt"></i>  <small>Download</small>'),
              array('controller' => 'comments', 'ext' => 'pdf', 'action' => 'comment_content_download', $comment['id']),
              array('escape' => false, 'class' => 'btn pull-right', 'style' => 'margin-right: 10px;')
            );
          }
        }
        ?>
    </th>
  </tr>
  </tbody>
  </table>
  </div><br>
<?php } ?>
<!-- </div> -->
<!-- </div> -->