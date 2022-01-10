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
  <h4>Seller Name : <?php echo $product_offer->business_name; ?></h4>
  <h5>Product Name : <?php echo $product_offer->product_name; ?></h5>
  <h5>Offer : </h5>
  <p><?php echo $product_offer->offer; ?></p>                                                                                      
  
</div>

</body>
</html>

