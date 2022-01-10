	<!--[if lt IE 9]>
		<script src="js/modernizr.custom.js"></script>
	<![endif]-->
	<script src="<?php echo base_url();?>js/jquery.flexslider-min.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>js/functions.js" type="text/javascript"></script>
	
	<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/jquery-1.7.min.js"></script>
		
	<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/jquery.cookie.js"></script>

	<script type="text/javascript" src="<?php echo base_url(); ?>js/custom/general.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/plugins/jquery.uniform.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/plugins/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/custom/forms.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/plugins/tinymce/jquery.tinymce.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/jquery.tagsinput.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/plugins/jquery.tagsinput.css">
	<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/jquery.colorbox-min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/check_email_availability.js"></script>
	
	
<div class="container">
  <div class="row">
    <div class="account_creation_tag">
      <div class="">
        <div class="col-md-1 round ">1</div>
        <div class="col-md-2 Account_head">Account Creation</div>
        <div class="col-md-1 arrow_img"><img src="<?php echo base_url(); ?>img/arrows_1.png" /></div>
      </div>
      <div class="">
        <div class="col-md-1 round colomactive">2</div>
        <div class="col-md-2 Account_head">Verification of Details</div>
        <div class="col-md-1 arrow_img"><img src="<?php echo base_url(); ?>img/arrows_1.png" /></div>
      </div>
      <div class="">
        <div class="col-md-1 round">3</div>
        <div class="col-md-2 Account_head">Account Verified</div>
        <!--<div class="col-md-1 arrow_img"><img src="<?php echo base_url(); ?>img/arrows_1.png" /></div>-->
      </div>
    </div>
  </div>
</div>

<div role="main" class="main shop">
  <div class="container">
    <hr class="tall">
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <div class="panel-body">		              
			<div class="account lpmrgn">
				<h6>Congratulations!!</h6>
				<p>Dear <?php echo $seller_record->name; ?>,</p>
				<p>Your account has been created. To move on to the next step, log in to your mail account and click on the verification link sent to your e-mail. <b>In case not showing in your inbox please check your spam folder.</b><br>
				( <?php echo $seller_record->email_id; ?> )</p>
				<p>Haven't received the mail yet? <a href="<?php echo base_url(); ?>send_email_verification_link/<?php echo base64_encode($seller_record->id); ?>" >Click here</a> to Resend.</p>
				<p></p>
			</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


