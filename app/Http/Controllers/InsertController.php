<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use KubAT\PhpSimple\HtmlDomParser;


class InsertController extends Controller
{
    public function index(){

    	$str = ;

    	//$html = HtmlDomParser::file_get_html('https://www.babynamesdirect.com/baby-names/american/boy/a');
    	// $html = file_get_contents('https://www.babynamesdirect.com/baby-names/american/boy/a');

		// Find all links
// foreach($html->find('div ul li') as $element)
//        echo $element . '<br>';
        
        $variableee = $this->get_dataa($str);
echo $variableee;


$homepage = file_get_contents('https://www.babynamesdirect.com/baby-names/american/boy/a');
$doc = new \DOMDocument;
$doc->loadHTML($homepage);
$titles = $doc->getElementsByTagName('h3');

dd($doc);
// echo $titles->item(0)->nodeValue;



		 //print_r ($html);

     }


function get_dataa($url) {
  $ch = curl_init();
  $timeout = 5;
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
  curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}






}
