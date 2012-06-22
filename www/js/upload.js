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
	};
	var dataUrl = canvas.toDataURL("image/png");
	document.getElementById('upload').addEventListener('click', startUpload(dataUrl), false);
}
function startUpload(dataURL){
	var xhr = new XMLHttpRequest();
	xhr.upload.addEventListener("progress", function(e) {
	if (e.lengthComputable) {
		var percentage = Math.round((e.loaded * 100) / e.total);

	}}, false);
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
function l(text){console.log(text)}