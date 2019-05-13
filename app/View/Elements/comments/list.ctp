<!-- <div class="row"> -->
    <!-- <div class="col-xs-12"> -->
      <?php 
        foreach ($comments as $key => $comment) {
      ?>
      <a class="btn btn-link" role="button" data-toggle="collapse" href="#comment<?php $comment['id'] ?>" aria-expanded="false" 
            aria-controls="comment<?php $comment['id'] ?>">
        <?php ($key+1).'.  '.$comment['sender'].' <small><em>'.$comment['created'].'</em></small> <br><small class="muted">'.$comment['category'].'</small>' ?>
      </a>
        <div id="comment<?php $comment['id'] ?>" class="bs-example">
              <form>
                <div class="form-group">
                  <label class="control-label">Sender</label>
                  <div>
                    <p class="form-control-static"><?php echo $comment['sender'] ?></p>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label">Subject</label>
                  <div>
                    <p class="form-control-static"><?php echo $comment['subject'] ?></p>
                  </div>
                </div> 
                <div class="form-group">
                  <label class="control-label">Content</label>
                  <div>
                  <p class="form-control-static"><?php echo $comment['content'] ?></p>
                  </div> 
                </div> 
                <div class="form-group">
                  <label class="control-label">File(s)</label>

                </div> 
              </form> 
        </div><br>
        <?php } ?>
    <!-- </div> -->
<!-- </div> -->