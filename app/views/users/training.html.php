<?php
use lithium\storage\Session;
$session = Session::read('session');
?><br>
<div style="margin:auto;width:90%">
<?php echo($page['Description'])?>
<?php if($session['mcaNumber']=='92143138'){?>
<script src="/ckeditor/ckeditor.js"></script>
<script src="/ckfinder/ckfinder.js"></script>

<?=$this->form->create(null,array('class'=>'form-group','id'=>'Training','url'=>'/users/training')); ?>
		<input type="hidden" name="page" value="training">
		<textarea id="Description" name="Description" cols="60" rows="4" class="ckeditor"><?=$page['Description']?></textarea>
		<br>
		<input type="submit" value="Save" class="form-control btn btn-primary">
</form>
<script type="text/javascript">
var Description = CKEDITOR.replace( 'Description', {
	filebrowserBrowseUrl : '/ckfinder/ckfinder.html',
	filebrowserImageBrowseUrl : '/ckfinder/ckfinder.html?type=Images',
	filebrowserFlashBrowseUrl : '/ckfinder/ckfinder.html?type=Flash',
	filebrowserUploadUrl : '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
	filebrowserImageUploadUrl : '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
	filebrowserFlashUploadUrl : '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
});
CKFinder.setupCKEditor( Description, '../' );
</script>

<?php }?>
</div>
