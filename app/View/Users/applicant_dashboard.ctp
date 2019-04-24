<?php
	$this->assign('Dashboard', 'active');
	$this->Html->script('dashboard', array('inline' => false));
	$this->Html->script('bootstrap-editable', array('inline' => false));
    $this->Html->css('bootstrap-editable', null, array('inline' => false));
?>
<section>
<div class="row-fluid">
	<ul class="thumbnails">
	  <li class="span4">
		<div class="thumbnail">
		  <img alt="" src="/img/authenticated/text.png">
		  <div class="caption">
			<h4>New Application</h4>
			<?php
				echo $this->Form->create('Application');
				echo $this->Form->input('email_address', array('type' => 'email', 'value' => $this->Session->read('Auth.User.email')));
				echo $this->Form->end(array(
					'label' => 'Create',
					'value' => 'Create',
					'class' => 'btn btn-success btn-large',
					// 'div' => array(
						// 'class' => 'form-actions',
					// )
				));
				// echo $this->Form->end(__('Submit'), array('class' => 'btn btn-large btn-success'));
			?>
			<hr>
			<p><small><i class="icon-minus"></i> <span class="label label-info">NOTE!</span> Fields marked with <span class="sterix">*</span> are mandatory and your application will not be submitted to PPB without first completing them.</small></p>
			<p><small><i class="icon-minus"></i> Notifications will be sent to the email address entered above</small></p>

		  </div>
		</div>
	  </li>
	  <li class="span4">
		<div class="thumbnail">
		  <img alt="" src="/img/authenticated/preferences_composer.png">
		  <div class="caption">
			<h4>Recent Protocols</h4>
			<ol><?php
				 foreach($applications as $application) {
					if($application['Application']['submitted']) {
						$ndata = $application['Application']['study_drug'].' ('.$application['Application']['protocol_no'].')';
						echo $this->Html->link('<li>'.$ndata.'</li>', array('controller' => 'applications', 'action' => 'view', $application['Application']['id']),
							array('escape' => false));
						?>
			<!-- Trial status start -->
                <small>
                 Trial Status: 
                  <?php
                    $assoc = array();
                    foreach ($trial_statuses as $i => $value) {
                            $assoc[] = array('value' => $i, 'text' => $value);
                    }
                    // print_r(json_encode($assoc));
                    if(!empty($application['Application']['trial_status_id'])) {
                  ?>
                  <span class="xeditable tiptip" data-type="select" data-name="data[Application][trial_status_id]"
                          data-url="/applicant/applications/view/<?php echo $application["Application"]["id"];?>"
                          data-pk="<?php echo $application['Application']['id'];?>"
                          data-original-title="Update trial status">                                          
                    <?php  echo $trial_statuses[$application['Application']['trial_status_id']]; ?>
                  </span>
                  <?php
                    }
                    else { 
                  ?>                      
                      <span class="xeditable tiptip" data-type="select" data-name="data[Application][trial_status_id]"
                          data-url="/applicant/applications/view/<?php echo $application["Application"]["id"];?>"
                          data-pk="<?php echo $application['Application']['id'];?>"
                          data-original-title="Update trial status">
                      <em>&laquo;(click to set!)&raquo;</em>
                    </span>
                  <?php
                    }
                  ?>
                </small>
            <!-- Trial Status end -->
						<?php
					} else {
						$ndata = (!empty($application['Application']['study_drug'])   ? $application['Application']['study_drug'] : date('d-m-Y h:i a', strtotime($application['Application']['created'])) );
						echo $this->Html->link('<li>'.$ndata.'</li>', array('controller' => 'applications', 'action' => 'edit', $application['Application']['id']),
							array('escape' => false));						
					}
				 }
				 ?>
			</ol>
			<br>
			<?php echo $this->Html->link('<i class="icon-link"></i> View All Applications', array('controller' => 'applications', 'action' => 'index'),
					array('escape' => false, 'class' => 'btn'));?>
		  </div>
		</div>
	  </li>
	  <li class="span4">
		<div class="thumbnail">
		  <img alt="" src="/img/authenticated/preferences_desktop_notification.png">
		  <div class="caption">
			<h4>Notifications <small>Actions that require your attention.</small></h4>
			<!-- <dl class="notifications"> -->
			<?php
				// pr($notifications);
				foreach ($notifications as $notification) {
					echo '<div class="alert" id="'.$notification['Notification']['id'].'">';
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
					}
					echo '</div>';
				}
			?>
			<!-- </dl> -->
		  </div>
		</div>
	  </li>
	 <!--  <li class="span3">
		<div class="thumbnail">
		  <img alt="" src="/img/authenticated/beos_query.png">
		  <div class="caption">
			<h3>Queries</h3>
			<p>Respond to queries raised by reviewers below</p>
		  </div>
		</div>
	  </li> -->
	</ul>
  </div>
 </section>


<script text="type/javascript">
$.fn.editable.defaults.mode = 'popup';
$(function() {
  //$('#data\\[Application\\]\\[approval_date\\] ,  #data\\[Application\\]\\[date_submitted\\]').editable({
  $('.xeditable').editable({
      //url: '/admin/applications/view/<?php echo $application["Application"]["id"];?>',
      ajaxOptions: {
           dataType: 'json' //assuming json response
      },
      value: <?php if(isset($application['Application']['trial_status_id'])) echo $application['Application']['trial_status_id'] ;
                   else echo 0; ?>,
      source: <?php echo json_encode($assoc);?>,
      params: function(params) {
        var data = {};
        data['_method'] = 'POST';
        data['data[Application][id]'] = params.pk;
        data[params.name] = params.value;
        return data;
      }
    });

});
</script>