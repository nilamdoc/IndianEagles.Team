<?php
namespace Data
{
    /**
    * Scraping class
    */
    class Scrap
    {
        function __construct($request = array())
        {
            include_once __DIR__.'/simplehtmldom/simple_html_dom.php';
            $this->request = $request;
        }
        
        function initialize()
        {
        ob_start();
        $month = $this->request['month'];
            $page = '1';
            $year = $this->request['year'];
         ini_set('memory_limit','-1'); 
         ini_set('max_execution_time', 0); 
         print_r($this->request['month'].' ');
         print_r($this->request['year'].' ');
         ob_flush();
         flush();
            /************************************************
            * values used throughout the script
            ************************************************/
            // urls to call - the login page and the secured page
            $urlLogin = "http://modicare.com/default.aspx"; // login url
            $urlSecuredPage = "http://modicare.com/Consultant/comm_builders.aspx"; // data scraping url

            // POST names and values to support login
            $nameUsername='ctl00$txtELogin';       // the name of the username textbox on the login form
            $namePassword='ctl00$txtPasLogin';       // the name of the password textbox on the login form
            $nameLoginBtn='ctl00$btnlogin';          // the name of the login button (submit) on the login form
            $valUsername ='92143138';        // the value to submit for the username
            $valPassword ='A3670279Ahd';        // the value to submit for the password
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
            $code = $this->regexExtract($data,$abc,$regs,1);
            $new_pass = md5('A3670279Ahd');
            $code_pass = $code.$new_pass;
            //echo $new_pass,'<br/>';
            $valPassword = md5($code_pass);        // the value to submit for the password
            //echo $valPassword;
            // from the returned html, parse out the __VIEWSTATE and
            // __EVENTVALIDATION values
            $viewstate = $this->regexExtract($data,$regexViewstate,$regs,1);
            $eventval = $this->regexExtract($data, $regexEventVal,$regs,1);

            /************************************************
            * now issue a second call to the Login page;
            *   this time, it will be a POST; we'll send back
            *   as post data the __VIEWSTATE and __EVENTVALIDATION
            *   values the server previously sent us, as well as the
            *   username/password.  We'll also set up a cookie
            *   jar to retrieve the authentication cookie that
            *   the server will generate and send us upon login.
            ************************************************/
            $postData = '__VIEWSTATE='.rawurlencode($viewstate)
                      .'&__EVENTVALIDATION='.rawurlencode($eventval)
                      .'&__VIEWSTATEGENERATOR=CA0B0334
                        &__EVENTTARGET=
                        &__EVENTARGUMENT=
                        &__VIEWSTATEENCRYPTED='
                      .'&'.$nameUsername.'='.$valUsername
                      .'&'.$namePassword.'='.$valPassword
                      .'&'.$nameLoginBtn.'='.$valLoginBtn
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

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:11.0) Gecko/20100101 Firefox/11.0' );
            curl_setOpt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_URL, $urlLogin);
            curl_setopt ($ch, CURLOPT_COOKIE,$cookies);
            curl_setopt($ch, CURLOPT_COOKIEJAR, $cookies);     

            $data = curl_exec($ch);
            
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:11.0) Gecko/20100101 Firefox/11.0' );
            curl_setOpt($ch, CURLOPT_POST, FALSE);
            curl_setopt($ch, CURLOPT_URL, $urlSecuredPage);
            curl_setopt ($ch, CURLOPT_COOKIE,$cookies);
            curl_setopt($ch, CURLOPT_COOKIEJAR, $cookies); 
            
            $data = curl_exec($ch);

            $html = str_get_html($data); 

            $viewstate = $this->regexExtract($data,$regexViewstate,$regs,1);
            $eventval = $this->regexExtract($data, $regexEventVal,$regs,1);
            
            // $viewstate = $html->find('#__VIEWSTATE')[0]->value;
            // $eventval = $html->find('#__EVENTVALIDATION')[0]->value;
            
            $VIEWSTATEGENERATOR = $html->find('#__VIEWSTATEGENERATOR')[0]->value;

            // dont' why __VIEWSTATE and __EVENTVALIDATION value not working from current page so hardcode both in $data
            $data = "ctl00%24ContentPlaceHolder1%24ScriptManager1=ctl00%24ContentPlaceHolder1%24UpdatePanel1%7Cctl00%24ContentPlaceHolder1%24ddlPaging&ctl00%24hdnAahdaarAuthen=&ctl00%24txtTracking=&ctl00%24ContentPlaceHolder1%24ddlfmonth=".$month."&ctl00%24ContentPlaceHolder1%24ddlfyear=".$year."&ctl00%24ContentPlaceHolder1%24RegularMenu=PBV&ctl00%24ContentPlaceHolder1%24TxtPBV=&ctl00%24ContentPlaceHolder1%24txtcumm=300&ctl00%24ContentPlaceHolder1%24Btn_Submit=ShowNetwork&__EVENTTARGET=ctl00%24ContentPlaceHolder1%24ddlPaging&__EVENTARGUMENT=&__LASTFOCUS=&__VIEWSTATE=".rawurlencode($viewstate)."&__VIEWSTATEGENERATOR=".$VIEWSTATEGENERATOR."&__EVENTVALIDATION=".rawurlencode($eventval)."&__VIEWSTATEENCRYPTED=&__ASYNCPOST=true";

            //echo $data;die;

            // first page data for get total pages
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

            $response = curl_exec($ch);
            $err = curl_error($ch);

            if ($err) {
              return false;
            } else {
              
                // get DOM from string or file
                $html = str_get_html($response);

                $total_page = 1;
                print_r($total_page. ' ');
        ob_flush();
        flush();
                foreach($html->find('select#ContentPlaceHolder1_ddlPaging option') as $option)
                {
                    $total_page = $option->innertext; // get total pages for data
                    //$total_page = 9;
                }
                print_r($total_page. ' ');
        ob_flush();
        flush();

                $dataFile =  $year.'-'.$month.'-b.csv'; // csv file name

                if(file_exists($dataFile)){
                  unlink($dataFile);    
                }


                $file = file_exists($dataFile) ? fopen($dataFile, 'a') : fopen($dataFile, 'w');

                fputcsv($file, array('SN', 'MCA No', 'Consultant Name', 'Status', 'Enrollment Date', 'Enrollment Sponsor', 'Valid Title', 
                                    'PaidAs Title', 'Level %','PV', 'PBV','GPV','GBV','Cumulative BV','Level','PGBV', 'Roll Up',
                                    'Legs', 'Qualified Director Legs', 'APB', 'DB', 'LPB', 'TF', 'CF', 'HF', 'Gross'));

                $mainArray = array();

                foreach($html->find('table#ContentPlaceHolder1_GvPbv_Slab') as $e)
                {
                    foreach($e->find('tr') as $el)
                    {
                        $dataArray = array();
                        foreach($el->find('td') as $val)
                        {
                            $column = str_replace(';', ' ', trim($val->innertext));

                            $dataArray[] = $column;
                        }
                        if(!empty($dataArray))
                        {
                            $mainArray[] = $dataArray;
                        }
                    }
                }
                // not use yet
                // foreach ($mainArray as $row)
                // {
                //   fputcsv($file, $row);
                // }
                // $AllPages = $this->dynamicData(2, $total_page, $html, $month, $year, $ch, $urlSecuredPage);
                // echo "here";
                // echo '<pre>';print_r($AllPages);
                // die;
                // skip first page
                for($i = 2; $i <= $total_page; $i++)
                {

                    $page = $i;
                    $getPageData = $this->getAllData($page, $month, $year, $ch, $urlSecuredPage, $viewstate, $VIEWSTATEGENERATOR, $eventval);
                    print_r($i.' ');
                    ob_flush();
                    flush();

                    $html = str_get_html($getPageData);

                    foreach($html->find('table#ContentPlaceHolder1_GvPbv_Slab') as $e)
                    {
                      foreach($e->find('tr') as $el)
                      {
                          $dataArray = array();
                          foreach($el->find('td') as $val)
                        {
                            $column = str_replace(';', ' ', trim($val->innertext));

                            $dataArray[] = $column;
                        }
                        if(!empty($dataArray))
                        {
                            $mainArray[] = $dataArray;
                        }
                      }
                    }
                }
                //echo '<pre>';print_r($mainArray);
                // output each row of the data
                foreach ($mainArray as $row)
                {
                  fputcsv($file, $row);
                }
                return true;
            }

            curl_close($ch);
            ob_end_clean();
        }

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

        
        function getAllData($page, $month, $year, $ch, $urlSecuredPage, $viewstate, $VIEWSTATEGENERATOR, $eventval)
        {
            

            // dont' why __VIEWSTATE and __EVENTVALIDATION value not working from current page so hardcode both in $data

//            $data = "ctl00%24ContentPlaceHolder1%24ScriptManager1=ctl00%24ContentPlaceHolder1%24UpdatePanel1%7Cctl00%24ContentPlaceHolder1%24ddlPaging&ctl00%24hdnAahdaarAuthen=&ctl00%24txtTracking=&ctl00%24ContentPlaceHolder1%24ddlfmonth=".$month."&ctl00%24ContentPlaceHolder1%24ddlfyear=".$year."&ctl00%24ContentPlaceHolder1%24RegularMenu=PBV&ctl00%24ContentPlaceHolder1%24TxtPBV=&ctl00%24ContentPlaceHolder1%24txtcumm=300&ctl00%24ContentPlaceHolder1%24Btn_Submit=ShowNetwork&__EVENTTARGET=ctl00%24ContentPlaceHolder1%24ddlPaging=".$page."&__EVENTARGUMENT=&__LASTFOCUS=&__VIEWSTATE=".rawurlencode($viewstate)."&__VIEWSTATEGENERATOR=".$VIEWSTATEGENERATOR."&__EVENTVALIDATION=".rawurlencode($eventval)."&__VIEWSTATEENCRYPTED=&__ASYNCPOST=true";
            //echo $data;die;

            $data = "ctl00%24ContentPlaceHolder1%24ScriptManager1=ctl00%24ContentPlaceHolder1%24UpdatePanel1%7Cctl00%24ContentPlaceHolder1%24ddlPaging&ctl00%24hdnAahdaarAuthen=&ctl00%24txtTracking=&ctl00%24ContentPlaceHolder1%24ddlfmonth=".$month."&ctl00%24ContentPlaceHolder1%24ddlfyear=".$year."&ctl00%24ContentPlaceHolder1%24RegularMenu=PBV&ctl00%24ContentPlaceHolder1%24TxtPBV=&ctl00%24ContentPlaceHolder1%24txtcumm=300&ctl00%24ContentPlaceHolder1%24Btn_Submit=ShowNetwork&__EVENTTARGET=ctl00%24ContentPlaceHolder1%24ddlPaging=".$page."&__EVENTARGUMENT=&__LASTFOCUS=&__VIEWSTATE=".rawurlencode($viewstate)."&__VIEWSTATEGENERATOR=".$VIEWSTATEGENERATOR."&__EVENTVALIDATION=".rawurlencode($eventval)."&__VIEWSTATEENCRYPTED=&__ASYNCPOST=true";

            //            $data = "ctl00%24ContentPlaceHolder1%24ScriptManager1=ctl00%24ContentPlaceHolder1%24UpdatePanel1%7Cctl00%24ContentPlaceHolder1%24ddlPaging&ctl00%24hdnAahdaarAuthen=&ctl00%24txtTracking=&ctl00%24ContentPlaceHolder1%24ddlfmonth=".$month."&ctl00%24ContentPlaceHolder1%24ddlfyear=".$year."&ctl00%24ContentPlaceHolder1%24RegularMenu=PBV&ctl00%24ContentPlaceHolder1%24TxtPBV=&ctl00%24ContentPlaceHolder1%24txtcumm=300&ctl00%24ContentPlaceHolder1%24ddlPaging=".$page."&__EVENTTARGET=ctl00%24ContentPlaceHolder1%24ddlPaging&__EVENTARGUMENT=&__LASTFOCUS=&__VIEWSTATE=".rawurlencode($viewstate)."&__VIEWSTATEGENERATOR=".$VIEWSTATEGENERATOR."&__EVENTVALIDATION=".rawurlencode($eventval)."&__VIEWSTATEENCRYPTED=&__ASYNCPOST=true";

            // get other page data
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

            $response1 = curl_exec($ch);
            $err = curl_error($ch);
            //echo $response1;

            if ($err) {
              echo "cURL Error #:" . $err;die;
            } else {
                return $response1;
            }

        }

        // no use yet
        function dynamicData($page = 2, $total_page, $response, $month, $year, $ch, $urlSecuredPage)
        {
            if($page == 2)
            {
                $html = $response; 
            }
            else{
                $html = str_get_html($response); 
                
            }
            
            $dataFile =  $year.'-'.$month.'.csv'; // csv file name

            $file = file_exists($dataFile) ? fopen($dataFile, 'a') : fopen($dataFile, 'w');
            
            $viewstate = $html->find('#__VIEWSTATE')[0]->value;
            $eventval = $html->find('#__EVENTVALIDATION')[0]->value;
            
            $VIEWSTATEGENERATOR = $html->find('#__VIEWSTATEGENERATOR')[0]->value;
            

            // dont' why __VIEWSTATE and __EVENTVALIDATION value not working from current page so hardcode both in $data
            $data = "ctl00%24ContentPlaceHolder1%24ScriptManager1=ctl00%24ContentPlaceHolder1%24UpdatePanel1%7Cctl00%24ContentPlaceHolder1%24ddlPaging&ctl00%24hdnAahdaarAuthen=&ctl00%24txtTracking=&ctl00%24ContentPlaceHolder1%24ddlfmonth=".$month."&ctl00%24ContentPlaceHolder1%24ddlfyear=".$year."&ctl00%24ContentPlaceHolder1%24RegularMenu=PBV&ctl00%24ContentPlaceHolder1%24TxtPBV=&ctl00%24ContentPlaceHolder1%24txtcumm=300&ctl00%24ContentPlaceHolder1%24ddlPaging=".$page."&__EVENTTARGET=ctl00%24ContentPlaceHolder1%24ddlPaging&__EVENTARGUMENT=&__LASTFOCUS=&__VIEWSTATE=".rawurlencode($viewstate)."&__VIEWSTATEGENERATOR=".$VIEWSTATEGENERATOR."&__EVENTVALIDATION=".rawurlencode($eventval)."&__VIEWSTATEENCRYPTED=&__ASYNCPOST=true";

            //echo $data;die;

            // first page data for get total pages
            curl_setopt_array($ch, array(
              CURLOPT_URL => $urlSecuredPage,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_USERAGENT => 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:11.0) Gecko/20100101 Firefox/11.0',
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => $data,
              CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded"
              ),
            ));

            $response = curl_exec($ch);
            $err = curl_error($ch);
            
            if ($err) {
              return false;
            } else {
              
                // get DOM from string or file
                $html = str_get_html($response);
                //echo $html;
                $mainArray = array();

                foreach($html->find('table#ContentPlaceHolder1_GvPbv_Slab') as $e)
                {
                    foreach($e->find('tr') as $el)
                    {
                        $dataArray = array();
                        foreach($el->find('td') as $val)
                        {
                            $column = str_replace(';', ' ', trim($val->innertext));

                            $dataArray[] = $column;
                        }
                        if(!empty($dataArray))
                        {
                            $mainArray[] = $dataArray;
                        }
                    }
                }
                foreach ($mainArray as $row)
                {
                  fputcsv($file, $row);
                }
                if($page <= $total_page)
                {
                    $page = $page + 1;
                    $this->dynamicData($page, $total_page, $response, $month, $year, $ch, $urlSecuredPage);
                }
                else{
                    return true;   
                }
            }
        }
    }

}