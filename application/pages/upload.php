<?php
	if(!$_SESSION['loggedin'])
		die('YOu are not logged in');
?>
<div id="options" style="display:block; text-align:center; margin:auto auto;margin-bottom:8px;">
	<input type="text" id="titel" placeholder="Titel of your image" style="width:400px;height:40px;font-size:18px" />
	<input type="submit" id="upload" value="upload"  style="width:100px;height:40px;font-size:18px" />
</div>
<div id="uploadwrapper" style="width:600px; height:600px; background-color:#FFF; text-align:center; margin:auto auto;">
	<form method="post" enctype="multipart/form-data" action="">
		<p id="drag" style="padding-top:300px"; >
			<span id="dragtext">Drag and drop a image here or manually select a picture!</span>
			<input style="padding-top:20px;" type="file" id="fileupload" />
		</p>
	</form>
</div>
