<div style="margin-top:-10px;margin-left:40px"  align="center">
<?php if($msg=="Upload OK"){?>
<div class="alert alert-success" style="margin-top:25px">
<h4>Documents submitted, we shall call back to you soon!</h4>
</div>
<?php }?>
<h3>Register with IndianEagles as a Consultant</h3>
<div class="row">
	<div class="col-md-6" align="left">
		<?php echo $this->_render('element', 'register');?>	
	</div>
	<div class="col-md-6" align="left">
<?=$this->form->create(null,array('class'=>'form-group','id'=>'Register', 'enctype'=>"multipart/form-data")); ?>
	<div class="form-group">
	<input type="text" class="form-control" name="registerfor" id="registerfor" value="Consultant" readonly="readonly">
	Want to get registered for <a href="/users/gettraining">training</a>? Want to give training to <a href="/users/givetraining">consultants</a>?
	</div>
	<div class="row">
	<div class="col-md-6" align="left">
		<div class="form-group">
			<label for="name"><?=$t('Reference Name')?></label>
			<input type="text" class="form-control" name="sponsorname" id="sponsorname">
			<span id="sponsornameError" style="color:red"></span>
		</div>	
		</div>
		<div class="col-md-6" align="left">
		<div class="form-group">
			<label for="surname"><?=$t('Reference MCA No')?></label>
			<input type="text" class="form-control" name="sponsormcano" id="sponsormcano">
			<span id="sponsormcanoError" style="color:red"></span>
		</div>	
		</div>
		</div>
		<div class="row">
		<div class="col-md-6" align="left">
		<div class="form-group">
			<label for="name"><?=$t('Name')?></label>
			<input type="text" class="form-control" name="name" id="name">
			<span id="nameError" style="color:red"></span>
		</div>	
		</div>
		<div class="col-md-6" align="left">
		<div class="form-group">
			<label for="surname"><?=$t('Surname')?></label>
			<input type="text" class="form-control" name="surname" id="surname">
			<span id="surnameError" style="color:red"></span>
		</div>	
		</div>
	</div>
	<div class="row">
		<div class="col-md-6" align="left">
	<div class="form-group">
					<label for="DateofBirth"><?=$t('Date of Birth')?></label>
					<input type="text" class="form-control" id="dateofbirth" placeholder="1985-12-31" name="dateofbirth" value="">
					<span id="dobError" style="color:red"><?=$t('Select Date of birth')?></span>
				</div>
				</div>
			<div class="col-md-6" align="left">
		<div class="form-group">
			<label for="email"><?=$t('Email')?></label>
			<input type="text" class="form-control" name="email" id="email">
			<span id="emailError" style="color:red">yourname@emailaddress.com</span>
		</div>	
		</div>
	</div>
<div class="row">
<div class="col-md-12" align="left">
<div class="form-group">
			<label for="address"><?=$t('Address, including City')?></label>
			<input type="text" class="form-control" name="address" id="address">
			<span id="addressError" style="color:red"></span>
		</div>	
		</div>
</div>
		<div class="row">
		<div class="col-md-6" align="left">
		<div class="form-group">
			<label for="pincode"><?=$t('Pin Code')?></label>
			<input type="text" class="form-control" name="pincode" id="pincode">
			<span id="pincodeError" style="color:red"></span>
		</div>	
		</div>
		<div class="col-md-6" align="left">
		<div class="form-group">
			<label for="mobile"><?=$t('Mobile')?></label>
			<input type="text" class="form-control" name="mobile" id="mobile">
			<span id="mobileError" style="color:red"></span>
		</div>	
		</div>
	</div>
	<hr>
	<h4>Upload any 2 (two) documents</h4>
	<h5><?=$t('Only Images (JPG, PNG, GIF). NO PDF documents')?></h5>
		<div class="row">
		<div class="col-md-6" align="left">
		<div class="form-group">
		<select class="form-control" name="doc1" id="doc1" onblur="$('#doc1value').html($('#doc1 option:selected').text()+' No:');$('#Option1').val('doc1_'+$('#doc1 option:selected').val());">
			<option value="aadhar">Aadhar Card</option>
			<option value="pan">PAN Card</option>
			<option value="passport">Passport</option>
			<option value="voter">Voter ID</option>
			<option value="driving">Driving License</option>
			<option value="utility">Utility Bill</option>
		</select><br>
		<div class="form-group">
			<label for="doc1name"><span id="doc1value">Aadhar Card No:</span></label>
			<input type="text" class="form-control" name="doc1name" id="doc1name">
			<span id="doc1nameError" style="color:red"></span>
		</div>	
		</div>	
		</div>
		<div class="col-md-6" align="left">
								<?=$this->form->field('file1', array('type' => 'file','label'=>'', 'class'=>'form-control-file')); ?>
								<span id="file1Error" style="color:red"></span>
								<?=$this->form->field('option1',array('type'=>'hidden','value'=>"doc1")); ?>
		</div>
		</div>
		<hr>
		<div class="row">
		<div class="col-md-6" align="left">
			<div class="form-group">
<select class="form-control" name="doc2"  id="doc2" onblur="$('#doc2value').html($('#doc2 option:selected').text()+' No:');$('#Option2').val('doc2_'+$('#doc2 option:selected').val());">
			<option value="pan">PAN Card</option>
			<option value="passport">Passport</option>
			<option value="aadhar">Aadhar Card</option>
			<option value="voter">Voter ID</option>
			<option value="driving">Driving License</option>
			<option value="utility">Utility Bill</option>
		</select><br>
		<div class="form-group">
			<label for="doc2name"><span id="doc2value">PAN Card No:</span></label>
			<input type="text" class="form-control" name="doc2name" id="doc2name">
			<span id="doc2nameError" style="color:red"></span>
		</div>
		</div>	
		</div>
		<div class="col-md-6" align="left">
								<?=$this->form->field('file2', array('type' => 'file','label'=>'', 'class'=>'form-control-file')); ?>
								<span id="file2Error" style="color:red"></span>
								<?=$this->form->field('option2',array('type'=>'hidden','value'=>"doc2")); ?>
		</div>
		</div>	
		<hr>
		<h3>Bank Details</h3>
		<div class="row">
		<div class="col-md-6" align="left">
		<div class="form-group">
			<label for="AccountName"><?=$t('Account Name')?></label>
			<input type="text" class="form-control" name="AccountName" id="AccountName">
			<span id="emailError" style="color:red"></span>
		</div>	
		</div>
		<div class="col-md-6" align="left">
		<div class="form-group">
			<label for="AccountNumber"><?=$t('Account Number')?></label>
			<input type="text" class="form-control" name="AccountNumber" id="AccountNumber">
			<span id="emailError" style="color:red"></span>
		</div>	
		</div>
		</div>
		<div class="row">
		<div class="col-md-6" align="left">
		<div class="form-group">
			<label for="IFSCCode"><?=$t('Search IFSC Code')?></label>
			<input type="text" class="form-control" name="IFSCCode" id="IFSCCode" onkeyup="checkIFSC(this.value);">
			<label for="IFSCoptions"><?=$t('Select IFSC Code')?></label>
			<select class='form-control' id="IFSCoptions"  name="IFSCoptions" onblur="selectIFSC(this.value);">
			</select>
		</div>	
		</div>
		<div class="col-md-6" align="left">
		<strong>Bank: </strong><span id="bank"></span><br>
		<strong>Bank IFSC: </strong><span id="bankifsc"></span><br>
		<strong>Branch: </strong><span id="bankbranch"></span><br>
		<strong>Address: </strong><span id="bankaddress"></span><br>
		<strong>City: </strong><span id="bankcity"></span><br>
		<strong>State: </strong><span id="bankstate"></span><br><br>
		</div>
		</div>
		<div class="row">
		<div class="col-md-6" align="left">
		<div class="form-group">
		<select class="form-control" name="bankType" id="bankType" onblur="$('#bank1value').html($('#bankType option:selected').text()+' No:');$('#Option3').val('bank_'+$('#bankType option:selected').val());">
			<option value="cheque">Cheque</option>
			<option value="passbook">Passbook</option>
		</select>
		</div>	
		</div>
		<div class="col-md-6" align="left">
								<?=$this->form->field('file3', array('type' => 'file','label'=>'', 'class'=>'form-control-file')); ?>
								<span id="file1Error" style="color:red"></span>
								<?=$this->form->field('option3',array('type'=>'hidden','value'=>"bank")); ?>
		</div>
		
		<div class="row">
			<input type="hidden" name="IP" id="IP" value="<?=$_SERVER['REMOTE_ADDR'];?>">
			
			<input type="button" value="Save" class="form-control btn btn-primary" onclick="checkForm();">
		</div>
</form>
</div>
</div>
</div>
