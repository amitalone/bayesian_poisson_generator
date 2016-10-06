<?php

require_once 'feedmap.php';
$category = $_GET['category'];
$command = $_GET['cmd'];
$count = $_GET['count'];

if($command == 'peek') {
	$res = file_exists("feed/$category");
	if(!$res) {
		echo 'nofile';
	} else {
		echo getWords($category, $count);
	}
}

if($command == 'create') {
	generateFeed($category);
	echo 'done';
}

function getWords($category, $count)
{
  $contents = file_get_contents("feed/$category");
  $words = explode(",", $contents);
  shuffle($words);
  
  $words = array_slice($words, 0, $count);
  return implode(',', $words);
}

function generateFeed($category) {
	$url = FeedMap::getFeedURL($category);
	
	$a=  getFeed($url);
	$str = '';
	foreach($a as $link) {
		$res = getPlain($link);
		$str .= $res;
	}
	$array  = explode(" ", $str);
	
	$unique = array_unique($array);
	
	$newStr  = implode(',' ,$unique);
	writeTofile("feed/$category", $newStr);
}

function writeTofile($fname, $contents) {
	file_put_contents($fname, $contents);
}

function getPlain($link) {
	$javascript = '/<script[^>]*?>.*?<\/script>/si';
	$content = file_get_contents($link);
	$content =  preg_replace($javascript, '', $content);
	$content = strip_tags($content);
	$content = preg_replace("/&#?[a-z0-9]+;/i","",$content);
	$content = preg_replace('/\s\s+/', ' ', $content);
	$content = preg_replace('/[^@\s]*@[^@\s]*\.[^@\s]*/', '', $content);
	$content = preg_replace('/[a-zA-Z]*[:\/\/]*[A-Za-z0-9\-_]+\.+[A-Za-z0-9\.\/%&=\?\-_]+/i', '', $content);
	$pattern = ".hide { display: none; } @import url();";
	$content = str_replace($pattern, '', $content);
	$remove = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
	$content = str_replace($remove, '', $content);
	$content = preg_replace("/[^a-zA-Z0-9\s]/", "", $content);
	
	return $content;
}

function getFeed($feed_url) {
	 $links = array();
		$content = file_get_contents($feed_url);
		$x = new SimpleXmlElement($content);
		foreach($x->channel->item as $entry) {
		array_push($links, $entry->link);
	  }
	  return $links;
 }
?>