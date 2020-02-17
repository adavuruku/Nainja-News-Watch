

function changeSrc()
  {
	var j = document.getElementById("record").innerHTML;
	if(j=="0"){
		document.getElementById("items").style.display="none";
		document.getElementById("record").innerHTML="1";
	}else{
		document.getElementById("items").style.display="inline";
		document.getElementById("record").innerHTML="0";
	}
	
  }

/*THIS PRINT TRANSACTION ORDER ALL YOUR ITEM IN CART*/
function Print_Cart(purchase_order)
{
	var message = "Are You sure You Want to Submit all the Goods List in Your Cart for Purchase...?";
	var r=confirm(message);
	if (r==true)
	{
			//alert(p);
			document.getElementById('show_cart').innerHTML="";
			window.location.assign("store_files/Purchase_Order_Slip_Print.php?former_trans_code=" + purchase_order);
	}
}

function Empty_Cart()
{
	var message = "Are You sure You Want to Empty your Cart List...?";
	var r=confirm(message);
	if (r==true)
	{
			xmlHttp=GetXmlHttpObject();
			if (xmlHttp==null)
			  {
			  alert ("Your browser does not support AJAX!");
			  return;
			 }
			
			
			var submit6 = "empty";
			var url="Cart_Processor.php";
			parameters="empty_cart="+submit6;
			xmlHttp.onreadystatechange=stateChanged33;
			xmlHttp.open("POST",url,true);
			xmlHttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			xmlHttp.send(parameters);
	}

}
/*THIS DELETE ITEM FROM CART*/
function delete_Cart(p,q)
{
	//alert(q);
	var message = "Are You sure You Want to Remove \n" + q + " .. \nFrom your Cart List...?";
	var r=confirm(message);
	if (r==true)
	{
			xmlHttp=GetXmlHttpObject();
			if (xmlHttp==null)
			  {
			  alert ("Your browser does not support AJAX!");
			  return;
			 }
			
			
			var submit2 = "delete";
			var url="Cart_Processor.php";
			parameters="delete_item="+submit2+"&goods_id="+p;
			xmlHttp.onreadystatechange=stateChanged33;
			xmlHttp.open("POST",url,true);
			xmlHttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			xmlHttp.send(parameters);
	}
} 

//THIS UPDATE THE QUANTITY OF ITEM ON STACK
function update_Cart(p)
{
	var new_quantity = document.getElementById(p).value;
	if(new_quantity >0)
	{
	//alert(p);
			xmlHttp=GetXmlHttpObject();
			if (xmlHttp==null)
			  {
			  alert ("Your browser does not support AJAX!");
			  return;
			 }
			
			
			var submit1 = "update";
			var url="Cart_Processor.php";
			parameters="update_item="+submit1+"&goods_id="+p+"&new_quantity="+new_quantity;
			xmlHttp.onreadystatechange=stateChanged33;
			xmlHttp.open("POST",url,true);
			xmlHttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			xmlHttp.send(parameters);
	}else{
		alert("Quantity Cant Be less than or equal Zero (0) And Empty as well");
	}
}
/*THIS PROCESS ADDING ITEM TO CART*/
function Add_to_Cart(p)
{
	
	var r=confirm("Are You sure You want to Add this Goods to your Cart..?");
	if (r==true)
	{
			xmlHttp=GetXmlHttpObject();
			if (xmlHttp==null)
			  {
			  alert ("Your browser does not support AJAX!");
			  return;
			 }
			
			
			var submit4 = "add";
			var url="Cart_Processor.php";
			parameters="add_item="+submit4+"&goods_id="+p;
			xmlHttp.onreadystatechange=stateChanged33;
			xmlHttp.open("POST",url,true);
			xmlHttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			xmlHttp.send(parameters);

	}
}



function stateChanged33() 
{ 
	if (xmlHttp.readyState==4)
	{ 
		document.getElementById('show_cart').innerHTML="";
		document.getElementById('show_cart').innerHTML=xmlHttp.responseText;
	}
}



function GetXmlHttpObject()
{
	var xmlHttp=null;
	try
		{
			 // Firefox, Opera 8.0+, Safari
			xmlHttp=new XMLHttpRequest();
		}
	catch (e)
		{
			// Internet Explorer
			 try
				{
					xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
				}
			  catch (e)
				{
					xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
		}
			return xmlHttp;
}

function noNumbers(e, t) 
{
            try {

                if (window.event) {
                    var charCode = window.event.keyCode;}

                else if (e) {
                    var charCode = e.which;
                }
                else { return true; }

                if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                    return false;
                }
                return true;
            }
            catch (err) {
                alert(err.Description);
            }

         
} 
