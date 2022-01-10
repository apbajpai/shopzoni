<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/jquery-1.7.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/jquery.cookie.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/custom/general.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/plugins/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/custom/forms.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/plugins/tinymce/jquery.tinymce.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/jquery.tagsinput.min.js"></script>


<div role="main" class="main shop banner_top_margin account_page_header_height mobile_header_top_margin" >

				<div class="container">

					<div class="row">
						<div class="col-md-12">
						
						
						
						
						 <?php if (!$this->agent->is_mobile()){ ?>

							<div class="row featured-boxes login brand_page_top_mr">
								<div class="col-sm-6">
								
									<div class="featured-box featured-box-secundary default info-content">
										<div class="box-content">
											<h4>Login</h4>										
											<?php if($success_msg!=''){ ?><span style="color:green;"><?php echo $success_msg; ?></span><?php } ?>
											<?php if($this->session->userdata('sucess_msg')!=''){ ?><span style="color:green;"><?php echo $this->session->userdata('sucess_msg'); ?></span><?php 
											$data = array(
															'sucess_msg' => "",						
															);
											$this->session->set_userdata($data); } ?>
											<?php if($error_msg!=''){ ?><span style="color:red;"><?php echo $error_msg; ?></span><?php } ?>
											<form action="<?php echo base_url();?>dologin" id="login" name="login" method="post">
												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<label>E-mail Address</label>
															<input type="text" name="email_id" id="email_id" value="" class="form-control input-lg">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<span class="main-nav">															
															<a class="pull-right" href="#" data-toggle="modal" data-target="#myModal">Forgot Password</a>															
															</span>
															<label>Password</label>
															<input type="password" name="password" id="password" value="" class="form-control input-lg">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<span class="remember-box checkbox">
															<label for="rememberme">
																<input type="checkbox" id="rememberme" name="rememberme">Remember Me
															</label>
														</span>
													</div>
													<div class="col-md-6">
														<input type="submit" value="Login" class="btn <?php if (!$this->agent->is_mobile()){ ?>pull-right <?php } ?> push-bottom brand_search_btn btn_coust" data-loading-text="Loading...">
													</div>
													<div class="col-md-12">
														<!--<p> Login with your social networking account </p>-->
												        <!--<p> <a onclick="popup('<?php echo $login_url; ?>')" class="social_icon"><img src="<?php echo base_url(); ?>img/facebook.gif"/> SIGN IN WITH FACEBOOK</a>-->
														
														<!--<a href="" onclick="popup('<?php echo $login_url; ?>')" class="b_register"><img src="<?php echo base_url(); ?>img/facebook.gif"/> SIGN IN WITH FACEBOOK</a>-->
														<!--</p>
												        <p> <a href="<?php echo base_url(); ?>login_via_google" class="social_icon"><img src="<?php echo base_url(); ?>img/google_plua.png"/> SIGN IN WITH GOOGLE ACCOUNT</a> </p>
												        <p>Note : When you log out, please also log out from the corresponding account separately.</p>-->
													</div>
												</div>
												<input type="hidden" name="previous_url" id="previous_url" value="<?php echo $this->agent->referrer(); ?>">
											</form>
										</div>
									</div>
									
									
									
									
									
									<div class="featured-box featured-box-secundary default">
										<div class="box-content">
										<h4>Buyer Guide</h4>
											
										<div class="row">
											<div class="form-group">
												<div class="col-md-12">
													<a target="_blank" href="http://shopzoni.com/pdf/BuyerGuide.pdf">Click here</a> to view buyer guideline
												</div>
											</div>
										</div>
										</div>
												
									</div>	
								</div>
								<div class="col-sm-6">
									<div class="featured-box featured-box-secundary default info-content">
										<div class="box-content">
											<h4>Sign Up</h4>
											<?php if($success_msg_signup!=''){ ?><span style="color:green;"><?php echo $success_msg_signup; $success_msg_signup='';?></span><?php } ?>
											<?php if($reg_error_msg!=''){ ?><span style="color:red;"><?php echo $reg_error_msg; $reg_error_msg=''; ?></span><?php } ?>
											<form action="<?php base_url(); ?>register " id="register" name="register" method="post">
												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<label>Name <font color='red'>*</font></label>
															<input type="text" name="name" id="name" value="<?php echo $name; ?>" class="form-control input-lg">
															<label class="error" for="section_id"><p><font color="red"><?php echo $this->session->userdata('name'); ?></font></p></label>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<label>Business Name</label>
															<input type="text" name="business_name" id="business_name" value="<?php echo $business_name; ?>" class="form-control input-lg">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<label>Address <font color='red'>*</font></label>
															<input type="text" name="address" id="address" value="<?php echo $address; ?>" class="form-control input-lg">
															<label class="error" for="section_id"><p><font color="red"><?php echo $this->session->userdata('address'); ?></font></p></label>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<label>Pincode <font color='red'>*</font></label>
															<input type="text" name="pincode" id="pincode" value="<?php echo $pincode; ?>" class="form-control input-lg">
															<label class="error" for="section_id"><p><font color="red"><?php echo $this->session->userdata('pincode'); ?></font></p></label>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<label>E-mail Address <font color='red'>*</font></label>
															<input type="text" name="email" id="email" value="<?php echo $email; ?>" class="form-control input-lg">
															<label class="error" for="section_id"><p><font color="red"><?php echo $this->session->userdata('email'); ?></font></p></label>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<label>Phone/Mobile <font color='red'>*</font></label>
															<input type="text" name="mobile" id="mobile" value="<?php echo $mobile; ?>" class="form-control input-lg">
															<label class="error" for="section_id"><p><font color="red"><?php echo $this->session->userdata('mobile'); ?></font></p></label>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-6">
															<label>Password <font color='red'>*</font></label>
															<input type="password" name="password" id="rpassword" value="<?php echo $password; ?>" class="form-control input-lg">
															<label class="error" for="section_id"><p><font color="red"><?php echo $this->session->userdata('password'); ?></font></p></label>
														</div>
														<div class="col-md-6">
															<label>Re-enter Password <font color='red'>*</font></label>
															<input type="password" name="cpassword" id="rcpassword" value="<?php echo $cpassword; ?>" class="form-control input-lg">
															<span id='message'></span>
															<!--<label class="error" for="section_id"><p><font color="red"><?php echo $this->session->userdata('cpassword'); ?></font></p></label>-->
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<p> By Signup, you agree to our Terms & Conditions</p>
												</div>
												<div class="row">
													<div class="col-md-12">
														<input type="submit" value="Register" class="btn brand_search_btn btn_coust pull-right push-bottom" data-loading-text="Loading...">
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>

						</div>
    					
						 <?php }else{ ?>
						
						<div class="row featured-boxes login">
						
						<?php $uri1 = $this->uri->segment(1); 
						
						if($uri1=="login" || $redirect_url=="login" || $uri1=="activate_buyer"){
						?>
						
								<div class="col-sm-6">								
									<div class="featured-box featured-box-secundary default info-content">
										<div class="box-content">
											<h4>Login</h4>										
											<?php if($success_msg!=''){ ?><span style="color:green;"><?php echo $success_msg; ?></span><?php } ?>
											<?php if($this->session->userdata('sucess_msg')!=''){ ?><span style="color:green;"><?php echo $this->session->userdata('sucess_msg'); ?></span><?php 
											$data = array(
															'sucess_msg' => "",						
															);
											$this->session->set_userdata($data); } ?>
											<?php if($error_msg!=''){ ?><span style="color:red;"><?php echo $error_msg; ?></span><?php } ?>
											<form action="<?php echo base_url();?>dologin" id="login" name="login" method="post">
												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<label>E-mail Address</label>
															<input type="text" name="email_id" id="email_id" value="" class="form-control input-lg">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<span class="main-nav">															
															<a class="pull-right" href="#" data-toggle="modal" data-target="#myModal">Forgot Password</a>															
															</span>
															<label>Password</label>
															<input type="password" name="password" id="password" value="" class="form-control input-lg">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<span class="remember-box checkbox">
															<label for="rememberme">
																<input type="checkbox" id="rememberme" name="rememberme">Remember Me
															</label>
														</span>
													</div>
													<div class="col-md-6">
														<input type="submit" value="Login" class="btn <?php if (!$this->agent->is_mobile()){ ?>pull-right <?php } ?> push-bottom brand_search_btn btn_coust" data-loading-text="Loading...">
													</div>
													<div class="col-md-12">
														<!--<p> Login with your social networking account </p>-->
												        <!--<p> <a onclick="popup('<?php echo $login_url; ?>')" class="social_icon"><img src="<?php echo base_url(); ?>img/facebook.gif"/> SIGN IN WITH FACEBOOK</a>-->
														
														<!--<a href="" onclick="popup('<?php echo $login_url; ?>')" class="b_register"><img src="<?php echo base_url(); ?>img/facebook.gif"/> SIGN IN WITH FACEBOOK</a>-->
														<!--</p>-->
												        <!--<p> <a href="<?php echo base_url(); ?>login_via_google" class="social_icon"><img src="<?php echo base_url(); ?>img/google_plua.png"/> SIGN IN WITH GOOGLE ACCOUNT</a> </p>-->
												        <!--<p>Note : When you log out, please also log out from the corresponding account separately.</p>-->
													</div>
												</div>
												<input type="hidden" name="previous_url" id="previous_url" value="<?php echo $this->agent->referrer(); ?>">
											</form>
										</div>
									</div>										
									<div class="featured-box featured-box-secundary default">
										<div class="box-content">
										<h4>Buyer Guide</h4>
											
										<div class="row">
											<div class="form-group">
												<div class="col-md-12">
													<a target="_blank" href="http://shopzoni.com/pdf/BuyerGuide.pdf">Click here</a> to view buyer guideline
												</div>
											</div>
										</div>
										</div>
												
									</div>	
								</div>
								
						<?php }else if($uri1=="register"){ ?>		
								
								<div class="col-sm-6">
									<div class="featured-box featured-box-secundary default info-content">
										<div class="box-content">
											<h4>Sign Up</h4>
											<?php if($success_msg_signup!=''){ ?><span style="color:green;"><?php echo $success_msg_signup; $success_msg_signup='';?></span><?php } ?>
											<?php if($reg_error_msg!=''){ ?><span style="color:red;"><?php echo $reg_error_msg; $reg_error_msg=''; ?></span><?php } ?>
											<form action="<?php base_url(); ?>register " id="register" name="register" method="post">
												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<label>Name <font color='red'>*</font></label>
															<input type="text" name="name" id="name" value="<?php echo $name; ?>" class="form-control input-lg">
															<label class="error" for="section_id"><p><font color="red"><?php echo $this->session->userdata('name'); ?></font></p></label>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<label>Business Name</label>
															<input type="text" name="business_name" id="business_name" value="<?php echo $business_name; ?>" class="form-control input-lg">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<label>Address <font color='red'>*</font></label>
															<input type="text" name="address" id="address" value="<?php echo $address; ?>" class="form-control input-lg">
															<label class="error" for="section_id"><p><font color="red"><?php echo $this->session->userdata('address'); ?></font></p></label>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<label>Pincode <font color='red'>*</font></label>
															<input type="text" name="pincode" id="pincode" value="<?php echo $pincode; ?>" class="form-control input-lg">
															<label class="error" for="section_id"><p><font color="red"><?php echo $this->session->userdata('pincode'); ?></font></p></label>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<label>E-mail Address <font color='red'>*</font></label>
															<input type="text" name="email" id="email" value="<?php echo $email; ?>" class="form-control input-lg">
															<label class="error" for="section_id"><p><font color="red"><?php echo $this->session->userdata('email'); ?></font></p></label>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<label>Phone/Mobile <font color='red'>*</font></label>
															<input type="text" name="mobile" id="mobile" value="<?php echo $mobile; ?>" class="form-control input-lg">
															<label class="error" for="section_id"><p><font color="red"><?php echo $this->session->userdata('mobile'); ?></font></p></label>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-6">
															<label>Password <font color='red'>*</font></label>
															<input type="password" name="password" id="password" value="<?php echo $password; ?>" class="form-control input-lg">
															<label class="error" for="section_id"><p><font color="red"><?php echo $this->session->userdata('password'); ?></font></p></label>
														</div>
														<div class="col-md-6">
															<label>Re-enter Password <font color='red'>*</font></label>
															<input type="password" name="cpassword" id="cpassword" value="<?php echo $cpassword; ?>" class="form-control input-lg">
															<label class="error" for="section_id"><p><font color="red"><?php echo $this->session->userdata('cpassword'); ?></font></p></label>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<p> By Signup, you agree to our Terms & Conditions</p>
												</div>
												<div class="row">
													<div class="col-md-12">
														<input type="submit" value="Register" class="btn brand_search_btn btn_coust pull-right push-bottom" data-loading-text="Loading...">
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>

						 <?php } ?>
						</div>
						
						
						 <?php } ?>
						
					</div>

				</div>
			</div>

     

	

	 


	<div class="clear"></div>	

    <!---<div class="container">
    <div class="col-md-2"></div>
    <div><img src="img/add_banner.jpg" class="img-responsive"></div>
    </div>-->
	
	
	
<!--Pop Up-->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
      <div class="col-md-1"></div>
      <div class="col-md-10"><br/>
      <form name="forgot_password" id="forgot_password" action="<?php echo base_url();?>forgot_password" method="post">
        <label>E-mail Address</label>
        <input type="email" value="" placeholder="Enter Your Email id" name="email" id="email" class="form-control input-lg"><br/>
        <input type="submit" value="Submit" class="btn btn-default">
      </form>
      </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!--Pop Up End-->
    


<!-- Login-register >-->
  <div class="cd-user-modal" style="z-index:200000000000;">
  <!-- this is the entire modal form, including the background -->
  <div class="cd-user-modal-container">
   
    <div id="">
      <!-- log in form -->
      <form class="cd-form" name="forgot_password" id="forgot_password" action="<?php echo base_url(); ?>forgot_password" method="post">
         <p class="fieldset">
          <label class="image-replace cd-email" for="reset-email">E-mail</label>
          <input class="full-width has-padding has-border" name="email" id="reset-email" type="email" placeholder="E-mail">
          <span class="cd-error-message">Error message here!</span> </p>
        <p class="fieldset">
          <input class="full-width has-padding" type="submit" value="Reset password">
        </p>
      </form>
    </div>
	</div>
</div>	


<script language="javascript" type="text/javascript">
    $(document).ready(function () {
		$('#rpassword, #rcpassword').on('keyup', function () {
				
				
			if ($('#rpassword').val() == $('#rcpassword').val()) {
				
			$('#message').html('Password and confirm password matched..!').css('color', 'green');
			} else 
			$('#message').html('Password and confirm password not matched..!').css('color', 'red');
		});
	});
</script>


<script>
jQuery(document).ready(function(){
	 jQuery("#register").validate({
		rules: {
			name: "required",
			business_name: "required",
			address: "required",
			pincode: {
				required: true,
				number: true
			},
			email: {
				required: true,
				email: true
			},
			
			rpassword: {
                required: true,
                minlength: 5,
				maxlength: 20
            },			
			rcpassword: {
			required: true,
			minlength: 5,
			maxlength: 20,
			equalTo: "#rpassword"
			}, 			
			mobile: {
				required: true,
				number: true
			}					
		},
		
		messages: {
			email:{
			    email_id: "Please enter Email Address..!",
				email: "Please enter a valid email address..!"
			},
			rpassword: {
                required: "Please enter a password..!",
                minlength: "Your password must be at least 5 characters long..!",               
                maxlength: "Your password must be less than equal to 20 characters..!"               
            },			
			rcpassword: {
			required: "Please enter confirm password..!",
			equalTo: "Password and confirm password not matched..!" 
			}
		}
	});	
});	

</script>



<script>	
         
function popup(url) {
alert(url);	
//url="https://www.facebook.com/";
newwindow=window.open(url,'name','height=700,width=900');
if (window.focus) {newwindow.focus()}
return false;
}
</script>

<script src="<?php base_url(); ?>js/jquery_1.10.2_jquery.min.js"></script>

<script>
function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
  console.log('Name: ' + profile.getName());
  console.log('Image URL: ' + profile.getImageUrl());
  console.log('Email: ' + profile.getEmail());
  
  var id 	= 	profile.getId();
  var name 	= 	profile.getName();
  var url	=	profile.getImageUrl();
  var email	=	profile.getEmail();
 	
	$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>google_signin",
			data: {
				name : name,
				email : email,
			}
		})
		.done (function(data) { 
			//alert(data);
			//$('#ajaxDIV').html(data); 	
			//reload();
		})
		.fail(function(){ 
			alert("Error")   ; 
		});
}


function reload(){
	window.location.assign("<?php echo base_url(); ?>home");
}

</script>


<script>
  function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
    });
  }
</script>

   


