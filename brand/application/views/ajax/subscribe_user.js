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
	
		
	function subscribe_user(val) {
	//alert(val);
		if(val==1){
			div_name='subscribe';
		}else if(val==2){
			div_name='subscribe2';
		}
		
		var email_id=document.getElementById(div_name).value;
		//alert(email_id);				
		var url=window.location.hostname;		
		if(email_id!=''){
			var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			if( !emailReg.test(email_id) ) {
					document.getElementById(div_name).value='';
					document.getElementById(div_name).placeholder='Invalid Email Address..!';
					return false;
			} 
			var strURL="registration/subscribe?email_id="+email_id;		
		}else{			
			document.getElementById(div_name).placeholder='Enter Email Address...!';
		}
		strURL='http://'+url+'/'+strURL;
		//alert(strURL);
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
								document.getElementById(div_name).value='';
								document.getElementById(div_name).placeholder='Subscribe Successfully..!';
						}else if(response>0){
								document.getElementById(div_name).value='';
								document.getElementById(div_name).placeholder='Already Subscribe..!';
						}
					} 
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
