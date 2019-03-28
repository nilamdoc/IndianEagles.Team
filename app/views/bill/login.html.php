<?php echo $this->_render('element', 'bill');?>	
<div class="container ">
<br><br><h3>Login</h3><br>
<?=$this->form->create('',array('method'=>'post', 'enctype'=>"multipart/form-data")); ?>
 <div class="row"  style="text-align:center">
    <div class="col-md-3 field">
     <input type="text" class="form-control inPhone" id="phone" name="phone" aria-describedby="phoneHelp" required placeholder="1234567890" onblur="sendSMS(this.value);">
     <label for="phone">Phone Number</label>
    <small id="phoneHelp" class="form-text text-muted">Write your phone / mobile number.</small>
    </div>
 </div>
 <div class="row"  style="text-align:center">
  <div class="col-md-3 field">
     <input type="password" class="form-control inPassword" id="password" name="password" aria-describedby="passwordHelp" required placeholder="      ">
     <label for="password">SMS Code</label>
     <small id="passwordHelp" class="form-text text-muted">SMS Code received on mobile.</small>
  </div>
 </div>
 <div class="row" style="margin-top:20px">
  <div class="col-md-1 field">
  <button type="submit" name="submit" class="btn btn-outline-success">Login</button>
  <input type="hidden" name="phone_code" id="phone_code" value="">
  </div>
 </div>

</form>
</div>
<script>
function sendSMS(mobile){
 if(mobile.length!=10){
  return false;
 }
 var  myURL = "/twilio/sendSMS/"+mobile;
 $.ajax({crossOrigin: true,
		url: myURL,
   success: function(data){
    $("#phone_code").val(data['sms'])
 }});
}
</script>
<style>
.field {
  padding-top: 0px;
  display: flex;
  flex-direction: column;
}
label {
  order: -1;
  padding-left: 15px;
  transition: all 0.3s ease-in;
  transform: translateY(40px);
  pointer-events: none;
}
input:focus + label {
  padding-left: 2px;
  transform: translateY(5px);
}
.inEmail:placeholder-shown + label{
  order: -1;
  padding-left: 15px;
  transition: all 0.3s ease-in;
  transform: translateY(40px);
  pointer-events: none;
}
.inEmail:not(:placeholder-shown) + label {
  padding-left: 2px;
  transform: translateY(5px);
}

.inPassword:placeholder-shown + label{
  order: -1;
  padding-left: 15px;
  transition: all 0.3s ease-in;
  transform: translateY(40px);
  pointer-events: none;
}
.inPassword:not(:placeholder-shown) + label {
  padding-left: 2px;
  transform: translateY(5px);
}
</style>