var peekWordsCallBack = {
		  success: function(o) {
			var response = o.responseText;
			response = response.split("<!")[0];
			 //document.getElementById("status").innerHTML = response;
			 hidePrg(); 
			 
			 if(response == 'nofile'){
				 setStatus('Content not Found.');
				 createWords();
			 }else {
				 //alert(response);
				 var old = document.getElementById('salt').value;
				 
				 if(old.length > 0) {
					 document.getElementById('salt').value = old +',' + response;
				 }else {
				   document.getElementById('salt').value = response;
				 }
				 setStatus('Words Populated');
			 }
			
			},
		  failure: function(o) {handleTimeout(); },
		  timeout: 10000
	};

function peekWords()
{
	var category = document.getElementById('category').value;
	var count = document.getElementById('count').value;
	if(count == '') {
		 alert('Please entre count');
		 return;
	 }
	 var url = 'feedcollector.php?cmd=peek&category='+category+'&count='+count;
	 setStatus('Peeking Words');
	 showPrg();
	 var cObj = YAHOO.util.Connect.asyncRequest('GET', url, peekWordsCallBack);
}

var createWordsCallback = {
		  success: function(o) {
			var response = o.responseText;
			response = response.split("<!")[0];
			 //document.getElementById("status").innerHTML = response;
			 hidePrg();
			 setStatus('Words Generated.');
			 alert('Words Generated. Please Peek words.');
			},
		  failure: function(o) {handleTimeout(); },
		  timeout: 360000
	};

function createWords() 
{ 
	
	var category = document.getElementById('category').value;
	 setStatus('Generating Words');
	 var url = 'feedcollector.php?cmd=create&category='+category;
	showPrg();
	var cObj = YAHOO.util.Connect.asyncRequest('GET', url, createWordsCallback);
	
}



var sendMailsCallback = {
		  success: function(o) {
			var response = o.responseText;
			response = response.split("<!")[0];
			hidePrg();
			setStatus('Mails Sent');
			//alert(response);
setStatus(response);

		},
		  failure: function(o) {/*failure handler code*/getPHPPID();},
		  timeout: 360000
	};

function sendMails() {
	document.getElementById('seedcheck').value ='false';
	var formObject = document.getElementById('form1');
	YAHOO.util.Connect.setForm(formObject);
	showPrg();
	setStatus('Sending Mails');
	var cObj = YAHOO.util.Connect.asyncRequest('POST', 'submitmail.php', sendMailsCallback);
}

function seedCheck() {
	
	document.getElementById('seedcheck').value = 'true';
	
	var formObject = document.getElementById('form1');
	YAHOO.util.Connect.setForm(formObject);
	showPrg();
	setStatus('Sending Test');
	var cObj = YAHOO.util.Connect.asyncRequest('POST', 'submitmail.php', sendMailsCallback);
}

function showPrg()
{
	document.getElementById('prg').style.display = 'block';
}
function hidePrg()
{
	document.getElementById('prg').style.display = 'none';
}

function setStatus(msg) {
	document.getElementById('status').innerHTML = msg+'....';
}

function handleTimeout() {
	alert('Operation timed Out Retry!'); hidePrg();
}
	
