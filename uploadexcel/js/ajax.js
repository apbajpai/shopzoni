function createRequestObject()
{
	var xmlhttp = false;
	try
	{
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch (e)
 	{
		try 
		{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  		} 
		catch (E) 
		{
			xmlhttp = false;
		}
 	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined')
	{
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}


function subCategory(catID)
{  
	 var request = createRequestObject();
	 var url = "subCatDropdown.php?catID="+catID;
	 request.open("GET",url);
	
	 request.onreadystatechange = function() 
		{ 
			if(request.readyState == 4) 
	       	{   
				//print(request);
				response = request.responseText;
				//alert(response);
				if(response){ 
				  document.getElementById('subcategory').innerHTML = response;
				}
			} else {
				     document.getElementById('subcategory').innerHTML = '<img src="images/loading.gif" width="25">';
			}
   }
		request.send(null);
}