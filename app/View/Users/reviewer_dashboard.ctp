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
			<h4>My Applications</h4>
			<p>A list of protocols that I have accepted to review</p>
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
			<?php echo $this->Html->link('<i class="icon-link"></i> View All Applications', array('controller' => 'applications', 'action' => 'index'),
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
				foreach ($notifications as $notification) {
					echo '<div class="alert" id="'.$notification['Notification']['id'].'">';
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
			?>
			</dl>
		  </div>
		</div>
	  </li>
	</ul>
  </div>
 </section>
