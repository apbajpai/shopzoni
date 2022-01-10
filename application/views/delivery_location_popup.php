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
  <h2>Delivery Locations.</h2>
  
  <div class="table-responsive">          
  <table class="table">
    <thead>	
      <tr>
        <th>SL.</th>
        <th>Delivery Location</th>
        <th>Shipping Charge</th>       
      </tr>
    </thead>
	
    <tbody>
	<?php $i=1; foreach($delivery_location as $key=>$location){ ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php  echo substr($location->delivery_location, 0,30); if(strlen($location->delivery_location)>30) echo " ."; ?></td>
        <td><?php echo $location->shipping_charge; ?></td>       
      </tr>
	<?php $i++; } ?>  
    </tbody>
  </table>
  </div>
</div>

</body>
</html>
