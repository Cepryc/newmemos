﻿<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8">


        <title>Blogunets</title>
        <style type="text/css">
body {
margin:0;
padding:0;
background: #f5f5f5;
font-face:Arial;
font-size:12pt;
color:#9FBBEA;
}
div#form {
text-align:center;
width:90%;
font-size:100%;
margin: 0 auto;
text-align:left;
}
input, textarea {
border:#cccccc 1px solid;
width:100%;
}
.log {
width:100%;
height:75px;
}
.but {
	float:right;
	background:#ffffff;
	color:#9FBBEA;
}
h1 {
font-face:Times New Roman;
font-size:26pt;
color:#9FBBEA;
}

.s_checkbox {width:50px; height:20px}


</style>
    </head>
    <body>
        <div id="form" align="center">
        <h1><?php include("../user.txt");?>.livejournal.com</h1>
        <form method="post" name="add" action="send.php">

            Заголовок:<br/><input type="text" name="title" /><br />
            Текст:<br/><textarea rows="10" name="text"> <?php $text= file_get_contents("http://flaner41.myjino.ru/777/content/index.php"); echo $text; ?><br><br></textarea><br />
     		



			<table VALIGN="lift">
			<tr>
				<td>Cut:</td>
				<td > <input align="left" type="checkbox" class="s_checkbox" name="checkme" checked="checked"></td>
				<td><input width=100% size=100% type="text" name="rec" ></td>
				<td><INPUT TYPE=button VALUE="(*!)" onClick=recom();> </td>
				<td><INPUT TYPE=button VALUE="(*!-)" onClick=recom1();> </td>
			    <td>. .</td>
				<td><INPUT TYPE=button VALUE="(,!)" onClick=recom2();> </td>
				<td><INPUT TYPE=button VALUE="(,!-)" onClick=recom3();> </td>
			    <td>. .</td>
				<td><INPUT TYPE=button VALUE="(,?)" onClick=recom4();> </td>
				<td><INPUT TYPE=button VALUE="(,?-)" onClick=recom5();> </td>
			
			
			</tr>
			</table>
			
			
			



			
			<textarea rows="5" name="post" onChange="gettxt(this.value)"  autocomplete="off"></textarea>


<table ALIGN="right" width=100%>
<tr>
	<td>



<table align="right" width=100%>


<tr>

	<td></td>
	<td>URL</td>
	<td></td>
	<td>Заголовок</td>
	<td></td>
	<td>Постовой</td>
	<td></td>
	<td>Текст</td>
</tr>





<tr>
    <td align="right"> </td>
	<td><input type="text" size=30 name=url   autocomplete="off"></td>
	<td align="right"> </td>
	<td><input type="text" size=45 name=ankor   autocomplete="off"></td>
	
	<td align="right"></td>
	<td>
	
<SCRIPT language=javascript type="text/javascript"> <!--//
document.write("<input type=text name=curpost size=4 class=forms>");
//-->
</SCRIPT>

	</td>
	
	<td align="right"></td>
	
	<td>
	
<SCRIPT language=javascript type="text/javascript"> <!--//
document.write("<input type=text name=curtxt size=4 class=forms>");
//-->
</SCRIPT>

	
	</td>
	<td> </td>
</tr>
<tr>
	<td> </td>
	<td><input type="text" size=35 name=url2   autocomplete="off"></td>
	<td> </td>
	<td><INPUT TYPE=button VALUE="Заголовок" onClick="document.add.ankor.value='';"></td>
	<td> </td>
	<td> <INPUT TYPE=button VALUE="Постовой" onClick="document.add.post.value='';"></td>
	<td> </td>
	<td><INPUT TYPE=button VALUE="Текст" onClick="document.add.text.value='';"></td>
	<td></td>

</tr>
</table>

</td>
	<td><input type="submit" class="log but"  value="ОТПРАВИТЬ">
</td>
</tr>
</table>




	     
</form>

      


<script language="JavaScript"> 
 function gettxt(a) 
  {


function ucFirst(str) {
  var newStr = str.charAt(0).toUpperCase();

  for(var i=1; i<str.length; i++) {
    newStr += str.charAt(i);
  }

  return newStr;
}


 var reg=/>(.*)<\//; 
 var arr=reg.exec(a) 
 
 var reg1=/http:\/\/(.*?)\//; 
 var arr1=reg1.exec(a);

 var reg2=/http:\/\/(.*)\"/; 
 var arr2=reg2.exec(a);


 rez1=ucFirst(arr[1]);
 
 
 //rez2 = arr1[1].replace(new RegExp("/",'g'),"");

 
 setTimeout("gettxt()",100);
 document.add.ankor.value=rez1;
 document.add.url.value=arr1[1];
 document.add.url2.value=arr2[1]; 
  }
 </script>




<SCRIPT language=javascript type="text/javascript">
<!--//
function gettxt2() 
{
 document.add.title.value=document.add.ankor.value;
 document.add.curtxt.value=document.add.text.value.length;
 document.add.curpost.value=document.add.post.value.length;
 setTimeout("gettxt2()",100);
}
gettxt2();
//-->
</SCRIPT>


<SCRIPT language=javascript type="text/javascript">
<!--//
function recom() 
{

	var beg=1
	var end=8
	var val=Math.random()*(end-beg+1)
	a=Math.floor(val)+beg
	
if(a==1) {
 document.add.rec.value="Очень рекомендую посетить данный сайт!";
}

if(a==2) {
 document.add.rec.value="Обязательно загляните на этот сайт!";
}

if(a==3) {
 document.add.rec.value="Рекомендую посетить данный сайт!";
}

if(a==4) {
 document.add.rec.value="Рекомендую перейти по этой ссылке!";
}

if(a==5) {
 document.add.rec.value="Очень рекомендую перейти по этой ссылке!";
}

if(a==6) {
 document.add.rec.value="Обязательно зайдите на этот сайт!";
}

if(a==7) {
 document.add.rec.value="Рекомендую заглянуть на данный сайт!";
}

if(a==8) {
 document.add.rec.value="Рекомендую заглянуть на этот сайт!";
}

}

//-->
</SCRIPT>


<SCRIPT language=javascript type="text/javascript">
<!--//
function recom1() 
{

	var beg=1
	var end=8
	var val=Math.random()*(end-beg+1)
	a=Math.floor(val)+beg
	
if(a==1) {
 document.add.rec.value="Очень рекомендую посетить сайт - ";
}

if(a==2) {
 document.add.rec.value="Обязатльно загляните на сайт - ";
}

if(a==3) {
 document.add.rec.value="Рекомендую посетить сайт - ";
}

if(a==4) {
 document.add.rec.value="Рекомендую перейти по этой ссылке на сайт - ";
}

if(a==5) {
 document.add.rec.value="Очень рекомендую перейти по этой ссылке на сайт - ";
}

if(a==6) {
 document.add.rec.value="Обязательно зайдите на сайт - ";
}

if(a==7) {
 document.add.rec.value="Рекомендую заглянуть на сайт - ";
}

if(a==8) {
 document.add.rec.value="Советую заглянуть на сайт - ";
}

}

//-->
</SCRIPT>


<SCRIPT language=javascript type="text/javascript">
<!--//
function recom2() 
{

	var beg=1
	var end=8
	var val=Math.random()*(end-beg+1)
	a=Math.floor(val)+beg
	
if(a==1) {
 document.add.rec.value=", очень рекомендую посетить данный сайт!";
}

if(a==2) {
 document.add.rec.value=", обязательно загляните на этот сайт!";
}

if(a==3) {
 document.add.rec.value=", рекомендую посетить данный сайт!";
}

if(a==4) {
 document.add.rec.value=", рекомендую перейти по этой ссылке!";
}

if(a==5) {
 document.add.rec.value=", очень рекомендую перейти по этой ссылке!";
}

if(a==6) {
 document.add.rec.value=", обязательно зайдите на этот сайт!";
}

if(a==7) {
 document.add.rec.value=", рекомендую заглянуть на данный сайт!";
}

if(a==8) {
 document.add.rec.value=", рекомендую заглянуть на этот сайт!";
}

}

//-->
</SCRIPT>


<SCRIPT language=javascript type="text/javascript">
<!--//
function recom3() 
{

	var beg=1
	var end=8
	var val=Math.random()*(end-beg+1)
	a=Math.floor(val)+beg
	
if(a==1) {
 document.add.rec.value=", очень рекомендую посетить сайт - ";
}

if(a==2) {
 document.add.rec.value=", обязательно загляните на сайт - ";
}

if(a==3) {
 document.add.rec.value=", рекомендую посетить сайт - ";
}

if(a==4) {
 document.add.rec.value=", рекомендую перейти по этой ссылке на сайт - ";
}

if(a==5) {
 document.add.rec.value=", очень рекомендую перейти по этой ссылке на сайт - ";
}

if(a==6) {
 document.add.rec.value=", обязательно зайдите на сайт - ";
}

if(a==7) {
 document.add.rec.value=", рекомендую заглянуть на сайт - ";
}

if(a==8) {
 document.add.rec.value=", советую заглянуть на сайт - ";
}

}

//-->
</SCRIPT>


<SCRIPT language=javascript type="text/javascript">
<!--//
function recom4() 
{

	var beg=1
	var end=6
	var val=Math.random()*(end-beg+1)
	a=Math.floor(val)+beg
	
if(a==1) {
 document.add.rec.value=", значит вам на этот сайт.";
}



if(a==2) {
 document.add.rec.value=", вам поможет этот сайт.";
}

if(a==3) {
 document.add.rec.value=", в этом, вам поможет данный сайт.";
}

if(a==4) {
 document.add.rec.value=", обязательно почитайте этот сайт.";
}

if(a==5) {
 document.add.rec.value=", вам нужно заглянуть на этот сайт.";
}

if(a==6) {
 document.add.rec.value=", вам обязательно нужно зайти на этот сайт.";
}



}

//-->
</SCRIPT>





<SCRIPT language=javascript type="text/javascript">
<!--//
function recom5() 
{

	var beg=1
	var end=6
	var val=Math.random()*(end-beg+1)
	a=Math.floor(val)+beg
	
if(a==1) {
 document.add.rec.value=", значит вам на сайт - ";
}

if(a==2) {
 document.add.rec.value=", вам поможет сайт - ";
}

if(a==3) {
 document.add.rec.value=", в этом, вам поможет сайт - ";
}

if(a==4) {
 document.add.rec.value=", обязательно почитайте сайт - ";
}

if(a==5) {
 document.add.rec.value=", вам нужно заглянуть на сайт - ";
}
W
if(a==6) {
 document.add.rec.value=", вам обязательно нужно зайти на сайт - ";
}



}

//-->
</SCRIPT>



     </body>
</html>