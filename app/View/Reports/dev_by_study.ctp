<?php
  $this->assign('Reports', 'active');        
  echo $this->Session->flash();
  // $this->Html->css('comments', null, array('inline' => false));
  $this->Html->script('highcharts/highcharts', array('inline' => false));
  $this->Html->script('highcharts/modules/data', array('inline' => false));
  $this->Html->script('highcharts/modules/exporting', array('inline' => false));
  $this->Html->script('highcharts/modules/export-data', array('inline' => false));
?>

<?php //pr($data) ;?>


<div id="dev-by-study"></div>

<hr>
<h4>Raw Data</h4>
<table class="table table-condensed table-bordered" id="datatable_dev">
    <thead>
        <tr>
            <th></th>
            <th>Deviation</th>
            <th>Violation</th>
        </tr>
    </thead>
    <tbody>
      <?php
          foreach ($data as $key => $value) {
              echo "<tr>";
                echo "<th>".$value['Application']['protocol_no']."</th>";
                echo "<td>".(($value['Deviation']['deviation_type'] == 'Deviation') ? $value[0]['cnt'] : 0)."</td>";
                echo "<td>".(($value['Deviation']['deviation_type'] == 'Violation') ? $value[0]['cnt'] : 0)."</td>";
              echo "</tr>";
          }
      ?>        
    </tbody>
</table>


        <script type="text/javascript">
Highcharts.chart('dev-by-study', {
    data: {
        table: 'datatable_dev'
    },
    chart: {
        type: 'column'
    },
    title: {
        text: 'Deviations by study'
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

