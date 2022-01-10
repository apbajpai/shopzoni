<?php $uri1 = $this->uri->segment(1); ?>
<?php $uri2 = $this->uri->segment(2); ?>


<script src="<?php base_url(); ?>js/jquery_1.10.2_jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/colorbox.css" />
<script src="<?php echo base_url(); ?>js/jquery.colorbox.js"></script>    
    
<style>
.option_sym{
  #background: url(<?php echo base_url();?>img/rupee_symbol.png) no-repeat; background-position:90px;
}
</style> 


  <script>
    $(document).ready(function(){
    $(".group1").colorbox({rel:'group1'});
    $('.retina').colorbox({rel:'', transition:'none', retinaImage:true, retinaUrl:true, width:"799",
      height:"419",
      overflow:"auto",
      title:"To close this dialog click any where else to dialog box", 
      iframe:true});
    
    $(".inline").colorbox({inline:true, width:"50%"});
    $(".inline1").colorbox({inline:true, width:"750px", height:"500px", overflow: "hidden"});
    $(".inline2").colorbox({inline:true, width:"750px", height:"300px", overflow: "hidden"});
    $(".ajax").colorbox();
            
    });
  </script>
  
		<div class="container-fluid banner_top_margin mobile_header_top_marginn" style="padding-top: 130px">

		<div class=" featured-boxes login">                
			<div class="col-sm-10 padding_l_r">
			  <div class="featured-box featured-box-secundary default info-content">
				<div class="box-content">					
				  <!--<h4><?php //$array = explode(" ",$this->session->userdata('name')); echo $first_name = $array[0]; ?></h4>-->
				  <h4><?php echo $seller_record[0]->business_name; ?></h4>
				  <h4><?php echo $seller_record[0]->business_address; ?></h4>
				  <h4><?php if($seller_record[0]->mobile_number!=""){ ?>
					Mobile No. - <?php echo $seller_record[0]->mobile_number; ?>
					<?php } ?></h4>
				</div>
			  </div>
			</div>
			<div class="col-sm-2 padding_l_r">
				<div class="featured-box featured-box-secundary default info-content">
					<div class="box-content">
						<h4><a target="_blank" href="<?php echo base_url();?>seller-details/<?php echo $seller_record[0]->seller_code; ?>">Seller Details</a></h4>
					</div>
				</div>
			</div>
		</div>

            
            <div class="col-md-12 padding_l_r">
            <nav class="navbar navbar-inverse navbar-static-top marginBottom-0" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            
            <div class="collapse navbar-collapse" id="navbar-collapse-1">
                <ul class="nav navbar-nav">
          <?php foreach($section_record as $section){ ?>
                    <li class="dropdown"><a href="<?php echo base_url().'shop/'.$seller_record[0]->seller_code.'/'.$section->code;?>" class="dropdown-toggle"><?php echo $section->name;?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
              <?php foreach($section->category_record as $category){ ?>
                            <li class="divider"></li>
                            <li class="dropdown dropdown-submenu"><a href="<?php echo base_url().'shop/'.$seller_record[0]->seller_code.'/'.$section->code.'/'.$category->code;?>" class="dropdown-toggle"><?php echo $category->name;?></a>
                <ul class="dropdown-menu">
                 <?php foreach($category->subcategory_record as $subcategory){ ?>
                  <li><a href="<?php echo base_url().'shop/'.$seller_record[0]->seller_code.'/'.$section->code.'/'.$category->code.'/'.$subcategory->code;?>"><?php echo $subcategory->name;?></a></li>
                 <?php } ?>
                </ul>
              </li>
              <?php } ?>
                        </ul>
                    </li>
          <?php } ?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
       
        </div>  
    </div>
	
	
	 <!----  Filter Code Start Here ---------------------->


    <div class="container-fluid padding_l_r shop_filter_prod">
	
      <div class="col-md-2 grid_margin">
       <div class="filter_box">
          <div class="brand_filter_head">Filter By</div>
          <div class="col-md-12">
		  
       <form name="productfrm" id="productfrm" action="<?php echo base_url().$uri1.'/'.$uri2; ?>" method = "post">
		  <div class="input-group input-search brand_search_box">
			<input type="text" class="form_search-control" name="product" id="product" placeholder="Product Name...">
			<span class="input-group-btn">
			<button class="btn brand_search_btn" type="submit">Search</button>
			</span>
		  </div>
       </form>
          </div>		  
		  <?php //echo base_url(uri_string()); ?>
          <div class="brand_filter_head">Brand</div>
            <div class="col-md-12">
			  <form name="brandfrm" id="brandfrm" action="<?php echo base_url().$uri1.'/'.$uri2; ?>" method = "post" style="display: block;">
			  <?php foreach($brand_record as $key=>$brand){ 
					
					if (in_array($brand->id, $brand_ids))
					  $selected = 'checked="checked"';
					else
					  $selected = '';
				  ?>
					  <div class="checkbox-custom checkbox-default check_box_brand">
				  <input type="checkbox" name="brand[]" id="brand<?php echo $brand->id; ?>" <?php echo $selected; ?> value="<?php echo $brand->id; ?>">
				  <label for="checkboxExample1"><?php echo $brand->name; ?></label>
					  </div>
					<?php } ?>  
					
					<div><button class="btn brand_search_btn btn_coust" type="submit">GO</button></div>
			  </form>
            </div>
            
          <div class="clear"></div>
       </div>
      </div>
      
    </div>  


  <div class="clear"></div> 
  
  
  
  <!---- End Filter Code Here ---------------------->
  
  
  
  
  
  
  <?php foreach($section_record as $section){   
			foreach($section->category_record as $category){			
				foreach($category->subcategory_record as $subcategory){
						$mobile_category1[$subcategory->id] = $subcategory;
				}
			}	
		}
		
		
		foreach($mobile_category1 as $cat1){
			foreach($product_record as $product){
				if($product->category_id==$cat1->id){
					$mobile_category[$cat1->id] = $cat1;
				}
			}
		}
		
		
		
  ?>  
  
  
  <?php foreach($mobile_category as $cat){ ?>
	
  <h4>&nbsp; &nbsp; <?php echo $cat->name; ?></h4>
  <div class="pro_shop_scroll box_scroll text-center product_saller_detail">
	<?php	
			foreach($product_record as $product){         
				if($product->image[0]->image!=''){
				  $image_path = base_url()."brand/public/uploads/product/".$product->image[0]->image;
				}else{
				  $image_path = base_url()."img/product-1.jpg";
				}
				$packet	=	$product->packet;				
			
		
		
			if($product->category_id==$cat->id){
			
		  ?>
		
	  <?php if($packet[0]->id!=''){ ?>
      <div class="m-box_d "> 
        <div><a onclick="productpopup('<?php echo $product->product_map_id; ?>');"><img src="<?php echo $image_path; ?>" class="shop_pro_img"></a></div>
          <div>
		  <?php  echo substr($product->name, 0,15); if(strlen($product->name)>15) echo " ..."; ?>
		  </div>
          <div>
			<?php if($product->offer){ ?>
				<a  onclick="productpopup('<?php echo $product->product_map_id; ?>');" title="<?php echo strip_tags($product->offer); ?>" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom" class="shop_cunt">
				<span style="color:#E57911;font-weight:bold; font-size:18px; text-decoration:underline;"><?php echo "Offer"; ?></span>
				</a>
			<?php }else{ ?>
			&nbsp;
			<?php } ?>
		  </div>
          <div><?php echo $product->brand_name; ?></div>
          <div>
			 <?php if($packet[0]->id!=''){ ?>
			<select class="form-control option_sym" name="packet_map_id<?php echo $product->product_map_id; ?>" id="packet_map_id<?php echo $product->product_map_id; ?>">
				<?php foreach($packet as $keys=>$pkt){ ?>
				  <option class="option_sym" value="<?php echo $pkt->id; ?>"><?php echo $pkt->weight; ?>  <?php echo $pkt->unit; ?>- Rs. <?php echo $pkt->price; ?></option>
				<?php } ?>  
			</select>
			 <?php }else{ ?>
				<div style="height:35px;"><?php echo $product->weight; ?> <?php echo $product->unit; ?> - Rs. <?php echo $product->price; ?></div>
			 <?php } ?>
			
		</div>
          <div class="input-group shop_cunt_input">
			<span class="input-group-btn"><button class="btn btn-default value-control" data-action="minus" data-target="quantity<?php echo $product->product_map_id; ?>"><span class="glyphicon glyphicon-minus"></span></button></span>
			<input type="text" name="quantity[]" id="quantity<?php echo $product->product_map_id; ?>" value="1" class="form-control qut_text">
			<div id="productavlDiv<?php echo $product->product_map_id; ?>" style="color:red; font-size:12px;"></div>
			<div id="productavlDivsucess<?php echo $product->product_map_id; ?>" style="color:green; font-size:12px;"></div>
			<span class="input-group-btn"><button class="btn btn-default value-control" data-action="plus" data-target="quantity<?php echo $product->product_map_id; ?>"><span class="glyphicon glyphicon-plus"></span></button></span>
			</div>
          <div><a class="btn brand_search_btn shop_cunt_bun" buy_now<?php echo $product->product_map_id; ?> onclick="buy_packet('<?php echo $product->product_map_id; ?>'),updateCartCounter();" type="submit">Add to Cart</a></div>
      </div>
	  
	  <?php }else{ ?>
	  
	  <div class="m-box_d "> 
        <div><a onclick="productpopup('<?php echo $product->product_map_id; ?>');">
		<img src="<?php echo $image_path; ?>" class="shop_pro_img"></a></div>
          <div>
		  <?php  echo substr($product->name, 0,15); if(strlen($product->name)>15) echo " ..."; ?>
		  </div>
          <div>
			<?php if($product->offer){ ?>
				<a  onclick="offerpopup('<?php echo $product->product_map_id; ?>');" title="<?php echo strip_tags($product->offer); ?>" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom" class="shop_cunt">
				<span style="color:#E57911;font-weight:bold; font-size:18px; text-decoration:underline;"><?php echo "Offer"; ?></span>
				</a>
			<?php }else{ ?>
			&nbsp;
			<?php } ?>
		  </div>
          <div><?php echo $product->brand_name; ?></div>
          <div>
			 <?php if($packet[0]->id!=''){ ?>
			<select class="form-control option_sym" name="packet_map_id<?php echo $product->product_map_id; ?>" id="packet_map_id<?php echo $product->product_map_id; ?>">
				<?php foreach($packet as $keys=>$pkt){ ?>
				  <option class="option_sym" value="<?php echo $pkt->id; ?>"><?php echo $pkt->weight; ?>  <?php echo $pkt->unit; ?>- Rs. <?php echo $pkt->price; ?></option>
				<?php } ?>  
			</select>
			 <?php }else{ ?>
				<div style="height:35px;"><?php echo $product->weight; ?> <?php echo $product->unit; ?> - Rs. <?php echo $product->price; ?></div>
			 <?php } ?>
			
		</div>
          <div class="input-group shop_cunt_input">
			<span class="input-group-btn"><button class="btn btn-default value-control" data-action="minus" data-target="quantity<?php echo $product->product_map_id; ?>"><span class="glyphicon glyphicon-minus"></span></button></span>
			<input type="text" name="quantity[]" id="quantity<?php echo $product->product_map_id; ?>" value="1" class="form-control qut_text">
			<div id="productavlDiv<?php echo $product->product_map_id; ?>" style="color:red; font-size:12px;"></div>
			<div id="productavlDivsucess<?php echo $product->product_map_id; ?>" style="color:green; font-size:12px;"></div>
			<span class="input-group-btn"><button class="btn btn-default value-control" data-action="plus" data-target="quantity<?php echo $product->product_map_id; ?>"><span class="glyphicon glyphicon-plus"></span></button></span>
			</div>
          <div><a class="btn brand_search_btn shop_cunt_bun" buy_now<?php echo $product->product_map_id; ?> onclick="buy('<?php echo $product->product_map_id; ?>'),updateCartCounter();" type="submit">Add to Cart</a></div>
      </div>  
	  
	  <?php } ?>

	<?php } } ?>
      
  </div>

  <div class="clear"></div>

  <?php } ?>
  
  
  
  <!--Pop Up-->
  <?php foreach($product_record as $product){ ?>
  <div id="myModal<?php echo $product->product_map_id; ?>" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <?php //foreach($product->image as $img_record){ 
        //$image_path = base_url()."brand/public/uploads/product/".$img_record->image;
        $image_path = base_url()."brand/public/uploads/product/".$product->image[0]->image;
      ?>
      <img width="750px" height="500px" src="<?php echo $image_path; ?>" />
      <?php //} ?>
    </div>

    </div>
  </div>
  <?php } ?>
  <!--Pop Up End-->
  
  
  
    
  
<script>
  function buy(id){ 
    check_quantity(id);
    var qty_id = 'quantity'+id;
    var quantity  = document.getElementById(qty_id).value;  
	    
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>addtocart",
      data: {
        quantity : quantity,
        product_id : id,
        seller_id : <?php echo $_SESSION['seller_id']; ?>,  
        //buyer_id : <?php echo $_SESSION['user_id']; ?>,
      }
    })
    .done (function(data) { 
      //alert(data);
      $('#cartDiv').html(data); 
    })
    .fail(function(){ 
      //alert("Error")   ; 
    });
  } 
  
  
  
  function buy_packet(id){    
    var qty_id = 'quantity'+id;
    var quantity  = document.getElementById(qty_id).value;  
	var packet_map = 'packet_map_id'+id;	
    var packet_map_id  = document.getElementById(packet_map).value;	
	check_packet_quantity(id,packet_map_id);
	//alert(packet_map_id);
    
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>addtocart",
      data: {
        quantity : quantity,
        product_id : id,
        packet_map_id : packet_map_id,
        seller_id : <?php echo $_SESSION['seller_id']; ?>,  
        //buyer_id : <?php echo $_SESSION['user_id']; ?>,
      }
    })
    .done (function(data) { 
      //alert(data);
      $('#cartDiv').html(data); 
    })
    .fail(function(){ 
      //alert("Error")   ; 
    });
  }
  
  
  function check_quantity(id){
    var qty_id = 'quantity'+id;
    var quantity  = document.getElementById(qty_id).value;  
    //document.getElementById(qty_id).value="";
    //alert(quantity);
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>check_quantity",
      data: {
        quantity : quantity,
        product_id : id,
        seller_id : <?php echo $_SESSION['seller_id']; ?>,  
        //buyer_id : <?php echo $_SESSION['user_id']; ?>,
      }
    })
    .done (function(data) { 
      var val = data.split("###");      
      if(val[1]==1)
      {
        $('#productavlDiv'+val[0]).html('');
        updateCartCounter();        
      }else if(val[1]!=''){
        $('#productavlDiv'+val[0]).html(val[1]);
      }
    })
    .fail(function(){ 
      //alert("Error")   ; 
    });
  }
  
  
  function check_packet_quantity(id,packet_map_id){
    var qty_id = 'quantity'+id;
    var quantity  = document.getElementById(qty_id).value;  
    //document.getElementById(qty_id).value="";
    //alert(quantity);
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>check_packet_quantity",
      data: {
        quantity : quantity,
        product_id : id,
        packet_map_id : packet_map_id,
        seller_id : <?php echo $_SESSION['seller_id']; ?>,  
        //buyer_id : <?php echo $_SESSION['user_id']; ?>,
      }
    })
    .done (function(data) { 
      var val = data.split("###"); 
	  //alert(val[1]);
      if(val[1]==1)
      {
        $('#productavlDiv'+val[0]).html('');
        updateCartCounter();        
      }else if(val[1]!=''){
        $('#productavlDiv'+val[0]).html(val[1]);
      }
    })
    .fail(function(){ 
      //alert("Error")   ; 
    });
  }
  
  
  
  function updateCartCounter()
  {   
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>updateCartCounter",
      data: {
        seller_id : <?php echo $_SESSION['seller_id']; ?>,  
      }
    })
    .done (function(data) { 
      //alert(data);
      $('#cartCounter').html(data); 
    })
    .fail(function(){ 
      //alert("Error")   ; 
    });
  }
  
</script>
    <style type="text/css">
       
.dropdown-menu > li.kopie > a {
    padding-left:5px;
}
 
.dropdown-submenu {
    position:relative;
}
.dropdown-submenu>.dropdown-menu {
   top:0;left:100%;
   margin-top:-6px;margin-left:-1px;
   -webkit-border-radius:0 6px 6px 6px;-moz-border-radius:0 6px 6px 6px;border-radius:0 6px 6px 6px;
 }
  
.dropdown-submenu > a:after {
  border-color: transparent transparent transparent #333;
  border-style: solid;
  border-width: 5px 0 5px 5px;
  content: " ";
  display: block;
  float: right;  
  height: 0;     
  margin-right: -10px;
  margin-top: 5px;
  width: 0;
}
 
.dropdown-submenu:hover>a:after {
    border-left-color:#555;
 }

.dropdown-menu > li > a:hover, .dropdown-menu > .active > a:hover {
  text-decoration: underline;
}  
  
@media (max-width: 767px) {
  .navbar-nav  {
     display: inline;
  }
  .navbar-default .navbar-brand {
    display: inline;
  }
  .navbar-default .navbar-toggle .icon-bar {
    background-color: #fff;
  }
  .navbar-default .navbar-nav .dropdown-menu > li > a {
    color: red;
    background-color: #ccc;
    border-radius: 4px;
    margin-top: 2px;   
  }
   .navbar-default .navbar-nav .open .dropdown-menu > li > a {
     color: #333;
   }
   .navbar-default .navbar-nav .open .dropdown-menu > li > a:hover,
   .navbar-default .navbar-nav .open .dropdown-menu > li > a:focus {
     background-color: #ccc;
   }

   .navbar-nav .open .dropdown-menu {
     border-bottom: 1px solid white; 
     border-radius: 0;
   }
  .dropdown-menu {
      padding-left: 10px;
  }
  .dropdown-menu .dropdown-menu {
      padding-left: 20px;
   }
   .dropdown-menu .dropdown-menu .dropdown-menu {
      padding-left: 30px;
   }
   li.dropdown.open {
    border: 0px solid red;
   }

}
 
@media (min-width: 768px) {
  ul.nav li:hover > ul.dropdown-menu {
    display: block;
  }
  #navbar {
    text-align: center;
  }
}  

.shop_cunt{
color:#000!important;
}
    </style>
    
    <script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>

<script>
function offerpopup(str){	
    var myWindow = window.open("<?php echo base_url().'product-offer/'; ?>"+str, "", "width=500,height=500");
}
</script>


<script>
function productpopup(str){	
    var myWindow = window.open("<?php echo base_url().'product-description-popup/'; ?>"+str, "", "width=500,height=500");
}
</script>