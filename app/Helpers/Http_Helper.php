<?php namespace App\Helpers;

class Http_Helper {

	public static function addParamsUrl($url,$params){
		$final_url = $url.'?';

		foreach ($params as $key => $value) {
			$final_url .= $key.'='.$value;
			$final_url .= '&';
		}
		
		return rtrim($final_url,'&');
	}

	public static function isValidUrl($url){
		
		if(!filter_var($url, FILTER_VALIDATE_URL))
		{
			return false;
		}

		return true;
	}

	public static function getDuration($string_duration){

		$duration_pieces = explode(":", $string_duration);

		if(count($duration_pieces) == 2){
			$duration = "00:".$duration_pieces[0].":".$duration_pieces[1];
		}else{
			$duration = $string_duration;
		}

		return $duration;
	}

}