
  <form class="form-horizontal" style="margin: 0px">
      <table class="table table-condensed table-intable" style="margin: 0px">
        <tbody>
            <tr>
              <td colspan="2"><strong class="<?php
                  if (count($application['Review']) < 3) {
                      echo 'text-error';
                  } elseif (count($application['Review']) == 3) {
                      echo 'text-success';
                  } elseif (count($application['Review']) > 3) {
                      echo 'text-warning';
                  }
                  ?>">Assigned Reviewers: <?php echo count($application['Review']); ?></strong><br/>
                  <?php
                      foreach ($application['Review'] as $akey => $avalue) {
                          echo $users[$avalue['user_id']].", ";
                      }
                    ?>
              </td>
            </tr>
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
              <td><strong>Trial Status</strong></td>
              <td>
                <span>
                  <?php
                    if(!empty($application['Application']['trial_status_id'])) echo $trial_statuses[$application['Application']['trial_status_id']];
                    else echo "<em>(not set!)</em>";
                  ?>
                </span>
              </td>
            </tr>
            <tr>
              <td>Submitted to ppb</td>
              <td><span><?php
                if($application['Application']['submitted']){
                  echo "<span class='text-success'><i class='icon-ok'></i> <em>(submitted!)</em></span>";
                  if ($application['Application']['unsubmitted']) {
                    echo "<br>".$application['Application']['initial_date_submitted'];
                  }else{
                  echo "<br>".$application['Application']['date_submitted'];
                  }
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
