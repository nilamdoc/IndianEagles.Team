<?php
use lithium\storage\Session;
$session = Session::read('session');
?><br>
<div style="margin:auto;width:90%">
<!--
<?php echo($page['Description'])?>
<?php if($session['mcaNumber']=='92143138'){?>
<script src="//cdn.ckeditor.com/4.5.11/full/ckeditor.js"></script>
<?=$this->form->create(null,array('class'=>'form-group','id'=>'Business','url'=>'/users/businessplan')); ?>
		<input type="hidden" name="page" value="businessplan">
		<textarea name="Description" cols="60" rows="4" class="ckeditor"><?=$page['Description']?></textarea>
		<br>
		<input type="submit" value="Save" class="form-control btn btn-primary">
</form>
<?php }?>
-->
<div class="panel panel-primary">
  <div class="panel-heading" ><h2>Business Plan</h2></div>
  <div class="panel-body">
    <h3>Business Plan explained in simple video</h3>
						<iframe src="https://www.youtube.com/embed/65maFnLsQd8?rel=0&amp;controls=0" allowfullscreen="" frameborder="0" height="400" width="100%"></iframe>
				<!-- https://youtu.be/65maFnLsQd8 -->
				<h3>Detailed Business Plan</h3>
				
  </div>
</div>
</div>
