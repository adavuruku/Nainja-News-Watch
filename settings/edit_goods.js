
function openloader(){
    document.getElementById("result2").innerHTML ='<img src="../store_files/images/loader.gif" class="img-responsive" alt="Uploading...."/>';
}
function closeloader(){
    document.getElementById("result2").innerHTML ='';
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

function write_data() 
{
	var data_file=document.getElementById("desc").innerHTML;
	document.getElementById("g_description").value=data_file;
}


/*THIS DELETE ITEM FROM CART*/
function delete_Cart_Two(p,q)
{
	//alert(q);
	var message = "Are You sure You Want to Remove \n" + q + " .. \n From your News List...?";
	var r=confirm(message);
	if (r==true)
	{
			xmlHttp=GetXmlHttpObject();
			if (xmlHttp==null)
			  {
			  alert ("Your browser does not support AJAX!");
			  return;
			 }
			
			openloader();
			var submit2 = "delete";
			var url="Admin_Cart_Processor.php";
			parameters="delete_item_2="+submit2+"&goods_id="+p+"&goods_name="+q;
			xmlHttp.onreadystatechange =stateChanged33;
			xmlHttp.open("POST",url,true);
			xmlHttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			xmlHttp.send(parameters);
	}
}


/*THIS DELETE ITEM FROM CART*/
//var pu, qu;


function stateChanged33() 
{ 
	if (xmlHttp.readyState==4)
	{ 
		closeloader();
		var message_two = xmlHttp.responseText + " ... \n was Remove Succesfully!!";
		alert(message_two);
		location.reload(true);
	}
}

/*Like a news*/
function like_news_post(p)
{
	pu=p;
	//alert(pu);
	//document.getElementById(p).innerHTML="sherif";
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	}
	var submit2 = "like_n";
	var url="admin/Admin_Cart_Processor.php";
	parameters="like_news="+submit2+"&news_id="+p;
	xmlHttp.onreadystatechange= stateChanged22;
	xmlHttp.open("POST",url,true);
	xmlHttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xmlHttp.send(parameters);
}
/*Like a COMENT*/
function like_news_comment(p)
{
	pu=p;
	//alert(pu);
	//document.getElementById(p).innerHTML="sherif";
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	}
	var submit2 = "like_n";
	var url="admin/Admin_Cart_Processor.php";
	parameters="like_comment="+submit2+"&news_id="+p;
	xmlHttp.onreadystatechange= stateChanged22;
	xmlHttp.open("POST",url,true);
	xmlHttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xmlHttp.send(parameters);
}
/*Like a COMENT REPLY*/
function like_news_reply(p)
{
	pu=p;
	//alert(pu);
	//document.getElementById(p).innerHTML="sherif";
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	}
	var submit2 = "like_n";
	var url="admin/Admin_Cart_Processor.php";
	parameters="like_comment_reply="+submit2+"&news_id="+p;
	xmlHttp.onreadystatechange= stateChanged22;
	xmlHttp.open("POST",url,true);
	xmlHttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xmlHttp.send(parameters);
}
function stateChanged22() 
{ 
	//alert("hjhjhjh");
	if (xmlHttp.readyState==4)
	{ 
		//var message_two = xmlHttp.responseText +" ... \n was Remove Succesfully!!";
		//alert(message_two);
		document.getElementById(pu).innerHTML= xmlHttp.responseText + " Likes";
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