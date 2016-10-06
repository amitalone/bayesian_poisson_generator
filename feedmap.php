<?php
class FeedMap {
 private static $feedmap = array(
	"daily_analysis" => "http://feeds.cfr.org/publication/daily_analysis",
	"backgrounder" => "http://feeds.cfr.org/publication/backgrounder",
	"interview" => "http://feeds.cfr.org/publication/interview",
	"online_debate" => "http://feeds.cfr.org/publication/online_debate",
	"transcript" => "http://feeds.cfr.org/publication/transcript",
	"must_read" => "http://feeds.cfr.org/publication/must_read",
	"essential_document" => "http://feeds.cfr.org/publication/essential_document",
	"expert_briefs" => "http://feeds.cfr.org/publication/expert_briefs",
	"expertroundups" => "http://feeds.cfr.org/expertroundups",
	"americas" => "http://feeds.cfr.org/region/americas",
	"economics" => "http://feeds.cfr.org/issue/economics",
	"energyenvironment" => "http://feeds.cfr.org/issue/energyenvironment",
	"proliferation" => "http://feeds.cfr.org/issue/proliferation",
	"CFR_GlobalEconomyInCrisis" => "http://feeds.feedburner.com/CFR_GlobalEconomyInCrisis",
	"society_and_culture" => "http://feeds.cfr.org/issue/society_and_culture"
	);
	
	
	private static $ipmap = array(
	"174.x.x.x"=>"xyz.com",
	"174.x.x.x"=>"abc.xyz.com",
	 
);
	
	public static function getFeedCategories() {
	    $keys = array();
		foreach(self::$feedmap as $key=>$value) {
			array_push($keys, $key);
		}
		return $keys;
	}
	
	public static function getFeedURL($category) {
		return self::$feedmap[$category];		
	}
	
	public static function getIP() {
		return self::$ipmap;
	}
}
?>