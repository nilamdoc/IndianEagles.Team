<?php
if (defined('TELEGRAM_REQUIRED_LOADED')) {
    return;
}
define('TELEGRAM_REQUIRED_LOADED', true);
require dirname(__FILE__) . '/Api/BotApi.php';
?>