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
<br>
<!--<a href="#" onclick="history.back()"><< back</a> <a href="/mca/addproduct">Add product</a>-->
<div class="row" style="background-color:white;margin:auto;width:90%">
<div class="col-md-2" align="left" style="padding:0px">
<table class="table table-condensed table-bordered" >
	<tr>
		<th style="background-color:#9999CC"><?=$product['category']?></th>
	</tr>
	<?php foreach($category as $c){ ?>
	<tr>
		<td style="background-color:#99ff99">Code: <?=$c['code']?></td>
	<tr>
	<tr>
		<td><a href="/mca/product/<?=$c['Code']?>"><?=$c['name']?></a></td>
	<tr>
	
	<?php }?>
	</table>
</div>
<?php print_r($product['category'])?>
	<div class="col-md-5" align="left" style="border: 1px solid black">
<h2  style="background-color:#ccccff;padding:4px"><?=$product['category']?></h2>
<h3 style="background-color:#cceeff;padding:4px;margin-top:-10px"><?=$product['code']?> - <?=$product['name']?></h3>
<table class="table table-condensed table-bordered">
	<tr>
		<td colspan="3">
		<img src="/img/<?=$product['code']?>.jpg" width="100%">
		</td>
	</tr>
	<tr>
		<td>
		<h3>MRP: &#8377; <?=number_format($product['mrp'],2)?>
		</h3>
		</td>
		<td>
		<h3>DP: &#8377; <?=number_format($product['dp'],2)?>
		</h3>
		<td>
		<h3>BV: &#8377; <?=number_format($product['bv'],2)?>
		</h3>
		</td>
	</tr>
	<tr>
		<td colspan="3"><h3>Size: <?=$product['size']?></h3>
		</td>
	</tr>
	<tr>
		<td colspan="3">
		<div class="form-group">
    <label class="sr-only" for="CopyURL">Copy URL</label>
    <div class="input-group">
      <div class="input-group-addon">URL</div>
      <input id="Copyto" type="text" class="form-control" id="CopyURL" value="http://indianeagles.team/mca/product/<?=$product['code']?>">
      <div class="input-group-addon btn" type="button" data-clipboard-demo data-clipboard-target="#Copyto">Copy</div>
    </div>
  </div>
		
		
		</td>
	</tr>
</table>
		<p>
		<iframe src="https://www.youtube.com/embed/<?=$product['video']?>?rel=0&amp;controls=0" allowfullscreen="" frameborder="0" height="400" width="100%"></iframe>
		</p>
	</div>
	<div class="col-md-5" align="left">
	<?php echo($product['description'])?>
	</div>
</div>


	<script src="//cdn.ckeditor.com/4.5.11/full/ckeditor.js"></script>
		<?=$this->form->create(null,array('class'=>'form-group','id'=>'Product',)); ?>
		<textarea name="description" cols="60" rows="4" class="ckeditor"><?=$product['description']?></textarea>
		<br>
		Video:
		<input type="text" name="video" id="video" class="form-control" value="<?=$product['video']?>">
		<input type="hidden" name="code" id="code" value="<?=$product['code']?>">
		<input type="button" value="Save" class="form-control btn btn-primary" onclick="$('#Product').submit();">
		</form>
