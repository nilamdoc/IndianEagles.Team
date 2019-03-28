<?php
include_once __DIR__.'/scrap.php';

    $data = new Data\Scrap($month,$year);
    $scrap = $data->initialize();
    if($scrap)
    {
        echo "CSV created successfully";
    }
    else{
        echo "Error in create CSV";
    }
?>