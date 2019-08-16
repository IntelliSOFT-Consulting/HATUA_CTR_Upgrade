<h5>MANUFACTURER(S) (<small>Click button to add - 
                          <button type="button" class="btn btn-mini btn-primary" id="addManufacturers" >&nbsp;<i class="icon-plus"></i>&nbsp;</button> Manufacturers</small>)</h5>
<div class="ctr-groups">
    <div id="manufacturer_group">
    <?php
        $this->Html->script('multi/manufacturers', array('inline' => false));
        echo $this->Form->input('Manufacturer.0.id');
        echo $this->Form->input('Manufacturer.0.manufacturer_name', array(
          'type' => 'text',
          'label' => array('class' => 'control-label required', 'text' => 'Name of manufacturer'),
          'placeholder' => ' ' , 'class' => 'input-xxlarge',
        ));
        echo $this->Form->input('Manufacturer.0.address', array(
          'label' => array('class' => 'control-label required', 'text' => 'Manufacturing site address'),
          'placeholder' => ' ' , 'class' => 'input-xxlarge',
        ));
        
        $countries = $this->requestAction('/countries/countrylist');
        echo $this->Form->input('Manufacturer.0.manufacturer_country', array(
          'type' => 'select', 'label' => array('class' => 'control-label required', 'text' => 'Country of manufacture'),
          'placeholder' => ' ' , 'class' => 'input-xlarge', 'options' => $countries, 'empty' => true,
        ));
        echo $this->Html->tag('hr', '', array('id' => 'ManufacturerHr0'));
    ?>
    </div>
    <div id="Manufacturers">
        <?php
            if (!empty($this->request->data['Manufacturer'])) {
                for ($i = 1; $i <= count($this->request->data['Manufacturer'])-1; $i++) {
                  ?>
                  <div class="manufacturer-group">
                  <?php
                    echo $this->Form->input('Manufacturer.'.$i.'.id');
                    
                    echo $this->Form->input('Manufacturer.'.$i.'.manufacturer_name', array(
                      'type' => 'text',
                      'label' => array('class' => 'control-label required', 'text' => 'Name of manufacturer'),
                      'placeholder' => ' ' , 'class' => 'input-xxlarge',
                    ));
                    echo $this->Form->input('Manufacturer.'.$i.'.address', array(
                      'label' => array('class' => 'control-label required', 'text' => 'Manufacturing site address'),
                      'placeholder' => ' ' , 'class' => 'input-xxlarge',
                    ));
                    echo $this->Form->input('Manufacturer.'.$i.'.manufacturer_country', array(
                      'type' => 'select', 'label' => array('class' => 'control-label required', 'text' => 'Country of manufacture'),
                      'placeholder' => ' ' , 'class' => 'input-xlarge', 'options' => $countries, 'empty' => true,
                    ));

                    echo $this->Html->tag('div', '<button id="removeManufacturer'.$i.'" class="btn btn-mini btn-danger removeManufacturer" type="button"> &nbsp;<i class="icon-trash"></i>&nbsp; Remove Manufacturer</button>', array(
                      'class' => 'controls', 'escape' => false));
                  echo $this->Html->tag('hr', '', array('id' => 'ManufacturerHr'.$i));
                  ?>
                  </div>
                  <?php
                }
            }
        ?>
    </div>
</div>
