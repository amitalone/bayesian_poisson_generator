<html>
<head>
<script type="text/javascript" src="js/yahoo-min.js"></script>
<script type="text/javascript" src="js/event-min.js"></script>
<script type="text/javascript" src="js/connection-min.js"></script>
</head>
<body class="yui-skin-sam">

<script>

var t;
var timer_is_on=0;
function doTimer()
 {
	if (!timer_is_on)
	{
	  timer_is_on=1;
	  getScriptLog();

	}
}
function stopRequest()
{
  hidePrg();
  clearTimeout(t);
  timer_is_on=0;
}

var scriptLogCallback = {
		  success: function(o) {
			var response = o.responseText;
			response = response.split("<!")[0];
			 document.getElementById("status").value = response;
			 var pos = response.indexOf("Deployment finished");
			 if(pos >= 0 || pos2 >= 0)
			 {
			  		stopRequest();
			 }
			},
		  failure: function(o) {/*failure handler code*/},
		  timeout: 10000
	};

function getScriptLog()
{
   var url = 'getscriptlog.php';
   var cObj = YAHOO.util.Connect.asyncRequest('GET', url, scriptLogCallback);
   t=setTimeout("getScriptLog()",3000);
}
</script>
doTimer();

<div id='status' >  </div>
</body>
</html>