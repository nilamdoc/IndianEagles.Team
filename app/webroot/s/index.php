<?php 
ob_start();
ob_end_flush();
flush();
$urlLogin = "https://modicare.com/default.aspx"; // login url
$captchaURL = "https://modicare.com/Captcha.aspx"; // Captcha URL
$urlSecuredPage = "https://modicare.com/Consultant/comm_enroll.aspx"; // data scraping url
include_once __DIR__.'/simplehtmldom/simple_html_dom.php';

// POST names and values to support login
$nameUsername='ctl00$txtELogin';       // the name of the username textbox on the login form
$namePassword='ctl00$txtPasLogin';       // the name of the password textbox on the login form
$nameLoginBtn='ctl00$btnlogin';          // the name of the login button (submit) on the login form
$valUsername ='92143138';        // the value to submit for the username
$valPassword ='6b108c56596b7e4e1a337b071e8b985a';        // the value to submit for the password
$valLoginBtn ='Login';             // the text value of the login button itself

// the path to a file we can read/write; this will
// store cookies we need for accessing secured pages
$cookies =  __DIR__.'/cookie.txt';

// regular expressions to parse out the special ASP.NET
// values for __VIEWSTATE and __EVENTVALIDATION
$regexViewstate = '/__VIEWSTATE\" value=\"(.*)\"/i';
$regexEventVal  = '/__EVENTVALIDATION\" value=\"(.*)\"/i';

$regs = '';

/************************************************
* initialize a curl handle; we'll use this
*   handle throughout the script
************************************************/
$ch = curl_init();


/************************************************
* first, issue a GET call to the ASP.NET login
*   page.  This is necessary to retrieve the
*   __VIEWSTATE and __EVENTVALIDATION values
*   that the server issues
************************************************/
curl_setopt($ch, CURLOPT_URL, $urlLogin);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
$data=curl_exec($ch);

$viewstate = regexExtract($data,$regexViewstate,$regs,1);
$eventval = regexExtract($data, $regexEventVal,$regs,1);

$html = str_get_html($data); 
$VIEWSTATEGENERATOR = $html->find('#__VIEWSTATEGENERATOR')[0]->value;

$abc = "/abc = \'(.*)\'/i";

$code = regexExtract($data,$abc,$regs,1);
foreach($html->find('img') as $element){
 if($element->src=="Captcha.aspx"){
   echo '<img src="https://modicare.com/'. ($element->src).'">' . '<br>';
 }
}

// var_dump($CaptchaAspx);


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
        <script src="../js/md5.js" type="text/javascript"></script>

            

        </head>
    <body>
        <div class="container">
            <h2>Modicare</h2>
            <form action="sc.php" method="post" id="form-data">
                <div class="form-group">
                 <label for="month">ABC:</label>
                 <input type="text" name="abc" id="abc" value=""  class="form-control">
                </div>

                <div class="form-group">
                 <label for="month">Password:</label>
                 <input type="text" name="password" id="password" value=""  class="form-control">
                </div>
                <div class="form-group">
                 <label for="month">EventVal:</label>
                 <input type="text" name="eventval" id="eventval" value=""  class="form-control">
                </div>
                <div class="form-group">
                 <label for="month">Viewstate:</label>
                 <input type="text" name="viewstate" id="viewstate" value=""  class="form-control">
                </div>
                <div class="form-group">
                 <label for="month">Viewstate Generator:</label>
                 <input type="text" name="viewstategen" id="viewstategen" value=""  class="form-control">
                </div>
             
                <div class="form-group">
                 <label for="month">MCA:</label>
                 <input type="text" name="id" id="id" value=""  class="form-control">
                </div>
                <div class="form-group">
                 <label for="captcha">Captcha:</label>
                 <img src="<?=$captchaURL?>">
                 <input type="text" name="captcha" id="captcha" value=""  class="form-control">
                </div>
                <div class="form-group">
                    <label for="month">Month:</label>
                    <select name="month" id="month" class="form-control">
                        <option value="">SELECT MONTH</option>
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="year">Year:</label>
                    <select name="year" id="year" class="form-control">
                        <option value="">SELECT YEAR</option>
                        <?php for($i=0; $i < 3; $i++): ?>
                            <?php 
                                $year = date('Y',strtotime(" - ".$i." year"));
                            ?>
                            <option value="<?php echo $year ?>"><?php echo $year ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <button type="submit" name="submit" class="btn btn-default">Submit</button>
            </form>
            <div id="success-message"></div>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {

                $('#form-data').validate({ // initialize the plugin
                    rules: {
                        month: {
                            required: true
                        },
                        year: {
                            required: true
                        },
                        captcha:{
                            required: true
                        }
                    }
                });

            });
        </script>
    </body>
</html>

<?php
     function regexExtract($text, $regex, $regs, $nthValue)
        {
            /************************************************
            * utility function: regexExtract
            *    use the given regular expression to extract
            *    a value from the given text;  $regs will
            *    be set to an array of all group values
            *    (assuming a match) and the nthValue item
            *    from the array is returned as a string
            ************************************************/

            if (preg_match($regex, $text, $regs)) {
                $result = $regs[$nthValue];
            }
            else {
                $result = "";
            }
            return $result;
        }
?>

        <script>
        
         var newpass = hex_md5('A3670279Ahd');
         var code = '<?=$code?>';
         var password = hex_md5(code+newpass);
         var viewstate = '<?=rawurlencode($viewstate)?>';
         var viewstategen = '<?=rawurlencode($VIEWSTATEGENERATOR)?>';
         var eventval = '<?=rawurlencode($eventval)?>';
//alert(newpass);
//alert(<?=$code?>);
//alert(password);
$("#abc").val(code);
$("#password").val(password);
$("#viewstate").val(viewstate);
$("#viewstategen").val(viewstategen);
$("#eventval").val(eventval);


$("#id").val('92143138');
//window.location = "scrapMonth.php?password=" + password + "&id=92143138&month=<?=$month?>&year=<?=$year?>"; 
</script>