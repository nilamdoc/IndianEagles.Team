<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('../../simple_html_dom.php');

function scraping_IMDB($url) {
     // create HTML DOM
    $html = file_get_html($url);

    // get title
    $ret['Title'] = $html->find('title', 0)->innertext;

    // get rating
    $ret['Type'] = $html->find('div[class="match-section-head"]', 0)->plaintext;
    
    
    $myDiv = $html->find('div[class="innings-info-1"]',0); // wherever your the div you're ending up with is
    $children = $myDiv->children; // get an array of children
    //echo '<pre>';print_r($children);die;
    foreach ($children AS $child) {
        $child->outertext = ''; // This removes the element, but MAY NOT remove it from the original $myDiv
    }
    
    $ret['Team_1'] = $myDiv->innertext;
    $ret['Team_1_score'] = $html->find('div[class="innings-info-1"]',0)->find('span',0)->plaintext;
    $ret['Team_2'] = $html->find('div[class="innings-info-2"]',0)->plaintext;
    $ret['Team_2_score'] = $html->find('div[class="innings-info-2"]',0)->find('span',0)->plaintext;
   
    // clean up memory
    $html->clear();
    unset($html);

    return $ret;
}


// -----------------------------------------------------------------------------
// test it!
//$ret = scraping_IMDB('http://imdb.com/title/tt0335266/');
// test it!
$ret = scraping_IMDB('http://www.espncricinfo.com/wi/engine/match/index.html?date=2018-03-23');

foreach($ret as $k=>$v)
    echo '<strong>'.$k.' </strong>'.$v.'<br>';
?>