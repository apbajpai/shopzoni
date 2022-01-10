<?php $image_path = base_url()."brand/public/uploads/product/".$product_details->image[0]->image; ?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <div class="col-md-12" style="top:30px; right:5px" align="right"><a href="<?php echo base_url(); ?>shop/<?php echo $product_details->seller_code; ?>"><b>Back</b></a></div>
  <br>
  <h4>Seller Name : <?php echo $product_details->business_name; ?></h4>
  <h5>Product Name : <?php echo $product_details->product_name; ?> </h5> 
  <h5>Brand Name : <?php echo $product_details->brand_name; ?> </h5>  
  <p><img width="250" height="200" alt="" class="img-responsive" src="<?php echo $image_path; ?>"></p>  
  <?php if($product_details->offer){ ?>
  <h5>Offer : </h5>  
  <p><b><?php echo $product_details->offer; ?></b></p>
  <?php } ?>
  <?php if($product_details->short_description){ ?>
  <h5>Short Description : </h5> 
  <p><?php echo $product_details->short_description; ?></p>
  <?php } ?>
  <?php if($product_details->description){ ?>  
  <h5>Description : </h5>  
  <p><?php echo $product_details->description; ?></p>
  <?php } ?>
</div>

</body>
</html>

