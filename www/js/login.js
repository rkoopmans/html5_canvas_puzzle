function onDocumentReady(){
	document.getElementById('submit').addEventListener('click', login, false);
	console.log(1);
}
function login(){
	var username = document.getElementById('username').value;
	var password = document.getElementById('password').value;

	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'ajax/login.php', true);
	xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xhr.setRequestHeader("Cache-Control", "no-cache");
	xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
	xhr.onload = function(e) {
		if (this.status == 200) {
			console.log(this.responseText);
			switch(this.responseText){
				case '1':
					alert('Succesvol ingelogd!');
					window.location = "/";
					break;
				case '0':
					alert('Uw inloggegevens zijn onjuist!');
				break;
			}
		}
	}
	var send = 'username='+username+'&password='+password;
	xhr.send(send);
}
