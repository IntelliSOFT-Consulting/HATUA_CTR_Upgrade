  <div class="row-fluid">
    <div class="span12">
      <?php
      echo $this->Session->flash();
      ?>
      <div class="page-header">
        <div class="styled_title">
          <h3>ECITIZEN INVOICE STATUS</h3>
        </div>
        <div class="row-fluid">
          <div class="span6">
            <?php
            echo $this->Html->link(
              __('<i class="icon-download"></i> Verify Status'),
              array('controller' => 'applications', 'action' => 'verify_invoice', $application['Application']['id']),
              array('escape' => false, 'class' => 'btn pull-right btn-success')
            ); ?>
          </div>
        </div>


      </div>
    </div>
  </div>


  <?php
  if (isset($this->params['named']['data'])) { ?>
  <div class="row-fluid">
    <div class="span12">
      <div class="span6">
        <h4>Client Information</h4>
        <table class="table table-borderless">
          <tbody>
            <tr>
              <th>Client Name:</th>
              <td><?php echo $this->params['named']['data']['name'] ?></td>
            </tr>
            <tr>
              <th>Client Email:</th>
              <td><?php echo $this->params['named']['data']['clientEmail'] ?></td>
            </tr>
            <tr>
              <th>Client MSISDN:</th>
              <td><?php echo $this->params['named']['data']['clientMSISDN'] ?></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="span6">
        <h5>Invoice Information</h5>
        <table class="table table-borderless">
          <tbody>
            <tr>
              <th>Status:</th>
              <td><?php echo ucfirst($this->params['named']['data']['status']) ?></td>
            </tr>
            <tr>
              <th>Reference Number:</th>
              <td><?php echo $this->params['named']['data']['ref_no'] ?></td>
            </tr>
            <tr>
              <th>Currency:</th>
              <td><?php echo $this->params['named']['data']['currency'] ?></td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>
  </div>

    <div class="row-fluid">
      <div class="span12">
        <table class="table table-bordered invoice-table">
          <thead>
            <tr>
              <th>Description</th>
              <th>Client Invoice Ref</th>
              <th>Bill Ref Number</th>
              <th>Amount Expected</th>
              <th>Amount Paid</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Clinical Trials</td>
              <td><?php echo $this->params['named']['data']['client_invoice_ref'] ?></td>
              <td><?php echo $this->params['named']['data']['billRefNumber'] ?></td>
              <td><?php echo $this->params['named']['data']['amount_expected'] ?></td>
              <td><?php echo $this->params['named']['data']['amount_paid'] ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="row-fluid">
      <div class="span6">
      </div>
      <div class="span6 text-md-right">
        <table class="table table-borderless">
          <tbody>
            <tr>
              <th>Total Amount Expected:</th>
              <td><?php echo $this->params['named']['data']['amount_expected'] ?></td>
            </tr>
            <tr>
              <th>Total Amount Paid:</th>
              <td><?php echo $this->params['named']['data']['amount_paid'] ?></td>
            </tr>
            <tr>
              <th>Balance Due:</th>
              <td><?php echo $this->params['named']['data']['amountExpected'] ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  <?php } ?>