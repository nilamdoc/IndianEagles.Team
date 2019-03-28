<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

//include_once __DIR__.'/scrap.php';

if (isset($_POST['submit'])){
         ob_start();
        $month = $_REQUEST['month'];
            $page = '1';
            $year = $_REQUEST['year'];
         ini_set('memory_limit','-1'); 
         ini_set('max_execution_time', 0); 
         print_r($_REQUEST['month'].' ');
         print_r($_REQUEST['year'].' ');
         ob_end_flush();
         flush();
            /************************************************
            * values used throughout the script
            ************************************************/
            // urls to call - the login page and the secured page
            $urlLogin = "http://modicare.com/default.aspx"; // login url
            $urlSecuredPage = "http://modicare.com/Consultant/comm_enroll.aspx"; // data scraping url

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
            
            $abc = "/abc = \'(.*)\'/i";
            
            $code = regexExtract($data,$abc,$regs,1);
            print_r($code);
            ?>
<script src="../js/md5.js" type="text/javascript"></script>
<script>
var newpass = hex_md5('A3670279Ahd');
var password = hex_md5(<?=$code?>+newpass));
alert(newpass);

window.location = "scrapMonth.php?password=" + password + "&id=92143138&month=<?=$month?>&year=<?=$year?>"; 

</script>
            
           <?php
//}
            
            

    $data = new Data\Scrap($_REQUEST);
    $scrap = $data->initialize();
    if($scrap)    {
        echo "CSV created successfully";
    } else{
        echo "Error in create CSV";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
 crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="../js/md5.js" type="text/javascript"></script>
        <script>
var newpass = hex_md5('A3670279Ahd');
//var password = hex_md5(<?=$code?>+newpass));
alert(newpass);
//window.location = "scrapMonth.php?password=" + password + "&id=92143138&month=<?=$month?>&year=<?=$year?>"; 

</script>
            

        </head>
    <body>
        <div class="container">
            <h2>Modicare</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="form-data">
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