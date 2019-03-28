<script src="https://cdn.rawgit.com/zenorocha/clipboard.js/v1.5.12/dist/clipboard.min.js"></script>
<script>var clipboard = new Clipboard('.btn');

clipboard.on('success', function(e) {
    console.info('Action:', e.action);
    console.info('Text:', e.text);
    console.info('Trigger:', e.trigger);

    e.clearSelection();
});

clipboard.on('error', function(e) {
    console.error('Action:', e.action);
    console.error('Trigger:', e.trigger);
});
</script>
	<style type="text/css">
					body{
				font-family: 'b_bharati_aloktwonormal', Arial, ;
							}

@font-face {
    font-family: 'b_bharati_aloktwonormal';
    src: url('/css/balokt_-webfont.woff2') format('woff2'),
         url('/css/balokt_-webfont.woff') format('woff');
    font-weight: normal;
    font-style: normal;

}
.entry-content {font-family: b_bharati_aloktwonormal;} 

.size30{ font-family: 'b_bharati_aloktwonormal';font-size:30px; }
.size36{ font-size: 36px; }
</style>

<br>

<!--<a href="#" onclick="history.back()"><< back</a> <a href="/mca/addproduct">Add product</a>-->
<div class="row" style="background-color:white;margin:auto;width:90%">
<div class="col-md-2" align="left" style="padding:0px">
<table class="table table-condensed table-bordered" >
	<tr>
		<th style="background-color:#9999CC"><?=$product['g_category']?></th>
	</tr>
	<?php foreach($category as $c){ ?>
	<tr>
		<td style="background-color:#99ff99">Code: <a href="/mca/gujarati/<?=$c['code']?>"><?=$c['code']?></a></td>
	<tr>
	<tr>
		<td><a href="/mca/gujarati/<?=$c['Code']?>"><?=$c['g_name']?></a><br><?=$c['name']?></td>
	<tr>
	<?php }?>
	</table>
</div>
	<div class="col-md-10" align="left" style="border: 1px solid black">
	<h2  style="background-color:#ccccff;padding:4px"><?=$product['category']?></h2>
	<h3 style="background-color:#cceeff;padding:4px;margin-top:-10px"><?=$product['code']?> - <?=$product['name']?></h3>
	<script src="//cdn.ckeditor.com/4.5.11/full/ckeditor.js"></script>
	<?=$this->form->create(null,array('class'=>'form-group','id'=>'Product',)); ?>
		<input type="hidden" name="Code" id="Code" class="form-control" value="<?=$product['code']?>">
		<label>Category</label>
		<input type="text" name="g_Category" id="g_Category" class="form-control" value="<?=$product['g_category']?>">
		<label>Name</label>
		<input type="text" name="g_Name" id="g_Name" class="form-control"  value="<?=$product['g_name']?>"><br>
		<textarea name="g_Description" id="g_Description" class="form-control size30"   ><?php echo $product['g_description']?></textarea>
		<input type="text" value="<ul> <li> </li> </ul>">
		<input type="submit" value="save" class="form-control btn btn-primary">
	</form>
</div>