<?php
    $this->assign('MEETINGS', 'active');
?>

<div class="row-fluid">
  <div class="span12">
    
    <div class="marketing">
      <div class="row-fluid">
            <div class="span12">
              <!-- <h3>Meeting Dates:<small> <i class="icon-glass"></i> Filter, <i class="icon-search"></i> Search, and <i class="icon-eye-open"></i> view reports</small></h3>
              <hr class="soften" style="margin: 7px 0px;"> -->

              <h4>Pre-Submission Meeting</h4>
              <p>
                <small><i class="icon-hand-right"></i> Request for pre-submission meeting to discuss pertinent issues prior to Protocol submission.</small>
              <br>
                <small><i class="icon-hand-right"></i> The request for a meeting should propose two different dates for the meeting with the proposed dates being at lease three weeks away.</small>
              </p>



              <?php
                if($redir == 'applicant') {
                    echo $this->Form->postLink(__('Create'), array('action' => 'add'), 
                        array('class' => 'btn btn-primary btn-small', 'prefix' => false), 
                        __('Create new meeting dates??'));
                }
              ?>

            </div>
        </div>
    </div>


    <?php
        echo $this->Form->create('MeetingDate', array(
          'url' => array_merge(array('action' => 'index'), $this->params['pass']),
          'class' => 'ctr-groups', 'style'=>array('padding:9px;', 'background-color: #F5F5F5'),
        ));
      ?>
      <table class="table table-condensed table-bordered" style="margin-bottom: 2px;">
        <thead>
          <tr>
            <th style="width: 15%;">
              <?php
                echo $this->Form->input('email',
                    array('div' => false, 'class' => 'span12 unauthorized_index', 'label' => array('class' => 'required', 'text' => 'Email')));
              ?>
              </th>
              <th>
              <?php
                echo $this->Form->input('start_date',
                  array('div' => false, 'type' => 'text', 'class' => 'input-medium unauthorized_index', 'after' => '-to-',
                      'label' => array('class' => 'required', 'text' => 'Proposed Meeting Dates'), 'placeHolder' => 'Start Date'));
                echo $this->Form->input('end_date',
                  array('div' => false, 'type' => 'text', 'class' => 'input-medium unauthorized_index',
                       'after' => '<a style="font-weight:normal" onclick="$(\'.unauthorized_index\').val(\'\');" >
                            <em class="accordion-toggle">clear!</em></a>',
                      'label' => false, 'placeHolder' => 'End Date'));
              ?>
              </th>
              <th>
                <?php
                  echo $this->Form->input('pages', array(
                    'type' => 'select', 'div' => false, 'class' => 'span12', 'selected' => $this->request->params['paging']['MeetingDate']['limit'],
                    'empty' => true,
                    'options' => $page_options,
                    'label' => array('class' => 'required', 'text' => 'Pages'),
                  ));
                ?>
              </th>
              <th rowspan="2" style="width: 14%;">
                <?php
                  echo $this->Form->button('<i class="icon-search icon-white"></i> Search', array(
                      'class' => 'btn btn-inverse', 'div' => 'control-group', 'div' => false,
                      'style' => array('margin-bottom: 5px')
                  ));

                  echo $this->Html->link('<i class="icon-remove"></i> Clear', array('action' => 'index'), array('class' => 'btn', 'escape' => false, 'style' => array('margin-bottom: 5px')));echo "<br>";
                  echo $this->Html->link('<i class="icon-file-alt"></i> Excel', array('action' => 'index', 'ext' => 'csv'), array('class' => 'btn btn-success', 'escape' => false));
                ?>
              </th>
          </tr>
        </thead>
      </table>
    <p>
      <?php
        echo $this->Paginator->counter(array(
        'format' => __('Page <span class="badge">{:page}</span> of <span class="badge">{:pages}</span>,
                showing <span class="badge">{:current}</span> SAEs out of
                <span class="badge badge-inverse">{:count}</span> total, starting on record <span class="badge">{:start}</span>,
                ending on <span class="badge">{:end}</span>')
        ));
      ?>
    </p>
    <?php echo $this->Form->end(); ?>


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
        <th><?php echo $this->Paginator->sort('email'); ?></th>
        <th><?php echo $this->Paginator->sort('final_decision'); ?></th>
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
        <td><?php echo h($meetingDate['MeetingDate']['email']); ?>&nbsp;</td>
        <td><?php echo h($meetingDate['MeetingDate']['final_decision']); ?>&nbsp;</td>
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
          minDate:"-1Y",
          // maxDate:"-0D",
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