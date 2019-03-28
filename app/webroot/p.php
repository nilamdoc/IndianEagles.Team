<html>
<head>
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="ckfinder/ckfinder.js"></script>
</head>
<body>
	<h1>CKEditor CKFinder Integration using PHP</h1>
	<p>
	<textarea id="Description" name="Description" rows="10" cols="80" class="ckeditor"></textarea>
	</p>
 
<script type="text/javascript">
var editor = CKEDITOR.replace( 'Description', {
	filebrowserBrowseUrl : 'ckfinder/ckfinder.html',
	filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',
	filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',
	filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
	filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
	filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
});
CKFinder.setupCKEditor( editor, '../' );
</script>
</body>
</html>

<?php 
phpinfo();
?>