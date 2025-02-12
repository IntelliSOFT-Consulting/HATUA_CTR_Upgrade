<div class="row-fluid">
    <div class="span12">

        <table class="table  table-bordered" style="margin-bottom: 1px;">

            <thead>
                <tr>
                    <th style="width:3%">ID</th>
                    <th style="width:3%">Protocol No</th>
                    <th style="width:3%">Status</th>
                    <th style="width:3%">User</th>
                    <th style="width:3%">Created</th>
                    <th style="width:3%"><?php echo __('Actions'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php

                foreach ($application['Termination'] as $akey => $dd) {
                ?>
                    <tr>

                        <td><?php echo $akey + 1; ?></td>
                        <td><?php echo $dd['reference_no']; ?></td>
                        <td><?php echo ($dd['submitted'] == 0) ? 'Unsubmitted' : 'Submitted'; ?></td>
                        <td><?php echo $dd['User']['name']; ?></td>
                        <td><?php echo $dd['created']; ?></td>
                        <td>
                            <?php
                            if ($dd['submitted'] == 0) {
                            } else {
                                echo "&nbsp;";
                                echo $this->Html->link(
                                    '<span class="label label-info"> View </span>',
                                    array('action' => 'view', $application['Application']['id'], 'vterm' => $dd['id']),
                                    array('escape' => false)
                                );
                                echo "&nbsp;";
                                echo $this->Html->link(
                                    __('<span class="label label-success"> <i class="icon-download-alt"></i>  Download PDF </span>'),
                                    array('controller' => 'applications', 'ext' => 'pdf', 'action' => 'download_termination', $dd['id']),
                                    array('escape' => false)
                                );
                            }
                            echo "&nbsp;";

                            ?>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<hr>
<div class="row-fluid">
    <div class="span12">

        <hr>

        <!-- View Letter -->

        <?php
        if (isset($this->params['named']['vterm']))  $cid = $this->params['named']['vterm'];

        if (isset($this->params['named']['vterm'])) {
            foreach ($application['Termination'] as $akey => $kk) {
                if ($kk['id'] == $cid) {
        ?>


                    <div class="span12">
                        <h4 class="text-info">View Letter</h4>
                        <hr class="soften" style="margin: 10px 0px;">
                    </div>
                    <div class="span12">
                        <div class="well">
                            <div class="row-fluid">
                                <div class="span12">
                                    <p><strong>Protocol Code: </strong><?php echo $application['Application']['protocol_no']; ?></p>
                                    <p><strong>Study Title: </strong><?php echo $application['Application']['study_title']; ?></p>
                                    <p><strong>Letter Reference: </strong><?php echo $kk['reference_no']; ?></p>
                                    <p><strong>Created on: </strong><?php echo date('d-m-Y h:i:s a', strtotime($kk['created'])); ?></p>
                                    <hr>
                                    <p><strong>Letter Content</strong></p>
                                    <div class="well">
                                        <?php echo $kk['content']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


        <?php }
            }
        } ?>
    </div>
    <!-- View Letter -->
</div>