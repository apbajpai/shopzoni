<div class="vernav2 iconmenu">
	<ul>	
		
		<?php if($this->session->userdata('arole') == '1'){ ?>
		<li>
			<a href="#forsellerregistration" class="editor">Seller Registration</a>
			<span class="arrow"></span>
			<ul id="forsellerregistration" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='seller_registration'))?'style="display:block;"':''?>>
				<li>
					<a href="<?php echo base_url()?>admin/seller_registration">View Seller Registration</a>
				</li>
				<li>
					<a href="<?php echo base_url()?>admin/seller_registration/addedit">
						Add Seller Registration
					</a>
				</li>
			</ul>
		</li>		
		
		<li>
			<a href="#formsection" class="editor">Section</a>
			<span class="arrow"></span>
			<ul id="formsection" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='section'))?'style="display:block;"':''?>>
				<li><a href="<?php echo base_url()?>admin/section/addedit">ADD Section</a></li>
				<li><a href="<?php echo base_url()?>admin/section">List Section</a></li>
			</ul>
		</li>
		
		<li>
			<a href="#forcategory" class="editor">category</a>
			<span class="arrow"></span>
			<ul id="forcategory" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='category')&&($this->uri->segment(3)=='main' || $this->uri->segment(3)=='addeditmain'))?'style="display:block;"':''?>>
				<li>
					<a href="<?php echo base_url()?>admin/category/main">View category</a>
				</li>
				<li>
					<a href="<?php echo base_url()?>admin/category/addeditmain">
						Add category
					</a>
				</li>
			</ul>
		</li>
		
		<li>
			<a href="#formsliderimage" class="editor">Home Slider Image</a>
			<span class="arrow"></span>
			<ul id="formsliderimage" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='slider_image'))?'style="display:block;"':''?>>
				<li><a href="<?php echo base_url()?>admin/slider_image/addedit">ADD Slider Image</a></li>
				<li><a href="<?php echo base_url()?>admin/slider_image">List Slider Image</a></li>
			</ul>
		</li>
		
		<li>
			<a href="#formproductsliderimage" class="editor">Home Product Slider Image</a>
			<span class="arrow"></span>
			<ul id="formproductsliderimage" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='slider_product_image'))?'style="display:block;"':''?>>
				<li><a href="<?php echo base_url()?>admin/slider_product_image/addedit">ADD Product Slider Image</a></li>
				<li><a href="<?php echo base_url()?>admin/slider_product_image">List Product Slider Image</a></li>
			</ul>
		</li>
		
		<li>
			<a href="#formbrandsliderimage" class="editor">Brand Slider Image</a>
			<span class="arrow"></span>
			<ul id="formbrandsliderimage" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='slider_brand_image'))?'style="display:block;"':''?>>
				<li><a href="<?php echo base_url()?>admin/slider_brand_image/addedit">ADD Brand Slider Image</a></li>
				<li><a href="<?php echo base_url()?>admin/slider_brand_image">List Brand Slider Image</a></li>
			</ul>
		</li>

		
		<li>
			<a href="#forasellerproduct" class="editor">Seller's Product</a>
			<span class="arrow"></span>
			<ul id="forasellerproduct" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='seller_product'))?'style="display:block;"':''?>>
				<li><a href="<?php echo base_url()?>admin/seller_product">Seller's Product</a></li>
			</ul>
		</li>
		
		<li>
			<a href="#forsellertermsconditions" class="editor">Seller's Terms & Condition</a>
			<span class="arrow"></span>
			<ul id="forsellertermsconditions" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='seller_terms_condition'))?'style="display:block;"':''?>>
				<li><a href="<?php echo base_url()?>admin/seller_terms_condition">Seller's Terms & Condition</a></li>
			</ul>
		</li>
		
		<li>
			<a href="#foradminbuyer" class="editor">Buyer List</a>
			<span class="arrow"></span>
			<ul id="foradminbuyer" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='buyer'))?'style="display:block;"':''?>>
				<li><a href="<?php echo base_url()?>admin/buyer">View Buyers</a></li>
			</ul>
		</li>

		<li>
			<a href="#foradminsubscription" class="editor">Subscription</a>
			<span class="arrow"></span>
			<ul id="foradminsubscription" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='subscription'))?'style="display:block;"':''?>>
				<li><a href="<?php echo base_url()?>admin/subscription">View Subscription</a></li>
			</ul>
		</li>		
		
		<li>
			<a href="#formcontact_us" class="editor">Contact Us</a>
			<span class="arrow"></span>
			<ul id="formcontact_us" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='contact_us'))?'style="display:block;"':''?>>
				<li><a href="<?php echo base_url()?>admin/contact_us">View Contact</a></li>
			</ul>
		</li>
		
		<li>
			<a href="#forbuyerquery" class="editor">Buyer Query</a>
			<span class="arrow"></span>
			<ul id="forbuyerquery" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='query'))?'style="display:block;"':''?>>
				<li><a href="<?php echo base_url()?>admin/query">View Buyer Query</a></li>
			</ul>
		</li>
		
		<li>
			<a href="#forreports" class="editor">Reports</a>
			<span class="arrow"></span> 
			<ul id="forreports" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='report') &&($this->uri->segment(3)=='buyer' || $this->uri->segment(3)=='seller' || $this->uri->segment(3)=='shop_visitor' || $this->uri->segment(3)=='order'  || $this->uri->segment(3)=='brand_seller_report'  || $this->uri->segment(3)=='product' || $this->uri->segment(3)=='buyer_request' || $this->uri->segment(3)=='message_seller'))?'style="display:block;"':''?>>
				<li><a href="<?php echo base_url()?>admin/report/buyer">Buyer Login Details</a></li>
				<li><a href="<?php echo base_url()?>admin/report/seller">Seller Login Details</a></li>	
				<li><a href="<?php echo base_url()?>admin/report/shop_visitor">Shop Visitor Details</a></li>
				<li><a href="<?php echo base_url()?>admin/report/order">Order Details</a></li>
				<li><a href="<?php echo base_url()?>admin/report/brand_seller_report">Brand Wise Seller</a></li>
				<li><a href="<?php echo base_url()?>admin/report/product">Product Details</a></li>
				<li><a href="<?php echo base_url()?>admin/report/buyer_request">Buyer Request</a></li>
				<li><a href="<?php echo base_url()?>admin/report/message_seller">Buyer Message</a></li>
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
		
		<?php } ?>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		<?php if($this->session->userdata('arole') == '2'){ ?>
		
		
		<li>
			<a href="#forprofile" class="editor">Profile</a>
			<span class="arrow"></span>
			<ul id="forprofile" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='profile'))?'style="display:block;"':''?>>				
				<li><a href="<?php echo base_url()?>admin/profile/addedit/<?php echo $this->session->userdata('seller_id'); ?>">Edit Profile</a></li>
			</ul>
		</li>
		
		
		<li>
			<a href="#formbrandProduct" class="editor">Add Brand Wise Product</a>
			<span class="arrow"></span>
			<ul id="formbrandProduct" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='brand_product'))?'style="display:block;"':''?>>
				<li><a href="<?php echo base_url()?>admin/brand_product">Brand Wise Product</a></li>
			</ul>
		</li>
		
		<li>
			<a href="#forproduct" class="editor">Yours Product</a>
			<span class="arrow"></span>
			<ul id="forproduct" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='product'))?'style="display:block;"':''?>>
				<li><a href="<?php echo base_url()?>admin/product">View Product</a></li>
				<!--<li><a href="<?php echo base_url()?>admin/product/addedit">Add Product</a></li>-->
			</ul>
		</li>	
		
		<?php 	
		$this->load->model('admin/quantity_alert_model');
		$total_unreadqtyalert	= $this->quantity_alert_model->GetTotalRecord();
		?>
		
		<li>
			<a href="#forquantityalert" class="editor">Quantity Alert <?php if($total_unreadqtyalert>0){ ?>&nbsp;&nbsp;&nbsp;&nbsp;[<?php echo $total_unreadqtyalert; ?>] <?php } ?></a>
			<span class="arrow"></span>
			<ul id="forquantityalert" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='quantity_alert'))?'style="display:block;"':''?>>
				<li><a href="<?php echo base_url()?>admin/quantity_alert">View Quantity Alert</a></li>
				<!--<li><a href="<?php echo base_url()?>admin/product/addedit">Add Product</a></li>-->
			</ul>
		</li>		
		
		<!--<li>
			<a href="#forbuyer_request" class="editor">Buyer Request</a>
			<span class="arrow"></span>
			<ul id="forbuyer_request" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='buyer_request'))?'style="display:block;"':''?>>
				<li><a href="<?php echo base_url()?>admin/buyer_request">View Buyer Request</a></li>				
			</ul>
		</li>-->
		<?php 
		$this->load->model('admin/order_model');
		$total_unreadorder	= $this->order_model->totalUnreadOrder(); ?>
		
		<li>
			<a href="#order" class="editor">Order <?php if($total_unreadorder>0){ ?>&nbsp;&nbsp;&nbsp;&nbsp;[<?php echo $total_unreadorder; ?>] <?php } ?></a>
			<span class="arrow"></span>
			<ul id="order" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='order' || $this->uri->segment(2)=='approved_order'))?'style="display:block;"':''?>>
				<li><a href="<?php echo base_url()?>admin/order">View Order</a></li>
				<li><a href="<?php echo base_url()?>admin/approved_order">Approved Order</a></li>
			</ul>
		</li>
		
		
		<?php 
		$this->load->model('admin/cancel_order_model');
		$total_unreadorder	= $this->cancel_order_model->totalUnreadOrder(); ?>
		
		<li>
			<a href="#cancelorder" class="editor">Cancel Order <?php if($total_unreadorder>0){ ?>&nbsp;&nbsp;&nbsp;&nbsp;[<?php echo $total_unreadorder; ?>] <?php } ?></a>
			<span class="arrow"></span>
			<ul id="cancelorder" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='cancel_order'))?'style="display:block;"':''?>>
				<li><a href="<?php echo base_url()?>admin/cancel_order">View Order</a></li>				
			</ul>
		</li>		
		
		<?php 
		$this->load->model('admin/message_seller_model');
		$total_unreadorder	= $this->message_seller_model->totalUnreadMessage(); ?>
		
		<li>
			<a href="#formessage" class="editor">Message From Buyer <?php if($total_unreadorder>0){ ?>&nbsp;&nbsp;&nbsp;&nbsp;[<?php echo $total_unreadorder; ?>] <?php } ?></a>
			<span class="arrow"></span>
			<ul id="formessage" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='message_seller'))?'style="display:block;"':''?>>
				<li><a href="<?php echo base_url()?>admin/message_seller">Message From Buyer</a></li>
			</ul>
		</li>
		
		
		<li>
			<a href="#fortermscondition" class="editor">Terms Conditions</a>
			<span class="arrow"></span>
			<ul id="fortermscondition" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='terms_conditions'))?'style="display:block;"':''?>>
				<li><a href="<?php echo base_url()?>admin/terms_conditions">Terms Conditions</a></li>
			</ul>
		</li>
		
		
		
		<li>
			<a href="#foremailhistory" class="editor">Email History</a>
			<span class="arrow"></span>
			<ul id="foremailhistory" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='email_history'))?'style="display:block;"':''?>>
				<li><a href="<?php echo base_url()?>admin/email_history">Email History</a></li>
			</ul>
		</li>
		
		<?php if($this->session->userdata('type') == '1'){ ?>
		
		<li>
			<a href="#forholiday" class="editor">Holiday</a>
			<span class="arrow"></span>
			<ul id="forholiday" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='holiday'))?'style="display:block;"':''?>>
				<li><a href="<?php echo base_url()?>admin/holiday">View Holiday</a></li>
				<li><a href="<?php echo base_url()?>admin/holiday/addedit">Add Holiday</a></li>
			</ul>
		</li> 
		
		
		
		<li>
			<a href="#fordeliverylocation" class="editor">Delivery Location</a>
			<span class="arrow"></span>
			<ul id="fordeliverylocation" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='delivery_location'))?'style="display:block;"':''?>>
				<li><a href="<?php echo base_url()?>admin/delivery_location">View Delivery Location</a></li>
				<li><a href="<?php echo base_url()?>admin/delivery_location/addedit">Add Delivery Location</a></li>
			</ul>
		</li>
		
		<li>
			<a href="#fortimeslot" class="editor">Time Slot</a>
			<span class="arrow"></span>
			<ul id="fortimeslot" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='time_slot'))?'style="display:block;"':''?>>
				<li><a href="<?php echo base_url()?>admin/time_slot">View Time Slot</a></li>
				<li><a href="<?php echo base_url()?>admin/time_slot/addedit">Add Time Slot</a></li>
			</ul>
		</li>
		
		<li>
			<a href="#forminvite" class="editor">Buyer's List</a>
			<span class="arrow"></span>
			<ul id="forminvite" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='invite_buyer' || $this->uri->segment(2)=='buyer_list'))?'style="display:block;"':''?>>
				<li><a href="<?php echo base_url()?>admin/buyer_list">Buyer's List</a></li>
			</ul>
		</li>

		
		<?php }else{ ?>
		
		<?php 
		$this->load->model('admin/buyer_request_model');
		$total_record	= $this->buyer_request_model->GetTotalRecord(); ?>
		<li>
			<a href="#formbuyermessage" class="editor">Buyer Request <?php if($total_record>0){ ?>&nbsp;&nbsp;&nbsp;&nbsp;[<?php echo $total_record; ?>] <?php } ?></a>
			<span class="arrow"></span>
			<ul id="formbuyermessage" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='buyer_request'))?'style="display:block;"':''?>>
				<li><a href="<?php echo base_url()?>admin/buyer_request">View Buyer Request</a></li>
			</ul>
		</li>
		
		<li>
			<a href="#forminvite" class="editor">Approved Buyer's List</a>
			<span class="arrow"></span>
			<ul id="forminvite" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='invite_buyer' || $this->uri->segment(2)=='address_book'))?'style="display:block;"':''?>>
				<li><a href="<?php echo base_url()?>admin/invite_buyer">Compose Email</a></li>
				<!--<li><a href="<?php echo base_url()?>admin/address_book/addedit">ADD Buyer</a></li>-->				
				<li><a href="<?php echo base_url()?>admin/address_book">Buyer's List</a></li>
			</ul>
		</li>
		
		<?php } ?>
		
		<?php } ?>
		
	</ul>
	<a class="togglemenu"></a>
	<br /><br />
</div><!--leftmenu-->
        