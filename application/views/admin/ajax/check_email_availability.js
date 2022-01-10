function getXMLHTTP() { //fuction to return the xml http object
var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }
	
		
	function check_email_availability(email_id) {			
		//alert(email_id);
		var url=window.location.hostname;
		if(email_id!=''){
			var strURL="http://"+url+"/admin/seller_registration/email_availability?email="+email_id;
		}
		alert(strURL);
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					 //only if "OK"
					//alert(req.status);
					response=(req.responseText);
					 //alert(response);
					if (req.status == 200) {
						if(response==0){
							//document.getElementById('emailDiv').innerHTML='<span style="color:#00CC00"> Email Address Available.!</span>';
							document.getElementById("email_check").value='1';
						}else if(response>0){
							//document.getElementById('emailDiv').innerHTML='<span style="color:#FF0000">Already Register.!</span>';
							document.getElementById("email_check").value='';
						}
					} 
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
