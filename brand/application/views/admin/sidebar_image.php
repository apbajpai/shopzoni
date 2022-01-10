<?php echo $this->session->userdata('arole'); ?>
<div class="vernav2 iconmenu">
	<ul>
		
		<?php if($this->session->userdata('arole') == '2'){ ?>		
		<li>
			<a href="#forproduct" class="editor">Product Image</a>
			<span class="arrow"></span>
			<ul id="forproduct" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='product_image'))?'style="display:block;"':''?>>
				<li><a href="<?php echo base_url()?>admin/product_image">View Product Image</a></li>
				<li><a href="<?php echo base_url()?>admin/product_image/addedit/<?php echo $this->session->userdata('product_id'); ?>">Add Product Image</a></li>
			</ul>
		</li>				
		<?php } ?>
		
		
		
		
		
	</ul>
	<a class="togglemenu"></a>
	<br /><br />
</div><!--leftmenu-->
        