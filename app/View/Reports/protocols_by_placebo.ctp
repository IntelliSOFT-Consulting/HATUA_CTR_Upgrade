<?php
  $this->assign('Reports', 'active');        
  echo $this->Session->flash();
  // $this->Html->css('comments', null, array('inline' => false));
  $this->Html->script('highcharts/highcharts', array('inline' => false));
  $this->Html->script('highcharts/modules/data', array('inline' => false));
  $this->Html->script('highcharts/modules/exporting', array('inline' => false));
  $this->Html->script('highcharts/modules/export-data', array('inline' => false));
?>


<?php
echo $this->Form->create('Application', array(
    'url' => array_merge(array('controller'=>'reports','action' => 'protocols_by_placebo')),
    'class' => 'ctr-groups', 'style' => array('padding:9px;', 'background-color: #F5F5F5'),
));
 
?>
<div class="row-fluid">
    <div class="span4">
        <?php
        echo $this->Form->input(
            'start_date',
            array(
                'div' => false, 'type' => 'text', 'class' => 'input-small unauthorized_index', 'after' => '-to-',
                'label' => array('class' => 'required', 'text' => 'Submission Dates'), 'placeHolder' => 'Start Date'
            )
        );
        echo $this->Form->input(
            'end_date',
            array(
                'div' => false, 'type' => 'text', 'class' => 'input-small unauthorized_index',
                'after' => '<a style="font-weight:normal" onclick="$(\'.unauthorized_index\').val(\'\');" >
                      <em class="accordion-toggle">clear!</em></a>',
                'label' => false, 'placeHolder' => 'End Date'
            )
        );
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

<?php echo $this->Form->end(); ?>


<div id="protocols-by-phase"></div>

<hr>
<h4>Raw Data</h4>
<table class="table table-condensed table-bordered" id="datatable8">
    <thead>
        <tr>
            <th></th>
            <th>Protocols</th>
        </tr>
    </thead>
    <tbody>
      <?php
          foreach ($data as $key => $value) {
              echo "<tr>";
                echo "<th>".$value[0]['placebo_present']."</th>";
                echo "<td>".$value[0]['cnt']."</td>";
              echo "</tr>";
          }
      ?>        
    </tbody>
</table>


<script type="text/javascript">
Highcharts.chart('protocols-by-phase', {
    data: {
        table: 'datatable8'
    },
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Protocols by Placebo'
    },
    yAxis: {
        allowDecimals: false,
        title: {
            text: 'Units'
        }
    },
    tooltip: {
        formatter: function () {
            return '<b>' + this.series.name + '</b><br/>' +
                this.point.y + ' ' + this.point.name.toLowerCase();
        }
    }
});
</script>



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

