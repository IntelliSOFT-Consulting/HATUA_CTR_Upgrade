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
    'url' => array_merge(array('controller'=>'reports','action' => 'sae_by_type')),
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

<div id="sae-by-type"></div>

<hr>
<h4>Raw Data</h4>
<table class="table table-condensed table-bordered" id="datatable7">
    <thead>
        <tr>
            <th></th>
            <th>SAE</th>
            <th>SUSAR</th>
        </tr>
    </thead>
    <tbody>
      <?php
          foreach ($data as $key => $value) {
              echo "<tr>";
                echo "<th>".$value['Application']['protocol_no']."</th>";
                echo "<td>".(($value['Sae']['form_type'] == 'SAE') ? $value[0]['cnt'] : 0)."</td>";
                echo "<td>".(($value['Sae']['form_type'] == 'SUSAR') ? $value[0]['cnt'] : 0)."</td>";
              echo "</tr>";
          }
      ?>        
    </tbody>
</table>


        <script type="text/javascript">
Highcharts.chart('sae-by-type', {
    data: {
        table: 'datatable7'
    },
    chart: {
        type: 'column'
    },
    title: {
        text: 'SAE/SUSARS by study'
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
