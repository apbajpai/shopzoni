<style>
	body
	{
		background-color: rgb(240,240,240);
		margin: 0px;
		padding: 0px;
	}
	#main-body
	{
		font-family: sans-serif;
		max-width: 860px;
		margin: 0px auto;
		padding: 0px 10px;
		border: 1px dotted green;
		background-color: white;
		/*padding-top: 20px;*/
	}
	.accordion
	{
		width: 220px;
		margin: -15px;
		float: left;			
	}
	@media (max-width: 350px)
	{
		.accordion
		{
			width: 93%;
		}
	}
	h2
	{
		text-align: center;
		margin-bottom: 0px;				
		color: white; 
		line-height: 2em; 
		font-weight: 100; 
		font-family: monospace;
	}
	h3
	{
		color: green;
		font-weight: 105;
		padding-top: 10px;
		margin-bottom: 0px;
		clear: both;
	}
	
	code
	{
		display: block;
		margin: 5px 0px;
		padding: 0px 20px;
		font-size: 15px;
		color: gray;		
		border-left: 3px solid green;
		background-color: rgba(248, 248, 248, 0.5);
	}
	.dark-blue
	{
		color: #069;
		font-weight: bold;
	}
	.string
	{
		color: blue;
	}
	#intro
	{
		padding: 5px 10px;	
		line-height: 1.4em;		
	}
	ul
	{
		-webkit-padding-start: 0px;
		-moz-padding-start: 0px;
		-khtml-padding-start: 0px;
		-o-padding-start: 0px;
		padding-start: 0px;		
	}
	ul code
	{
		padding-left: 40px;
	}
	ul ul code
	{
		padding-left: 80px;
	}
	.button
	{
		display: inline-block;
		border: 1px solid black;
		margin-right: 5px;
		padding: 5px;
		border-radius: 5px;
		text-decoration: none;
		background-color: rgb(240,240,240);
		color: black;
		
		box-shadow: -1px -1px 1px 0px black;
	}

	#submit {
		background-color:#ed9c28;
		border:none;
		border-radius:5px;
		margin-top:1px;
	}
	.button:visited
	{
		color:black;
		
	}
	.button:hover
	{
		box-shadow: -1px -1px 3px 1px black;
	}
	a, a:visited
	{
		color:red;
	}
	#nn {
		width:30%;
		height:auto;
		background-color:#ccc;
		color:#ffffff;
	}
	#pro {
	width:14%;
	height:auto;
	border-left:1px solid gray;
		background-color:#ccc;
		color:#ffffff;
		 padding-left:35px;
		
	}
	#nn1 {
		width:30%;
		height:auto;		
	}
	
	#nn15 {
		width:60%;
		height:auto;
		
	}
	
	#pro1 {
	width:13.888%;
	height:auto;
	padding-left:35px;
	border-left: 0px solid #ccc;
	text-align:right;

	}
	#pro2 {
	width:13.888%;
	height:auto;
	padding-left:35px;
	border-left: 0px solid #ccc;
	//margin-left:7px;
	}
	#pro3 {
	width:13.888%;
	height:auto;
	padding-left:35px;
	border-left: 0px solid #ccc;
	//margin-left:7px;
	}
	#pro4 {
	width:13.888%;
	height:auto;
	padding-left:35px;
	border-left: 0px solid #ccc;
	text-align:right;
	
	}
	#pro5 {
	width:13.888%;
	height:auto;
	padding-left:35px;
	border-left: 0px solid #ccc;
	//margin-left:7px;
	}
	#pro11 {
	width:13.99999%;
	height:auto;
	padding-left:30px;
	border-left: 0px solid #ccc;
	float:right;
	}
	#nn2 {
		width:30%;
		height:auto;
		background-color:#ccc;
		margin-top:2px;
	}
	#pro22 {
	width:14%;
	height:auto;
	margin-top:2px;
	padding-left:22px;
	background-color:#ccc;
	}
	
	#pro221 {
	width:14%;
	height:auto;
	margin-top:2px;
	padding-left:22px;
	background-color:#ccc;
	text-align:right;
	}
		
</style>
	
	
	
		
<div role="main" class="main shop">
<div class="container">					
<div class="row">
<div class="col-md-12">
<div class="row featured-boxes login">


<div class="col-md-12" id="login">
<div class="featured-box featured-box-secundary default">
<div class="box-content">
<!--<h4>Cart</h4>-->										
<?php if($sucess_msg!=''){ ?><span style="color:green;"><?php echo $sucess_msg; ?></span><?php } ?>
<?php if($error_msg!=''){ ?><span style="color:red;"><?php echo $error_msg; ?></span><?php } ?>
<div class="row">
<div class="form-group">
<div class="col-md-12">															
<div class="container-fluid">		
<div id="sellercartDiv">			
<div class="col-md-10">
	<div class="broduct_box_devise">
	<!--<div class="row product_border mobile_phone_hide" id="pp">
	<div class="col-md-3 " id="nn">Seller code</div>
	<div class="col-md-6 " id="nn">Sneller Name</div>					
	<div class="col-md-3 " id="pro">Action</div>
	</div>-->
	
	
	<h4>Orders</h4>
	<?php 
	    $amount= 0;
		$total = 0;
		if(count($seller_cart_record[0])>0){
		foreach($seller_cart_record as $key=>$seller){ 
	?>
	<div class="row product_detail_border product_cat" style="color:black;">
	<div class="col-md-3 " 1d="nn1"><b><?php echo $seller->seller_code; ?></b></div>
	<div class="col-md-6" 1d="nn1"><b><?php echo $seller->business_name; ?></b></div>
	<div class="col-md-3 " id="pro1">
	<button type="button" class="btn btn-warning" id="your_orders<?php echo $seller->seller_id; ?>" data-toggle="collapse" data-target="#toggle-example">View Orders</button></div>
	</div>
	
	<script>						
			$("#your_orders<?php echo $seller->seller_id; ?>").click(function(){						  
			  $("#cartDiv<?php echo $seller->seller_id; ?>").toggle(); // toggle collapse
			});
	</script>

	
	<div id="cartDiv<?php echo $seller->seller_id; ?>" style="display:none">
	<div class="col-md-10">
	<form name="frm<?php echo $seller->seller_id; ?>" id="frm<?php echo $seller->seller_id; ?>" action="<?php echo base_url(); ?>place_order" method="post">
		<div class="broduct_box_devise">
			<tr>
			<div class="row product_border mobile_phone_hide" id="pp">
			<div class="col-md-3 " id="nn">Name</div>            
			<div class="col-md-1 " id="pro">Price</div>
			<div class="col-md-1 " id="pro">Unit</div>
			<div class="col-md-1 " id="pro">Qty</div>
			<div class="col-md-1 " id="pro">Amount</div>
			<div class="col-md-1 " id="pro">Action</div>
			</div>
			
			<?php 
				$amount= 0;
				$total = 0;
				foreach($cart_record[$seller->seller_id] as $product){ 
					$amount = ($product->price*$product->quantity);
					$total += $amount; 
					
			?>
			<div id="cartRowDiv<?php echo $product->cart_id; ?>">
			<div class="row product_detail_border product_cat"  style="color:black;">
			<div class="col-md-3 " id="nn1"><?php echo $product->name; ?></div>
			<div class="col-md-1 " id="pro1"><?php echo $product->price; ?></div>
			<div class="col-md-1 " id="pro2"><?php echo $product->unit; ?></div>				
			<div class="col-md-1 " id="pro3"><?php echo $product->quantity; ?></div>
			<div class="col-md-1 " id="pro4"><?php echo number_format($product->price*$product->quantity , 2, '.', ''); ?></div>																		
			<input type="hidden" class="qty" name="qty[]" value="<?php echo number_format($product->price*$product->quantity , 2, '.', ''); ?>" />						
			<div class="col-md-1 " id="pro5"><a onclick="removetocart('<?php echo $product->cart_id; ?>','<?php echo $seller->seller_id; ?>')" ><i class="fa fa-times" aria-hidden="true"></i></a></div>
			<input type="hidden" name="cart_ids[]" value="<?php echo $product->cart_id; ?>">
			</div>
			</div>
			<?php } ?>
			
			<div class="row product_detail_border product_cat" style="color:black;">
			<div class="col-md-3 " id="nn2"><b>Total</b></div>
			<div class="col-md-1 " id="pro22">&nbsp;</div>
			<div class="col-md-1 " id="pro22">&nbsp;</div>				
			<div class="col-md-1 " id="pro22">&nbsp;</div>
			<div class="col-md-1 " id="pro221"><div id="total_quantity"><?php echo number_format($total, 2, '.', ''); ?></div></div>
			<div class="col-md-1" ><input type="submit" name="submit" id="submit" value="<?php if($seller->type=="B2B"){?>submit<?php }else{ ?>Proceed <?php } ?>"></div>	
			<input type="hidden" name="type" id="type" value="<?php echo $seller->type; ?>">
			<input type="hidden" name="seller_id" id="seller_id" value="<?php echo $seller->seller_id; ?>">
			</div>
			
			<div class="row product_detail_border product_cat">						
				<div class="col-md-12" >&nbsp;</div>						
			</div>																			
		</div>
	</form>	
		
	</div>		
	</div>
	<?php } }else if($sucess_msg==""){ ?>
	<span> There is no item in your cart. </span>
	<?php } ?>
	
	
	</div>
</div>			
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

</div>

</div>
</div>
</div>
</div>
		
		
	
<script>
	function removetocart(cart_id,seller_id) {	

		$.ajax({			
			type: "POST",
			url: "<?php echo base_url(); ?>removetocart",
			data: {
				cart_id : cart_id,
				seller_id : seller_id
			}
		})
		.done (function(data) { 
			$('#cartRowDiv'+data).remove();	
			
			var sum = 0;
			$('.qty').each(function(){
			   sum += Number($(this).val());
			});
			//alert(sum);
			
			$(total_quantity).html(sum);
			//$('#cartDiv'+data).show();	
		})
		.fail(function(){ 
			//alert("Error")   ; 
		});
	}	
</script>

<script>
$("#b2bbtn").click(function(){
    $("#b2cdiv").hide();
	$("#b2bdiv").show();
});

$("#b2cbtn").click(function(){
    $("#b2bdiv").hide();
	$("#b2cdiv").show();
});


$("#proceed").click(function(){
    $( "#proceedDIV" ).toggle();
});
</script>
