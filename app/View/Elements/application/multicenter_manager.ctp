<?php
$this->Html->script('multicenter', array('inline' => false));
?>

<div class="row-fluid">
    <div class="span12">
        <?php

        echo $this->Session->flash();
        ?>
        <div class="page-header">

            <h3 class="text-info">Multicenters</h3>
            <div class="amend-form">


                <!-- Tab Content -->
                <div class="row-fluid">
                    <div class="span12">

                        <table class="table table-striped table-bordered table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Protocol No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Center Name</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
 
                                $i = 0;
                                foreach ($application['MultiCenter'] as $center) {
                                    $i++;
                                ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td>
                                            <!-- here  -->
                                            <?php

                                            // debug($center['NewApplication']);
                                            if (!empty($center['NewApplication']) && isset($center['NewApplication']['protocol_no'], $center['NewApplication']['id'])) {
                                                $reference = $center['NewApplication']['protocol_no'];
                                                $action = !empty($center['NewApplication']['submitted']) ? 'view' : 'edit';

                                                echo $this->Html->link(
                                                    __($reference),
                                                    array('controller' => 'applications', 'action' => $action, $center['NewApplication']['id']),
                                                    array('class' => '', 'confirm' => 'Are you sure you want to navigate to the site protocol?', 'target' => '_blank')
                                                );
                                            } ?>

                                        </td>
                                        <td><?php echo $center['CoPI']['name']; ?></td>
                                        <td><?php echo $center['CoPI']['email']; ?></td>
                                        <td><?php echo $center['site_name']; ?></td>

                                        <td><?php echo $center['status']; ?></td>
                                        <td>
                                            <?php
                                            if ($center['status'] === 'Approved') {

                                                if (!empty($center['NewApplication']) && isset($center['NewApplication']['protocol_no'], $center['NewApplication']['id'])) {
                                                    $reference = $center['NewApplication']['protocol_no'];
                                                    $action = !empty($center['NewApplication']['submitted']) ? 'view' : 'edit';

                                                    echo $this->Html->link(
                                                        __('View'),
                                                        array('controller' => 'applications', 'action' => $action, $center['NewApplication']['id']),
                                                        array('class' => 'btn btn-mini btn-primary', 'confirm' => 'Are you sure you want to navigate to the site protocol?', 'target' => '_blank')
                                                    );
                                                }
                                            } else { ?>
                                                <a href="#" class="btn btn-mini btn-info" title="Edit" data-toggle="modal" data-target="#editCenter<?php echo $center['id']; ?>"><i class="icon-edit">Edit</i></a>
                                                <a href="#" class="btn btn-mini btn-danger" title="Delete" data-toggle="modal" data-target="#deleteCenter<?php echo $center['id']; ?>"><i class="icon-trash">Delete</i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>

                                <?php
                                }
                                ?>
                            </tbody>

                        </table>


                    </div>
                </div>

            </div>
        </div>
    </div>
</div>