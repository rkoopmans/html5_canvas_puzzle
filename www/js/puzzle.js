/**
 *  JavaScript puzzle.js
 */
function onDocumentReady() {
	var canvas = document.getElementById("cPuzzle");
	ctx = canvas.getContext('2d');
	canvas.height = canvas.offsetHeight;
	canvas.width = canvas.offsetWidth;
	img = new Image();
	img.src = getXML('url');
	finalDataURL = "Base64";
	img.onload = function () {
		ctx.drawImage(img, 0, 0);
		finalDataURL = canvas.toDataURL();
		clear(0, 0, canvas.width, canvas.height);
		init();
	};
	const PIECES = 3;
	piece = {
		width:(canvas.width / PIECES),
		height:(canvas.height / PIECES)
	};
	imagePieces = [];
	solved = false;
	mouse = {x:0, y:0};
	selectedTile = 0;
	tileSelected = false;
	information = {title: getXML('titel'), timesCompleted: getXML('times_completed'), user: getXML('user')}

	var tile = function (startx, starty, base64_code) {
		this.x0 = startx;
		this.y0 = starty;

		this.base64 = base64_code;
		this.img = new Image();
		this.img.pappa = this;
		this.img.src = this.base64;

		this.draw = function(){
			ctx.drawImage(this.img, this.x0, this.y0);
		}
		this.remove = function(){
			clear(this.x0, this.y0, piece.width, piece.height);
		}
	};
	var tileList = [];
	var initPuzzle = function(){
		this.canvas = document.createElement('canvas');
		document.body.appendChild(this.canvas);
		this.canvas.height=piece.height;
		this.canvas.width=piece.width;
		this.canvas.style.display = "none";
		this.ctx = this.canvas.getContext('2d');

		for (var i = 0; i < PIECES; i++) {
			//Loop for the X axis
			for (var j = 0; j < PIECES; j++) {
				this.ctx.drawImage(img, j * piece.width, i * piece.height, piece.width, piece.height,0, 0, piece.width, piece.height);
				tileList.push(new tile(0, 0, this.canvas.toDataURL()));
			}
		}
		document.body.removeChild(this.canvas);
	}

	canvas.onclick = function (event){
		mouse.x = event.pageX - this.offsetLeft;
		mouse.y = event.pageY - this.offsetTop;
		for(var i = 0; i < tileList.length; i++){
			if(mouse.x >= tileList[i].x0 && mouse.x <= tileList[i].x0 + piece.width && mouse.y >= tileList[i].y0 && mouse.y <= tileList[i].y0 + piece.height){
				console.log(tileList[i] + i);
				if(!tileSelected){
					tileSelected = true;
					selectedTile = [i];
					tileList[i].remove();
				}else{
					tileSelected = false;
					switchTile(selectedTile, i);
					selectedTile = null;
				}
			}
		}
	}
	var checkInterval;
	//Function initialize starts when the source image is loaded.
	function init(){
		new initPuzzle();
		drawTiles();
		checkInterval = setInterval(checkIfFinished,100);

		document.getElementById('title-puz').innerHTML = information.title;
		document.getElementById('gemaakt-door').innerHTML = information.user;
		document.getElementById('aantal-keer-gemaakt').innerHTML = information.timesCompleted;
	}
	function drawTiles(){
		var counter = 0;
		tileList.shuffle();
		for (var i = 0; i < PIECES; i++) {
			//Loop for the X axis
			for (var j = 0; j < PIECES; j++) {
				tileList[counter].x0 = j * piece.width;
				tileList[counter].y0 = i * piece.height;
				tileList[counter].img.onload=function(e){
					this.pappa.draw();
				}
				counter ++;
			}
		}

	}
	function switchTile(tile1, tile2){
		var t1 = [tileList[tile1].x0, tileList[tile1].y0];
		var t2 = [tileList[tile2].x0, tileList[tile2].y0];

		tileList[tile1].x0 = t2[0];
		tileList[tile1].y0 = t2[1];
		tileList[tile2].x0 = t1[0];
		tileList[tile2].y0 = t1[1];

		tileList[tile1].remove();
		tileList[tile2].remove();
		tileList[tile1].draw();
		tileList[tile2].draw();
	}
	function clear(startx, starty, endx, endy) {
		ctx.clearRect(startx, starty, endx, endy);
	}
	function checkIfFinished(){
		if(canvas.toDataURL() == finalDataURL){
			window.clearInterval(checkInterval);
			var request = new XMLHttpRequest();
			request.open('POST', 'ajax/puzzlecompleted.php?id='+getUrlSegment('id'), false);
			request.send();
			if(request.status === 200){
				alert('Puzzle completed!');
			}
		}
	}
}
var xml = "";
/**
 * @param name string Name of the XML tag
 * @return {String} returns the content of the XML tag
 */
function getXML(name){
	if(!xml){
		var request = new XMLHttpRequest();
		request.open('GET', 'ajax/puzzleinfo.php?id='+getUrlSegment('id'), false);
		request.send();
		if (request.status === 200) {
			xml = request.responseXML;
			return request.responseXML.getElementsByTagName(name)[0].childNodes[0].nodeValue;
		}
	}
	return xml.getElementsByTagName(name)[0].childNodes[0].nodeValue;
}
function getUrlSegment(id)
{
	var vars = [], hash;
	var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
	for(var i = 0; i < hashes.length; i++){
		hash = hashes[i].split('=');
		vars.push(hash[0]);
		vars[hash[0]] = hash[1];
	}
	return vars[id];
}
Array.prototype.shuffle = function() {
	var len = this.length;
	var i = len;
	while (i--) {
		var p = parseInt(Math.random()*len);
		var t = this[i];
		this[i] = this[p];
		this[p] = t;
	}
};