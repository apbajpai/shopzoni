<script type="text/javascript" src="<?php echo VIEWBASE?>js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE?>js/plugins/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo VIEWBASE?>js/custom/forms.js"></script>
<?php 
if($row){
	$id=$row->id; 
	$brand_id=$row->brand_id; 
	$name=$row->name; 
	$email=$row->email; 
	//$password=$row->password; 
	$role = $row->role;
	$indate=$row->indate; 
	$status=$row->status; 
	$created_by=$row->created_by; 
}
else{
	$status = 1;
	$id = 0;
}
?> 
<div class="centercontent">
	<div class="pageheader">
		<h1 class="pagetitle"><?php echo $heading; ?></h1>
		<span class="pagedesc"><div style="color:red"><?php echo validation_errors(); ?></div></span>
		<?php if($msg!=''){ ?>
				<span class="pagedesc"><div style="color:red"><?php echo $msg; ?></div></span>
		<?php } $msg='';?>
	</div><!--pageheader-->
    <div id="contentwrapper" class="contentwrapper">
		<div id="validation" class="subcontent">            	
			<form enctype="multipart/form-data" method="post" class="stdform" id="admin" name="add_data_view" accept-charset="utf-8" action="<?php echo base_url();?>admin/admin/save">	
				
				<!--<p>
					<label>Brand<font color='red'>*</font></label>
					<span class="field">
						<select name="brand_id" id="brand_id">
							<option value="">Select Brand</option>
							<?php
								foreach($brands as $val){
									if($brand_id==$val->id)$selected='selected="selected"';
									else $selected='';
							?>
									<option value="<?php echo $val->id; ?>" <?php echo $selected ?>><?php echo $val->name; ?></option>
							<?php
								}
							?>
						</select>
					</span>					
				</p>-->
				
				<p>
					<label>Name<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="name" id="name" class="longinput" value="<?php echo $name?>" />
					</span>					
				</p>
				
				<p>
					<label>Email<font color='red'>*</font></label>
					<span class="field">
						<input type="text" name="email" id="email" class="longinput" value="<?php echo $email?>" />
					</span>
				</p>
				
				<p>
					<label>Password<font color='red'>*</font></label>
					<span class="field">
						<input type="password" name="password" id="password" class="longinput" value="<?php echo $password?>" />
					</span>
				</p>
				
				<!--<p>
					<label>Role<font color='red'>*</font></label>
					<span class="field">
						<select name="role" id="role">
							<option value="">Select Role</option>
							<?php foreach($roles as $role1){?>
              <option value="<?php echo $role1->id; ?>" <?php echo ($role1->id == $role)?'selected':''; ?>><?php echo $role1->name; ?></option>
							<?php }?>
						</select>
					</span>					
				</p>-->
				
				<p>
					<label>Status</label>
					<span class="field">
					<select name="status">
						<option value="1" <?php if($status==1)echo 'selected';?>>Active</option>
						<option value="0" <?php if($status==0)echo 'selected';?>>Inactive</option>
					</select>
					</span>
				</p>	
				
				<p class="stdformbutton">					
					<input type="submit"  name="addedit" id="addedit" value="Submit">
					<input type="hidden" name="id" id="id" value="<?php echo $id?>">
				</p>
				
			</form>
        </div>
	</div><!--contentwrapper-->
    <br clear="all" />
</div><!-- centercontent -->


<script>
jQuery(document).ready(function(){
	
	jQuery("#admin").validate({
		rules: {
			brand_id: "required",
			name: "required",
			email: {
				required: true,
				email: true
			},
			password: {
                required: true,
                minlength: 5
            },
		},
		messages: {
			name: {
				required: "Please enter name",
			},
			password: {
                required: "Please enter a password..!",
                minlength: "Your password must be at least 5 characters long..!"
            },
		}
	});
	
});	
</script>

