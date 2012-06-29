function onDocumentReady(){
	document.getElementById('submit').addEventListener('click', register, false);
	console.log(1);
}
function register(){
	var username = document.getElementById('username').value;
	var password = document.getElementById('password').value;
	var password2 = document.getElementById('password2').value;

	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'ajax/register.php', true);
	xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xhr.setRequestHeader("Cache-Control", "no-cache");
	xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
	xhr.onload = function(e) {
		if (this.status == 200) {
			if(this.responseText == 'success')
				alert('Succesvol geregistreerd');
			else
				alert(this.responseText);
		}
	}
	var send = 'username='+username+'&password='+password+'&password2='+password2;
	xhr.send(send);
}
