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
	
		
	function checkLogin() {			
		//alert(window.location.hostname);
		var user_name=document.getElementById("user_name").value;	
		if(user_name==''){
			document.getElementById('userDiv').innerHTML='<span style="color:#FF0000">Please enter user name</span>';
			document.getElementById('loginDiv').innerHTML='';
		}
		var password=document.getElementById("password").value;	
		if(password==''){
			document.getElementById('passwordDiv').innerHTML='<span style="color:#FF0000">Please enter password</span>';
			document.getElementById('loginDiv').innerHTML='';
		}

		var url=window.location.hostname;
		if(user_name!='' && password!=''){
			var strURL="register/login?user_name="+user_name+"&password="+password;
		}
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
							document.getElementById('loginDiv').innerHTML='<span style="color:#FF0000">Invalid Login</span>';
							document.getElementById('userDiv').innerHTML='';
							document.getElementById('passwordDiv').innerHTML='';
						}else if(response>0){
							document.getElementById('loginDiv').innerHTML='<span style="color:#00CC00"> Login Successful.!</span>';
							document.getElementById('userDiv').innerHTML='';
							document.getElementById('passwordDiv').innerHTML='';
							location.reload();
						}
					} 
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
