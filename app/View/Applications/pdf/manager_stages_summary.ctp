<?php
echo $this->Html->image('cake.power.png', array('fullBase' => true, 'alt' => 'Pharmacy and Poisons Board', 'style' => 'border: 0;'));
?>

<div class="row-fluid">
    <div class="span12">
        <table class="table  table-bordered">
            <thead>
                <tr>
                    <th style="width:3%">#</th>
                    <th style="width: 27%"><?php echo $this->Paginator->sort('protocol_no'); ?></th>
                    <th style="width: 70%">Application Stages </th>
                </tr>
            </thead>
            <tbody>

                <?php
                $count = 0;
                foreach ($applications as $application) {
                ?>
                    <tr class="<?php
                      $stages = $this->requestAction('applications/stages/'.$application['Application']['id']);
                      if(Hash::check($stages, '{s}[color!=success]')) {
                          $var = Hash::extract($stages, '{s}[color!=success].color');
                          if(in_array('warning', $var)) echo 'warning';
                          if(in_array('danger', $var)) echo 'error';
                      }
                   ?>">
                        <td><?php $count++;
                            echo $count; ?></td>
                        <td> <?php echo $application['Application']['protocol_no']; ?></td>
                        <td>
                            <!-- In table start -->
                            <table class="table table-condensed table-intable" style="margin: 1px; border:1px">
                                <thead>
                                    <tr>
                                        <th>
                                            <p class="text-warning"><strong>Stage</strong></p>
                                        </th>
                                        <th>
                                            <p class="text-warning"><strong>Start Date</strong></p>
                                        </th>
                                        <th>
                                            <p class="text-warning"><strong>End Date</strong></p>
                                        </th>
                                        <th>
                                            <p class="text-warning"><strong>Days</strong></p>
                                        </th>
                                    </tr>
                                </thead>
                                <?php
                                $cound = 0; 
                                ?>
                                <tbody>
                                    <?php
                                    foreach ($stages as $sk => $stage) {
                                        $cound++;

                                        echo "<tr>";
                                        echo "<td>" . $cound . '. ' . strip_tags($stage['label']) . (($sk == 'AnnualApproval') ? ' (to expiry)' : '');
                                        echo "</td>";
                                        echo "<td>" . $stage['start_date'];
                                        echo "</td>";
                                        echo "<td>" . $stage['end_date'];
                                        echo "</td>";
                                        echo "<td>" . $stage['days'];
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <?php }?>
            </tbody>
        </table>
        <!-- In table end --> 
    </div>
</div>