function onDocumentReady(){
	document.getElementById('fileupload').addEventListener('change', fileSelected, false);
	document.getElementById('drag').addEventListener('drop', handleDrop, false);
}
function fileSelected(data){
	var file = this.files[0];

	checkRequirements(file);
}
function handleDrop(e){
	e.stopPropagation();
	e.preventDefault();

	var file = event.dataTransfer.files[0];

	checkRequirements(file);
}
function checkRequirements(file){
	if (file.type.match(/image.*/)) {
		processImage(file);
	}else{
		document.getElementById('dragtext').innerHTML = 'No image selected!! please upload a new image!';
	}
}
var dataUrl;
function processImage(file){
	var wrapper = document.getElementById('uploadwrapper');

	clear();

	canvas = document.createElement('canvas');
	wrapper.appendChild(canvas);
	canvas.height='600';
	canvas.width='600';
	ctx = canvas.getContext('2d');

	//var img = document.createElement('img');

	var img = new Image();
	img.src = setImageSrc(file);
	img.onload = function() {
		ctx.drawImage(img, 0, 0, 600, 600);
		dataUrl = canvas.toDataURL("image/png");
	};
	document.getElementById('upload').removeEventListener('click', function(){}, false);
	document.getElementById('upload').addEventListener('click', startUpload, false);
}
function startUpload(){
	var titel = document.getElementById('titel').value;
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'ajax/upload.php', true);
	xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xhr.setRequestHeader("Cache-Control", "no-cache");
	xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
	var answer = "";
	xhr.onload = function(e) {
		if (this.status == 200) {
			serveranswer = this.responseText;
			l(serveranswer);
			switch(serveranswer){
				case 'no-title':
					alert('No image title!');
				break;
				case 'title-toshort':
					alert('Your image title is too short!');
				break;
			}
			if(serveranswer.substring(0, 22) == 'successsssssssssssssss'){
				var id = serveranswer.split('--');
				finishUpload(id[1]);
			}
		}
	};

	var send = 'dataurl='+encodeURIComponent(dataUrl)+'&titel='+titel
	xhr.send(send);
}
function fixedEncodeURIComponent (str) {
	return encodeURIComponent(str).replace(/[!'()*]/g, escape);
}
function clear(){
	var wrapper = document.getElementById('uploadwrapper');
	while ( wrapper.childNodes.length >= 1 )
		wrapper.removeChild( wrapper.firstChild );
}
function setImageSrc(file){
	var myURL = window.URL || window.webkitURL
	var fileURL = myURL.createObjectURL(file);
	return fileURL;
}
function finishUpload(id){
	var wrapper = document.getElementById('wrapper');
	while ( wrapper.childNodes.length >= 1 )
		wrapper.removeChild( wrapper.firstChild );

	var titel = '<h1>Succesfully Uploaded!</h1>';
	var body = '<p>asdadsadsa</p>';

	var h1 = document.createElement('div');
	var p = document.createElement('p');
	wrapper.appendChild(document.createTextNode("Upload Finished! /n /r URL = http://127.0.0.1/Do_It_Yourself/www/index.php?p=puzzle&id="+id));
	wrapper.appendChild(h1);
	h1.innerHTML(titel);
	p.innerHTML(body);


}
function l(text){console.log(text)}