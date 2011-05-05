<html>
	<head>
		<title>Upload Profile Image</title>
	</head>
	<body>
		<h1>Upload your profile image</h1>
		<form id="upload-form" action="<?php echo URL::site('crop/do') ?>" method="post" enctype="multipart/form-data">
			<p>Choose file:</p>
			<p><input type="file" name="avatar" id="avatar" /></p>
			<p><input type="submit" name="submit" id="submit" value="Upload and crop" /></p>
		</form>
	</body>
</html>