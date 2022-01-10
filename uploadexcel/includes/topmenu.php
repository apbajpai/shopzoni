<SCRIPT LANGUAGE="JavaScript">
function popup_window_barcode()
{
alert("hello");
/*popupwindow=window.open(url ,'text to shoe','top=100,left=200,width=550,height=325,scrollbars=yes');
popupwindow.focus();
*/
}

</SCRIPT>

<script type="text/javascript" src="js/ddaccordion.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>

<script>
     jQuery.noConflict();
     
     // Use jQuery via jQuery(...)
     jQuery(document).ready(function(){
       jQuery("div").show();
	   jQuery("#plant1").hide();
	   jQuery("#plant2").hide();
     });
     
     // Use Prototype with $(...), etc.
     $('someid').hide();
   </script>

<script type="text/javascript">

ddaccordion.init({
	headerclass: "headerbar", //Shared CSS class name of headers group
	contentclass: "submenu", //Shared CSS class name of contents group
	revealtype: "mouseover", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false
	defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc] [] denotes no content
	onemustopen: true, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", "selected"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "normal", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})

</script>
<link rel="stylesheet" type="text/css" href="css/slideMenu.css">

<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/flexdropdown.css" />

<script type="text/javascript" src="js/flexdropdown.js">

/***********************************************
* Flex Level Drop Down Menu- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for this script and 100s more
***********************************************/

</script>
<script type="text/JavaScript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>


<link rel="stylesheet" type="text/css" href="css/anylinkcssmenu.css" />

<script type="text/javascript" src="js/anylinkcssmenu.js">

/***********************************************
* AnyLink CSS Menu script v2.0- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Project Page at http://www.dynamicdrive.com/dynamicindex1/anylinkcss.htm for full source code
***********************************************/

</script>

<script type="text/javascript">

//anylinkcssmenu.init("menu_anchors_class") ////Pass in the CSS class of anchor links (that contain a sub menu)
anylinkcssmenu.init("anchorclass")
</script>





<tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td bgcolor="#f4f8ef"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <!--<td width="78"><a href="barcode_log.php"><img src="images/logo.jpg" width="78" height="39" border="0" /></a></td>-->
            <td width="70%" align="center"><!--<span class="HPS_Green">Accounts </span>--><span class="HPS_Black">Account</span></td>
           
         <td style="padding:0 15px 0 0" width="30%" align="right" class="logout"><strong>Welcome, <?=$_SESSION['username']?>!</strong>  |  <a href="logout.php" class="logout">Logout</a></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="24" background="images/topMenuBg.jpg" style="background-repeat:repeat-x; padding:0 2px 0 2px;"><table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="120" ><table width="120" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="24" class="topMenu" background="images/admin_Bg.jpg" style="background-repeat:no-repeat; padding:0px 0 0px 32px;" onclick="document.location.href='home.php'" onmouseover="this.style.cursor='pointer'; this.style.backgroundImage='url(images/admin_Sel.jpg)'; this.style.color='#000000'; this.style.fontWeight='bold';" onmouseout="this.style.cursor=''; this.style.backgroundImage='url(images/admin_Bg.jpg)'; this.style.color='#ffffff'; this.style.fontWeight='';" >Dashboard</td>
                
              </tr>
            </table></td>
             <td width="1">&nbsp;</td>
             <td >&nbsp;</td>
             <td width="1">&nbsp;</td>
             
             <td >&nbsp;</td>
             <td width="1">&nbsp;</td>
            
             <td width="88">&nbsp;</td>
             <!--
            
             <td width="1">&nbsp;</td>
            <td ><table width="162" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="24" class="topMenu" background="images/AF_Bg.jpg" style="background-repeat:no-repeat; padding:0px 0 0px 41px;" onclick="document.location.href=''" onmouseover="this.style.cursor='pointer'; this.style.backgroundImage='url(images/AF_Sel.jpg)'; this.style.color='#000000'; this.style.fontWeight='bold';" onmouseout="this.style.cursor=''; this.style.backgroundImage='url(images/AF_Bg.jpg)'; this.style.color='#ffffff'; this.style.fontWeight='';" >Account and Finance </td>
              </tr>
            </table></td>
            
            
             <td width="1">&nbsp;</td>
           <td ><table width="156" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="24" class="topMenu" background="images/MI_Bg.jpg" style="background-repeat:no-repeat; padding:0px 0 0px 38px;" onclick="document.location.href=''" onmouseover="this.style.cursor='pointer'; this.style.backgroundImage='url(images/MI_Sel.jpg)'; this.style.color='#000000'; this.style.fontWeight='bold';" onmouseout="this.style.cursor=''; this.style.backgroundImage='url(images/MI_Bg.jpg)'; this.style.color='#ffffff'; this.style.fontWeight='';" >Materials / Inventory </td>
              </tr>
            </table></td>
             <td width="1">&nbsp;</td>
            <td ><table width="176" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="24" class="topMenu" background="images/PO_Bg.jpg" style="background-repeat:no-repeat; padding:0px 0 0px 35px;" onclick="document.location.href=''" onmouseover="this.style.cursor='pointer'; this.style.backgroundImage='url(images/PO_Sel.jpg)'; this.style.color='#000000'; this.style.fontWeight='bold';" onmouseout="this.style.cursor=''; this.style.backgroundImage='url(images/PO_Bg.jpg)'; this.style.color='#ffffff'; this.style.fontWeight='';" >Production / Operations </td>
              </tr>
            </table></td>
             <td width="1">&nbsp;</td>
            <td ><table width="168" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="24" class="topMenu" background="images/TK_Bg.jpg" style="background-repeat:no-repeat; padding:0px 0 0px 38px;" onclick="document.location.href=''" onmouseover="this.style.cursor='pointer'; this.style.backgroundImage='url(images/TK_Sel.jpg)'; this.style.color='#000000'; this.style.fontWeight='bold';" onmouseout="this.style.cursor=''; this.style.backgroundImage='url(images/TK_Bg.jpg)'; this.style.color='#ffffff'; this.style.fontWeight='';" >Training & Knowledge</td>
              </tr>
            </table></td> -->
             <td width="1">&nbsp;</td>
            
          </tr>
        </table></td>
      </tr>
    </table></td>
 
  </tr>
  
