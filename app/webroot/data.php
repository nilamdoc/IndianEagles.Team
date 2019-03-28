<?php
function get_headers_from_curl_response($headerContent)
{

    $headers = array();

    // Split the string on every "double" new line.
    $arrRequests = explode("\r\n\r\n", $headerContent);

    // Loop of response headers. The "count() -1" is to 
    //avoid an empty row for the extra line break before the body of the response.
    for ($index = 0; $index < count($arrRequests) -1; $index++) {

        foreach (explode("\r\n", $arrRequests[$index]) as $i => $line)
        {
            if ($i === 0)
                $headers[$index]['http_code'] = $line;
            else
            {
                list ($key, $value) = explode(': ', $line);
                $headers[$index][$key] = $value;
            }
        }
    }

    return $headers;
}
function regexExtract($text, $regex, $regs, $nthValue)
{
    if (preg_match($regex, $text, $regs)) {
        $result = $regs[$nthValue];
    }
    else {
         $result = "";
    }
return $result;
}
$regexViewstate = '/__VIEWSTATE\" value=\"(.*)\"/i';
$regexEventVal  = '/__EVENTVALIDATION\" value=\"(.*)\"/i';


$ch = curl_init("http://modicare.com/default.aspx");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');
/* 
if (!Page.IsPostBack)
{ //do something 
$response = curl_exec($ch);
curl_close($ch);
foreach(get_headers_from_curl_response($response) as $value)
{
    foreach($value as $key => $value2)
    {
        echo $key . ": " .$value2 . "<br />";
    }
}
}

	<input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="CA0B0334" />
	<input type="hidden" name="__EVENTTARGET" id="__EVENTTARGET" value="" />
	<input type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="" />
	<input type="hidden" name="__VIEWSTATEENCRYPTED" id="__VIEWSTATEENCRYPTED" value="" />
	<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="ZYE/E7G6oucHqwVTLYqJJt07T5ZlB0UBXZOUjupEfvdKVGw+PYx+wOQvQH0sWKgCYb9hPvoFOuvHaOYrGNvD68HbRrazJ4sWbx+A289Mgyp/Cpw4n++4jrQEBpInpRe4IyTXWtOAtIaPycbUGMlM6nPPThj+4ZSV/FD0vlA0MF/ifvfPIEZgWmoM1Zv/d3O+EyF4Tk/LRZTVQMneDonFB1qNuFBE5AWECEhQcKIoqVmVMga9" />

*/


$viewstate = regexExtract($response,$regexViewstate,$regs,1);
$eventval = regexExtract($response, $regexEventVal,$regs,1);


$params = array(
				'__VIEWSTATEGENERATOR'=>'',
    '__EVENTTARGET' => '',
    '__EVENTARGUMENT' => '',
				'__VIEWSTATEENCRYPTED'=>'',
    '__VIEWSTATE' => $viewstate,
    '__EVENTVALIDATION' => $eventval, 
    'ctl00$txtELogin' => '92143138',
    'ctl00$txtPasLogin' => 'A3670279Ahd',
    'ctl00$ImgLogin.x' => '0',
    'ctl00$ImgLogin.y' => '0',
);

$ch2 = curl_init("http://modicare.com/default.aspx");
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch2, CURLOPT_HEADER, 1);
curl_setopt ($ch2, CURLOPT_POST, true);
curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch2, CURLOPT_POSTFIELDS, http_build_query($params));
curl_setopt ($ch2, CURLOPT_COOKIE,'cookies.txt');
curl_setopt($ch2,CURLOPT_COOKIEJAR,'cookies2.txt');
if (!Page.IsPostBack)
{
$response2 = curl_exec($ch2);
curl_close($ch2);

foreach(get_headers_from_curl_response($response2) as $value)
{
    foreach($value as $key => $value2)
    {
        echo $key . ": " .$value2 . "<br />";
    }
}
}
?>