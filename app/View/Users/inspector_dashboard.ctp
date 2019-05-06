<?php
	$this->assign('Dashboard', 'active');
	$this->Html->script('dashboard', array('inline' => false));
?>
<section>
<div class="row-fluid">
	<ul class="thumbnails">
	  <li class="span6">
		<div class="thumbnail">
		  <img alt="" src="/img/authenticated/preferences_composer.png">
		  <div class="caption">
			<h4>Submitted Protocols</h4>
			<ol><?php
				 foreach($applications as $application) {
					if(!empty($application['Application']['study_drug'])) {
						$ndata = $application['Application']['study_drug'];
					} else {
						$ndata = date('d-m-Y h:i a', strtotime($application['Application']['created']));
					}
					echo $this->Html->link('<li>'.$ndata.'</li>', array('controller' => 'applications', 'action' => 'view', $application['Application']['id']),
							array('escape' => false));
				 }
				 ?>
			</ol>
			<?php echo $this->Html->link('<i class="icon-link"></i> View All Protocols', array('controller' => 'applications', 'action' => 'index'),
					array('escape' => false, 'class' => 'btn'));?>
		  </div>
		</div>
	  </li>
	  <li class="span6">
		<div class="thumbnail">
		  <img alt="" src="/img/authenticated/preferences_desktop_notification.png">
		  <div class="caption">
			<h4>Notifications <small>Actions that require your attention</small> </h4>
			<dl>
	  <?php
		// pr($notifications);
		foreach ($notifications as $notification) {
			echo '<div class="alert" id="'.$notification['Notification']['id'].'">';
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
	  ?>
			</dl>
		  </div>
		</div>
	  </li>
	</ul>
  </div>
 </section>
