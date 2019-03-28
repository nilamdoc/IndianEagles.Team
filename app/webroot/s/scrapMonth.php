<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

    include_once __DIR__.'/scrap.php';

    $data = new Data\Scrap($_REQUEST);
    $scrap = $data->initialize();
    if($scrap)    {
        echo "CSV created successfully";
    } else{
        echo "Error in create CSV";
    }


?>