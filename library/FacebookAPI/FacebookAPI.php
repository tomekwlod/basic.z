<?php
/*
 * TODO: 
 * - implement comments
 * - users
 * - is fan, like it?
 */

include_once('facebook-php-sdk/src/facebook.php');

class FacebookAPI extends Facebook {
	
	public function __construct(Array $Config) {
		parent::__construct(
			Array(
				'appId' => $Config['ApplicationId'],
				'secret' => $Config['ApplicationSecret'],
				'cookie' => true
			)
		);
	}
	
	public function Query($Query) {
		if (is_array($Query)) return self::MultiQuery($Query);
		
		return 
			self::api(
				Array(
					'method' => 'fql.query',
					'query' => $Query,
					'access_token' => self::getAccessToken()
				)
			);
	}
	
	public function MultiQuery($Queries) {
		if (!is_array($Queries) && count($Queries) == 0) return Array();
		
		foreach ($Queries as $Index => $Query) $Queries[$Index] = '"'.$Index.'" : "'.$Query.'"';
		
		$Queries = '{ '.join(', ', $Queries).' }';
		
		$Results =
			self::api(
				Array(
					'method' => 'fql.multiquery',
					'queries' => $Queries,
					'access_token' => self::getAccessToken()
				)
			);
		
		foreach ($Results as $Index => $Result) $Return[$Result['name']] = $Result['fql_result_set'];
		
		unset($Results);

		return $Return;
	}
	
	/*
	* @param string or array $Username
	* @return array
	*/
	
	public function getPageDataByUser($Username) {
		if (!is_array($Username) && trim($Username) == '') return Array();
		
		if (is_array($Username)) 
			$Username = join(', ', '\''.$Username.'\'');
		else
			$Username = '\''.$Username.'\'';
		return
			self::Query(
				'SELECT page_id, page_url, name, username, description, categories, pic, pic_small, pic_big, pic_large, pic_cover, fan_count, type, website, general_info, location, hours, phone FROM page WHERE username IN ('.$Username.')'
			);
	}
	
	/*
	* @param string or array $Id
	* @return array
	*/
	
	public function getPageDataById($Id) {
		if (!is_array($Id) && trim($Id) == '') return Array();
		
		if (is_array($Id)) $Id = join(', ', $Id);
		
		return
			self::Query(
				'SELECT page_id, page_url, name, username, description, categories, pic, pic_small, pic_big, pic_large, pic_cover, fan_count, type, website, general_info, location, hours, phone FROM page WHERE page_id IN ('.$Id.')'
			);
	}

	/*
	 * @param string or array $URL
	 * @return array
	 */
	
	public function getPageDataByURL($URL) {
		if (!is_array($URL) && trim($URL) == '') return Array();
		
		$URL = 
			str_replace(
				Array('http://', 'https://', 'www.', 'facebook.com/', 'pages/'), 
				'', 
				$URL
			);
		
		$Query = 'SELECT page_id, page_url, name, username, description, categories, pic, pic_small, pic_big, pic_large, pic_cover, fan_count, type, website, general_info, location, hours, phone FROM page WHERE ';
		
		if (is_array($URL)) {
			foreach ($URL as $Index => $String) {
				$String = explode('?', $String);
				$String = explode('/', $String[0]);
				
				if (count($String) > 0) {
					$Queries[$Index] = $Query.'name = \''.$String[0].'\' or username = \''.$String[0].'\'';
					if (trim($String[1]) != '' && ereg('^[0-9]*$', $String[1])) $Queries[$Index] .= ' and page_id = \''.$String[1].'\'';
				}
			}
			
			unset($URL);
			
			return self::MultiQuery($Queries);
		}
		
		$URL = explode('?', $URL);
		$URL = explode('/', $URL[0]);
		
		if (count($URL) == 0) return false;
		
		$Query .= 'name = \''.$URL[0].'\' or username = \''.$URL[0].'\'';
		
		if (trim($URL[1]) != '' && ereg('^[0-9]*$', $URL[1])) $Query .= ' and page_id = \''.$URL[1].'\'';	
		
		unset($URL);
		
		return self::Query($Query);
	}
	
	public function getLinkStat($URL) {
		if (!is_array($URL) && trim($URL) == '') return Array();
		
		if (is_array($URL)) $URL = join('", "', $URL);
		
		return
			self::Query('SELECT url, normalized_url, share_count, like_count, comment_count, total_count, commentsbox_count, comments_fbid, click_count FROM link_stat WHERE url in ("'.$URL.'")');
	}
	
	/*
	* @param string or array $Id
	* @param string $Time
	* @return array
	*/
	
	public function getPageEvents($Id, $Times = null) {
		if (!is_array($Id) && trim($Id) == '') return Array();
		
		if (is_array($Id)) $Id = join(', ', $Id);

		$Query = 'SELECT eid, creator, name, description, pic_big, location, venue, start_time, end_time FROM event WHERE eid IN (SELECT eid FROM event_member WHERE uid in ('.$Id.'))';
		if ($Times != '') $Query .= ' and '.$Times;
		$Query .= ' ORDER BY start_time ASC';
				
		unset($Id, $Time);
		
		return self::Query($Query);
	}
	
	/*
	* @param string or array $Id
	* @param string $Time
	* @return array
	*/
	
	public function getEvent($Id, $Times = null) {
		if (!is_array($Id) && trim($Id) == '') return Array();
	
		if (is_array($Id)) $Id = join(', ', $Id);
	
		$Query = 'SELECT eid, creator, name, description, pic_big, location, venue, start_time, end_time FROM event WHERE eid IN ('.$Id.')';
		if ($Times != '') $Query .= ' and '.$Times;
		$Query .= ' ORDER BY start_time ASC';
		
		unset($Id, $Time);
		
		return self::Query($Query);
	}
	
	/*
	* @param string or array $Id
	* @return array
	*/
	
	public function getPageAlbums($Id) {
		if (!is_array($Id) && trim($Id) == '') return Array();
		
		if (is_array($Id)) $Id = join(', ', $Id);
		
		return 
			self::Query('SELECT aid, object_id, owner, cover_pid, cover_object_id, name, created, modified, description, location, size, link, visible, modified_major, type, photo_count, video_count FROM album WHERE owner IN ('.$Id.') ORDER BY created ASC');
	}
	
	/*
	* @param string or array $Id
	* @return array
	*/
	
	public function getAlbum($Id) {
		if (!is_array($Id) && trim($Id) == '') return Array();
		
		if (is_array($Id)) $Id = join(', ', $Id);
		
		return self::Query('SELECT aid, object_id, owner, cover_pid, cover_object_id, name, created, modified, description, location, size, link, visible, modified_major, type, photo_count, video_count FROM album WHERE aid IN ('.$Id.') ORDER BY created ASC');
	}
	
	/*
	* @param string or array $Id
	* @return array
	*/
	
	public function getAlbumPhotos($Id) {
		if (!is_array($Id) && trim($Id) == '') return Array();
		
		if (is_array($Id)) $Id = join(', ', $Id);
		
		return self::Query('SELECT object_id, pid, aid, owner, src_big, src_big_width, src_big_height, src_small, src_small_width, src_small_height, images, link, caption, created, modified, position, album_object_id, place_id FROM photo WHERE aid IN ('.$Id.') ORDER BY position ASC');
	}
	
	/*
	* @param string or array $Id
	* @return array
	*/
	
	public function getPagePhotos($Id) {
		if (!is_array($Id) && trim($Id) == '') return Array();
		
		if (is_array($Id)) $Id = join(', ', $Id);
		
		return self::Query('SELECT object_id, pid, aid, owner, src_big, src_big_width, src_big_height, src_small, src_small_width, src_small_height, images, link, caption, created, modified, position, album_object_id, place_id FROM photo WHERE aid in (SELECT aid FROM album WHERE owner IN ('.$Id.') ORDER BY created ASC) ORDER BY aid ASC');
	}

	/*
	* @param string or array $Id
	* @return array
	*/
	
	public function getPhoto($Id) {
		if (!is_array($Id) && trim($Id) == '') return Array();
	
		if (is_array($Id)) $Id = join(', ', $Id);
	
		return self::Query('SELECT object_id, pid, aid, owner, src_big, src_big_width, src_big_height, src_small, src_small_width, src_small_height, images, link, caption, created, modified, position, album_object_id, place_id FROM photo WHERE pid IN ('.$Id.') ORDER BY position ASC');
	}
	
	
	
	/*	public function isFan($UserId, $PageId) {
	//	<input accept="image/*" name="pic" class="fbTimelineSelectorFileInput" style="top: -4px; left: -143px;">
	*
	$URL = 'https://graph.facebook.com/oauth/access_token?client_id='.self::getAppId().'&client_secret='.self::getApiSecret().'&grant_type=client_credentials';
	
	$CH = curl_init($URL);
	
	curl_setopt($CH, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($CH, CURLOPT_HEADER, 0);
	curl_setopt($CH, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($CH, CURLOPT_SSL_VERIFYHOST, true);
	$FacebookAccessToken = explode('=', curl_exec($CH));
	curl_close($CH);
	
	echo $FacebookAccessToken = $FacebookAccessToken[1];
	
	
	/*
	Facebook Bug
	
	$Result =
	self::Query(
	'SELECT created_time FROM page_fan WHERE uid = '.$UserId.' AND page_id = '.$PageId
	);
	*/
	
	//		dodac w query access token dla testu jak nie to pobierac z graph
	//		dodac z cron eventy
	
	//		$Queries = '{"q1":"SELECT created_time FROM page_fan WHERE uid = '.$UserId.' AND page_id = '.$PageId.'"}';
	
	/*
	 echo		$URL = 'https://api.facebook.com/method/fql.multiquery?queries='.urlencode($Queries).'&access_token='.self::getAccessToken().'&format=json';
	
	
	
	print_r($Result);
	
	if (count($Result) > 0) return true;
	}*/

	public function StreamPublish(Array $Data) {
		$URL = 'https://api.facebook.com/method/stream.publish?access_token='.self::getAccessToken();
	
		foreach($Data as $Key => $Value) {
			$URL .= '&'.strtolower($Key).'=';
				
			if (is_array($Value))
				$URL .= urlencode(json_encode($Value));
			else
				$URL .= urlencode($Value);
		}
	
		$XML = simplexml_load_string($this->FileGetContents($URL));
	
		return $XML[0];
	}
	
	private function FileGetContents($URL) {
	    $CURL = curl_init();
	    
	    $Options =
	    	Array(
			    CURLOPT_RETURNTRANSFER => true,
			    CURLOPT_SSL_VERIFYPEER => false,
			    CURLOPT_URL => $URL
	    	);
	    
	    curl_setopt_array($CURL, $Options);
	    
	    $Contents = curl_exec($CURL);
	    $Error  = curl_getinfo($CURL,CURLINFO_HTTP_CODE);
	    curl_close($CURL);
	    
	    if ($Contents != '') return $Contents;

	    return $Error;
	}

	/*
	 * 
	 * <?php
header('Content-Type: text/html; charset=UTF-8');

$TimeStart = microtime(true);

$City['Id'] = '{$Id}';
$City['Name'] = '{$Name}';

include_once('system/core/functions.inc');
include_once('system/core/mysql.class.inc');
include_once('system/core/config.class.inc');
include_once('system/helpers/url.class.inc');

Config::Load('system/configs/system.ini');
Config::Load('system/configs/database.ini');
Config::Load('system/configs/facebook.ini');

$DB = new MySQL(Config::Get('MySQL'));

$Since = strtotime(date('j F Y').' + 2 hours');
$Until = strtotime('+ 7 days', $Since);

if (date('w') == 7) $Until = strtotime('+ 1 days', $Until);
	
$URL = 'https://graph.facebook.com/search?q='.$City['Name'].'&type=event&until='.$Until.'&since='.$Since.'&limit=5000&date_format=U';

$CH = curl_init($URL);
	
curl_setopt($CH, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($CH, CURLOPT_HEADER, 0);
curl_setopt($CH, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($CH, CURLOPT_SSL_VERIFYHOST, true);
$Data = curl_exec($CH);
curl_close($CH);

$Data = json_decode($Data);
$Data = $Data->data;
	
if (count($Data) > 0) {
	foreach ($Data as $Object)
		if ($Object->start_time >= $Since && $Object->end_time <= $Until) $Events[] = $Object->id;
}

unset($Data);

if (count($Events) > 0) {
	$Events = join(',', $Events);

	$URL = 'https://graph.facebook.com/oauth/access_token?client_id='.Config::Get('FacebookAPI.ApplicationId').'&client_secret='.Config::Get('FacebookAPI.ApplicationSecret').'&grant_type=client_credentials';
	
	$CH = curl_init($URL);
	
	curl_setopt($CH, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($CH, CURLOPT_HEADER, 0);
	curl_setopt($CH, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($CH, CURLOPT_SSL_VERIFYHOST, true);
	$FacebookAccessToken = explode('=', curl_exec($CH));
	curl_close($CH);
	
	$FacebookAccessToken = $FacebookAccessToken[1];
	
	$URL = 'https://api.facebook.com/method/events.get?eids='.$Events.'&access_token='.$FacebookAccessToken.'&format=json';
	
	$CH = curl_init($URL);
	
	curl_setopt($CH, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($CH, CURLOPT_HEADER, 0);
	curl_setopt($CH, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($CH, CURLOPT_SSL_VERIFYHOST, true);
	$Events = json_decode(curl_exec($CH));
	curl_close($CH);
	
	if (count($Events) > 0) {
		foreach ($Events as $Object) {
			if ($Object->venue->city == $City['Name']) {
				$Object->eid = number_format($Object->eid, 0, '', '');
				$Object->name = $DB->RealEscapeStr($Object->name);
				$Object->url = 'https://www.facebook.com/events/'.$Object->id;			
				$Object->description = $DB->RealEscapeStr($Object->description);
				$Object->start_time = date('Y-m-d H:i:s', $Object->start_time);
				$Object->end_time = date('Y-m-d H:i:s', $Object->end_time);

				$Count = 
					$DB->NumRows(
						$DB->Query('select Id from Events where FacebookIdEvent = \''.$Object->eid.'\' and IdCity = \''.$City['Id'].'\' limit 1;')
					);
		
				if ($Count == 0)
					$DB->Query('insert into Events (FacebookIdEvent, IdCity, Name, URL, Description, Picture, StartDateTime, EndDateTime, Published) values(\''.$Object->eid.'\', \''.$City['Id'].'\', \''.$Object->name.'\', \''.$Object->url.'\', \''.$Object->description.'\', \''.$Object->pic.'\', \''.$Object->start_time.'\', \''.$Object->end_time.'\', \'y\')');
				else
					$DB->Query('update Events set Name = \''.$Object->name.'\', URL = \''.$Object->url.'\', Description = \''.$Object->description.'\', Picture = \''.$Object->pic.'\', StartDateTime = \''.$Object->start_time.'\', EndDateTime = \''.$Object->start_time.'\' where FacebookIdEvent = \''.$Object->eid.'\' and IdCity = \''.$City['Id'].'\'');
			}
		}
	}
}

$TimeEnd = microtime(true);

echo $TimeEnd - $TimeStart;
?>
	 * 
	 * 
	 */
	
	
}
?>