 <?php
    App::uses('Hash', 'Utility');
    ?>
 <div style="text-align: center;">
     <h3 style="text-align: center;">
         <?php
            echo $this->Html->image('cake.power.png', array(
                'fullBase' => true, 'alt' => 'Pharmacy and Poisons Board',
                'style' => 'border: 0; float: center; margin-right: 10px; margin-bottom: 10px;'
            ));
            ?>

     </h3>
     <p style="text-align: center;">
         <span style="font-family:bookman old style,serif;"><strong>MINISTRY</strong> <strong>OF</strong> <strong>HEALTH</strong></span>
     </p>
     <p style="text-align: center;">
         <span style="font-family:bookman old style,serif;"><strong>PHARMACY</strong> <strong>AND</strong> <strong>POISONS</strong> <strong>BOARD</strong></span>
     </p>

 </div>

 <div class="row-fluid">
     <div class="span12">
         <table>
             <thead>
                 <tr>
                     <th style="width:3%">#</th>
                     <th style="width: 27%"><?php echo $this->Paginator->sort('protocol_no'); ?></th>
                     <th style="width: 70%">Amendments </th>
                 </tr>
             </thead>
             <tbody>

                 <?php
                    $count = 0;
                    foreach ($applications as $application) {
                    ?>
                     <tr>
                         <td><?php $count++;
                                echo $count; ?></td>
                         <td> <?php echo $application['Application']['protocol_no']; ?></td>
                         <td>
                             <!-- In table start -->
                             <table>
                                 <thead>
                                     <tr>
                                         <th>
                                             <p class="text-warning"><strong>#</strong></p>
                                         </th>
                                         <th>
                                             <p class="text-warning"><strong>Description</strong></p>
                                         </th>
                                     </tr>
                                 </thead>
                                 <?php
                                    $cound = 0;
                                    ?>
                                 <tbody>
                                     <?php
                                      $former = $this->requestAction('/pockets/checklist/amendment');
                                        $years = array_unique(Hash::extract($application['AmendmentChecklist'], '{n}.year'));
                                        rsort($years);
                                        foreach ($years as $year) { ?>
                                         <tr>

                                             <td><?= $year ?></td>
                                             <td>

                                                 <?php
                                                    $f = 0;
                                                    foreach ($former as $rem => $mer) {
                                                        $f++;
                                                        echo "<div id='$rem$year'>";
                                                        echo "$f. ";
                                                        echo "$mer<br/>";
                                                        foreach ($application['AmendmentChecklist'] as $anc) {
                                                            if ($anc['year'] == $year && $anc['pocket_name'] == $rem) {
                                                                $id = $anc['id'];
                                                                echo "&nbsp;&nbsp; <span id='$rem$id'> &nbsp;<i class='icon-file-text-alt'></i> ";
                                                                echo $this->Html->link(
                                                                    __($anc['basename']),
                                                                    array('controller' => 'attachments', 'action' => 'download', $anc['id'], 'full_base' => true),
                                                                    array('class' => '')
                                                                );
                                                                $version_no = $anc['version_no'];
                                                                $file_date = $anc['file_date'];
                                                                echo "</span>&nbsp;
                          <span id='version$id' style='margin-left:10px;'>Version: $version_no</span>
                          <span id='fileDate$id' style='margin-left:10px;'>Dated: $file_date</span>
                          <span id='AmendmentChecklist$id' style='margin-left:10px;' class='btn btn-mini'><i class='icon-remove'></i></span>
                          <br>";
                                                            }
                                                        }
                                                        echo "</div>";
                                                    }
                                                    echo "<h5>Additional Files</h5>";

                                                    $ccloop = 0;
                                                    foreach ($application['AmendmentChecklist'] as $anc) {

                                                        if ($anc['year'] == $year && $anc['pocket_name'] == '') {
                                                            $ccloop++;
                                                            $id = $anc['id'];
                                                            $version_no = $anc['version_no'];
                                                            $file_date = $anc['file_date'];
                                                            $description = $anc['description'];
                                                            echo "<br>" . $ccloop . ". " . $description . "<br>";
                                                            echo "&nbsp;&nbsp; <span id='$rem$id'> &nbsp;<i class='icon-file-text-alt'></i> ";
                                                            echo $this->Html->link(
                                                                __($anc['basename']),
                                                                array('controller' => 'attachments', 'action' => 'download', $anc['id'], 'full_base' => true),
                                                                array('class' => '')
                                                            );

                                                            echo "</span>&nbsp;
                      <span id='version$id' style='margin-left:10px;'>Version: $version_no</span>
                      <span id='fileDate$id' style='margin-left:10px;'>Dated: $file_date</span>
                      <span id='AmendmentChecklist$id' style='margin-left:10px;' class='btn btn-mini'><i class='icon-remove'></i></span>
                      <br>";
                                                        }
                                                    }


                                                    ?>
                                             </td>
                                         </tr>

                                     <?php } ?>

                                 </tbody>
                             </table>
                         </td>
                     </tr>
                 <?php } ?>
             </tbody>
         </table>
         <!-- In table end -->
     </div>
 </div>

 <style>
     table {
         border-collapse: collapse;
         width: 100%;
         margin: 0px auto;
     }

     th,
     td {
         border: 1px solid gray;
         padding: 8px;
         text-align: left;
     }
 </style>