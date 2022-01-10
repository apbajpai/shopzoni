<?php echo $this->session->userdata('arole'); ?>
<div class="vernav2 iconmenu">
	<ul>
		
		<?php if($this->session->userdata('arole') == '2'){ ?>
		
		<li>
			<a href="#forsubcategory" class="editor">sub category</a>
			<span class="arrow"></span>
			<ul id="forsubcategory" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='category')&&($this->uri->segment(3)=='index' || $this->uri->segment(3)=='addedit'))?'style="display:block;"':''?>>
				<li>
					<a href="<?php echo base_url()?>admin/category/index">View sub category</a>
				</li>
				<li>
					<a href="<?php echo base_url()?>admin/category/addedit">
						Add sub category
					</a>
				</li>
			</ul>
		</li>		
		
		
		<li>
			<a href="#forproduct" class="editor">Product</a>
			<span class="arrow"></span>
			<ul id="forproduct" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='product'))?'style="display:block;"':''?>>
				<li><a href="<?php echo base_url()?>admin/product">View Product</a></li>
				<li><a href="<?php echo base_url()?>admin/product/addedit">Add Product</a></li>
			</ul>
		</li>		
		
		<li>
			<a href="#forpartner" class="editor">Partner</a>
			<span class="arrow"></span>
			<ul id="forpartner" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='partner'))?'style="display:block;"':''?>>
				<li><a href="<?php echo base_url()?>admin/partner">View Partner</a></li>
				<li><a href="<?php echo base_url()?>admin/partner/addedit">Add Partner</a></li>
			</ul>
		</li>
		
		<li>
			<a href="#forservicecenter" class="editor">Service Center</a>
			<span class="arrow"></span>
			<ul id="forservicecenter" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='service_center'))?'style="display:block;"':''?>>
				<li><a href="<?php echo base_url()?>admin/service_center">View Service Center</a></li>
				<li><a href="<?php echo base_url()?>admin/service_center/addedit">Add Service Center</a></li>
			</ul>
		</li>
		
		<li>
			<a href="#forsliderimage" class="editor">Slider Image</a>
			<span class="arrow"></span>
			<ul id="forsliderimage" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='slider_image'))?'style="display:block;"':''?>>
				<li><a href="<?php echo base_url()?>admin/slider_image">View Slider Image</a></li>
				<li><a href="<?php echo base_url()?>admin/slider_image/addedit">Add Slider Image</a></li>
			</ul>
		</li>
		
		<!--<li>
			<a href="#forbranddetails" class="editor">Brand Details</a>
			<span class="arrow"></span>
			<ul id="forbranddetails" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='brand_details'))?'style="display:block;"':''?>>
				<li><a href="<?php echo base_url()?>admin/brand_details">View Brand Details</a></li>
				<!--<li><a href="<?php echo base_url()?>admin/brand_details/addedit">Add Brand Details</a></li>-->
			<!--</ul>
		</li>-->		
		
		<li>
			<a href="#forbrandprofile" class="editor">Brand Profile</a>
			<span class="arrow"></span>
			<ul id="forbrandprofile" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='brand_profile'))?'style="display:block;"':''?>>
				<!--<li><a href="<?php echo base_url()?>admin/brand_profile">View Brand Profile</a></li>-->
				<li><a href="<?php echo base_url()?>admin/brand_profile/addedit">Brand Profile</a></li>
			</ul>
		</li>
				
		<?php } ?>
		
		
		
		<?php 

		if($this->session->userdata('arole') == '1'){?>
		
		<li>
			<a href="#formdepartment" class="editor">Department</a>
			<span class="arrow"></span>
			<ul id="formdepartment" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='department'))?'style="display:block;"':''?>>
				<li><a href="<?php echo base_url()?>admin/department/addedit">ADD Department</a></li>
				<li><a href="<?php echo base_url()?>admin/department">List Department</a></li>
			</ul>
		</li>
		
		<li>
			<a href="#formbrand" class="editor">Brand</a>
			<span class="arrow"></span>
			<ul id="formbrand" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='brand'))?'style="display:block;"':''?>>
				<li><a href="<?php echo base_url()?>admin/brand/addedit">ADD Brand</a></li>
				<li><a href="<?php echo base_url()?>admin/brand">List Brand</a></li>
			</ul>
		</li>
		
		<li>
			<a href="#formuser" class="editor">User</a>
			<span class="arrow"></span>
			<ul id="formuser" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='user'))?'style="display:block;"':''?>>
				<li><a href="<?php echo base_url()?>admin/user/addedit">ADD User</a></li>
				<li><a href="<?php echo base_url()?>admin/user">List User</a></li>
			</ul>
		</li>
		
		<li>
			<a href="#formadmin" class="editor">Admin</a>
			<span class="arrow"></span>
			<ul id="formadmin" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='admin'))?'style="display:block;"':''?>>
				<li><a href="<?php echo base_url()?>admin/admin/addedit">ADD Admin</a></li>
				<li><a href="<?php echo base_url()?>admin/admin">List Admin</a></li>
			</ul>
		</li>
		<?php }  ?>
		
	</ul>
	<a class="togglemenu"></a>
	<br /><br />
</div><!--leftmenu-->
        