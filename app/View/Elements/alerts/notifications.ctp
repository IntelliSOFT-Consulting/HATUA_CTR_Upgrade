<?php
if ($redir === 'reviewer') {
    foreach ($notifications as $notification) {
        echo '<div class="alert alert-'.$messages[$notification['Notification']['type']].'" id="'.$notification['Notification']['id'].'">';
        echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
        if ($notification['Notification']['type'] == 'reviewer_new_application') {
            echo "<p>".$notification['Notification']['title']."</p>";
            // echo "<dt>  <a >".$notification['Notification']['title']."</a></dt>";
            echo "<p>".$notification['Notification']['system_message']."</p>";
            echo "<p><i class='icon-comment-alt'></i>Manager PPB: ".$notification['Notification']['user_message']."</p>";
        }   elseif ($notification['Notification']['type'] == 'reviewers_approve_message') {
            echo "<p>".$notification['Notification']['title']."</p>";
            echo "<p>".$notification['Notification']['system_message']."</p>";
            echo "<p><i class='icon-comment-alt'></i> ".$notification['Notification']['user_message']."</p>";
        }
        echo "</div>";
    }
} elseif ($redir === 'partner') {
  foreach ($notifications as $notification) {
      echo '<div class="alert alert-'.$messages[$notification['Notification']['type']].'" id="'.$notification['Notification']['id'].'">';
      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
      if ($notification['Notification']['type'] == 'manager_new_application') {
        echo "<p><i class='icon-star-empty'></i>".$notification['Notification']['title']."</p>";
        echo "<p>".$notification['Notification']['system_message']."</p>";
      } elseif ($notification['Notification']['type'] == 'manager_reviewer_response') {
        echo "<p>".$notification['Notification']['system_message']." ".$this->Html->link($notification['Notification']['title'], array('controller' => 'applications', 'action' => 'view_notification', $notification['Notification']['foreign_key'], $notification['Notification']['id']), array('escape' => false, ))."</p>";
      }  elseif ($notification['Notification']['type'] == 'new_reviewer_comment') {
        echo "<p>".$notification['Notification']['system_message']." ".$this->Html->link($notification['Notification']['title'], array('controller' => 'applications', 'action' => 'view_notification', $notification['Notification']['foreign_key'], $notification['Notification']['id']), array('escape' => false, ))."</p>";
      }  elseif ($notification['Notification']['type'] == 'managers_approve_message') {
        echo "<p>".$notification['Notification']['title']."</p>";
        echo "<p>".$notification['Notification']['system_message']."</p>";
        echo "<p><i class='icon-comment-alt'></i> ".$notification['Notification']['user_message']."</p>";
      } else {
        // pr($notification);
        echo "<p>".$notification['Notification']['title']."</p>";
        echo "<p>".$notification['Notification']['system_message']."</p>";
        echo "<p><i class='icon-comment-alt'></i> ".$notification['Notification']['user_message']."</p>";
      }
      echo '</div>';
  }
} elseif ($redir === 'manager') {
  foreach ($notifications as $notification) {
      echo '<div class="alert alert-'.$messages[$notification['Notification']['type']].'" id="'.$notification['Notification']['id'].'">';
      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
      if ($notification['Notification']['type'] == 'manager_new_application') {
        echo "<p><i class='icon-star-empty'></i>".$notification['Notification']['title']."</p>";
        echo "<p>".$notification['Notification']['system_message']."</p>";
      } elseif ($notification['Notification']['type'] == 'manager_reviewer_response') {
        echo "<p>".$notification['Notification']['system_message']." ".$this->Html->link($notification['Notification']['title'], array('controller' => 'applications', 'action' => 'view_notification', $notification['Notification']['foreign_key'], $notification['Notification']['id']), array('escape' => false, ))."</p>";
      }  elseif ($notification['Notification']['type'] == 'new_reviewer_comment') {
        echo "<p>".$notification['Notification']['system_message']." ".$this->Html->link($notification['Notification']['title'], array('controller' => 'applications', 'action' => 'view_notification', $notification['Notification']['foreign_key'], $notification['Notification']['id']), array('escape' => false, ))."</p>";
      }  elseif ($notification['Notification']['type'] == 'managers_approve_message') {
        echo "<p>".$notification['Notification']['title']."</p>";
        echo "<p>".$notification['Notification']['system_message']."</p>";
        echo "<p><i class='icon-comment-alt'></i> ".$notification['Notification']['user_message']."</p>";
      } else {
        // pr($notification);
        echo "<p>".$notification['Notification']['title']."</p>";
        echo "<p>".$notification['Notification']['system_message']."</p>";
        echo "<p><i class='icon-comment-alt'></i> ".$notification['Notification']['user_message']."</p>";
      }
      echo '</div>';
  }
} elseif ($redir === 'applicant') {
  foreach ($notifications as $notification) {
        echo '<div class="alert alert-'.$messages[$notification['Notification']['type']].'" id="'.$notification['Notification']['id'].'">';
        echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
        if ($notification['Notification']['type'] == 'registration_welcome') {
            echo '<strong>'.$notification['Notification']['title'].'</strong>';
            echo "<br/><small>".$notification['Notification']['system_message']."</small>";
        } elseif ($notification['Notification']['type'] == 'manager_comment_applicant') {
            echo '<strong>'.$notification['Notification']['system_message'].'</strong>';
        } elseif ($notification['Notification']['type'] == 'applicant_approve_message') {
            echo "<strong>".$notification['Notification']['title']."</strong>";
            echo "<br/><small>".$notification['Notification']['system_message']."</small>";
            echo "<blockquote><p> ".$notification['Notification']['user_message']."</p><small>PPB Comment</small></blockquote>";
        } elseif ($notification['Notification']['type'] == 'applicant_new_amendment') {
            echo "<p>".$notification['Notification']['system_message']."</p>";
        } else {
            echo "<strong>".$notification['Notification']['title']."</strong>";
            echo "<br/><small>".$notification['Notification']['system_message']."</small>";
            echo "<p> ".$notification['Notification']['user_message']."</p>";
        }
        echo '</div>';
    }
} elseif ($redir === 'admin') {
  foreach ($notifications as $notification) {
      echo '<div class="alert alert-'.$messages[$notification['Notification']['type']].'" id="'.$notification['Notification']['id'].'">';
      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
      if ($notification['Notification']['type'] == 'manager_new_application') {
        echo "<p><i class='icon-star-empty'></i>".$notification['Notification']['title']."</p>";
        echo "<p>".$notification['Notification']['system_message']."</p>";
      } elseif ($notification['Notification']['type'] == 'manager_reviewer_response') {
        echo "<p>".$notification['Notification']['system_message']." ".$this->Html->link($notification['Notification']['title'], array('controller' => 'applications', 'action' => 'view_notification', $notification['Notification']['foreign_key'], $notification['Notification']['id']), array('escape' => false, ))."</p>";
      }  elseif ($notification['Notification']['type'] == 'new_reviewer_comment') {
        echo "<p>".$notification['Notification']['system_message']." ".$this->Html->link($notification['Notification']['title'], array('controller' => 'applications', 'action' => 'view_notification', $notification['Notification']['foreign_key'], $notification['Notification']['id']), array('escape' => false, ))."</p>";
      }  elseif ($notification['Notification']['type'] == 'managers_approve_message') {
        echo "<p>".$notification['Notification']['title']."</p>";
        echo "<p>".$notification['Notification']['system_message']."</p>";
        echo "<p><i class='icon-comment-alt'></i> ".$notification['Notification']['user_message']."</p>";
      } else {
        // pr($notification);
        echo "<p>".$notification['Notification']['title']."</p>";
        echo "<p>".$notification['Notification']['system_message']."</p>";
        echo "<p><i class='icon-comment-alt'></i> ".$notification['Notification']['user_message']."</p>";
      }
      echo '</div>';
    }
} elseif ($redir === 'inspector') {
  foreach ($notifications as $notification) {
      echo '<div class="alert alert-'.$messages[$notification['Notification']['type']].'" id="'.$notification['Notification']['id'].'">';
      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
      if ($notification['Notification']['type'] == 'manager_new_application') {
        echo "<p><i class='icon-star-empty'></i>".$notification['Notification']['title']."</p>";
        echo "<p>".$notification['Notification']['system_message']."</p>";
      } elseif ($notification['Notification']['type'] == 'manager_reviewer_response') {
        echo "<p>".$notification['Notification']['system_message']." ".$this->Html->link($notification['Notification']['title'], array('controller' => 'applications', 'action' => 'view_notification', $notification['Notification']['foreign_key'], $notification['Notification']['id']), array('escape' => false, ))."</p>";
      }  elseif ($notification['Notification']['type'] == 'new_reviewer_comment') {
        echo "<p>".$notification['Notification']['system_message']." ".$this->Html->link($notification['Notification']['title'], array('controller' => 'applications', 'action' => 'view_notification', $notification['Notification']['foreign_key'], $notification['Notification']['id']), array('escape' => false, ))."</p>";
      }  elseif ($notification['Notification']['type'] == 'managers_approve_message') {
        echo "<p>".$notification['Notification']['title']."</p>";
        echo "<p>".$notification['Notification']['system_message']."</p>";
        echo "<p><i class='icon-comment-alt'></i> ".$notification['Notification']['user_message']."</p>";
      } else {
        // pr($notification);
        echo "<p>".$notification['Notification']['title']."</p>";
        echo "<p>".$notification['Notification']['system_message']."</p>";
        echo "<p><i class='icon-comment-alt'></i> ".$notification['Notification']['user_message']."</p>";
      }
      echo '</div>';
    }
} else {
	foreach ($notifications as $notification) {
      echo '<div class="alert alert-'.$messages[$notification['Notification']['type']].'" id="'.$notification['Notification']['id'].'">';
      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
      if ($notification['Notification']['type'] == 'manager_new_application') {
        echo "<p><i class='icon-star-empty'></i>".$notification['Notification']['title']."</p>";
        echo "<p>".$notification['Notification']['system_message']."</p>";
      } elseif ($notification['Notification']['type'] == 'manager_reviewer_response') {
        echo "<p>".$notification['Notification']['system_message']." ".$this->Html->link($notification['Notification']['title'], array('controller' => 'applications', 'action' => 'view_notification', $notification['Notification']['foreign_key'], $notification['Notification']['id']), array('escape' => false, ))."</p>";
      }  elseif ($notification['Notification']['type'] == 'new_reviewer_comment') {
        echo "<p>".$notification['Notification']['system_message']." ".$this->Html->link($notification['Notification']['title'], array('controller' => 'applications', 'action' => 'view_notification', $notification['Notification']['foreign_key'], $notification['Notification']['id']), array('escape' => false, ))."</p>";
      }  elseif ($notification['Notification']['type'] == 'managers_approve_message') {
        echo "<p>".$notification['Notification']['title']."</p>";
        echo "<p>".$notification['Notification']['system_message']."</p>";
        echo "<p><i class='icon-comment-alt'></i> ".$notification['Notification']['user_message']."</p>";
      } else {
        // pr($notification);
        echo "<p>".$notification['Notification']['title']."</p>";
        echo "<p>".$notification['Notification']['system_message']."</p>";
        echo "<p><i class='icon-comment-alt'></i> ".$notification['Notification']['user_message']."</p>";
      }
      echo '</div>';
    }
}
?>