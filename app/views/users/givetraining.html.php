<div style="margin-top:-10px;margin-left:40px"  align="center">
<?php if($msg=="Upload OK"){?>
<div class="alert alert-success" style="margin-top:25px">
<h4>Documents submitted, we shall call back to you soon!</h4>
</div>
<?php }?>
<h3>Register with IndianEagles and Give Training</h3>
<div class="row">
	<div class="col-md-6" align="left">
<?php echo $this->_render('element', 'register');?>	
	</div>
	<div class="col-md-6" align="left">
<?=$this->form->create(null,array('class'=>'form-group','id'=>'Register', 'enctype'=>"multipart/form-data")); ?>
	<div class="form-group">
	<input type="text" class="form-control" name="registerfor" id="registerfor" value="Give Training" readonly="readonly">
	Want to get registered as a <a href="/users/register">consultant</a>? Want to get registered for <a href="/users/gettraining">training</a>?
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
		<div class="row">
			<input type="hidden" name="IP" id="IP" value="<?=$_SERVER['REMOTE_ADDR'];?>">
			<input type="button" value="Save" class="form-control btn btn-primary" onclick="checkFormRegister();">
		</div>
</form>
</div>
</div>
</div>
