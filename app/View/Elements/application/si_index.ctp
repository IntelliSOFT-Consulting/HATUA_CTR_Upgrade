<?php
    $this->assign('SI', 'active');
?>

<div class="row-fluid">
  <div class="span12">
    
    <div class="marketing">
      <div class="row-fluid">
            <div class="span12">
              <h3><i class="icon-skype"></i> Site Inspections: <small> <i class="icon-glass"></i> Filter, <i class="icon-search"></i> Search, and <i class="icon-eye-open"></i> view reports</small></h3>
              <hr class="soften" style="margin: 7px 0px;">
            </div>
        </div>
    </div>

    <?php
        echo $this->Form->create('SiteInspection', array(
          'url' => array_merge(array('action' => 'index'), $this->params['pass']),
          'class' => 'ctr-groups', 'style'=>array('padding:9px;', 'background-color: #F5F5F5'),
        ));
      ?>
      <table class="table table-condensed table-bordered" style="margin-bottom: 2px;">
        <thead>
          <tr>
            <th style="width: 15%;">
              <?php
                echo $this->Form->input('reference_no',
                    array('div' => false, 'class' => 'span12 unauthorized_index', 'label' => array('class' => 'required', 'text' => 'Reference No.')));
              ?>
              </th>
              <th>
              <?php
                echo $this->Form->input('protocol_no', array('div' => false, 'class' => 'span12 unauthorized_index',
                  'label' => array('class' => 'required', 'text' => 'Protocol No.'),
                  'type' => 'text',
                  ));
              ?>
              </th>
              <th>
              <?php
                echo $this->Form->input('start_date',
                  array('div' => false, 'type' => 'text', 'class' => 'input-small unauthorized_index', 'after' => '-to-',
                      'label' => array('class' => 'required', 'text' => 'Inspection Create Dates'), 'placeHolder' => 'Start Date'));
                echo $this->Form->input('end_date',
                  array('div' => false, 'type' => 'text', 'class' => 'input-small unauthorized_index',
                       'after' => '<a style="font-weight:normal" onclick="$(\'.unauthorized_index\').val(\'\');" >
                            <em class="accordion-toggle">clear!</em></a>',
                      'label' => false, 'placeHolder' => 'End Date'));
              ?>
              </th>
              <th>
                <?php
                  echo $this->Form->input('pages', array(
                    'type' => 'select', 'div' => false, 'class' => 'span12', 'selected' => $this->request->params['paging']['SiteInspection']['limit'],
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
                  // echo $this->Html->link('<i class="icon-file-alt"></i> Excel', array('action' => 'index', 'ext' => 'csv'), array('class' => 'btn btn-success', 'escape' => false));
                  echo $this->Html->link('<i class="icon-file-alt"></i> Excel', array_merge(array('action' => 'index', 'ext' => 'csv'), $this->request->named), array('class' => 'btn btn-success', 'escape' => false));
                ?>
              </th>
          </tr>
        </thead>
      </table>
    <p>
      <?php
        echo $this->Paginator->counter(array(
        'format' => __('Page <span class="badge">{:page}</span> of <span class="badge">{:pages}</span>,
                showing <span class="badge">{:current}</span> Site Inspections out of
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
        <th><?php echo $this->Paginator->sort('reference_no'); ?></th>
        <th><?php echo $this->Paginator->sort('application_id'); ?></th>
        <th><?php echo $this->Paginator->sort('pactr_number'); ?></th>
        <th><?php echo $this->Paginator->sort('country'); ?></th>
        <th><?php echo $this->Paginator->sort('outcome'); ?></th>
        <th><?php echo $this->Paginator->sort('created'); ?></th>
        <th class="actions"><?php echo __('Actions'); ?></th>
          </tr>
       </thead>
      <tbody>
    <?php
    foreach ($siteInspections as $siteInspection): ?>
    <tr class="">
        <td><?php echo h($siteInspection['SiteInspection']['id']); ?>&nbsp;</td>
        <td><?php echo h($siteInspection['SiteInspection']['reference_no']); ?>&nbsp;</td>
        <td><?php 
          // echo h($siteInspection['Application']['protocol_no']); 
        echo $this->Html->link($siteInspection['Application']['protocol_no'], array('controller' => 'applications' , 'action' => 'view', $siteInspection['Application']['id'], 
              'inspection_id' => $siteInspection['SiteInspection']['id']), array('escape' => false));
        ?>&nbsp;</td>
        <td><?php echo h($siteInspection['SiteInspection']['pactr_number']); ?>&nbsp;</td>
        <td><?php echo h($siteInspection['SiteInspection']['inspection_country']); ?>&nbsp;</td>
        <td><?php echo h($siteInspection['SiteInspection']['outcome']); ?>&nbsp;</td>
        <td><?php echo h($siteInspection['SiteInspection']['created']); ?>&nbsp;</td>
        <td class="actions">
            <?php echo $this->Html->link('<label class="label label-info">View</label>',
                             array('controller' => 'applications' ,'action' => 'view', $siteInspection['Application']['id'], 'inspection_id' => $siteInspection['SiteInspection']['id']), array('escape'=>false)); ?>
            <?php
              if(($siteInspection['SiteInspection']['user_id'] == $this->Session->read('Auth.User.id') || $redir === 'manager') && $siteInspection['SiteInspection']['approved'] < 1) {
                echo $this->Form->postLink(__('<label class="label label-important">Delete</label>'), array('action' => 'delete', $siteInspection['SiteInspection']['id'], 1), array('escape' => false), __('Are you sure you want to delete # %s?', $siteInspection['SiteInspection']['reference_no']));
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
  var adates = $('#SiteInspectionStartDate, #SiteInspectionEndDate').datepicker({
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
            var option = this.id == "SiteInspectionStartDate" ? "minDate" : "maxDate",
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