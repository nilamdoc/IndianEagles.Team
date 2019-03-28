<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

//include_once __DIR__.'/scrap.php';
            include_once __DIR__.'/simplehtmldom/simple_html_dom.php';

$month = $_POST['month'];
$year = $_POST['year'];
$password = $_POST['password'];
$captcha = $_POST['captcha'];


$id = $_POST['id'];
$viewstate = $_POST['viewstate'];
$viewstategen = $_POST['viewstategen'];
$eventval = $_POST['eventval'];

ob_start();
ob_end_flush();
flush();
$urlLogin = "https://modicare.com/default.aspx"; // login url
$urlDashboard = "https://modicare.com/Consultant/dash-board.aspx"; //dashboard
$urlSecuredPage = "https://modicare.com/Consultant/comm_enroll.aspx"; // data scraping url

// POST names and values to support login
$nameUsername='ctl00$txtELogin';       // the name of the username textbox on the login form
$namePassword='ctl00$txtPasLogin';       // the name of the password textbox on the login form
$nameCaptcha='ctl00$txtCaptcha';         // the name of the captcha text box for login form
$nameLoginBtn='ctl00$btnlogin';          // the name of the login button (submit) on the login form
$valUsername =$id;        // the value to submit for the username
$valPassword =$password;        // the value to submit for the password
$valLoginBtn ='Login';             // the text value of the login button itself
$valCaptcha = $captcha;


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
  

            $postData = '__VIEWSTATE='.$viewstate
                      .'&__EVENTVALIDATION='.$eventval
                      .'&__VIEWSTATEGENERATOR='.$viewstategen
                      .'&__EVENTTARGET=
                        &__EVENTARGUMENT=
                        &__VIEWSTATEENCRYPTED='
                      .'&'.$nameUsername.'='.$valUsername
                      .'&'.$namePassword.'='.$valPassword
                      .'&'.$nameLoginBtn.'='.$valLoginBtn
                      .'&'.$nameCaptcha.'='.$valCaptcha
                      .'&ctl00$txtforgot=
                      &ctl00$hdngotorangreeti=
                      &ctl00$txtProductHomeSearch=
                      &ctl00$txtMCANo=
                      &ctl00$txtPassword=
                      &ctl00$txtCustomerID=
                      &ctl00$txtCustomerPWD=
                      &ctl00$txtEmpCode=
                      &ctl00$txtEmpPassword=
                      &ctl00$hd1=CONSULTANT
                      &ctl00$hd2=M';
//print_r($postData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:11.0) Gecko/20100101 Firefox/11.0' );
            curl_setOpt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_URL, $urlLogin);
            curl_setopt($ch, CURLOPT_COOKIE,$cookies);
            curl_setopt($ch, CURLOPT_COOKIEJAR, $cookies);     
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_MAXREDIRS,5);
            
            $data=curl_exec($ch);
            $viewstate = regexExtract($data,$regexViewstate,$regs,1);
            $eventval = regexExtract($data, $regexEventVal,$regs,1);

            $html = str_get_html($data); 
//            print_r($data);
//            $VIEWSTATEGENERATOR = $html->find('#__VIEWSTATEGENERATOR')[0]->value;

            // dont' why __VIEWSTATE and __EVENTVALIDATION value not working from current page so hardcode both in $data
            $data = "ctl00%24ContentPlaceHolder1%24ScriptManager1=ctl00%24ContentPlaceHolder1%24UpdatePanel1%7Cctl00%24ContentPlaceHolder1%24ddlPaging&ctl00%24hdnAahdaarAuthen=&ctl00%24txtTracking=&ctl00%24ContentPlaceHolder1%24ddlfmonth=".$month."&ctl00%24ContentPlaceHolder1%24ddlfyear=".$year."&ctl00%24ContentPlaceHolder1%24RegularMenu=PBV&ctl00%24ContentPlaceHolder1%24TxtPBV=&ctl00%24ContentPlaceHolder1%24txtcumm=300&ctl00%24ContentPlaceHolder1%24Btn_Submit=ShowNetwork&__EVENTTARGET=ctl00%24ContentPlaceHolder1%24ddlPaging&__EVENTARGUMENT=&__LASTFOCUS=&__VIEWSTATE=".rawurlencode($viewstate)."&__VIEWSTATEGENERATOR=".$viewstategen."&__EVENTVALIDATION=".rawurlencode($eventval)."&__VIEWSTATEENCRYPTED=&__ASYNCPOST=true";


            curl_setopt_array($ch, array(
              CURLOPT_URL => $urlSecuredPage,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 60,
              CURLOPT_USERAGENT => 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:11.0) Gecko/20100101 Firefox/11.0',
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => $data,
              CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded"
              ),
            ));
//print_r(curl_setopt_array);
            $response = curl_exec($ch);
            $err = curl_error($ch);

           if($err) {
              return false;
            } else {
              
                // get DOM from string or file
                $html = str_get_html($response);
//print_r($html);
                $total_page = 1;
                                foreach($html->find('select#ContentPlaceHolder1_ddlPaging option') as $option)
                {
                    $total_page = $option->innertext; // get total pages for data
                    $total_page = 5;
                }
print_r($total_page);                

                $dataFile =  $year.'-'.$month.'.csv'; // csv file name

                if(file_exists($dataFile)){
                  unlink($dataFile);    
                }


                $file = file_exists($dataFile) ? fopen($dataFile, 'a') : fopen($dataFile, 'w');

                fputcsv($file, array('SN', 'MCA No', 'Consultant Name', 'Status', 'Enrollment Date', 'Level', 'Enrollment Sponsor', 'Valid Title', 
                                    'PaidAs Title', 'PV', 'GPV', 'PBV', 'Cummulative PBV', 'GBV', 'Cummulative BV', 'Level %', 'PGBV', 'Roll Up',
                                    'Legs', 'Qual Director Legs', 'Bonus Paid', 'Director Bonus Points', 'Director Bonus Earned', 'Leadership Productivity Points', 'Leadership Productivity Bonus', 'Travel fund', 'Car fund', 'House fund', 'Gross', 'NEFT', 'Aadhaar'));

                $mainArray = array();


            }
            
//print_r($html)
?>

<?php
function regexExtract($text, $regex, $regs, $nthValue)   {
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