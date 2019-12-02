<?php
    $this->assign('MEETINGS', 'active');
?>

<div class="row-fluid">
  <div class="span12">
    
    <div class="marketing">
      <div class="row-fluid">
            <div class="span12">
              <h3>Meeting Dates:<small> <i class="icon-glass"></i> Filter, <i class="icon-search"></i> Search, and <i class="icon-eye-open"></i> view reports</small></h3>
              <hr class="soften" style="margin: 7px 0px;">
            </div>
        </div>
    </div>

    <div class="pagination">
      <ul>
      <?php
        echo $this->Paginator->prev('&laquo;', array('tag' => 'li', 'escape' => false), null, array('class' => 'disabled', 'tag' => 'li', 'escape' => false));
        echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentClass' => 'active'));
        echo $this->Paginator->next('&raquo;', array('tag' => 'li', 'escape' => false), null, array('class' => 'disabled', 'tag' => 'li', 'escape' => false ));
      ?>
      </ul>
    </div>

    <table  class="table  table-bordered table-striped">
     <thead>
            <tr>
        <th><?php echo $this->Paginator->sort('id'); ?></th>
        <th><?php echo $this->Paginator->sort('proposed_date1'); ?></th>
        <th><?php echo $this->Paginator->sort('proposed_date2'); ?></th>
        <th><?php echo $this->Paginator->sort('created'); ?></th>
        <th class="actions"><?php echo __('Actions'); ?></th>
          </tr>
       </thead>
      <tbody>
    <?php
    foreach ($meetingDates as $meetingDate): ?>
    <tr class="">
        <td><?php echo h($meetingDate['MeetingDate']['id']); ?>&nbsp;</td>
        <td><?php echo h($meetingDate['MeetingDate']['proposed_date1']); ?>&nbsp;</td>
        <td><?php echo h($meetingDate['MeetingDate']['proposed_date2']); ?>&nbsp;</td>
        <td><?php echo h($meetingDate['MeetingDate']['created']); ?>&nbsp;</td>
        <td class="actions">
            <?php if($meetingDate['MeetingDate']['approved'] > 0) echo $this->Html->link(__('<label class="label label-info">View</label>'), array('action' => 'view', $meetingDate['MeetingDate']['id']), array('escape' => false)); ?>
            <?php if($redir === 'applicant' && $meetingDate['MeetingDate']['approved'] < 1) echo $this->Html->link(__('<label class="label label-success">Edit</label>'), array('action' => 'edit', $meetingDate['MeetingDate']['id']), array('escape' => false)); ?>
            <?php
              if($meetingDate['MeetingDate']['approved'] < 1) {
                echo $this->Form->postLink(__('<label class="label label-important">Delete</label>'), array('action' => 'delete', $meetingDate['MeetingDate']['id'], 1), array('escape' => false), __('Are you sure you want to delete # %s?', $meetingDate['MeetingDate']['id']));
              } 
            ?>            
        </td>
    </tr>
<?php endforeach; ?>
        </tbody>
    </table>
  </div>
</div>

<script type="text/javascript">
$(function() {
  $(".morecontent").expander();
  var adates = $('#MeetingDateStartDate, #MeetingDateEndDate').datepicker({
          minDate:"-100Y",
          maxDate:"-0D",
          dateFormat:'dd-mm-yy',
          format: 'dd-mm-yyyy',
          endDate: '-0d',
          showButtonPanel:true,
          changeMonth:true,
          changeYear:true,
          showAnim:'show',
          onSelect: function( selectedDate ) {
            var option = this.id == "MeetingDateStartDate" ? "minDate" : "maxDate",
              instance = $( this ).data( "datepicker" ),
              date = $.datepicker.parseDate(
                instance.settings.dateFormat ||
                $.datepicker._defaults.dateFormat,
                selectedDate, instance.settings );
            adates.not( this ).datepicker( "option", option, date );
          }
        });

});
</script>