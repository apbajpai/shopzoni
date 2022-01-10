<?php 
header("Content-type: application/x-msdownload"); 
header("Content-Disposition: attachment; filename=Product.xls"); 
header("Pragma: no-cache"); header("Expires: 0");   
?>

<table>

<tr>
<td>product_name</td>
<td>Image</td>
<td>section</td>
<td>category</td>
<td>Sub category</td>
<td>unit</td>
<td>weight</td>
<td>quantity</td>
<td>minimum_quantity_alert</td>
<td>tax_category</td>
<td>price</td>
<td>mrp</td>
<td>discount</td>
<td>Brand Name</td>
<td>Status</td>
</tr>


<?php foreach($product_record as $product){ ?>
<tr>
<td><?php echo $product->product_name; ?></td>
<td><?php echo $product->image; ?></td>
<td><?php echo $product->section_name; ?></td>
<td><?php echo $product->category_name; ?></td>
<td><?php echo $product->sub_category_name; ?></td>
<td><?php echo $product->unit; ?></td>
<td><?php echo $product->weight; ?></td>
<td><?php echo $product->quantity; ?></td>
<td><?php echo $product->minimum_quantity_alert; ?></td>
<td><?php echo $product->tax_category; ?></td>
<td><?php echo $product->price; ?></td>
<td><?php echo $product->mrp; ?></td>
<td><?php echo $product->discount; ?></td>
<td><?php echo $product->brand_name; ?></td>
<td><?php echo $product->status; ?></td>
</tr>
<?php } ?>
</table>
