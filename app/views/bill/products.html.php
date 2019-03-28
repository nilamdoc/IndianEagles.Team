<?php echo $this->_render('element', 'bill');?>	
<div class="container">
<br><?=$this->form->create('',array('url'=>'/bill/products', 'enctype'=>"multipart/form-data")); ?>
<br>
<?=$this->form->field('file', array('type' => 'file','label'=>'BV.csv', 'class'=>'form-control-file')); ?>
<br>
<input type="submit" name="submit" value="Submit" id="Submit" class="btn btn-primary">

</form>

</div>
