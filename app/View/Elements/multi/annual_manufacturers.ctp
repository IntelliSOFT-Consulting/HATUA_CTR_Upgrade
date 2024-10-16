
<!-- Ethical Committees -->
  <div class="row-fluid">
   <div class="span12">
    <h4 style="background-color: #8241c4; color: #fff; text-align: center;">Manufacturing Sites</h4>
      
      <?php        
        echo $this->Form->create('Manufacturer', array(
           'url' => array('controller' => 'manufacturers', 'action' => 'add'),
           // 'class' => 'form-horizontal',
           'inputDefaults' => array(
            'div' => array('class' => 'control-group'),
            'label' => array('class' => 'control-label'),
            'between' => '<div class="controls">',
            'after' => '</div>',
            'class' => '',
            'format' => array('before', 'label', 'between', 'input', 'after','error'),
            'error' => array('attributes' => array('class' => 'controls help-block')),
           ),
        )); 
      ?>
      <table class="table table-bordered table-condensed">
        <thead>
          <tr>
            <th>Name of manufacturer</th>
            <th>Manufacturing site address</th>
            <th>Manufacturing activities at site</th>
            <th>If others, specify</th>
            <th>Country of manufacture</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($application['Manufacturer'] as $key => $man) { ?>
          <tr>
            <td><?php  echo "<p>". $man['manufacturer_name']."</p>";  ?></td>   
            <td><?php  echo "<p>". $man['address']."</p>";  ?></td>
            <td><?php  echo "<p>". $man['manufacturing_activities']."</p>";  ?></td>     
            <td><?php  echo "<p>". $man['other_specify']."</p>";  ?></td>
            <td><?php  echo "<p>". $man['manufacturer_country']."</p>";  ?></td>
            <td></td>
          </tr>
        <?php } ?>

        <?php 
          if ($redir == 'applicant') { 
        ?>
          <tr style="background-color: #8241c4;">
            <td>
              <?php
                echo $this->Form->input('application_id', array('type' => 'hidden' ,'value' => $application['Application']['id']));                
                echo $this->Form->input('manufacturer_name', array(
                        'type' => 'text', 'class' => 'input-medium', 'label' => false,
                ));
              ?>
            </td>
            <td>
              <?php  echo $this->Form->input('address', array('label' => false, 'class' => 'input-medium' )); ?>
            </td>
            <td>
              <?php
                echo $this->Form->input('manufacturing_activities', array(
                  'type' => 'select', 'label' => false, 'class' => 'input-large', 
                  'options' => ['Complete manufacturing activities' => 'Complete manufacturing activities', 'Partial manufacturing' => 'Partial manufacturing', 'Batch certification' => 'Batch certification',
                        'Packaging' => 'Packaging', 'Quality testing' => 'Quality testing', 'Stability testing' => 'Stability testing', 'Blinding' => 'Blinding', 'Others' => 'Others']
                ));
              ?>
            </td>
            <td>
              <?php
                echo $this->Form->input('other_specify', array(
                  'type' => 'text ', 'class' => 'input-small', 'label' => false,

                ));
              ?>
            </td>
            <td>
              <?php
                $countries = $this->requestAction('/countries/countrylist');
                echo $this->Form->input('manufacturer_country', array(
                  'type' => 'select', 'label' => false, 'class' => 'input-medium', 'options' => $countries
                ));
              ?>
            </td>
            <td><?php echo $this->Form->button('Save', array('type' => 'submit', 'class'=>'btn btn-inverse'));?></td>
          </tr>
        <?php 
          } 
        ?>
        </tbody>
      </table>
      <?php
        echo $this->Form->end();
      ?>
      <hr>
      </div>
  </div>