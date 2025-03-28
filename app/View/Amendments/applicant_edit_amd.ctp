<?php
?>

<div class="row-fluid">
    <div class="span12">
        <?php

        echo $this->Session->flash();
        ?>
        <div class="page-header">

            <h3 class="text-info">Justification</h3>
            <div class="amend-form">


                <!-- Tab Content -->
                <div class="row-fluid">
                    <div class="span12">

                        <?php

                        echo $this->element('application/amendment'); ?>


                    </div>
                </div>

            </div>
        </div>
    </div>
</div>