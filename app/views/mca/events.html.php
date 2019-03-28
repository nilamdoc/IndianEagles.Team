<?php
use lithium\storage\Session;
$session = Session::read('session');
?>
<div style="margin:auto;width:90%">
<?php echo($page['Description'])?>
<?php if($session['mcaNumber']=='92143138'){?>
<script src="/ckeditor/ckeditor.js"></script>
<script src="/ckfinder/ckfinder.js"></script>

<?=$this->form->create(null,array('class'=>'form-group','id'=>'Events','url'=>'/mca/events')); ?>
		
		<TABLE id="Table" class="table table-condensed ">
		<tr>
		<td><label for="DateTime">Date Time</label>
		<input type="datetime" name="DateTime" id='DateTime' class="form-control input-sm"/></td>
		<td><label for="Event">Event</label>
		<input type="text" name="Event" id='Event' class="form-control input-sm"/></td>
		</tr>
		<tr>
		<td><label for="Place">Place</label>
		<input type="text" name="Place" id='Place' class="form-control input-sm"/></td>
		<td><label for="Address">Address</label>
		<input type="text" name="Address" id='Address' class="form-control input-sm"/></td>
		</tr>
		<tr>
		<td><label for="City">City</label>
		<input type="text" name="City" id='City' class="form-control input-sm"/></td>
		<td><label for="State">State</label>
		<input type="text" name="State" id='State' class="form-control input-sm"/></td>
		</tr>		<tr>
		<td><label for="Host">Host</label>
		<input type="text" name="Host" id='Host' class="form-control input-sm"/></td>
		<td><label for="Topic">Topic</label>
		<input type="text" name="Topic" id='Topic' class="form-control input-sm"/></td>
		</tr>
		<tr>
		<td><label for="Mobile">Mobile</label>
		<input type="text" name="Mobile" id='Mobile' class="form-control input-sm"/></td>
		<td><label for="Review">Review</label>
		<input type="text" name="Review" id='Review' class="form-control input-sm"/></td>
		</tr>
		</table>
		<label for="EventDescription">EventDescription</label>
		<textarea id="EventDescription" name="EventDescription" cols="60" rows="4" class="ckeditor"><?=$page['Description']?></textarea>
		<br>
		<input type="submit" value="Save" class="form-control btn btn-primary">
</form>
<?=$this->form->create(null,array('class'=>'form-group','id'=>'Events','url'=>'/mca/events')); ?>
		<input type="hidden" name="page" value="events">
		<textarea id="Description" name="Description" cols="60" rows="4" class="ckeditor"><?=$page['Description']?></textarea>
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
