<?php 
namespace app\controllers; 
use app\models\Telegrams; 
use app\models\Users; 
use app\models\Products;
use app\models\Distributors;
use TelegramBot\Api\BotApi;

class MessageController extends \lithium\action\Controller {
 public function run($botURL){
		if($botURL != TELEGRAM){return "False";}
		$telegram = new BotApi($botURL);
  $content = file_get_contents("php://input", false, stream_context_create($arrContextOptions));
  $update = json_decode($content, true);

		
		print_r($telegram->getMe());
		$chat_id ="149203072";
		print_r($telegram->SendMessage($chat_id,"This"));
		define('LITHIUM_WEBROOT_PATH', str_replace("\\","/",str_replace("F:","",dirname(LITHIUM_APP_PATH))) . '/app/webroot');
		$photo = "f:/".LITHIUM_WEBROOT_PATH."/img/".strtoupper("HC3025").".jpg";
//		print_r($telegram->SendPhoto($chat_id,$this->curl_file_create($photo),"Stericlean"));
		$document = "f:/".LITHIUM_WEBROOT_PATH."/catalogue/0000ES.pdf";
//		print_r($telegram->SendDocument($chat_id,$this->curl_file_create($document),"English PDF"));
		$fileID = "BQADAQADDAADmpGQRCF2r9ca5vHbAg";
//		$telegram->downloadFile($fileId);
$inlineQueryId = "640822318360552146";
$results =  array(
            "type" => "article",
            "id" => "0",
            "title" => $inlineQueryId,
            "message_text" => $inlineQueryId,
          );

//$telegram->answerInlineQuery($inlineQueryId, json_encode($results), $cacheTime = 300, $isPersonal = false, $nextOffset = '');
$telegram->getChatMember()
		return "Ok";
	}
	
 function Server()	{
$indicesServer = array('PHP_SELF',
'argv',
'argc',
'GATEWAY_INTERFACE',
'SERVER_ADDR',
'SERVER_NAME',
'SERVER_SOFTWARE',
'SERVER_PROTOCOL',
'REQUEST_METHOD',
'REQUEST_TIME',
'REQUEST_TIME_FLOAT',
'QUERY_STRING',
'DOCUMENT_ROOT',
'HTTP_ACCEPT',
'HTTP_ACCEPT_CHARSET',
'HTTP_ACCEPT_ENCODING',
'HTTP_ACCEPT_LANGUAGE',
'HTTP_CONNECTION',
'HTTP_HOST',
'HTTP_REFERER',
'HTTP_USER_AGENT',
'HTTPS',
'REMOTE_ADDR',
'REMOTE_HOST',
'REMOTE_PORT',
'REMOTE_USER',
'REDIRECT_REMOTE_USER',
'SCRIPT_FILENAME',
'SERVER_ADMIN',
'SERVER_PORT',
'SERVER_SIGNATURE',
'PATH_TRANSLATED',
'SCRIPT_NAME',
'REQUEST_URI',
'PHP_AUTH_DIGEST',
'PHP_AUTH_USER',
'PHP_AUTH_PW',
'AUTH_TYPE',
'PATH_INFO',
'ORIG_PATH_INFO') ;

	echo '<table cellpadding="10">' ;
	foreach ($indicesServer as $arg) {
					if (isset($_SERVER[$arg])) {
									echo '<tr><td>'.$arg.'</td><td>' . $_SERVER[$arg] . '</td></tr>' ;
					}
					else {
									echo '<tr><td>'.$arg.'</td><td>-</td></tr>' ;
					}
	}
	echo '</table>' ; 
	}
	
	
    function curl_file_create($filename, $mimetype = '', $postname = '') {
        return "@$filename;filename="
            . ($postname ?: basename($filename))
            . ($mimetype ? ";type=$mimetype" : '');
    }

}
?>