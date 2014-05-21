<?php
include_once('google-api-php-client/src/apiClient.php');
include_once('google-api-php-client/src/contrib/apiPlusService.php');

class GooglePlusAPI {
	
	private $Client;
	private $APIKey;
	
	public function __construct(Array $Config) {
		session_start();
		
		$this->APIKey= $Config['APIKey'];
		
		$this->Client = new apiClient();
		
		$this->Client->setApplicationName($Config['ApplicationName']);
		$this->Client->setClientId($Config['ClientId']);
		$this->Client->setClientSecret($Config['ClientSecret']);
		$this->Client->setScopes($Config['Scopes']);
		$this->Client->setDeveloperKey($Config['DeveloperKey']);
		$this->Client->setRedirectUri($Config['RedirectURI']);
		$this->Plus = new apiPlusService($this->Client);
	}
	
	public function getUser() {
		$AccessToken = json_decode($this->Client->getAccessToken(), true);
		
		$URL = 'https://www.googleapis.com/oauth2/v1/userinfo?alt=json&access_token='.$AccessToken['access_token'];
	
		$CURL = curl_init();
	
		$Options =
			Array(
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HEADER => false,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_ENCODING => '',
				CURLOPT_USERAGENT => 'spider',
				CURLOPT_AUTOREFERER => true,
				CURLOPT_CONNECTTIMEOUT => 5,
				CURLOPT_TIMEOUT => 10,
				CURLOPT_MAXREDIRS => 3,
				CURLOPT_URL => $URL,
				CURLOPT_SSL_VERIFYHOST => 0,
				CURLOPT_SSL_VERIFYPEER => false
			);
			
		curl_setopt_array($CURL, $Options);
	
		unset($URL, $Options);
	
		$Content = curl_exec($CURL);
		$Error  = curl_getinfo($CURL, CURLINFO_HTTP_CODE);
	
		curl_close($CURL);
			
		if ($Content != '') return json_decode($Content, true);
	
		return $Error;
	}
	
	public function getClient() {
		return $this->Client;
	}
	
	public function getPlus() {
		return $this->Plus;
	}
		
	public function getLinkStat($URL) {
		$CURL = curl_init();
		$URL =  'https://plusone.google.com/_/+1/fastbutton?url='.urlencode($URL).'&size=standard&count=true&width=450&annotation=inline';
		
		$Options =
			Array(
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HEADER => false,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_ENCODING => '',
				CURLOPT_USERAGENT => 'spider',
				CURLOPT_AUTOREFERER => true,
				CURLOPT_CONNECTTIMEOUT => 5,
				CURLOPT_TIMEOUT => 10,
				CURLOPT_MAXREDIRS => 3,
				CURLOPT_URL => $URL,
				CURLOPT_SSL_VERIFYHOST => 0,
				CURLOPT_SSL_VERIFYPEER => false
			);
		
		curl_setopt_array($CURL, $Options);
		
		unset($URL, $Options);
		
		$Content = curl_exec($CURL);
		
		if (curl_errno($CURL) != '') return 0;
		
		curl_close($CURL);
		
		unset($CURL);
		
		$DOM = new DOMDocument;
		$DOM->preserveWhiteSpace = false;
		@$DOM->loadHTML($Content);
		$DOMXPath = new DOMXPath($DOM);
		
		$Filtered = $DOMXPath->query("//div[@class='unchecked']");
		$Count = explode(' ', $Filtered->item(0)->nodeValue);
		
		unset($DOM, $DOMXPath, $Filtered);
		
		return str_replace('+', '', $Count[0]);		
	}
	
	public function getFanCount($Id) {
		return self::getLinkStat('https://plus.google.com/'.$Id);
	}
	
	public function getData($Id) {
		if (!$this->ValidateKey()) exit('No API Key!');
		
		$URL = 'https://www.googleapis.com/plus/v1/people/'.$Id.'?pp=1&key='.$this->APIKey;
		
		$CURL = curl_init();
		
		$Options = 
			Array(
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_SSL_VERIFYPEER => false,
				CURLOPT_URL => $URL
			);
		
		curl_setopt_array($CURL, $Options);
		
		unset($URL, $Options);
		
		$Content = curl_exec($CURL);
		$Error  = curl_getinfo($CURL, CURLINFO_HTTP_CODE);
		
		curl_close($CURL);
			
		if ($Content != '') return $Content;
	
		return $Error;
	}
	
	public function getId($URL) {
		$URL = 
			explode(
				'/', 
				str_replace(Array('http://', 'https://', 'www.', 'plus.google.com'), '', $URL)
			);
		
		if (ereg('^[0-9]*$', $URL[1])) return $URL[1];
	}
	
	private function ValidateKey() {
		if (trim($this->APIKey) == '') return false;
		
		return true;
	}

}
?>