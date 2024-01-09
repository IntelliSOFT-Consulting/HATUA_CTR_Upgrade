<?php
      $this->Html->script('bootstrap-editable', array('inline' => false));
      $this->Html->css('bootstrap-editable', null, array('inline' => false));
    ?>
  <form class="form-horizontal" style="margin: 0px">
      <table class="table table-condensed table-intable" style="margin: 0px">
        <tbody>
            <?php if($application['Application']['deactivated']) { ?>
            <tr>
              <td><strong class="text-warning">Deactivated!!</strong></td>
              <td>
                <span class="text-warning">Please contact PPB.</span></td>
            </tr>
            <?php } ?>
            <tr>
              <td><strong>Approval Status</strong></td>
              <td>
                <span>
                  <?php
                    if($application['Application']['approved'] == 2)  echo "<i class='icon-ok'></i> Approved";
                    elseif($application['Application']['approved'] == 1)  echo "<i class='icon-remove'></i> Rejected!!";
                    elseif($application['Application']['approved'] == 0)  echo "<i class='icon-time'></i> in review";
                    // else echo "<span class='text-error'><i class='icon-remove'></i></span>";
                  ?>
                </span>
              </td>
            </tr>
            <tr>
              <td>Submitted to ppb</td>
              <td><span><?php
                if($application['Application']['submitted']){
                  echo "<span class='text-success'><i class='icon-ok'></i> <em>(submitted!)</em></span>";
                  echo "<br>".$application['Application']['date_submitted'];
                }
                else {
                  echo "<span class='text-error'><i class='icon-remove'></i> <em>(not submitted!)</em></span>";
                }
            ?></span></td>
            </tr>
            <tr>
              <td  style="width: 50%; padding-right: 0px;">Protocol Date</td>
              <td><?php echo $application['Application']['date_of_protocol']; ?></td>
            </tr>
            <tr>
              <td colspan="2">Created on &nbsp; : &nbsp; <?php echo date('d-m-Y h:i a', strtotime($application['Application']['created'])); ?></td>
            </tr>
        </tbody>
      </table>
 </form>
