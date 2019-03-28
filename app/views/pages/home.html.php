<?php
use app\models\Pages;
use lithium\storage\Session;

		$page = Pages::find('first',array(
			'conditions'=>array('page'=>'home')
		));
$session = Session::read('session');

?><br>
<div style="margin:auto;width:90%">
<?php echo($page['Description'])?>
<?php if($session['mcaNumber']=='92143138'){?>
<script src="ckeditor/ckeditor.js"></script>
<script src="ckfinder/ckfinder.js"></script>
<?=$this->form->create(null,array('class'=>'form-group','id'=>'Home','url'=>'/users/Home')); ?>
		<input type="hidden" name="page" value="home">
		<textarea name="Description" cols="60" rows="4" class="ckeditor" id="Description"><?=$page['Description']?></textarea>
		<br>
		<input type="button" value="Save" class="form-control btn btn-primary" onclick="$('#Home').submit();">
</form>

<script type="text/javascript">
var Description = CKEDITOR.replace( 'Description', {
	filebrowserBrowseUrl : 'ckfinder/ckfinder.html',
	filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',
	filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',
	filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
	filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
	filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
});
CKFinder.setupCKEditor( Description, '../' );
</script>
<?php }?>
</div>