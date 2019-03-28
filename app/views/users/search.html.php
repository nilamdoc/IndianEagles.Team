<div style="width:70%;background-color:white;padding:10px">
<h2>Search</h2>
<?=$this->form->create('',array('url'=>'/users/search')); ?>
MCA Name:
<input type="text" name="mcaName" value="" id="mcaName" class="form-control" onkeyup="searchName();">
MCA Number:
<input type="text" name="mcaNumber" value="" id="mcaNumber" class="form-control" onkeyup="searchNumber();">
<br>
<div id="result"></div>
</form>
</div>