<html>
	<head>
		<title>Upload Profile Image Result</title>
	</head>
	<body>
		<?php if ($uploaded_file): ?>
		<h1>Upload success</h1>
		<p>
			Here is your uploaded and cropped avatar:
			<img src="<?php echo URL::site("/uploads/$uploaded_file") ?>" alt="Uploaded avatar" />
		</p>
		<?php else: ?>
		<h1>Something went wrong with the upload</h1>
		<p><?php echo $error_message ?></p>
		<?php endif ?>
	</body>
</html>