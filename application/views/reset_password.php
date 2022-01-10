	<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/jquery-1.7.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/jquery.cookie.js"></script>

	<script type="text/javascript" src="<?php echo base_url(); ?>js/custom/general.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/plugins/jquery.uniform.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/plugins/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/custom/forms.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/plugins/tinymce/jquery.tinymce.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/jquery.tagsinput.min.js"></script>
	
<style>
form label.error {
    color: #f00;	
    display: block;
    float: none;
    font-size: 11px;
    font-weight: bold;
    text-align: left;
    width: 80%;
}
</style>

<div role="main" class="main shop" style="padding-top: 180px">
				<div class="container">
					<hr class="tall">
					<div class="row">
						<div class="col-md-12">
							<div class="row featured-boxes login">
								
								<div class="col-md-6" id="registerDiv">
									<div class="featured-box featured-box-secundary default">
										<div class="box-content">
											<h4>Reset Password</h4>
											<?php if($success_msg!=''){ ?><span style="color:green;"><?php echo $success_msg; $success_msg='';?></span><?php } ?>
											<?php if($reg_error_msg!=''){ ?><span style="color:red;"><?php echo $reg_error_msg; $reg_error_msg=''; ?></span><?php } ?>
											<form action="<?php echo base_url(); ?>change_password" id="register" name="register" method="post">															
												
												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<label>Password<font color='red'>*</font></label>
															<input type="password" name="password" id="password" value="" class="form-control input-lg">
															<label class="error" for="section_id"><p><font color="red"><?php echo $this->session->userdata('password'); ?></font></p></label>
														</div>														
													</div>
												</div>
												
												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<label>Confirm Password<font color='red'>*</font></label>
															<input type="password" name="cpassword" id="cpassword" value="" class="form-control input-lg">
															<label class="error" for="section_id"><p><font color="red"><?php echo $this->session->userdata('cpassword'); ?></font></p></label>
														</div>														
													</div>
												</div>
												
												<div class="row">
													<div class="col-md-12">
														<input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
														<input type="submit" value="Submit" class="btn btn-primary pull-right push-bottom" data-loading-text="Loading...">
													</div>
												</div>											
												
											</form>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>

				</div>

			</div>
			
			<?php $this->session->sess_destroy(); ?>
   
<script>
jQuery.noConflict();
// Code that uses other library's $ can follow here.
</script>   


<script>
jQuery(document).ready(function(){		
	jQuery("#register").validate({
		rules: {
			password: {
                required: true,
                minlength: 5
            },			
			cpassword: {
			required: true,
			equalTo: "#password"
			}, 			
		},
		messages: {			
			password: {
                required: "Please enter a password..!",
                minlength: "Your password must be at least 5 characters long..!"
            },
			cpassword: {
			required: "Please enter confirm password..!",
			equalTo: "Password and confirm password not matched..!" 
			}
		}
	});
});	
</script>




