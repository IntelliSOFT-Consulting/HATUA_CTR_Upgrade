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
                         <td> <?php
                                $cound = 0;
                                $former = $this->requestAction('/pockets/checklist/amendment');
                                $years = array_unique(Hash::extract($application['AmendmentChecklist'], '{n}.year'));
                                rsort($years);
                                $uniqueYearCount = count($years);
                                echo $uniqueYearCount;
                                ?>
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