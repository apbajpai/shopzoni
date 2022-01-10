<?php echo $this->session->userdata('arole'); ?>
<div class="vernav2 iconmenu">
	<ul>
		
		<?php if($this->session->userdata('arole') == '2'){ ?>		
		<li>
			<a href="#forproduct_packet" class="editor">Product Packet</a>
			<span class="arrow"></span>
			<ul id="forproduct_packet" <?php echo (($this->uri->segment(1)=='admin')&&($this->uri->segment(2)=='product_packet'))?'style="display:block;"':''?>>
				<li><a href="<?php echo base_url()?>admin/product_packet">View Product Packet</a></li>
				<li><a href="<?php echo base_url()?>admin/product_packet/addedit/<?php echo $this->session->userdata('product_id'); ?>">Add Product Packet</a></li>
			</ul>
		</li>				
		<?php } ?>
		
	</ul>
	<a class="togglemenu"></a>
	<br /><br />
</div><!--leftmenu-->
        