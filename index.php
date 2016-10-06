<html>
<head>
<script type="text/javascript" src="js/yahoo-min.js"></script>
<script type="text/javascript" src="js/event-min.js"></script>
<script type="text/javascript" src="js/connection-min.js"></script>
<script type="text/javascript" src="js/default.js"></script>
</head>
<body class="yui-skin-sam">
<?php
require_once 'feedmap.php';
$keys = FeedMap::getFeedCategories();
$ipAddressMap = FeedMap::getIP();
?>
<form name='form1' id ='form1'>
<input type='hidden' name='seedcheck' id='seedcheck' value ='0' />
<table>
<tr>

<td style="width:300px;" valign='top'>
<table id='addTbl'>
			 <?php foreach($ipAddressMap as $key => $value){?>
			      <tr >
			        <td><input id='ips' type="checkbox" name="ips[<?php echo $key?>]" value="<?php echo $value?>"/></td>
			        <td> <?php echo $value;?></td>
			        
			      </tr>
			      <tr>
			      <td>&nbsp;</td>
			      <td class='hostname'><?php echo $key;?></td>
			      </tr>
			      <?php }?>
			</table>
</td>
 
<td valign='top'>
<table>
<tr><td>TO </td> <td><input name='mailto' type="text" style="width: 450px;"> </td></tr>
<tr><td>Subject </td> <td><input name='subject' type="text" style="width: 450px;"> </td></tr>
<tr><td>From </td> <td><input name='from' type="text" style="width: 450px;"> </td></tr>
<tr><td valign="top">SEED </td> <td valign="top"> <textarea  name='seed'  rows="15" style="width: 450px;"></textarea> </td></tr>
<tr><td valign="top">SALT </td> <td valign="top"> <textarea  name='salt' id='salt'  rows="15" style="width: 450px;"></textarea> </td></tr>
<tr><td valign="top"></td> <td valign="top"> <input type="button" value="Send Mail" onClick='sendMails()'> &nbsp;&nbsp;<input type="button" value="Check Seeds" onClick='seedCheck()'> </td></tr>
</table>

</td>

<td valign="top" >
<table border='0'>
<tr>
<td>CATEGORY </td>
<td>

<select id='category' name='category' onchange="">
<?php foreach($keys as $key) 
 		{?>
 			<option value="<?php echo $key;?>"><?php echo $key;?></option>
 		<?php }?>
</select>
</td> </tr>
<tr>
<td><input type="button" value="Pick" onClick='peekWords()'>  </td>
<td><input type="text" id='count' name='count'> </td>
</tr>
<tr><td><input type="button" value="Generate New">  </td> <td></td></tr>
 
<tr><td> <div id='prg' style='display:none;'><img  src='load_4.gif' border='0'/> </div>  </td> <td><div id='status' style='width:100%;'></div></td></tr>

</table>
</td>

</tr>

</table>
</form>
</body>
</html>