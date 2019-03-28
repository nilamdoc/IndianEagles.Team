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
            $valUsername =$this->request['id'];        // the value to submit for the username
            $valPassword =$this->request['password'];        // the value to submit for the password
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
            
            curl_setopt($ch, CURLOPT_URL, $urlLogin);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            $data=curl_exec($ch);
            
            $valPassword = $this->request['password'];        // the value to submit for the password
            echo $valPassword;
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
//print_r($VIEWSTATEGENERATOR); exit;            

            // dont' why __VIEWSTATE and __EVENTVALIDATION value not working from current page so hardcode both in $data
            $data = "ctl00%24ContentPlaceHolder1%24ScriptManager1=ctl00%24ContentPlaceHolder1%24UpdatePanel1%7Cctl00%24ContentPlaceHolder1%24ddlPaging&ctl00%24hdnAahdaarAuthen=&ctl00%24txtTracking=&ctl00%24ContentPlaceHolder1%24ddlfmonth=".$month."&ctl00%24ContentPlaceHolder1%24ddlfyear=".$year."&ctl00%24ContentPlaceHolder1%24RegularMenu=PBV&ctl00%24ContentPlaceHolder1%24TxtPBV=&ctl00%24ContentPlaceHolder1%24txtcumm=300&ctl00%24ContentPlaceHolder1%24Btn_Submit=ShowNetwork&__EVENTTARGET=ctl00%24ContentPlaceHolder1%24ddlPaging&__EVENTARGUMENT=&__LASTFOCUS=&__VIEWSTATE=".rawurlencode('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')."&__VIEWSTATEGENERATOR=".$VIEWSTATEGENERATOR."&__EVENTVALIDATION=".rawurlencode('rlRg/vIU63esWET2yFJKp4SQbyKYjz3MGMD5x8p5/jp6xAOPKQMBnBPbiQ/Qaejrn28aINHOts5rakNEiZLo3XhUPAs4wW7aqn13eKaAsyFD7rNg7KcJM5sS3JehxAEuR97loJmWeDHbNTUMQ9X1S8MHvdsE15/2JgpWpf63FPGQ0ejVvMnNHXds5TkXDXOhf8Iyuza+dPtT6mXTHQhwofddVad6P/BtoorjlZPMP/7i+9zRzT2ZVBi8usgGdrHs0VoYAGs1N39uz+yNv8cd4NzsaTO/y7J3T3nhr7qxnB5tysJRKy7c3/g9MU230mBdtrUgOed+WAaRTxQL1A6NIj0wwwbwy7qZAysl+N9iDNruxgQiDLnrwAZ4CUvkk7mN+LGCi2U2iMNBFk8lO52/A/ph0vzDCHXhvxmYelir3dMhdjV4h6iiQF7teudOd64IgSrchxsOLM0LDmyGOCyn7ekL32A8RNBH6rhewd/6u6S8GzAwSQLIZ6T41VrjZPczuPhbhzJWjoNwNVyxKRd6fz1pCb2eZrgl9eACJk4rcukDZH+dgZEB1jmS1Lt2Q6FVnuNWywhVRmHeYeYDK9R6krfVYcE2InZ8nvCEm3RSTcay2n8N4nUmgXX8kTpCBcnBliwRp3XzFItRsIABfzZ6S68SdNaSCA+GBO1kIrdQ9k6stZjvrB+hlyrXNkeoS+hsc8PWbpp3R+XgwHO2LqX3TaWMfawGZNWfKHKcdfx60b2cA4MmY90GDQ5oBPqO3eCBdqvBU2b/r9lbcY1P8UjWyD+opcG05/pglSmNaObWJCHrcGwaT9X+oa/UhdkwX19h')."&__VIEWSTATEENCRYPTED=&__ASYNCPOST=true";

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
                print_r($total_page. ' ');exit;
        ob_end_flush();
        flush();
                foreach($html->find('select#ContentPlaceHolder1_ddlPaging option') as $option)
                {
                    $total_page = $option->innertext; // get total pages for data
//                    $total_page = 5;
                }
                

                $dataFile =  $year.'-'.$month.'.csv'; // csv file name

                if(file_exists($dataFile)){
                  unlink($dataFile);    
                }


                $file = file_exists($dataFile) ? fopen($dataFile, 'a') : fopen($dataFile, 'w');

                fputcsv($file, array('SN', 'MCA No', 'Consultant Name', 'Status', 'Enrollment Date', 'Level', 'Enrollment Sponsor', 'Valid Title', 
                                    'PaidAs Title', 'PV', 'GPV', 'PBV', 'Cummulative PBV', 'GBV', 'Cummulative BV', 'Level %', 'PGBV', 'Roll Up',
                                    'Legs', 'Qual Director Legs', 'Bonus Paid', 'Director Bonus Points', 'Director Bonus Earned', 'Leadership Productivity Points', 'Leadership Productivity Bonus', 'Travel fund', 'Car fund', 'House fund', 'Gross', 'NEFT', 'Aadhaar'));

                $mainArray = array();

                foreach($html->find('table#ContentPlaceHolder1_GvPbv_Slab') as $e)
                {
                    foreach($e->find('tr') as $el)
                    {
                        $dataArray = array();
                        foreach($el->find('td') as $val)
                        {
                        if( date("d M Y", strtotime($val->innertext))=== $val->innertext){
                         $column = str_replace(';', ' ', date("Y-m-d", strtotime($val->innertext)));
                        }else{
 
                         $column = str_replace(';', ' ', trim($val->innertext));
                        }
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
                //print_r($total_page.' ');
                for($i = 2; $i <= $total_page; $i++)
                {
                 print_r($i.'/'.$total_page." ");
                 flush();
                    $page = $i;
//                    print_r($page.' ');
                    $getPageData = $this->getAllData($page, $month, $year, $ch, $urlSecuredPage);
                    $html = str_get_html($getPageData);
//                    print_r( $html);
                    
                    foreach($html->find('table#ContentPlaceHolder1_GvPbv_Slab') as $e)
                    {

                      foreach($e->find('tr') as $el)
                      {
                          $dataArray = array();
                          foreach($el->find('td') as $val)
                        {
                       if( date("d M Y", strtotime($val->innertext))=== $val->innertext){
                         $column = str_replace(';', ' ', date("Y-m-d", strtotime($val->innertext)));
                        }else{
 
                         $column = str_replace(';', ' ', trim($val->innertext));
                        }
                          $dataArray[] = $column;
                        }
                        if(!empty($dataArray))
                        {
                            $mainArray[] = $dataArray;
                        }
                     
                      }

                    foreach ($mainArray as $row)
                    {
                        if($page>=373){
                    //      print_r($row);
                          flush();
                          }

                      fputcsv($file, $row);
                    }
                    $mainArray = array();                
                    }
                }
//                echo '<pre>';print_r($mainArray);
                // output each row of the data
                return true;
            }

            curl_close($ch);
            
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

        
        function getAllData($page, $month, $year, $ch, $urlSecuredPage)
        {
            
//print_r($page . " - ");
            // dont' why __VIEWSTATE and __EVENTVALIDATION value not working from current page so hardcode both in $data
            $data = "ctl00%24ContentPlaceHolder1%24ScriptManager1=ctl00%24ContentPlaceHolder1%24UpdatePanel1%7Cctl00%24ContentPlaceHolder1%24ddlPaging&ctl00%24hdnAahdaarAuthen=&ctl00%24txtTracking=&ctl00%24ContentPlaceHolder1%24ddlfmonth=".$month."&ctl00%24ContentPlaceHolder1%24ddlfyear=".$year."&ctl00%24ContentPlaceHolder1%24RegularMenu=PBV&ctl00%24ContentPlaceHolder1%24TxtPBV=&ctl00%24ContentPlaceHolder1%24txtcumm=300&ctl00%24ContentPlaceHolder1%24ddlPaging=".$page."&__EVENTTARGET=ctl00%24ContentPlaceHolder1%24ddlPaging&__EVENTARGUMENT=&__LASTFOCUS=&__VIEWSTATE=HIUo9fL4ssP46YFeVbhg4BSceToXwE9sSvxxeuDtvvYaEXqTTnnikCjo8NHE%2F78IXqXXVVRY%2F5C26IEYj51SANkvNyQ1up3bO8uCBB%2BleBD0YzYThetbnus5p4aQErasTfbxeZL3P2eW7gfLHYKIiHy%2FmUZ63F%2BNQ3QW8HfKN%2F%2Fab7VQGhmOCtDI6Cwkjuyd4hAwa5lqQtZPqmMCnLNm28NReiO8VomL90pCbkVS7ylkiUqNjTjqAXBLE7wDUCHcrnPUhQHHY1llsc3gqgBbnQOU4fk%2BicH9HFCvosMaqSDiiCQqjUD2H%2BCxlZmn%2FeMFJKvBoOA9lzKZFWKAjZNL4vnnrKVC%2Bk78q5r5PNajPJxxaDxXnYAhKM0VTWpbSoX7udHKUuXvJYSi89fAZg9XnF4TohAgUI325rpp893%2F7aCQRTefiezSsQ1sN4ZnLSykMt7WdOTgjqAC2Rtay2Lj6wRzkZov1esxjyXER%2FyymnGBRJlKzwsnIJShtVtknYCMLYzitYWt80EAycubXDYokJ9RsL2RuqJu92h3OAvsuSHpCNbDaNT0n%2FuA1kJ0twok0oPzkKYvb%2FU1ceFn4h1x4meqjHitCdn5i3F8viNs9DanC2AGGH%2BX1r6IHh5%2Bd9WqLXd2lXoNs6tiPe8EBDCa8L%2FCwubvHglYOERhTf9pgSnizUe060e0567mWo02QSE4M%2F3NFLwRwUlgAlFfV9P2YxzbI9aYWHz9jg32jD3kRKSLGaKh9syV5EyYOH2%2Fe33v356Y8yj1Np829cduYka6PKriIi%2BNvcvbf3LyTQrfMI%2FaYpxErsxCVQn7Bcfk8Dg7qIYAKEEyOoR9kBAznz%2Fnw3a8M2fnqKFtkiiNk104yoci7rLMTuHod206yjsnuETrNtE46JY2JcIP%2FmroiFg91PmC1h1WWBTa2fHpODaY%2BjxnX9sx2BHN1DR6g8%2B496U9DaAy%2BU9kFXmzXv7tK4m%2B0QB0c2Dc7%2FMnWjRnn7sFYS44X7waUgw0lwGgZaxnwUbxsqcO9F3UJ%2B5erarWe7vNTv65VKW62xRUHVLQrQGpkiMdAhLzszTRLmVfmV5UZ3gWjGkn6ZR6IRWDdEEn1fWiNJZpru%2B1FWJ%2BydTJVq0ori%2FB1eZdKiy6%2BCNstcO7g%2BHA254k1dEyQnUqM8xy8kn3BCdVl8YWQOii2o99iS3kUdyHZ9xxtuz64r3L72ZHzYinS5%2FnKK%2FsqK0ks0C5ZDr0KXXPgwM6T3MDHN6rl3uVbMzfbHvsfIdLOUAZzvdMngfBp%2Burwkmgmhv%2BFsealFNNwNJFI1CYte9ZRYfF3qkNDvofUt%2B%2Fl5I2XbnKl6q%2FzTokZMNczCnZ4uQ54b4kj9ct8pK1yJZx5q9mJf2KbxwRPqOfBpnWaiDJIUzIJOJa9ZIw8D4bfg0SUPry9x7HJrwebInmUZs1p2%2FPSN0on7wSG1iV%2Fyp6%2FjV5k7FqpfdpZnp0%2BniTOG%2B%2Bg2WO6nBb%2BM67fHNfRahmBtRvZ%2BVHKYW%2Fe7llRchenYGLB%2FfLtdwvE08BTlASGs9TkoJd2upSb%2Bxz2exlPs5x0kO284F2UFfh%2F4aWB0QBXdEgabYRCUaw%2BGdtw9%2F8Z7B29u1jl%2Byb6SVT28DLCHHk4Zzw7cF1aTo8mbEpNOWWERFzuM6CY709Ht6IWSfheWWHnmKgqy4Fp4g2GL4pDBVg9jcGmfi4AjRITk66LUa%2Fc2rofuB0MO6lZ7hrwIMynCLoUGtX4riOqXX2%2B31NV%2BTsAl%2B5Kg%2F0SJJAz8ocVLaep%2BELcBazbwKFr27eNaQnu6qxYTRxn3jqOh9rHHBG8NMn47hdWGgCY%2BEYJTrBkh%2BfwjsvcD5Ys3kVGm%2B%2FA7qVSWvbJ2Gak7t%2FHeqpzO6XI9NCaG79XGY7bvh12TOMjunwZMpEu%2FSG%2BLLw9VT%2Fwe%2B7Hq%2FXYVBCXf9K5akjBaHb0%2B0%2FtIpVW7U%2FVcYIZ4VKWd3O2mQHTfgbCsQHjTK7kpwSMjpO26UHXqmF9P1RhDANuTkKOgwwJ2Mv5rM1Xn6FHT4A%2BfiNHXu3XU8tpT4dOuLwoMCF6QcSyGvtL4eUfvSZdXbEQLb9bdx61kUXhxPvC%2Fmo4dYhc1QgPBryVV24IWfavKxICWiHiK%2F%2FnqeQM582bZ5vDA7x2uHtbmKGlna8zjsNQF5tXowrWHKkkcb1tLiOHx25PsMeXPa5OeEjGzyZCy0X9lOPwINqwD%2BphT%2FQymJXtwHWTxKPHlfMKy%2FFbuQcIW5Ka9cjsufTaAOF9EDv707SrCpbwEp5sh6kK25vEuriNOuIs97IBTPTpozyNKsB1VrNmlXXsNG1kbll9uUQ7p5%2Fc86gHYXTr5yPGifXgVxX09FZ9Yn6rZwJS9%2FlXAi7UGBZdykAW11ndyN%2BabQh5U0xiS3qAA4C6dMk%2FXkayypWfKlC50RgoBpI9XoiYtIp1DP%2FpX%2Fqxzs8Cp1TOxWbR6LsF54zcpdcSzYKmON3xB9q%2Bctemd96S9%2FPwoGnXXnVDMKVtbLX%2FlSuFwEPCLHTZTI4pIwV58ktPlj4i1IEGk2Eo2C%2BtY4yW7ma0MNpY%2FYep3AlAH8%2BT36mIK6VwQdF5PYoGLI58XPF8HedVnvw9FZoW%2Bv7E1DaEs3qkHdiw0Pia%2FNuEvILZ3VpqwDHN%2BnbWoAcedc1F%2Fcd5VOWy%2FYJ5Fcdj%2FpVEfby2mosPKEnTOuT9BCkEqcYEvY%2FtBsVH6kja1%2FRB2KU%2Bf5hh8wMCXiDvaaHIsnd16wiC3qh%2FqcpFyGTR9elBGIpuTTfbDsTlviM%2FF9KbXQAk%2FgbgEoL5QzzA7egvaoi0zERzbX9l745%2B4%2B%2F63tx%2FVguJuGC5v31sWyqhBiF9XZGVnZ3TrOVJXr4ov7ambrEXNrlUx5r0ssF3%2B4yAgfOWFr8flgSvR61EtwmtaMuhP8naYLkdAxezlTn4JE6NbxXVO8p47%2B%2BBTjxUBxLEPYBjI7tD83SqeXoAOXlaWL6S37R%2BSPvjDzcFmCThpd6yKXTGGycDqog0szItjVw8%2BrRVTUTrE9%2F%2FDMPnXc0pkEjxJaLRCW05OeEVoY6YZK2RRWeQpDRzgcdUx%2FxA2eFGXZOjGUwLOMWGohILaGiDisPwZzuaYBHK2Xoclab2peejSNnfY7tFpZMKIm2QQ1qUFnASnIjnnFx%2Fpho5Otzt2%2FwIgNbqBi5Wx6hJkDVQx36GPHL2hhHVBVoHbeuoiFKxp6gn70jplTh553fqk4gikGvT1q%2FhoXd6F%2BCyeGVwbSH2udjmOxIA3%2BSKARJkpxPt4FXhMkduKh48SoU0uksxsSbLZwFpiFQnWQyAw3jYjImm6tZ4SDtO35ohU7dn94AsX8ByWPvdHOfu9kn%2Fsr24TubkFHY4zfJZJc8V%2BrDf%2BS%2FvHM%2B64012MLdLas843G%2FqJ0qwnAWpeSqgac9L0cdXFKwua36pwWhV4SUGBEKGJdoSajwdRzfNKCmR%2Fp71Va1%2FWUflSWpQuN0mwfmWwl0jFqQe8tGxBr3dFqJm4GXaoFWu1Y%2FYsif9lkKw4IvYcwwleNzHSaupSjq6sVWoqdFDZDxQxoX9kdAKFXgkWPKPdwKjuC9eICVyWVaUwW3OsMoa%2BUmsGXzz1PvATSoiniAdxvoOTRekzgtbkWbXFfZImmBZMgytlULH0f1%2BBo2kyL9NBRZJlTKR4ZiiclZc2DWeztVwIQrCvuTZjFGnR%2B8jCgiKMqwGVV3yUZDblS7wh%2BNhtTC8fqpH3uYRqY2ToY0PDZumble4LKmgJAjqTHQVPxvzMlf2%2B%2F6DAnFsUdeZMTXsPI9yO5xtTpKfRLhsW5dO%2BUUd%2Bb%2BhAqTtzgOcZAmmIpYIfKHGL1MaLqz3hruEtSkwXVoYFIt7r9mFl0GQxd0bOPWlNCQCXdxDQr6zrF0%2Fuo83ujcBuj01cn6ttXHZlXsrVZhC9s8QLjSu2nvk%2BNYDerDk%2FOlcdXU3VuV3o%2B0Fv63rnjdZYBDJKleiwRzm87SS%2B2UCGYhgxk1ol8Yro%2BG%2FUYS86eGgTpQFcyNmdYdTiHrS7knwnuVPf8%2B7%2FAUakqHOJ8fX6Yp7Xt%2BBTS%2FP317GOiHc1C07k6AN%2FGWHcaHDW%2BoJygVZ4pa8lknOiqmSSuXiU2bRNs7Nm1K8tfz%2FtPnR6GJN3x2Ss4tW9O9zHnjREiQ6UvabBVUrgCA7kmHpwe8q6VPBVRr%2BqvCH13bvXgYB1o5PGsnIhY9XGJWvKK%2Bz07xKHJ5rAeIjjyFgYHM7rlZkYAks3BYDnA4cTIGimTgOBE2s12SE0FXcs5YmgCcHf83VBeQN4iuV9sTQQa64EkClbq4JWZAhm7Hv%2B0riq9g2%2BW3z%2FXcuE21YVmJKXj4h8Y5%2BNSoKxZSoVc7Kd%2FZlKxdQiTwj9VClThNQwnw972ohH%2BVKPsOkuDqQzzenIT5ePKr5Di5oo3PfUaqV%2F228D%2FoUmxF6%2F742UCNwg6sGMk6xZoHE1hDHaeDulmtul68Z%2FrOfkjkqk4k7LrOyd3jhWiY07Glrr3gtvzGbKFmAWbbGYtc72gJkHgbfMuJ4mhmzpSqh2JkJgsbxYUYj3ct58tXiJXRqWY257qoSA3g%2Fr33z59l0HEx6IF4VIAZ6rRPNXAxitzdzs2sARjR6QYQ8tle%2BFIdRd3fD48wcMflb%2BZdjYtjd5eirENcqeP6OC9scHXjAXX8AqhI6VEecfjHjqsCHVung8RHeDOa9vm8Xkf8HNdtkHUo7Z1OGxFg0TOmTxFbE8j3Wx2qjYC7vl8dHRP343CktfWtSc1Typj6p2onwMmVEOUbSBkJwWb7Kf%2Fkat4BgVACvXIdlropS9pzOcGgWa1%2B%2Bk9qgk7illQ8CJkXeH4fyt090tzcccLuvKjwF68iXljpYyCRO8bC2ZP8jkJenmhu51DFvRei2TwJ9X%2FoiNxiK7lvAJY1eSDJePLZ0qhVtCkCWEvMLuIuGk2MQbTHR%2BoYstyvNUfUr%2BWrkdjppVVw6Hw40ogH63PL3gYtMIJMFN12y5j1%2BcZD%2Ff3TvnLu5Zy6edsvtrofoL5MMZiYVXVjYMAdhlkkaGc1IjpWGI5%2Ffr5WN1mr7Zy%2B5eZJ%2FZY4yShoj2QNjVFV2BhfwtXzpx4Z%2BxpQDYD%2BU7cnwulLgX9coiZfnEZ0iOEpUrVCCwmFAy5fuDhFgGG8Z6jvsmr9nNE1JKEpxn%2F8L4xnTI%2B8eCBV9nTbdZPdvVSyvEAyXU1tEDYMnhjKqX%2FEb0CG9yx4muwApSqzZ8xt1hQx5KQe3enzwpIKLKtv4pX797wuV2i90GXH32QX9mGB0bERWcfKlvm37nBSov2RRuzN7Xq6bYt1BXXzUx3Ksj6YNFSIoinJ42JwnBqIDXESdCJM5Olaf%2Bpkr6E%2F3uhRXhoUnLZ2AKRUokwfPOC2uLp0vCRhRmBbJCj%2B8ZUSP5x%2FvfQn0cr9%2BHaQoH2GPqIMbFiZ9LDi7S5lJjQH0EnbVogbl62dZrMzNySLiQL4LPy00CM8HNU3wzhKVm8BZYtcrJjF9aQC9DKaC3WyDLuub2%2B1kpiEe%2Fia7u9r9Fo4KzvhezZHD%2FbJgjVVw5fq1V7FI%2FyD0N4iuFE0nWHwgvP3T5k27JIUfZUn8UJP6TwClrclxDBmcNnyFPuXxXYBDfZWbHGHzuXWUtdelAzvk61HynpRGADIhxuyUh%2B8RSo8NTZLCBuB%2FVE%2Fq9%2F5U%2BQ2L941ILM3NUdVkKTSCXaVoYwa5Uk4Gg6YdE1jhpBMtw1SjA2Ko6YZrjD8gjyfer5XlyeUmhZl9l%2BmcfoLQM6ZuJVAvVNv7N88hCXvoHafWBwSL%2BCvzMZoCmyPZy9IkOOkJcSGexB3vX4OlPy0WCKnGTKP%2BwQ%2FJKfnHJzz%2BDIU0a1JlUkVYQx0qMQdqJvP%2FGIal46bHYIAtle3WbLpvyyS%2Bxy7Y778dtvzTVjztGFjRBpJjZV7o7u1vb42PfCEyLa0VMaF%2FAu7%2BiwfiGQ1h5%2FmePaYB0d41LGWDsxWr39KN9D1Y%2BZj3twnC49ClXA146U7ZE8RXXw2D3WVd0o0aOrkUpNZQog%2FHZwaoVKNT1j9e8nV89icbUWxuVQTE7PUpbq4W%2BYjp%2BJFdDDrqPBnh00iaSL792vcMXRQvL29k2MAhDI3RHmI7lpW4BvNpqalXwpSkL9l6NNajcrKEZiKMCl9yEywhqbTiDyL0eIOk1ilYWXPYDMH7xZasshIMd0zi0cZzbNwv3BFX3JBq8S9tfWiJmM52xgL7h4oB2N8p5Sno4PAyCycDIwF2oGrTaUTJkEMhgEkxaKTCCvmfZ3ttcCsacS3lsez7w85RWVlvEpGC2HIr0e1LN4uQMEe%2Fy3GNzPPzLCF85aFBdWEznzvt6qqp1YTvQ1%2FtnfTkNWfmAxyG7elSeOf6%2B6OeZ42ugbMLDSkdHysIOeA8Uhj0eeXdtOmjKTIs0coKKbtNeSHBkZA1FImSP9jsnLQj6YNGyblKBhBJ04QhrmDj%2FG0STZMXvGHb8lpY4X327f0bgVVMhp3fzZh62bLvGRU%2BhsG6ifafuIOrzoptoLsvPGDOfwcscEVGqD%2BqbPo9vTWT1TUp3dBvfwzDwKlirTjy9GJPSc67RDlD0%2BijgVtkCBCvK%2Fe2OBJ4bVXQQIMV9NqKWCDgppoTNsN2inAx70EC1xf%2F%2FYTvD%2BsrT2BonObM%2Fya7vI88TeLBzKuE%2BuvSQ6ggyBhPYxKW2f7VU%2BNHVEHNhXRUsUA0YV4zzjhNMwkfHuKarFFBhYxC7Vk2b9hhM%2B339c5fEMHzjtgXpUAF0jk6ZP74R%2FM0teJsvjQf88%2B0%2F3clB%2BywQr4xiESKalw3AccRKRbdIY%2FKSRA1x7l4EJvvgkK0ZPF%2B2bJutkKoMKrvKI%2B5iqlptjlTDj7T6WrPhT3wnvhMQUSY%2BYikLpjoJyyIXO0iqNWknphfNfLNxQ3HPLp1Xx5iOE8rcRE9nXb7QCve9DTNnzhb3CO6vRhYxD2dU%2FGpIQuYGHc1dqG0OEyTKob5ws20jMQ087UOq7HAvqrNu3sYsb1iGsZHO4H16jRPH0OofVwvoBb3NSk3MTQcyeE5dHjOK%2Fze88AyMgBt%2BDSsCugbXJ1YFZf9vFkaytp%2BF%2FdTbI9eV%2B18pzcvpm%2FY9otlZrPDlhyXGZHDIsMxtL1%2FcwzWeXMiUM1WuvThagBOPDA%2FnoKgKLFBxcEIDzAjgt39bV7TN%2FLdt%2Fq4s5NObRU2JG0Oo2O9RPk5vU0EtNv7YtrkfazauhE3kgw9Eg8sZFbRtfRZs5Nru1fcpeJzVLrkYxDlVA9t1lznG49UEx80YQy8l74zJaaTsHkjXjU0q1h3pNQBjAZTqsp5OcYmwf1prxJb5snRJsa0%2B16s3Vmc77ayx5xUvAMxEozafy08kJsXlHKpkhIEsdoz1xjFZbt4xAAY2%2BJDNuqAjawaCOqfJrl619b9CQcWinrN1wdvonkHLSWb38pspMFwJla2VRFFCwKRsbO55nmqAZmVe59382amsJdgGNyPlPiolgyQJ0tQYOs0cEastd%2FEcNgnDWMDJqSdgkObS7M%2BZ%2BU9lwUpkEToR7B3yGxdbxIB7WDSXEKLOJssDmMt1EExWdONCDyv7%2Fo0q%2Fd5EjOwaZ2Nw3NJTDxFS8tS29vMgIdfB%2FVKNgbs21fkolYOHCnLxLm0R8Pg3QKZwut%2BhR8ITBnEmapz5RTWdZu6NP8%2Bz%2F4%2FYUoHlI1bbCdBsdbfhnUK7rupq4xwVuGbRI9nhlnaM74P7RJ0McAnCJnd%2BTj4LRnBkqFG%2FlJJ5pDHS9TXlaDbhVGOIfkZ4LQPZ%2BmP6RyF42FN0AQISJ7yhgMz9yoV8HFMk7z2LBF01%2FUruTFz3UHSxHevEzXJySfiE7ITrxsTaj%2FSimP8SydqofqKbuqzpMYH1TgN6Sh4qVPtha9EidMBzGagXyq7JzK28zlysVLKZDcp%2B0Nuw%2B4%2BT5QZxsWqz6ANgJI%2FTomfKiZmerz%2BhPwRN2NS2cfxcutCmpV68q5%2FrmWJo57LaFrzgZQygSNw5J5GbgGNhItd4FHmajaEMguNFaXMcYArzoaNV2enPt%2BSZ6bAVJE7Ew70AVpwuAKcjSulb9rJyxdMjBVVF2kT0h0aABB7XJc%2B9m%2F3IvaSrwKnrfVwkmJgIRKgiKcyKAGZwg9llH6QwUnEBJQOugf8%2Fgxd9herhZZ8YQ2qFTdlBO1nawj87tRM7dX7Fhg2FdfEPviKWmJbDL25q0MFkawKpnsH90APiqT00FD2s0FLoPplk9wZWg33CX9VxhIE2srfNx7DAfAZpqXmURnlACcDY39ay04AeEk9rIh4e6S15GnWPNuq7KCo%2B9Lnw1NZBHBgvGB6LABzJ5RW9zgdj6UmHfhUSlDnpNTONipQnKTejHYatWaSWnpX9GkEl9sr6JscQM9z3qvO9VpzpCd1mOsuHVxqpDo6Qkz2ozqY7jlfrHY1NO946KnuIB0pqCpY00qbVhvkneffcJSz4A4oQO39qYkSk9pEP%2BLP16HXw95FyxAxzWk6yCm4ZdWWDH0SCGtQiNV%2B22F0DYgo5LhS8LVrKweJa6vRQgaXcy9bLnNk%2FsxtPeUCGMjh2gUzTe6JPWy5yTQUOBvZ6VYid%2Bxe2AlYcPlyXQ7W4N3an6a3gZx7rorxjFLoPqTSvVVeoIyW6f6BGJxcM1a5qTEH0mObaNuzsXfGMERUA8jncodw%2BAw7xbqm1clYnVi%2FnVJJGhgn9OLgfwk9F1a22BUzXNTigtolouEcZPQ43ekNPhxetQM%2FIhyY3loJ8pRyYPCDG8lBflMITtSAWe5lO1p20cFxsCV18R6%2BlRt8gzB5YvH9f6QUAZaXgR9fyLssmZ4ImFdzou7t62kEOAFumajo5aCpIf8CmmZmzTfvYhThYTijUGGxHtH9MPbLGdDjmM3YyxJgGYKXREedrQJumpONCWSfGPRCUclUHSav82uXPnMgJjQ3be7a8GXOtKun0vQgIE1jV%2B5hdafD0PVwAFAjxSyJkVlMEAXnjD3qBXz7xW6w4B4Iku%2BuJKbiXDd7yMZxX4AlUKjTLbOGWLKbvwkR5v2qFhL6%2FYMKtAgs8WrgV9Mcz4PAzwE8pRYpULzrd1HqgxBd07j%2FhN3eleRSvoOlJOsVLQPpDmJEsZ080mXbmc0x8OjTsx4D8LoroyMKqNkyFHT9sIr2SIc%2BObXyraF1J3oDHmoHfs5WOFssDi29eZ1jFiZNlORSELe2nhWn55I%2BnA7RTFkBKD5JJt9zylS0YAIQGsmq2t71woVcmHugicJDhFLWG2FMomZ8XCGUnSdrKhcoPkz1FhqJ0k%2Ftnzmzi7TKnpOqafwZkXXMKXfhPpJWJzhgp7qg5hL2dl0zhHoWhDW8Xa6v%2FL9esrQOS9I3zLFLOjb%2Fvt7xv4SajgEmvF4XaFiSnxZGAiSGKeTADHolGs7%2B2Oev%2Bah3bp04rI5G9xqqD%2BvraMYoWGKdVnpu9hiv1mnTMMtsm7rjK6YIJbvKvKg%2Fu75D%2FCmGBbEZCmlw1dWzLQ15fBScEz74%2B1iwq2QMqoWa9n1TTddWA02TJp8fspcJBlXhfmmvZJw0joWFnngkac5mWn9oiUBHaQQEP6rtSRAYJNC01GxNhadvZqIfNbOTz0FVrHxRWUsAnK1tnQ2OotgWVc0dknKKWX%2FybnVnNI0%2FeUBeicINykNcHS16FYfkqr0knDns6aN4NADzrJDlE5yDc9xN8X81PhPs0%2Bph8MX3yt31Z9I7l%2BAS%2BbKB%2B3MPYpOJC2jA%2FYSRTfdyuqAftllfyyzF2x765t8sEADKC1SgBJh%2BO5jygmz3LF3ZFvneK%2FX00q4ut5wl7iLkCbQTTLjPWzn6YpjtYp0SJIpKRZ2GP9LyC1QogV6A6MCV5ePJYLrfE0N0ZSOdv456FEaCDZQcpqkaTXDZiqkTbHpz11DbZb6eqHCawTxUixG7dRYTEYC1WTVgRrSFasd2wDFM2U0PK%2B%2BPygdGBrNO1qBl5DHJBLATKjLrive1%2FKdExljdB0dJGCNRnEfdVYOFBEUkfiw50WwN0w1rQ44wqhbsjEo8i4XvxiY%2F%2FpaEjhXijx1wXeo98x%2BW0YsmwmnY3MrCy1mkhkM7xLpme26BynZhBktRSZXbXNt648aw3OEv3kwWDNe73iu84z3YY844DQfSo5AhXZXk2ei%2FU3I4xbm4OQoO5SL%2FY6kZ1YCeOwG%2F7oAe4buZ3JMBEWHw6lJGtdbppLG9tdzdvTDG9Gi71ZqqeySBt61vmIcPQ8LUEEcvPCESERWOp9PLBQNRqAvQD8s7BlduSQzNytWjc1N21oAo9klwHSqyFt%2BfM1du%2BC8l9exigDz7CMrXjCVM9dfBBalIJRfj6Nj2j5gR57f%2FotSJyEA84%2FbKx5f0DbS3RNDKVQqeKXixGPiUJYMR62p1Q3exaEHrSEt1HcklctN6EKYkhOFy5EmvBPq3Iemkx1Fpzob%2FNNhmU28ULci1FVrLnKa0m3B%2FFaK6RAT2WoddAfO7u4yROlJoAgZXOEdRm3xB49iXpbsVuN7tlcXRygO5QXZ%2BKUYHMNbWPq%2B4WfbWZG%2F81S8IsAO6hrURKo7QY2vGI43SzBqoVjGtK3%2FZa0wBtQUoTs9CgUwXkaRiJyW3Hc%2F4n3eXBKe%2FDamJxcbaIk7BPiFut6dT2ldiBrQFTynF7ZLRlS9nsvRMNG2ppeCnbLeWl5XqPp1I0UTJtLiBG4PdBh0UyrIq7bN9c%2Bksh2YVy51YqhspWonBXjWZIumv1qHx8WHrMxQ9BWYfjDKVSI1xiL4LwTZ%2BQKxGeuczP77o1JisySTC8ts6pi%2BKBFMz6sg%2BUWzl5e3TuURQi%2FzwZc82YrGfp4EAcnTPKTb%2BJIi0mi30vB2r4OLkOT50FJrjMl5v2jN1PZ6L8uViuLutNx%2FUrT%2B8V3FOiTEAxPzG4Oug2du61BnpH%2BBbMGSO%2FzrWTsl98os1nvLNAPZI2LZIh4ce9EYRlgz6oAbtiV7eVhYQugWqC4GEIjNsGQ3P4PdCMofvISvplGg%2BaOzKgu39N7AJm6yNi1gAn%2BBfiE2mnDNe7ERkEuIrY2msx%2BtzGY8NAb6pgQ78DQErLv33p80GkElarQybEfdUZvwLAkIVw%2F5t5r3VMqd45DNl5dF8SKNOy7oX69pjQ5Fv0T03fOzQlVoy7VLAqpAFKcrsAPF1hk9KnLHggM2k13%2B1Qrt5nHT7e5ZPrNp2w%2FDRIK4K3AXG9irdAfuzN45ppazPEWBxJ5ICt7iXXZCkwNiPI%2FZpPTNHKGQLXdGp4xdiWHjX%2Boy3fZn0PjZwPb3tmN6RWrp8VqrAT%2FxiAi%2BcHwi5ke%2Bk3Qhc331ynHR3QyS9MPy3M7xf1L5MLXRBMzCrdE9V9LI4GFMHFeGrGuthRoW%2BWIZLgx%2Fy32kn7rNx3sr0xkI8FcL1hztD934WAxRBT%2FlWYHDcdk3xICbcoD8l9LWkrYBX%2BNEq6ZkqJMnV0XJCokGjOYVvJ1EMoJ5cSwadYW4WTnejIAlJt8ebYivh3hCM6ZpqkyrFMLqwDjweVzdD%2BW63Sl0zPQBA8EVu3Pb5odID5UxrGALl6M1JB7ZqKhFTIVkQ91glkFCRUd9%2FWJHxewHYLNdxK%2FXziAeoHChIlbmX2yi9szt0iaPk9uCtWxT%2FH9Y6GRZQt7avs4Lm01NxKCk97TtF9vT7pPXs8BbyGHtIjhMEmAZ5Ramu%2BB%2BZYdf2wYUE%2FR9u0aDvBo8ItfcGqxUYSl3nyaWHyKWg%2Fi3AV0auqRQY8C0KZk%2FSEC50%2B5oYnapBpWLcbW6N6Pjb9JJjd1udRnR%2BM0vUMhJV31f%2BuuawqGEhGL1zCXrJ4HSIecKOb6AR5kcDHjhBf44Nekz9cCqPcWesRojyKPc5ZweGndiCmkd93%2FaeK0H2Sl2bIYyjeRQSc7g7NkDbog1XNCnFB1F5Fdaw4Jnmmhw5tNzJ7o3f2fy0nn0EDRykHS4drAFfxgGugmm00Maoqe21iAnVgnpPW1FpbWIeJQVk79Qr5zUqiKCTKnq4ef%2FZcLxQANAwICpcY6nkXunpT7ySP8wtLzybNQmn3vfo77vk94ED613%2BnRESxnabtBv7Zl5Nubm%2BYqTh6NEZhfiwyVkAY1Y%2FHWe7hW9a%2FSnq8GMY9k4HL5Ta3dYzQQE0Httwee824M2yD6AggRVL5dA5OLfArVJHuqfrUx734NAG3NrfiUsUcHrBsr1U2r0z7mqeCditxXrKRwDW6wPnT8nM3jzcBA4nEkBL2NKYpNWtHipKoQlguaPo0QLJrMu0xQSC7nazcSZyB8By86h5ZUBVP1JaW87JRc4lns15WkXiEwb6iS%2FlHg8Nwf%2B%2BGEPTgnJeagO50RFf3E5l7eIbywy%2BVUAMX05QmWqaiNwRNFiQTgfwN3s%2BqPQAnnzZWRMuMBQVW%2FdX%2BbHdV9H%2BvZeYRRmugj3ufbrTDUcAdWL0biJ8SsvgF2jP1aoOnBDBEi387OIA5GHOQ96Uo2C4AUpR7wOIH9SF9ddxT8LO0%2BtjZoxsma3AathC1w4DiTERONuk9xWOo5p81tJ9O9f7MHWsXIR6wZMa0lnMMYoyh0k8TA6jqyr%2BxEL29dSxeLaFREPt80Mo8Al0UyQiP6FZ2dQPWigKbGI0nbIsKybYDZ0uX%2BG1nkH8Z32jTUv1MerjZvGftfiOwMiRISoG%2Blo23myNnL6G1f5DtDLl0CYoDV4n5P%2Bsfmg3c3kXQVZABgKaDEZw6mQCLveuZJ63hlPS%2B3JsPyFmn4B%2F2Z%2BjhONCaZIdQ7848O3HfDNgd%2F0u4jIKC7hpQL8z2mjJubcdWCtI0%2BdOSH2BGsTamEbh%2FK83MXQo%2FJ%2BmH5%2FxUe8DJHmRQiIfqota2zLDyrobjVbMSAdgwmFw1PKgKP3%2BLy9idpiSFAS1m7dGl8r37qRGb%2BlbpPLlqAx95koRvlfedi6VPpGGkYuqa6Bl3EqLP6FqHCM8kfojZE3uMKmFmMHJJEBNfUwWhBe6ZRr%2BVfKO6V9B7VPFuqsv0e5PsMQIFdtm0feQKHlNEOY51Qao1DLRDlXZgtfaAkyuZr7Q4h4A1ApVH8FWsAiI2JJ8%2Fo0cuzLFudgPjk%2F%2BFWg%2FHeCOnCk6aS5dSA1r225bm79ujlyA1iFZ9Yi2IdHftYdQoPCval%2Fv%2Ff7jiFF7J8GcdU%2FKOpuUQRntWUFuggon9%2FvfFd6n6mHE0NdE0SLSizUeZwekk4yPB9y7FBEQ%2B2dXLFHwUG%2BQE89skirQ2p3U1XNa9RuceI9nGPEwdoK9GZ0LzRhHAsrtOp%2F7YNRmGYkp5cgTSxZtFV5wDjIs2kzq8yVNOPYkA5TiMCktoKphtxEC78agFFH1J6sbL%2BfwXOjgeqyMc4w8yFglSVlPJMSkAUUSWnQ6Vg0IpcEx0NZIcQl9%2B3rvjMmlHXoELDO287rupjnJhKd5oQev5DBQ9E4bUR2QK6O%2B%2BERIjVugiqHiYhoi%2Bdf3gw%2F2ySFthRvzQz8dxdgEkWsL4FSqTvn2KJ6J%2B%2BE77K%2FGUTBGp8HcmVsmduq5YFG8ugWjbwnDbrO6%2Bopo8xkYy6sEyhy3KYluPQEvVu0t%2BGUGYTNQDsWXBkAevO%2FiTdKIkzdBsn%2Fg4y15F90o7DbaxT8i51IdWhI%2FIDgzCLedz1m51i8iCSoqnD3I2XKGgiTu516cTR7lrYtN9x0x%2BHq3%2BGjVL0ZUnUNJVL8OrjQbn6dzbwvzC9%2BJSgSVBSCuy0x7qCLjdp9qQy064bkgBLeUFaUDgBAjXddIakfiabxFNP4ZzQMK7gyaWXCZZ2fUDwsHWK%2B2lGCjVpdIvUp%2BXhE%2FILtuAtI2Q9QrRz%2BXzNzTGhtUa5wisAL5uftGyyIbbN2T16qIA8Hd6F0We0LIkOxeN4a%2FFVFG1kc8FdmXj5BIeE1bWfJXqBTKt8oqNj3J2dGKesZo7CA1JLzI3uschcsDwaEym%2BZWZ1UYZA8oFMi8ArJP4U%2Fh8umU1mh%2FJjsgm1KBKeVl8EN5YWI7GUHxyaZ16LFC9mcxv6ZzG1PZhZ2E4YaZG%2BHZ0bPM%2Fws1wWe%2B6yUg6oM0ujQfCl%2Byb9I0gcdJNpPgxEabX2p4AETci1vaGHvwW5kJbG06HNok4mhbP6l%2Fpj0YLI5oa4PzTSMLU7fsmPru6GoAE5uPg5Ja7ztGQmR9NrJ3B0Ly23gaEbWDXSv7aqqxuPuGNk1GJBZh%2Fm82J3%2Bq8Lg6HkA016EPiT1skXErswWuLyjOi7rSiTEOT5xnPWIVof4lSOkdq2shcqqJ3f7M05nFut0yq%2BzPsh6KQQNIkCF62QahG5%2B1vrjoEfGS3x9NSTcsVQuTNe4%2BZtkW%2FYEjGGIImTxaj9WqrTf8DkwZbngCyzu6MySNccRGVe4dgsPOTCvnxfnV2wuu%2FQWgFYx4D%2ByBlaJxz%2FnuHidbX0AdnyKI8BLAS3eS4mAc415%2FLXbauFJxDyDmX%2Fr86wOe3eU2ib85aXcIP8GQ6rEzgn69qdqUSNztDx6pC1zgyfIOwgoTe3UcpihMqGjG9g93exBsYu2IpsxEWEBH%2BmxrhQwyqJotBWoiZLiUcRDQ8QiezkkY974HKaWk54E3b72oFvz5d4AibMYtwzspldqVMLi8Yb8zG%2FEEHbU%2F7GiyWHfbGa%2BOkQCVx8fh5jW8K6LNnxc%2Fk0w2TfdptUqk8lrDBiRNFVmPIbaCP6BxRyz4GtVK36Z%2FYChrmJULAP8n7YQGCkSaKI9NRHEbbWSuKq1so8bMC7cQgJfSrwBdiFFlk6VH5xAqmPzr4bl%2B%2BTetWzhA72TDfzY5ZGvH7JB82w3hryN%2BjlnbJlioqr8fdjiz57kE%2F3vu1BD8S9FM9uqJOh3Pcz5lQzRaTr2d%2Br0aClyB4HQ9IWf%2FDr2VQDyv2vi9BbyXlbilpPL6D9O0IL%2FHhiNpTrLGkXgg2TPDsbbp5u3hrSqFWqJOpuOLG358lu4BXJsdznkPyNvDllsiC%2Bwm2iIE5VKvNht1%2BHU5QHc7xuckSCBisPtiOuw6ohyq3TkhEgPdwYPCyAatv60zo6dFvPM0%2BcazCjC9MIxTgmigXtS6Y7EdLRasrtDQjDLbtN6ZD7eGqiX9LYZII%2BVgq1461r4umaqPskxYcgTkzipyZZQCYGgkzy8Y1u%2B%2FTJd0FKwmXPSCbYuqeKHW9%2ByqXUWb5cY3JazIRtFGNaiiYmPawgEo8nDCAQHL2reIRgARre0Anw0%2BctoqOED0J5j8fQCBRlNjg3N%2FD2P0s589%2FvR3Tx1OSq1DxEvt2iHDrd2Fef%2FckJ2PNlAyIz92KvAG37h1TYEZzirXcQWhyLe4CQrNuUYdXyPC3CocQ0np9R1GNJuFdm2PToO8WjRrqUIeJcr2P2MbnNQB%2FddNM%2FoFu6Gh%2BUMsz2GM8viACImD1DAId%2BSGcL3f2lODItVGHaLNGMBED0ob8M%2BPPdaqKLz47aNkRXQRDEk%2FWwOZIjF0215xsi1AKA6OLQe0L9TlcNW5KEjVhmYPxdaSugDATntXvn7NhTgXTFrZjBgW5od%2Bqtz15e%2BDqSVMB%2Fgql4Yz93u0Ag0K2724LB0FBTh%2FbWv6CFk9Wx6icP28qdFfLaudcLWfc%2BjcyYfo4Kzse3zTCFm2pa72anER%2BogSJL2LxChLo%2BLSI0QT8MSjj4MuXrCytHcVkiX7SyqwFpTDbPM2ofZ6e9VLyZaklVwkUWpmiO1b5AZ2Qd3y5Y6Reqw3uqyUqOH7F4zzYQdaJfsLrPqftv%2B1r00A331xHeMoZEmNIp7p2Q3FUHNQpwJoqV5PdaBPF3NGhBFN6a6n8WIXaTRaXkzxa0uPI6Ui4fWaeyhfSaz6kBVhAcsJz765XsJZUzpv3aWh1oCHIUPbx4fed4ccLtSuv4M1%2Bu8D%2BnE8HuM6JyI6fps0fqioCo3nazn%2Fr%2BpO2a1TMGQaaFpzFvJ7DpVzP48ljlzjbgp7wKsmVOVhpAQHRk%2FGJhlZGKfNYMGW12Y%2BQ7liR2ZuUsdlCCjKod0yHUqea%2FkewBU7JgZVPIYly4BCIj%2BH73xDNJvOeUPMm7bu%2FEBLpXjG10XCz7ARqDNIpRrotGajwD00NR99pfqPIQlECOxK8DfZnolSxuvY6Ssv84N%2B%2FQ2GlBYPYxplOMFjlK%2FYxNC4IPigG02C0S%2BIskhbEUsmTR90BnqbwYEI0QavqraGsolXETz8fy%2B9OIhphWkAqx83X7Dmbn%2BWZid%2FIflldqP2hvzakSxi8CUeq8K5k5PKGDOcWuS0qEG4pGUu%2FX3lrHIQnvFg3EO434joghmnELjFoVpPGhYeDgWziVZFOdAxEBtKogF%2FotGG%2BbcRzaQdPpWteK%2BtCaYSISto1wym5hj2McrqnAppcYevtIbYKEkbHcTCVWla5DLSKvw%2BOQQGdYVmcMGcDSS4USBOeX%2FCkH4FTmm8%2BeWmtVpofDA6K6f0Inbpu1vmxcVoj9zUOIX8lXuosNoTroz8GFYpN43C7Hi4Ti4b8HCC55bw5r1FeoYzhq%2FMAmodvazcr0FtOUyPKKhZhDxdOnPKfTeENVg%2BKmHBLiI19a1Xozdyqgg8hstRn4L4DpIiBqzOpBV13w3nPl6z52kGxXwUsEGp5XHP1FEnTlrPOElKIWU3rPev11YRbF4h5CL%2B3B2CuVkzXzDOF%2B2rfG8zl%2BuvYYmHqpCaBFXAEXRyhW%2BqB8FlOwIU%2B2RVjsfu5my5B98Kbp2mxJd7p1Q0vmFeUAjauxpGDCOzWo5PubuxlFqgHXtEvJraV6Qig1k2O91S7EhzNHMvXgbp9DoqAVK3fK%2B7zlex%2FlDTpjwDHw4dE%2BMvdgQIJEALv6EoGhARQ3gk%2BnexvRKlylu1Miuw0mdGiXkBsUdEeNcXPNkW7lbOmPVN7jDwl4agw45vSpfbxwiE%2FtmQsmApl%2B5I7qSf18CG3fBQjT4iq8LYg3kp3gTPzAEQRbM15VUdQncnXG1o4Q0v5GM88BYqoJd5OTzN1MYHRJgFNRVOJwDdLlNiiPQ%2BHREOaNPkLVWfjlWqHVTOmDKtWuJrtBGwaYoH5mUJw%2FI5KFA6uIDIhRXMwpGRaiwm1TsoQFeYgHAasEG2zKR5QvFOAGtjcG9WUT7DZeNIGea4kbheIiLto9TsIWRxJDh2eS4OaLE1YMkLrdDKQd80rUxecoaPDdVpaW4dLHB2JXY7MdeP5jluoYM%2BV6wfGWNJqFzN%2F9ZHel5Zp%2FNLocN0T6DqfJxul1CJtIvhnPoG1z3gbnN0FLdYCbTlcuxZpzfkFdmmLqadzjjjQEdiIykC5AHwABMynnxw9e4nuDvcZokpoXdtifn4TqAVRI%2FaUQoI%2ByCr5KBKuI1BG0iCZ40XraxiJVnlqjViw1qYPskI98%2BnjonWjCHiKKtmB%2FWuSl%2By%2Fi6yBwft0eH9JfHKaWf7WEuIgbdiCLP3Dc5yepvT%2Bc26K23M1n%2FbXfJ4T2OJhrdvTcaEPqyFkqtW3qQ4V4TZf6bZCtiFhxdmGt0%2Bx3i%2BfZG5BRZdrAKShFhzzuxXtITBdmQV7SbCB0VGRrQ0j1RAew43pe9%2BiCC%2FIwj7%2F2PIB2v4a2GJYhqGzALaRyYx2dQt6kxr2GOcDv0OO1jHWmWD2kmh4wpXwfpf3ZA9QwA1WwHsD4SrRZHE4kAUkQ290iONt%2F%2FPOj3IEAJxNakEblUivQGUxIWc0S7r0kntvXgHmvtLeDWqqVSqRtTXb7VmuXf%2BZN5zc73pnykjKy57gkiDMzx%2FR8J2KvNFaBhOpnQAzwWXjgH%2B6AngFZ%2B5b4UOdeRFfMhV6WRdfT3ZWfo61UGXiFTDcsTnXQzsX1RmhHewd95cL3rcUSqyI0LBIG5JAgGXjg2cjmGJIHQSLkRt95WOH1iP2dPis4mY%2BM578xONrLxtaZqLx%2FSY2XwpNz2OERVLjx8m6ButgaaHmmvEFIhO8E6N2sMNvCUUhmyfmVTpFzt%2FN2rJ5rpDMJTP%2BQ%2F1wKT58FCAum55WVcgxXqohiRq40V8CLEZ03%2BeoCc2Zd04JstI49Eli%2FDl%2Fq%2FDq%2FVVP9TM6Wr1dm%2FOD4lKfngF5x0eQX4%2BBDzXF6n%2B8BGBl1VjT%2F6bMASJ2zeEAj6WZDUcPpk9EJL4F840KE37IcPMb%2Bh6rDEGGxpB2ZhQDS9H2AmVz4G3gFKAxgwy3y0veYk7DFX3huWeN5LSBOLhK4%2FYzcdWlhYnXDO81BFGS2F0bqSaA%2BRTv8M3MjDUDWHKnP9kou4%2FRH69urdDa0NC6ycFhLQ666qld52bfIQ%2B9K44uSqVwk%2B8xkKJP46KvHBg7gL0DhIAP3Y8%2BPlg2B3r3bdk4oiEVKOvxG1nmdTLx%2BCAzLLbfOKAym8ayerZvOJfrUD3zQEJzsAHegOL1tscQI%2F45%2BVT0Ju2qwBAsx5yR5z0RLBNaetREjoICMrUjnd4744dPyr5TmoRRgaBeI2oaNKAeRIE0zBN9METy7xEFnnIqTsxFnKsTnFKPxjlLnoJj5vNV50sqox0bgNQdmrHlKGJvLgHipGkURvU%2FuGQz6WpiPSqgnoyb%2Blgou%2F3eV88LYXSTEB%2FTwjzDOxxnnxYM51RmKfIQUCFmuK40x7U9k0PYHXPJTNifEChKBJvz8I6PJ%2FEfWTJJWNudnYvoVx2Wgc6gfqSYrLcm8kdO2lMUU2Dgyrm6S9qFtZ88uaTCZK%2BuYq%2Bal8bxEoQQvZq%2FGLTbp%2BNKwrNYwQB9r9DojrOBp9dCBxj%2FCtifblvTYFDhhw9SVjIRqy7LakybI97Q41s7GzUhf%2B6QHvDObpY8j7rAEqty9jEkdqu35MeT3xZ6c1bfZeevlW0BA%2FX2SuT8ysVfv6JV60AHkctjTeY55MSbvpE6%2FNJVuo2F9iJOMBFa0EnDlNVgZUKWgnHOwjNneGWLtKk7%2F9SbgeUIV%2FIMChAehjLs9JTNOHG%2BUUUihJ4a0wPq9PveeyHMbIhqUka1abo6OQ0y1ufUgH0MJcCC3TesacOWuFmn5CM3aowZwN0VF%2FULxjSGVYpU8Ga%2B8ZLh8XZP2i1Ax602qMfLuLT0froNMJtTrFAbDX%2F%2F7yb2cNAKGdLvqEfkEGf1mttGHPxfv14V7OTTCiizrig%2BjLuSEA%2BJP75yuiTEPVLYK76yrgAEnaFz4KV2v4P%2FCdV6H9ZCTjmJQDXeAYrUoVzXyLjqTU3%2BOeA48%2FmXk8D3oA1cwc0gDlXXR%2BxqmOQsiAVULvznLq7RT2%2FNRTn%2FRrEVYHjtN%2FMWP3dSTp5AM4Zo8oekeNIuqeyBDxB1VsSc1C8EK1Rytq3%2F0XRCcnC9nAwdBF1964Q3HiUovzmCUkIRcqRa5TVJYDVBy%2BdSz3xQeP6BN3QNL0955agvcHc7r0e%2F9Nx%2FVuqJ8d9MdEcZOFn9DX1%2FjsEfjEP6nhLAuANUudMIlgpnHgN%2FuQ1Lt%2Flvb4gtBRuLT0xkdoDKX0UsNk18MZL7tGhCaRXe8ousnWhgw7HVCVKx028y%2BP5kLK%2BaMzrPtc9SJIc8yeUeVmUdV8DaO9VyWgl4GVHqY4u6iF7KyrHobVBowoD8ViP5%2F0y84Q4CI43viHElV31UxR%2BG7ejvBimaozV2KeYHvKk5hA2tkQ2n%2BZ%2FiESKh9r7N0bThyI3u505M4GYsr8570en20lrh9MdIOQvxzYYlWA2M%2B9l3y6MZGqCMSFEVDOHSSSIxyK20xZnTURbZHI7SnwXoU2ONeD2uDqqKKNCV%2FL8ozyz9E35mweaIgd72ikmts%2BOXE6XuQieXUalcEeexcG%2Bvc%2BaeiT3r%2B5ptOmPaX9YilMn%2BCj2AQIhQ%2FGIbia4ezX64f8ThTwmxXmMBBYkRfhJioDv%2BOSlaQGzgu2%2FB0jMJvCCClPKzhioXMzQ5dLcSy5DdOInrfq06WmDFqY3yuugYxpDoobS7eHQN1L4Yd1SzZeAZCvt%2FYt72zph4aCNyL3imRK8qhRYP%2BBJ9jPDLnEfMExQ5PDUvl%2FmMQN5HAaUnCQBgGXe9YZHW6yQ%2BWhwmn0Jzo5p7sP%2BK7YNC5i3RsWkpY%2BbO%2B1cHqnfrc%2Fx8ffqRD8o29ywOH%2FXwOskbY%2Fu%2F%2FExfwkqBbkjH3CN0yRNEwx7qk3jSEc7bQmQPsbDOmAIRJc%2FWV2En7edI%2F5wY2iG%2FDoDH342YX0aLXGtdZEzfC6UimxGJYBJpjVXKdmdmtt2sSNUtjDIieARjNpE2XhSUKZskWquBsN2eLEdMMRgmveLwHwxfNEYmOA9nsfoHfW%2BEljHpABIbkeSVEPj%2BQBGfwGiInvFurcZiCjnaPaBbnOk8UefpTVhXFlLUFd%2BGqIbpwdzst7LLbhqNyDExsoFw4ktcyfA%2B19rmKXfwCXRjUeNEAfEn0YBuxEOmzXgQsPxDLoSPjDMqkFJnMiH6Z%2B%2BZYxYC3QIStX9XIQBa%2Fk0P3ZGCP53hJAmTI1pMweh9Qprr1gLObOK7%2BDSX7hdmlxhlOSbqCcbcTiGzij6ox7Nm7%2F7ukfx2x4T7Y9%2BpcpHXtAfjmpWMzxTM0Fo1PlhzDc1xIMr0LJptSwY2IPoiQnm4xLvxZlC8W031QuzeFAM9iwZoztUVJCjt1wm8mql51QPlDl4CAtCFKcC62PgsF9hM1YHh8IIK2rDpNBFLg682k5euNX5MSsbvb8XUycwkoa1ren%2BjpshhWRtHZCkC%2FZpwRLR4SFnzlORNts0ytJH22uDOIujZDT06TpT0iXcOikPhGUPGqkW%2Fx0pmWdaWD4LreZaNubcrinoS%2Ba1RXtaHewp8evyivBMKPlNAzSFz%2FRA%2FCEU4SfBhmEVG8d%2BmVTdolIODu5RD4C2rGE%2BCTvbpudo59JQzN%2FB9XlyCvMMOZIwfZ6ecf4oDZeuZFwKMPgA9JPt8A9lLlOcbGCs3aJVFphjY9ebqmiYwGz4kYc9wPHW%2FTCThzc4nbzf%2Baq1H8LYwW9OiB8g4dkFE4M2%2BQCRlEsywWj57O3BdxFcwe323gdsCcfnSbhVw6zuMKjYvca5c%2ByQZRqD6W0UQN07x%2FTZl%2BzTMeXTIdTW338hTYxrKC4KqRBSRTJx126g3g9TlN2i92KGuyoLqsKPPVRhpLj1IXBthC6Tv1ntjRlqF3iXEw73y%2BsdCvV07D%2FdXS1DjDK0wB%2BQNUHxkRwl3%2BYuC8zgA4ntKtyO6yla%2BcMZ8HTcnHGMETkbQBBiT%2F4jw96wvsChV%2FoZCnZTNakaWFAPaSS%2FVlnS2FaUDpvazlsSitSt35G2RJT6K1Y%2F6Ef2rdHOql8g%2BVa1nhCwWdKzCGB%2FboFJeAHW%2BJL3dxIKvdzTV%2F41zph%2FyFpGzC13DDklj0okztgqeUm4Vx8hQK6tXGXZMOXkqlTUyEQP8svUAvjiT7%2B5qZZxCF%2BBR9jqydIuyvZLoBLZUg8%2BAkkn6JJuBmrpAWTlCiAZpzIUcoeCvKKUTZwwskN6rGl%2FyTwbBQvBUMkRUjgOL%2BZq%2B7sb5W2su2MpHv1hsWpTFpEip1Dd9UBEypNpRDw%2F5un6jYVaLvlPSnkmvypuokcNgdNU3i3c5Q%2Ba3aUnWbYaAynMhZuBQZPPYZjr%2BpLS0pmbVccLAMTw0NJWNg5HAvdl%2FT0TPN8hvKknrtUZxifoMEQ8netLzKBYxv7i7JA4UVTw48aH%2FkCmhkKosiPITK8uSwFw45yFQTU2fFoaLRrsDD2hoYZxy%2B02DfgsPmnNP0D3HFABB52ngVZu4wEoPlxC86tc%2BPfs017hFe1TpOhuBL0DhQSf5V0nXFsw9ioO72W6P%2FQDgPOBrz75Aj2MB6sL8cpo2tWN0p8ZuWkVoMa5Mt45NcEwJeRcndiynB%2BkxGCzPWAROxRXS13%2BCfcYI8bnMeg38nbLS7xed5fFyouUBcGsnNRNctM5RDEi7LUbBNa2P6cgXCeyQ0%2FG3Rdo0ULyjG67ZfbdfC2UcatycLS3fMNO6SAu6I1cqcDcrNfo0RZKqtdQQ0ZBJ6%2B7E%2F9wn%2BJvJfcznZ%2Fv9WwR4DnJkEbRguicQ79o2lr1%2FhbSAoLZSgBs5RBy9Zcq2natjigWwW6cyQ38ICjEE9CiUH0CzK07cYe5eaZQnJ4j8jnUmwkt9%2BQJXG6rmH%2BIdpNhBPj6uCGrjw79FeIyYpvBBQFbQ81Y59xa9%2BsdsHQacnw5BAtRTFWvrlsu5xrqBaFCcZYN6HRdqN2BUe1gsWTT1pRIHLdcCAv5eRIzNxy7uwIi0qOSF%2Bt%2FWnDjHEpcN7qQJ9yA2j6ATGPXl%2F5h%2BZt2l%2BK1xWT8RbAf3aicZ504te4YQ8Qml3Rkhk2Jx4WXtCWaJUfzDcuLkm%2Bvsi%2FeXIoDgK6oQHc1JbhT8FS%2FMmaxyzfJgXkRDb0RFwWBD5ME5kY5DWc05L3u546qEkr%2BAV7F8ccJaS1cOTNpNZx1gggP0WBy%2BoXRHQ8BZ75QNQxjR41KWSoJZf0aun71tNSlmbyMCmcS7IDma7BzRGs6Ub7XfDexYFa9LLI8ewLvKkrZ1gaaTAwabP5ZMstR98JrmlYbZwdl%2F%2B4CSs8EDfrjioC%2BXH%2F%2BJCygUg1fJeV25Tfqo6Dosg%2FrGPWcta9Z3fvGD0JdueW613eRLcbo1QYBdnyds62ArRRhedrULMpNpOafM8tbZmqgRL%2BK30jkvqqhMU7coV4zN4JcP8CmR74s2Yh7dNgVjRkiYCas%2FeICp2MuwfZ5hAdYpV%2BvCegruYibPJLc9Fg5BWUMOovIdT6cjGwM%2BBL%2FprdSmf44iavhZlE7DI%2Fa73z8yX5i4jh%2FvJWYozFF7E1OHDL6H%2BEk3domxYL4qHaeeDpKL90wdFBQlRnQydX4n5lCSoUj%2FEIual4yYGn9%2BVeHMcS8y%2F3I4i91FZ1SIT9Fhw36oD1zctkDLQQCjh1p8jJ9aqQ4sp3KZL9seRWW6VntkXR0U9kHfsIeW7BCUTSeSti3M0LudWBd6fSNZBb9uzxvThLPwG5wOivXnYGDoaKX7p73HTBeheAIHAvfHSXmB28b4Wig%2F5JwTu4JfvFCKgpyTNntDSxBvh4Oy46ikSFRRGyASxqvylDU9%2B%2BBJKGTL7DIYjAOYrVRuVlmL6whMLgz9lQ%2FqvDkGl7l3gEi1DBIFLr8Jg%2Fdn5g1av2hDQF13U4H8JjcdbcCaXI%2Fh%2Beio0q92hb2aY6WC%2B0UICPi0tW1qRUfgfSIBXBH%2BIefcVmNKAHzRnHV4mKE9wFkrjqz0wmUuteCapO7uoK52fEUUXBoDnSQGpCQFddkmyGXRaHSK%2BgS8nn%2BIWwHLwXJX9nNvjmR%2FTzPNFI1Ni8ErkQmYCnQ7Q%2BvjPPrpirFflNtfIrsEgwu5pr5d2cKXSpy2ObqVJOCVidKr1agiGCsINOql%2FN%2BTnX3FEafcOUKUAJtaaLB7RDuIYJFXSZBNioi3n3PMF7kLJXRJN6FqG8zcmV1xNrN7CYwvXDxFDhV2estiwFWrfS4u%2FcRHuJ0sUTkrhzev%2B1mZYNwL9VlqqgQaRBdSA0ILy4Mo6GCADAanIJ%2BQYnYxq3jIcYFVRVk681m4zriR%2FrIe%2BdOR7GjI30dik0O8i5c9COAEaZK8t1pamJCTdbLHD%2B2MnizFS5LjDka8GO0uhUm06wZUTso1cZJlNbWdpOb6ESJXBM1SlbphrfvnslSPyvUdu5wOyxmr%2BygHIPD0GpvsCwYpkGrIDDBvj%2BeHZ83d076mgmJWTwBnL%2F9eqoxwx0qLVwoa9l5KKGdSmtrIIPiuUPa0l13zb0W4%2BmnmRdbvtw7pvWrMaJ7O8W2ZVbP3hJnnzyRSeNm6bKYHC3ug1eLLUA6WSHPFwsko%2BisO4tAsyGeUVHiXozbCNv2Oidvracundb0pKI7D8eLKHua9uKE%2BPGjp%2F3IuFsufdvxwQl879qo%2BlnjnAV48zHAg%2F3SmljGh%2BW%2BfR2hSjPu6b%2F8zS6naTgmOnky97MkVbAKZkp3pebFN8jU%2BI8%2FUGv3dcL0vry%2F%2BZ6ENd8dRqUNHrUwFJbG9u2gQpr%2BNtQoCRt20iIo%2BIxVOP9Num6rzUJqtEoyYCCxT88eO%2FpsW8KVduthncce3QfDZm7tHxWgzdYaS0Ino2Pd2vqj7BsIWIsq4xBzbpn&__VIEWSTATEGENERATOR=D9A3D67B&__EVENTVALIDATION=W1D4zYC1%2FjvGHN9tjZyGnBa4kzMa4SjeufMgdEtgxy%2Fn7yPaNPTJBJBctt87CuZ9U2LStsRqmfUQD0IHiCjeIJUgyFjCH3bh6OmxFNCEMO65KVRRAnvJeQx8DFPwGKFNQ3sAO6rXPKtzM2UXrUiV8EtNH1xjDwtOfWLWTaMfnZMpfGHmwNsvRuNLaIQyUoNZjK%2B%2FBhpNCFKc5cbojQ7zVCmYulOZ1yvXVcH9mRTrmH8m5qP1zYXi9AlrJA2Mlxs5PWp1dHyK7%2ByCzZkpRm9se3wW7iMYAx3QFGKWl0bvtW%2FMdwcE6iwpG7gNa8mLOuevF0axUlD3MjxC7VKYldTKi9N%2Bl8CpUleDs7HgI3SNq%2BVQee2sDAF2UUPgg48H8I224rXGFyVdPl7xxwrbGbfB8Hg9dO1uGZaeiZLX5eyGCKXwxCdPpEIt%2FJmPTjHXhKv3GawbwLAS%2B%2F3USypmoK5XcHSXyDg6iMbBugmHR7WokseZHo0WueZNs0e%2BXjnJ0fa2VC9kBNCVtLhCDLO3hg%2Fy5P7ewBhtc7a4oadau60PZS9rtwOmDm0OIREYBqoE0x88YSzTWsCf0RQOlmqwptHlYOD2zQnwMbt2d9y3Tg9Im2F2Um9A%2Bp0NE6szgbBsEkxu3fG4sWLM5NI4vX0yY8ZUmSyXd6GXPDC3PQyusO6soHBtQN2lFCvqzQgSyK4bHanK38qfa75%2FXR4a%2B2BAiSDz4y1M%2Bxuem42UcP2C5M3dWAImxINR97lwb5gEG2NNlhC%2BbbuOrIZyWXnht5m824abT5LVGckWus4SHGKd32coWhW%2BL0OHj65LRFRWhtu8TU87t%2F9yZTB6lZ4wvsxNi557vUnZJSUmOtB8ZamjOElbmj3fyvvFY4yV7S6IMAWiZPFd%2FXv5oy0eCzvdPa9W5fATUY4LZLU31HwbzsIwuNrywvfeaFNOYuE9dbQwgGcQThtW1gRgnCpudw2sUudTmN0V9i%2FaX0s9%2FwTnypOVRqSzuzR8ceref8Mdp8TNpnIi6hZvkqBpKZjhiRs7I3%2Byi%2FBscXmqRzKML6oyKwVzY%2BZI8nBdnDLJjSub7TIwr9irT%2FAChwuJvh4I5WtpFNSC2ZpRr6wLQs24lEqFHG6btLfRgu5WBBOA2kKq5xbQ2ZQfMeuNend6wJejl%2FMRy0iVQYier3XXYEE4qzkJc%2BDuvjJyJ%2BW%2BrGbRUBSKvD5i0zP3k%2BJRNnYAPx8wNUQIMIMl2yHUxIEyPeBJioYOVLpeUseLhAVEo5i%2BAp1WXZav22f9IJgavxjTeYMXiwoEcdm%2BC7TPbO7ikv2x%2FT4GssLlbAMDrkTePAN29L1OD3wkU6YwSR8kMZyef%2BNdwmoqmnq17pq0cAASjB5kOAcUjP9fxz3kpWNpSWxvjaai%2F3MNUQZ2qVz9yw3t5%2FoOVytUOqd%2B2T3JnPKS9Zug5KKiXv2f5uoz5qwp%2FguD0TyX5AspaB9VwFYxRZ4ZwA56D9XWDDKIZeHXZXH1%2B%2FSkWGROlaqOMhmrxYgfIyWwC4659YtKtmzmV3DPNCl4430XDL19m0rYsdTnvt4qecYHqGWH%2B7BGHiNy8k2KYVeHHrXdoi0r6C1hqKkNw8nj3Il9lv3v%2Ffa5ZvQmnMxqcPyYZfcPik37Ax3bmvgF8SNDGy2n6UDV%2B3EwQnqT8KHV7ha92LFWklSUK8EkV1qX2gZLYMHz9ocy1YcZaYV7p0d%2Bzxd8GtvhkW4T489DM1aRZCmuue4bW01SJFKGIBRCT6oKvSgepaCia07SKbvH6hac0POvr1g0i8Nk8oha4jgd9z0gLdg4a7dXsB3fFsyKQOYyDQwyOuNr0p%2BmJs2%2B%2FJBCNDJxba9qWys2dvbh%2Fh4PFlxO%2Bg%2F1zDSEipIKSDumyIylp76KRHhCOEbxv5WnWE5Sp0pNi0eM%2BsCWwJcoENfkbWKQv9O8lKC%2FFNHxqnwU4Y%2FqJuiRG9sqDW4SkkiAYp%2F8kukau%2F8XLHNyVzcUxKMRIuP3JpRA2VI2AWh7vkdfwizErqSaSogGsuq0ZFuD4yvHYQDAhxOu9T%2BHC1sSbaySkQReghbOGCKmxASvviCDguoImhjKNknJO6Txf8vL5RukPfyuNVlGDPV5jz3PM8UuwHTHkl1MoI%2FI3uRNEzjrYvbSpHeOgZfuyTysKk%2FidCfgRvv8BlshEIkAgaySqR8GQtlN8aZcqPMZxsA0jqoad45uya0hOOgDx1KQ63Glhq0PKfPMmSBY9OnBuXofrKyIwc43L7rNMfaWXXj8WtXOXGTQg0BkRER%2BhR1sYWXblopI0PWT0lyPR%2BwoE7P5%2Ff34B5zlEHBY4%2Fir1VTD4B%2BGqxcZm8RBPcPQWy%2FS2GsAShn7%2BpkCLaq7DXwqi3Wn%2Fkms%2BTG0Kik5cv2l0izW1dwS%2FClVoMqEYaoXYPY%2FMEFzOXMRakOm7f5LBF1YZzM3Z64ge%2B7L%2B1LqGU6GWhTt9ipPa8TcGLOJEZMGSXlryU81K8N%2BtCnVfxkyQB%2Bj9BlFsXH5WmCkmJjS7Kt79x3kttLKZvl7E%2FNcowfu4UrRPnPqDxmoEqvUllXcknaN3Ch0r2vtpveZA8PhjOHwX6zgtTutKJgZwKjkhH%2BE5z3V6fEG%2BA3uYZmtvU5JqsO2treF0JiQMaN5i9xvjRiIczZECpuJgip%2B2UjJiu5DncPB4vRpo01b0cxhSdUq0LGNbjq0f9luk4opLqIn0okl%2FHpcwga8EC0q9SGVmUQ6LvcVNlgG%2FPH7HfEGuMy2U%2BUDQEa78h436D4TkGAroy39MclR3%2FvrdSfuNCyKtsAF%2FrEjWZlR9y40kMunlDfFwDVYhlhAGjh%2FjimI3RK0Ye%2FQqdk2RTfqP07K%2FFvIrEf%2BM%2FWTrQutmOqtJMCuvVZyQixlDiVI7BsqJMRThOLXyxdygfCAQ2EpMu8YZNq15%2F%2B57wQbq3%2Bpoa1oNo4W4%2FD5Wjx0bBRnXuFTRtEXCzN5ochlKLgZLByf94BQLG5fTlpLKSEcFFT50MhsBIqHL%2BmhydmIG%2FbG2Bj8%2ByFU7VxSmL3mgtVdYALfr3UIUUs8hM33sOySWJz%2BzlpE%2FWXQVmfvAC4BMD%2FDq%2Fdx%2Fil2GVPnilA%2BEUZLu2BgsBJCkjcDQhOgLu%2BfV4Y7P1%2FrkWezy%2BjrmV%2BlcNiesymy7W0C1neBZEIObsyC0Hk%2B4E6tM%2B2qiSwe%2BDy%2BrzMkCJySDW%2BqB1JKpmhKgJ9hkvODa%2FoDlvSmoDwh8M0I5qQiTRdAPonCUQPpftjZdqJOpzOFT4OcOvMWaIsIpRdcJiuUgSR6reSBGVOIR2T3DsXX3%2BjVwZylMx%2FPANpTkD%2FLFcjwfpxk9K%2Bw4%2BzYfPjoHAYRkzIKGH%2B3qsqggZ7yZSNymixF58uooCwzLXuC9ujiwlz83f8no9LdnBrn4zqIWuK8CUDmGP9b6pnXZ1s%2FbgMTv4nmsshm1rUb4SFM8%2FiDoHfg8L14X%2Fkv7r9No0iPhp1nwGDfgJYCBHVveWcnQaCufcEs9aykNrsdhjUdeRh8M0tDiMTh9sp8OOoeBeYimwp7Xa3udBH%2BGh%2F7Cercgrey%2FWbFxmGU%2FpbAWpMkyF%2B75H3t53m6Mb3oFoL4ayaSyUEDxYwQ7NHgZJtcqgRXr7g%2FQ3Ho8jHxDv8XOUhnpwPQrkT9%2Bg4qJrzv7ODOcAnqVETt6jn1%2BQZz%2FlBMpnqe812KC0UTM1u5gr%2Bbt5f6Mp4j8Jp7J1RE6QeZRnKzc6zy8HYhsHXftWS9207y2B9sGaSR1pzUYOajdfXNBeQD%2BBwDx%2FcrMnLfpj%2FBwH5mboez28ly4sA3RzCgb70s3IsgZx0%2BeoXlUD6EXn9ji6RP3%2FVYemLq27pn41o9I5nFtfw%2BBMrPDj3qwD43DDECjkHil9TwHJPM536OgF%2BU%2FZfzIGD0yRc3uTCAj3AyqG05olcHNdrqaTEOVKdz8W5Y2014lVZTRw8r%2FlMXqjxHHzzkyM%2Bt0kM4qZr%2FMvOLimA7TTeLTY%2BZXg3yu5e8j5KTqPtBE4a8Vd8kvgkEdrUTa20uT1m0%2B7udy%2F3YT7048l8SIGlx2EnjZTWeZCjFbZEfQIlP37JKo2ypwWY%2FNADfpdsldCY3%2BFEw7oTFZjme34rRuLPiJ280%2BXmUgNIiqLDH9X7iBLlvGzAexmpYWJkCIMBA9lgkauCBrkNbQ3XKn5vkj0zTFexjgkj0nJaeGkn1um2JhfyqpX%2BREdvGxMN8XcG%2BILUGF8EbxpVs%2F4uVaKDQ2qOih%2F67YRlHhKtcF8C7p%2By2szWq1qu1lms9r91yQ7HYHsn7AQl6uotU1fIA41pzqbtEFk2QGMfYCqpSwg7dSL5AhtzmboVpE9D0TaSzmMqGlxRkH5ghkzlTPsUkmNNmZhgtQ4gYMg2IatQYshToFUqT8ZlPbVbhRVWPNebzLfJPpZxd%2FGKdpdDtzEieJ8UZ6V1YdV%2BgTyTQFI7lJwYiJ61La4hZKC1gk5tBEJj%2BhgC%2FY7AqPKn7wj48Kl58v0McQNM%2B8nHyxbDtfLWInLd7iBz%2F7WF47fwsvGNySj0E8%2Bl9e0CmfvpE4TFOxAWic2E0r%2B9LKU1oPPKNxdV1Sjom5hoWHvBS%2FOXFtJmgOfeaZExx2nyyEgVeqQcEhBFZ%2Bs5WSYhJiLx17tq5q293nzpEFMLu8ka1kgJ0qluB2mYVI4rY0yUztrz1hXVLcZFG9om7dlY%2BL4APO3rWC1vtTuCz1GEOVwK3SDF0PkPG7NxhJWz1fH6T5FmkNgIWvZCAUWb7BtocGetnZ15w5%2Fp78zSm8UQ1pODKHmq0%2Byzw%2FU1pJzdYKIR7qRry8R%2B2aQMM8WP5moJ99a1Mscy3Ao69bLBNhh4wyCK197l0NxqStYsjjHlfG3Kf1DYQM6aCa8R8gOSdt4cAQL8%2FsTr9A%2FZ%2Fw8GjNOCcx3n00y2slGmFrSgb1f6TpqiJejiv8adxMwZR0ZrAgIrw%2BiZw2xB5joEzG8mifPyaz%2FdSfC2A5XYXFhCqYDvFiXOIAA0hz4JzkPLcpB%2FHA6mJA%2BF43UEdFbAtFnBLIf1TWT0Y3grNkIASgY%2Fx0B%2Bm%2F1WL2eIIg7A%2Bs%2BXRivhzNmv5rehUmNi%2FaE8g5eDvO8vc67pW4dJ8s%2FfSIhwUs%2BrWvCOJVaZL9XtvC5NOOqVd%2FHQoh9iVOpwbYt93iYPhALHxzRFRUhtZLrfAp0TRPFDE7n3yegyom0%2B9cnqFMi80AeYGJL520q0S9WkKmTn2DnFmvdR5WIneLVfu0bI%2B88eiIIEfkm1JOo5OKiPfhFteCDT5q3R0Mhz4dqsKWxCG1M8MoURnj%2BXWRg%2BhhmNt0lbtahhFJkrsrsf8DCZ1b9S21txmwREYMJBfk4rHa2NpYKXfIAfl8pVC6zBOWxwCui9pU4yNFhTlVAMr847UC23c9nZjuQvGD%2FtujtIJ%2FpTzYgCc0YMNoSXSxtwcEMdnxFeolmjyTXd9cM3Wm4cIZjaMo6UZFGGrfhlePg2exh59hq86DKXen6w0OD1S9twAq%2Fj25TVHegk%2B0PYakpiaauM0xs2TS3QEOsRcOSjGw9BnC9YDrnutrzjN0DIgG5xSpnwbTLVTEeG4JwMdWVkhjMPz%2BDWILKemCemoxTRm%2Fh3UYEnaMX225ccmL7VPEZUNHukgAsRnmnpEPEUSMct%2B8bcMfZi5aS9I5PFpajONJVMoq0uUvwgEGVgy27DOE0dU6wiiRnAxzVSzYb1irEapBNsjE%2BYWLgjcun%2BeZdG1V6pLvJEM%2F3i5ghyucTSEftXrXH4xE2N%2B%2B3ErJneEzpcsCrKk%2BjVkbAJrcqz%2F5KN5ozrI3mdYAdxbzV4PNd9O6vHPMRjthECrz2AbOLUbSNWbnS2gZWRYCvtofBEp1ERrFosu1snNnlH%2B%2BWQ1e7zasY8CJyeZeMNeKjklaHh7Bg5%2B31chSNAUYRI8k4QYhfr51Wg4CmbBb2w15qblzsWli3huk2WaFbZmDuWSLVz0f5sPJDRYMvHs2%2FiXJrrW9SVEACuXTqfKfRai9Hl7VgolYls69S0GKhsZTx2OXaM1L6lArQW5PO6Vr5CLBkd1DWMNYzMHbP8aspWlPD%2FiiMvTJFPkg1N44KNVt4TTl1KmIjsEoRjgoYXOfLfKE3rCxLRD9Ev5rxqykDe%2B0d1Mtdg7aG3nmThkh7kobole1nbLnzPfLiYGIuLLjHsmWOxNjumQOQJHrExlRlqd9BXWGf3B6KNSAFcGlKge7qVfAwYfzYasByvElr%2FXfZ2kCyUPjaw15FLlZVx7LCP0XKZ10bBKVu%2B%2FwabcCPGc5G0J%2B7GBdHFt%2F1Q2fa7aY6v2Qd9Npt2lqY8BydhcxbbvI%2FNYZm%2B9Ds2PeGf1trqasACbbFIfCmp0H7oc4MnjsGcXQ38A%2FEbweLp72MprTqBIZJX0%2FJRATD5aukZCeTuJ7MZ9mqN1nTahUAuy%2BI3a2mccwakRK0UQFDwm5mrmd59ImC8HQ8ZbNEZWph%2BAKm8sZmvJn8XOlXFbeq22U3YIPJdpmAMH8OoxklVYbGZBnomOkWLh%2BzFI9w0%2FkFA6y9pkbC8cJ06cbDVodZ%2BzdAcSLmE9zzL5KE2GNtgLR8MtLvy%2FurRllph0iUKbItskYLUTH8vzMK78ToRFE%2FMZVa2KVY%2Fls1s0H3N9xPImkZwoe%2B35TbtTAMxmaKS0l9i49UiTY7zrewb6uMd%2FDZrI6piyoohP0A4I8AzlgX0SDrq6exhWkLsyaBsq5qWs32bFuvDlRYlyQ4t0IYb%2B9J578d8EjD6v2%2B8H4Grc2C6yL0%2F9O6EIP2zcyzUDuXB13hmW6xCyjmPCUL4vg3L7ALaZ0uDFg43VOhVUGO%2BYQ6iZJbyx%2FaPpuAbLcz2UxALndAzVLHYmLjaTUdZnpHJ3EdswODmFr%2B%2FwWwIgOfH7xu%2BqBiUH%2F%2FGle%2BngQMBO7AUQeZAFsS5Jl5eBtAxQejCkVpuUCFOkv8S6lNwPZBpOsg%2FsDhlssTYQEQbkkv7r7ltlkoSf9BTMWAtCyBuGcrq%2FeUVFop7v80%2Fls7M9KYCrRxl3Tqqj48AgKjRw%2B2D5epEWHfoLn8ioWnUY0CZxZUydrAZyjKvVXkIeMsXvqdN942%2Fzax6F2rZ%2Bfc5rDSGdQuhZf57rM9aEfcv90iJLk%2F8qJ1eKzSKK7VsPpdnm%2FCIUMIVoY4z5mINBLCkM7p5liiMnvDf9G%2BAVj%2FsOqZW%2FKnLIVwVy9SgjO3%2F7b3em8A70IXeYaZBzaoBRdmialC6%2FO1ERSAOSyNi9tz0MkCPweUupKY6UNoPfxmclY3YXY%2BoeGzZUdWGjtkrGTETqWcTlzjLvSqC%2Fuh9qBXyPfcKj5ljFQcJzuZdQiPhW7%2FU7DcX1Njr8HPcCn%2FuaKQG7A70m3QXH79P8ts6i%2F06M2iNKfppZp6bD%2BOFoubGMoqC8jVN0jrwgVlzz9eMwf8ZpzXqSbb1SJzFfu7H9c8nxn%2FDDmN1uwZYusKyx6TCYn%2Bn3fe4hMSC5kfp0znW8GZi6DJoeb4ohaf80ZvsWue%2BeBbqOYdcyMSUMMBG5%2Bh6NCpt%2FSlLaWBoz90HEyeJcSlyZXOTmGFEAVHwCs4TnQM88w8a%2B6sjjWpeCXif2yhz98sGIVLDdi5RqilfDFz94obwGfgCcg0dECKIYQ70dPyaDPpxCIu4Hdp4mu9Qi0cPj1A25hIuzgJOEa1AHZ%2FpoKhsnVLh%2FFVzh4SBKnxs2Hzv6MHk1g%2BmWXY20axCCmaCCcnEGJOqZfqRHw2QCwrHYGKr%2BaRa3HsZRw2UDIYNJHyIoFKBezikcE932y93NhFXW2E6XRaf7bLoMe3PlK3I5leSprg1agGEezyrpm4sFQKe6zQBS%2B0k2EFkr2mvXfZ5dJkfsKBiHs8hvoIi138L1FVuw0j36Z9bKccHvlk5wQYOAQEuHLoRRhGWXldJMWHYTU8lL%2BHaFyYBwxYhUPGB9Ob%2F8D%2FIgdVhfXZRcGSDezc%2Bx8aoVaH%2FjrW30QpZjPJhVdxIqw5sJs8%2F1JifpW3dXOP7aen9ghgD4GbMbuRbwRbYjVb1dGLXwHIe0bnamP07gAzzI16I4peqWwVchSpctl1uL5HZdxHD32L7%2B0jTY%2FfI2FKfwGVgr3zf3UQTNagiQKsrcfaBPxamSolaQL2Lepot6988gSGeiaqrQwiccmEnfOFhxrXcUbMarpV9i%2Fl29w2Okg8tlYwBa4lDozu6IyRPfSSTSqzs3p2tX9resQTpj9AT0KrADoUK%2BlnVB8LpS2D8lWWsMk5XSivjn7xpz%2B%2F7lphiLj11fh0B%2FtbfRlU7mNafmBRdTmR0RmtgY0T9%2FlPR76qaLf%2FlcoO40wBxmsruI%2FufWKd9JYjfEmYJDMWNGVb3l6iOTrwrF4kZxAUFkqfy4j7L4E1G8CQAYSFvFrcvZGIMJjpzOSMzTv52MwAKm1hIVpZMrCdekbDiT9sY0S6Lfa6tXNIqzakDCFuyOVvlVQvWogKElaycJk7HdcLN8n79wyjMXtq7LLQtL5e%2FirvBR562KvKswC9fclyy3BUJ9yTbSZgUzcq4q0TmoVvkuhDCbdDjtjCvxVNkPMOi1BApdlJg2hnLn1BPADvu7EDVrg09EjZPZNxUb1BBzJHQxzoZ%2FDmA25MQQw1SSMsE%2BakRKEmT%2B%2Fs2MaJGQo769uwxnEcCKKAsDA5YPaRaOSmaMIqX9PAWgZAH8rSVBCKYF%2FC%2FVMDbqEho5tvhQd2EcTOwtTCOND3gQBNuDTgBVzLd%2FKXhXUB4ZczKr02AAZZRdb%2BzXUulRB0Ia6s5Z1XyCXzhWbl6f69dTD27GkYwq6TId7scwSKuRgdIaI%2B6BBOesWluzmJ%2FOk%2B72APDN5DLloX8HSBTKqid6rNe2Ojc%3D&__VIEWSTATEENCRYPTED=&__ASYNCPOST=true";
            //echo $data;die;

            // get other page data
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
                "cache-control: private",
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