<?php
  $this->assign('Reports', 'active');        
  echo $this->Session->flash();
  // $this->Html->css('comments', null, array('inline' => false));
  $this->Html->script('highcharts/highcharts', array('inline' => false));
  $this->Html->script('highcharts/modules/exporting', array('inline' => false));
  $this->Html->script('highcharts/modules/export-data', array('inline' => false));
?>

<?php //pr(Hash::extract($data, '{n}.{n}')) ;?>

<div id="sae-per-month" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>



<script type="text/javascript">
    $(function () { 
        // Get the CSV and create the chart

        $.ajax({
            url: '/reports/sae_per_month.json',
            type: 'GET',
            async: true,
            dataType: "json",
            success: function (data) {
                // console.info($.map(data, function(el) { el.y = parseInt(el.y, 10); return el; }));
                Highcharts.chart('sae-per-month', {
                    chart: {
                            type: 'column'
                    },
                    title: {
                        text: 'SAE/SUSARs per Month'
                    },
                    series: [{
                        data: $.map(data, function(el) { el.y = parseInt(el.y, 10); return el; }),//data.data,
                        name: 'Months'
                    }], 
                    xAxis: {
                        type: 'category'
                    }
                });
            }
        });
    });
</script>
