<?php namespace App\Http\Controllers;

//use Response;
use Illuminate\Http\Request;
use App\Helpers\Http_Helper;

class ApiController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Api Controller
	|--------------------------------------------------------------------------
	|
	| Controller responsável pelo gerenciamento e retorno dos dados
	| requisitados pelo aplicativo de podcast
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		
	}

	public function itunesSearchAPI($country,$term){
		//travado para buscar apenas medias do tipo podcast		
		$url_itunes = 'https://itunes.apple.com/search';
		$params = array(
			'country'=>$country,
			'media'=>'podcast',
			'entity'=>'podcast',			
			'term'=>$term
			);
		
		$url_search = Http_Helper::addParamsUrl($url_itunes,$params);
		
		$json_content = file_get_contents($url_search);
		$json_array = json_decode($json_content);

		return response()->json($json_array);
		
	}

	public function itunesGetTopPodcasts(){
		//url adquirida no local https://rss.itunes.apple.com/us/?urlDesc=
		$url_itunes = 'https://itunes.apple.com/br/rss/toppodcasts/limit=25/explicit=true/json';
		
		$json_content = file_get_contents($url_itunes);
		$json_array = json_decode($json_content);

		return response()->json($json_array);
	}

	public function readFeed(Request $request){		
		$url = 'http://'.$request->query('feedUrl');
	
		if(Http_Helper::isValidUrl($url)){
					
			$file_xml = $url;

			$feedburner = false;
			if (strpos($file_xml,'feedburner') !== false) {
			    $feedburner = true;
			}

			if($feedburner){
				$file_xml = $file_xml."?fmt=xml";
			}

		    $xmlDoc = new \DOMDocument();
			$xmlDoc->load($file_xml);			

			$root = $xmlDoc->documentElement;
			
			$json_arr_podcast = array('podcast'=>array(),'episodes'=>array());
			
			foreach ($root->childNodes AS $feed) {

				if($feed->childNodes){
					foreach ($feed->childNodes AS $feedNode) {
						if($feedNode->nodeName != '#text'){

							$feedNodeName = trim($feedNode->nodeName);

							if($feedNodeName == 'title'){					
								$json_arr_podcast['podcast']['title'] = $feedNode->nodeValue;
							}

							if($feedNodeName == 'link'){
								$json_arr_podcast['podcast']['link'] = $feedNode->nodeValue;
							}

							if($feedNodeName == 'description'){
								$json_arr_podcast['podcast']['description'] = $feedNode->nodeValue;
							}

							if($feedNodeName == 'item'){					
								$episodio = array();
								foreach($feedNode->childNodes as $item){
									
									if($item->nodeName != '#text'){
										$itemNodeName = $item->nodeName;

										if($itemNodeName == 'content:encoded'){																						
											// if($item->nodeValue){
											// 	preg_match('/<img.+?src="(.+?)"/', $item->nodeValue, $matches);
											// 	$episodio['ep_cover'] = $matches[1];
											// }else{
												$episodio['ep_cover'] = '';
											// }											
										}									

										if($itemNodeName == 'title'){
											$episodio['title'] = $item->nodeValue;
										}

										if($itemNodeName == 'link'){
											// if(!$feedburner)
												$episodio['link'] = $item->nodeValue;
										}

										if($itemNodeName == 'pubDate'){
											$episodio['pubDate'] = $item->nodeValue;
										}

										if($itemNodeName == 'description'){
											$episodio['description'] = strip_tags(preg_replace('/^\s*\/\/<!\[CDATA\[([\s\S]*)\/\/\]\]>\s*\z/','$1',$item->nodeValue));
										}

										if($itemNodeName == 'enclosure'){
											
											//if(!$feedburner)
											$episodio['url'] = $item->getAttribute('url');


											$episodio['length'] = $item->getAttribute('length');
										}

										if($feedburner){
											if($itemNodeName == 'feedburner:origEnclosureLink'){
												$episodio['url'] = $item->nodeValue;;
											}

											if($itemNodeName == 'feedburner:origLink'){
												$episodio['link'] = $item->nodeValue;					
											}
										}

										if($itemNodeName == 'itunes:duration'){											
											$episodio['duration'] = Http_Helper::getDuration($item->nodeValue);
										}								
									}

									//Tratando variáveis vazias não retornadas pelo feed do Podcast
									if(!isset($episodio['duration'])){
										$episodio['duration'] = "0";
									}

									if(!isset($episodio['description'])){
										$episodio['description'] = "";
									}
								}

								array_push($json_arr_podcast['episodes'],$episodio);
							}				
						}
					}
				}
			}

			//echo json_encode($json_arr_podcast);
			return response()->json($json_arr_podcast);
		}

	}

}
