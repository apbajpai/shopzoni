<?php $uri2 = $this->uri->segment(2);  ?>
<div role="main" class="main shop banner_top_margin" style="padding-top: 180px">

				<div class="container">

					<div class="row">

						<div class="col-md-3 grid_margin">
							<div class="filter_box">
							<div class="brand_filter_head">Search</div>
							<div class="col-md-12">
					<form name="brandfrm" id="brandfrm" action="<?php echo base_url().'partner/'.$uri2; ?>" method = "post" style="display: block;">
					<div class="brand_detail_head">STATE</div>
					
					<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
					  <link rel="stylesheet" href="/resources/demos/style.css">
					  <script src="<?php echo base_url();?>carausel/js/jquery-1.9.1.min.js"></script>
					  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
					  
					  <?php						
						foreach($state_record as $key=>$state){
							if($key==0)
								$state_records = '"'.$state->state_name.'"';
							else
								$state_records .= ','.'"'.$state->state_name.'"';
						}
					  ?>			  
					  
					  <script>					  
					  jQuery( function() {
						var availableTags = [ <?php echo $state_records; ?>
						];
						jQuery( "#state" ).autocomplete({
						  source: availableTags
						});
					  } );
					  </script>
					  
					<div class="input-search brand_filter_location_box">
					  <input type="text" class="form_search-control" id="state" name="state" value="<?php echo $search['state']; ?>" placeholder="STATE...">
					</div>
					 <div class="brand_detail_head">DISTRICT/CITY</div>
					 <?php
						foreach($city_record as $key=>$city){
							if($key==0)
								$city_records = '"'.$city->district_name.'"';
							else
								$city_records .= ','.'"'.$city->district_name.'"';
						}
					?>			  
					  
					  <script>
					 
					  $( function() {
						var availableTags = [ <?php echo $city_records; ?> ];
						$( "#city" ).autocomplete({
						  source: availableTags
						});
					  } );
					  </script>
					 
					<div class="input-search brand_filter_location_box">
					  <input type="text" class="form_search-control" id="city" name="city" value="<?php echo $search['city']; ?>" placeholder="CITY...">
					</div>
					 <div class="brand_detail_head">PINCODE</div>
					 
					 <?php							
						/*foreach($pincode_record as $key=>$pincode){
							if($key==0)
								$pincode_records = '"'.$pincode->pincode.'"';
							else
								$pincode_records .= ','.'"'.$pincode->pincode.'"';
						} */
					  ?>			  
					  
					  <script>
					  $( function() {
						var availableTags = [ <?php echo $pincode_records; ?> ];
						$( "#pincode" ).autocomplete({
						  source: availableTags
						});
					  } );
					  </script>
					  
					<div class="input-search brand_filter_location_box">
					  <input type="text" class="form_search-control" id="pincode" name="pincode" value="<?php echo $search['pincode']; ?>" placeholder="PINCODE...">
					</div>
					<div><button class="btn brand_search_btn btn_coust" type="submit">GO</button></div>
					</form>
              </div>




							<div class="clear"></div>
							</div>
     					</div>


						<div class="col-md-9">

							<div class="row featured-boxes login">
								
								<div class="col-sm-12">
									<div class="featured-box featured-box-secundary default info-content">
										<div class="box-content">
											<h4><?php echo $brand_record->name; ?> Partners</h4>
						<div class="panel-body">
							<?php if($partner_record[0]->id !=""){ ?>
							<table class="table table-bordered table-striped table-condensed mb-none">
								<thead>
									<tr>
										<th class="text-center">Partner Name</th>
										<th class="hidden-xs hidden-sm text-center">Email</th>
										<th class="text-center">Address</th>
										<th class="text-center">Associated</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									if($search_title=="Partners"){
									foreach($partner_record as $key=>$partner){ 
															
									switch($partner->type){
										case 1: $type = "Distributor";
										break;
										case 2: $type = "Wholesaler";
										break;
										case 3: $type = "Dealer";
										break;
										case 4: $type = "Retailer";
										break;
									}
									
									?>
									<tr>
										<td class="text-center"><?php echo $partner->name; ?></td>
										<td class="hidden-xs hidden-sm text-center"><?php echo $partner->email; ?></td>
										<td class="text-center"><?php echo $partner->address; ?></td>
										<td class="text-center"><?php echo $type; ?></td>
									</tr>

									<?php } } ?>
									
								</tbody>
							</table>
							<?php }else{ 						
							if($search['state']=="" && $search['city']=="" && $search['pincode']==""){ ?>							
							This brand has no partner on shopzoni. <a href="<?php echo base_url(); ?>service_center/<?php echo $brand_record->id; ?>">Contact brand</a> for further detail.
							<?php }else{ ?>
							This Brand has no partners for <?php 
							if($search['state']){ echo '<br>'."state - ".$search['state'].'<br>'; }
							if($search['city']){ echo "city - ".$search['city'].'<br>'; }
							if($search['pincode']){ echo "pincode - ".$search['pincode'].'<br>'; }
							?>							
							<?php } }?>
						</div>
						</div>
									</div>
								</div>
							</div>

						</div>
    					
					</div>

			</div>

     

	

	 


	<div class="clear"></div>	

    <!--<div class="container">
    <div class="col-md-2"></div>
    <div><img src="<?php echo base_url();?>img/add_banner.jpg" class="img-responsive"></div>
    </div>--->
	
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/jquery-1.7.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/jquery.cookie.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/custom/general.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/plugins/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/custom/forms.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/plugins/tinymce/jquery.tinymce.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/jquery.tagsinput.min.js"></script>	
	
	
<script>
jQuery(document).ready(function(){	
	jQuery("#brandfrm").validate({
		rules: {
			pincode: {
				//required: true,
				number: true,
				minlength: 6,
				maxlength: 6
			}	
		},
		
		messages: {			
			pincode: {
                //required: "Please enter  pincode..!",
                number: "Enter number only",               
                minlength: "Your pincode must be 6 digit long..!",               
                maxlength: "Your pincode shuuld only 6 digit long..!"               
            }
		}
	});	
});	

</script>  



   


    