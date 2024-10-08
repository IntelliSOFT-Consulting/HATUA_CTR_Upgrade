<?php
  $this->extend('/Elements/application/public_index');
?>

<?php $this->start('header'); ?>
    <?php
      $this->assign('Applications', 'active');
    ?>
    <div class="marketing">
      <div class="row-fluid">
            <div class="span12">
              <h4>Clinical Trial Applications:<small> <i class="icon-glass"></i> Filter, <i class="icon-search"></i> Search, and <i class="icon-eye-open"></i> view applications</small> <?php  echo $this->element('google-recommend');?></h4>
              <!-- <hr style="margin: 10px 0px"> -->
              <hr class="soften" style="margin: 10px 0px;">
            </div>
        </div>
    </div>
<?php $this->end(); ?>

<?php
    $this->assign('color-codes', 'false');
?>

<?php
    $this->assign('attributes', 'application/attributes/public');
 ?>

<?php
/*
	$this->assign('Applications', 'active');
?>
<div class="row-fluid">
  <div class="span12">

    <div class="row-fluid">
      <div class="span12">
        <h4>Clinical Trial Applications:<small> <i class="icon-glass"></i> Filter, <i class="icon-search"></i> Search, and <i class="icon-eye-open"></i> view applications</small></h4>
        <hr style="margin: 10px 0px">
      </div>
    </div>

    <div class="row-fluid">
        <div class="span2">
          <div class="well" style="width:165px; padding:8px;">
            <ul class="nav nav-list">
              <li class="nav-header"><i class="icon-glass"></i> Filter By </li>
              <li class="divider"></li>
              <li class=""><a href="#components"><i class="icon-hand-right"></i> County</a></li>
              <li class=""><a href="#plugins"><i class="icon-hand-right"></i> Phase 1</a></li>
              <li class=""><a href="#variables"><i class="icon-hand-right"></i> Date</a></li>
              <li class="divider"></li>
            </ul>
          </div>
        </div>

        <div class="span10">
      <?php
        echo $this->Form->create('Application', array(
          'url' => array_merge(array('action' => 'index'), $this->params['pass']),
          'class' => 'ctr-groups', 'style'=>array('padding:9px;', 'background-color: #F5F5F5'),
        ));
      ?>
      <div class="row-fluid">
        <div class="span2">
        <?php
          echo $this->Form->input('protocol_no',
              array('div' => false, 'class' => 'span12 unauthorized_index', 'label' => array('class' => 'required', 'text' => 'Protocol No.')));
        ?>
        </div>
        <div class="span3">
        <?php
          echo $this->Form->input('filter', array('div' => false, 'class' => 'span12 unauthorized_index',
            'label' => array('class' => 'required', 'text' => 'Study Title / Abstract'),
            'type' => 'text',
            ));
        ?>
        </div>
        <div class="span4">
        <?php
          echo $this->Form->input('start_date',
            array('div' => false, 'type' => 'text', 'class' => 'input-small unauthorized_index', 'after' => '-to-',
                'label' => array('class' => 'required', 'text' => 'Application Submission Dates'), 'placeHolder' => 'Start Date'));
          echo $this->Form->input('end_date',
            array('div' => false, 'type' => 'text', 'class' => 'input-small unauthorized_index',
                 'after' => '<a style="font-weight:normal" onclick="$(\'.unauthorized_index\').val(\'\');" >
                      <em class="accordion-toggle">clear!</em></a>',
                'label' => false, 'placeHolder' => 'End Date'));
        ?>
        </div>
        <div class="span1">
          <?php
            echo $this->Form->input('pages', array(
              'type' => 'select', 'div' => false, 'class' => 'span12', 'selected' => $this->request->params['paging']['Application']['limit'],
              'empty' => true,
              'options' => $page_options,
              'label' => array('class' => 'required', 'text' => 'Pages'),
            ));
          ?>
        </div>
        <div class="span2">
          <?php
            echo $this->Form->button('<i class="icon-search icon-white"></i> Search', array(
                'class' => 'btn btn-inverse', 'div' => 'control-group', 'div' => false,
                'style' => array('margin-top: 25px')
            ));
          ?>
        </div>
      </div>
        <p>
          <?php
            echo $this->Paginator->counter(array(
            'format' => __('Page <span class="badge">{:page}</span> of <span class="badge">{:pages}</span>,
                    showing <span class="badge">{:current}</span> Applications out of
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

      <div class="row-fluid">
        <?php
          if(count($applications) >  0) { ?>
            <table  class="table  table-bordered table-striped">
            <thead>
              <tr>
                <th style="width:3%">#</th>
                <th style="width: 13%"><?php echo $this->Paginator->sort('protocol_no'); ?></th>
                <th style="width: 26%;"><?php echo $this->Paginator->sort('study_title'); ?></th>
                <th style="width: 26%;"><?php echo $this->Paginator->sort('abstract_of_study'); ?></th>
                <th style="width: 27%">Attributes </th>
                <th style="width: 5%;"><i class="icon-link"></i></th>
              </tr>
            </thead>
            <tbody>
            <?php
            $counder = ($this->request->paging['Application']['page'] - 1) * $this->request->paging['Application']['limit'];
            foreach ($applications as $application):
            ?>
              <tr>
                <td><p class="tablenums"><?php $counder++; echo $counder;?>.</p></td>
                <td>
                   <?php
                        echo $this->Html->link($application['Application']['protocol_no'],
                           array('action' => 'view', $application['Application']['id']), array('escape'=>false));
                  ?>&nbsp;</td>
                <td class="morecontent"> <?php echo $application['Application']['abstract_of_study']; ?> &nbsp; </td>
                <td class="morecontent"> <?php echo $application['Application']['study_title']; ?> &nbsp; </td>
                <td>
                    <form class="form-horizontal" style="margin: 0px">
                      <table class="table table-condensed table-intable" style="margin: 0px">
                        <tbody>
                            <tr>
                              <td class="table-label required">Created</td>
                              <td><?php echo date('d-m-Y h:i a', strtotime($application['Application']['created'])); ?></td>
                            </tr>
                            <tr>
                              <td class="table-label required"  style="width: 40%; padding-right: 0px;">Protocol Date</td>
                              <td><?php echo $application['Application']['date_of_protocol']; ?></td>
                            </tr>
                            <tr>
                              <td colspan="2"><strong>Protocol Status</strong></td>
                            </tr>
                            <tr>
                              <td class="table-label required">Submitted</td>
                              <td><span><?php
                                if($application['Application']['submitted'])  echo "<span class='text-success'><i class='icon-ok'></i> </span>";
                                else echo "<span class='text-error'><i class='icon-remove'></i></span>";
                            ?></span></td>
                            </tr>
                        </tbody>
                      </table>
                  </form>
                </td>

                <td>
                  <?php
                        echo $this->Html->link('<span class="label label-info"> View </span>',
                                array('action' => 'view', $application['Application']['id'], 'admin' => false), array('escape'=>false));
                        // else echo $this->Html->link('<span class="label label-success"> Edit </span>',
                        //                  array('action' => 'edit', $application['Application']['id']), array('escape'=>false));
                  ?>
                </td>
              </tr>
            <?php endforeach; ?>
            </tbody>
            </table>
        <?php } else { ?>
          <p>There were no reports that met your search criteria.</p>
        <?php } ?>
      </div> <!-- /row-fluid -->
        </div>
      </div>

  </div>
</div>
<script type="text/javascript">
$.expander.defaults.slicePoint = 70;
$(function() {
  var adates = $('#ApplicationStartDate, #ApplicationEndDate').datepicker({
      minDate:"-100Y",
      maxDate:"-0D",
      dateFormat:'dd-mm-yy',
      showButtonPanel:true,
      changeMonth:true,
      changeYear:true,
      showAnim:'show',
      onSelect: function( selectedDate ) {
        var option = this.id == "ApplicationStartDate" ? "minDate" : "maxDate",
          instance = $( this ).data( "datepicker" ),
          date = $.datepicker.parseDate(
            instance.settings.dateFormat ||
            $.datepicker._defaults.dateFormat,
            selectedDate, instance.settings );
        adates.not( this ).datepicker( "option", option, date );
      }
    });
  $(".morecontent").expander();

});
</script>
<?php */ ?>
