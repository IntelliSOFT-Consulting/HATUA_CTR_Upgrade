<?php
  $this->assign('Home', 'active');
  echo $this->Html->css('assets/css/flexslider', null, array('inline' => false));
?>

<?php $this->start('banner'); ?>
<section id="intro">
    <div class="jumbotron masthead">
      <div class="container">
        <!-- slider navigation -->
        <div class="sequence-nav">
          <div class="prev">
            <span></span>
          </div>
          <div class="next">
            <span></span>
          </div>
        </div>
        <!-- end slider navigation -->
        <div class="row">
          <div class="span12">
            <div id="slider_holder">
              <div id="sequence">
                <ul>
                  <!-- Layer 1 -->
                  <li>
                    <div class="info animate-in">
                      <h2>Pharmacy and Poisons Board</h2>
                      <br>
                      <h3>Kenya </h3>
                      <p>
                        Online clinical trials registry system
                      </p>
                      <a class="btn btn-success" href="#">Learn more &raquo;</a>
                    </div>
                    <img class="slider_img animate-in" src="/img/homepage/home1.jpeg" alt="">
                  </li>
                  <!-- Layer 2 -->
                  <li>
                    <div class="info">
                      <h2>Annual Approvals</h2>
                      <br>
                      <h3>Required for all ongoing studies</h3>
                      <p>
                        Submit checklist for annual approval for all ongoing trials
                      </p>
                      <a class="btn btn-success" href="#">Learn more &raquo;</a>
                    </div>
                    <img class="slider_img" src="/img/homepage/home3.jpeg" alt="">
                  </li>
                  <!-- Layer 3 -->
                  <li>
                    <div class="info">
                      <h2>Pharmacovigilance reporting</h2>
                      <br>
                      <h3>PV ERS</h3>
                      <p>check out the electronic pharmacovigilance reporting system at <a href="http://www.pv.pharmacyboardkenya.org" target="_blank">www.pv.pharmacyboardkenya.org</a></p>
                      <a class="btn btn-success" href="#">Learn more &raquo;</a>
                    </div>
                    <img class="slider_img" src="/img/homepage/home10.jpeg" alt="">
                  </li>
                </ul>
              </div>
            </div>
            <!-- Sequence Slider::END-->
          </div>
        </div>
      </div>
    </div>
  </section>
<?php $this->end(); ?>

<div class="row-fluid">
  <div class="span12">


    <div class="row-fluid">
    <div class="span12">
      <div class="page-header">
      <h1>EXPERT COMMITTEE ON CLINICAL TRIALS (ECCT) <?php  echo $this->element('google-recommend');?></h1>
      </div>
    </div>
    </div>
<!--
  <div class="row-fluid">
  <div class="span12">
      <div class="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>NOTE TO APPLICANTS!</strong> Please use the latest versions of Firefox or Google Chrome for the best experience of this site.
          </div>
  </div>
  </div> -->

      <div class="row-fluid">
        <div class="span12">
          <p>
            The number of clinical trials taking place in Kenya has been increasing in the recent past. As the National Medicines Regulatory Authority for Kenya, Pharmacy and Poisons Board (PPB) has the responsibility of regulating all clinical trials taking place in the country. In order to facilitate both the sponsors and investigators, PPB has upgraded the clinical trials online system based on feedback from the stakeholders. The new system also allows for the public to see all the PPB approved trials including theirs details like investigators, study status, sites and study objectives.  
          </p>
          <p>
          Investigators are expected to keep the details of their studies updated all the time. The site also has a link to the most updated reference documents for the conduct of clinical trials in Kenya like the Guideline and checklists.
          </p>
          <p>
          Any person intending to carry out a clinical trial in the country is expected to use this site to submit his application to PPB.
          </p>
          <p>
          Thank you and hope you enjoy using this improved system. 
          </p>
          <p>
          Please feel free to share your feedback  
          </p>

        </div>
      </div>
  </div>
</div>

<?php $this->start('homejs'); ?>
<!-- JavaScript Library Files -->
  <!-- <script src="/css/assets/js/jquery.min.js"></script> -->
  <script src="/css/assets/js/jquery.easing.js"></script>
  <script src="/css/assets/js/google-code-prettify/prettify.js"></script>
  <script src="/css/assets/js/modernizr.js"></script>
  <script src="/css/assets/js/bootstrap.js"></script>
  <script src="/css/assets/js/jquery.elastislide.js"></script>
  <script src="/css/assets/js/sequence/sequence.jquery-min.js"></script>
  <script src="/css/assets/js/sequence/setting.js"></script>
  <script src="/css/assets/js/jquery.prettyPhoto.js"></script>
  <script src="/css/assets/js/application.js"></script>
  <script src="/css/assets/js/jquery.flexslider.js"></script>
  <script src="/css/assets/js/hover/jquery-hover-effect.js"></script>
  <script src="/css/assets/js/hover/setting.js"></script>

  <!-- Template Custom JavaScript File -->
  <script src="/css/assets/js/custom.js"></script>
<?php $this->end(); ?>