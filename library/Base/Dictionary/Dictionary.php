<?php

/**
 * Description of Base_Dictionary_Dictionary
 *
 * @author rafal
 */
class Base_Dictionary_Dictionary implements arrayaccess, Iterator {

    protected $_iteratorPosition;
    protected $_keyPositions = array();
    
    protected $dictionaryTab = array();
    protected $idBackendApplication;
    protected $dictionaryCode;
    protected $dictionaryHash;

    protected $isTranslated = false;
    protected $dictionaryMapping = array();
    protected $translatedDictionaryBa = null;

    /**
     * @param array $dictionaryArray - tablica słownika
     * @param int $dictionaryCode - kod słownika (pole code tabeli dictionary)
     * @param int $idBackendApplication - id aplikacji zewnętrznej (id z tabeli backend_application)
     * @param string $dictionaryHash - hash jednoznacznie określający dodawany słownik
     */
    public function __construct($dictionaryArray, $dictionaryCode, $idBackendApplication, $dictionaryHash) {
        $this->dictionaryTab = $dictionaryArray;
        $this->idBackendApplication = $idBackendApplication;
        $this->dictionaryCode = $dictionaryCode;
        $this->dictionaryHash = $dictionaryHash;
        $this->_iteratorPosition = 0;
    }

    /** Funkcja do tłumaczenia słownika, mapuje wartości słownika na odpowiadąjece im wartości według tłumaczeń w tabelce dictionary_translate
     *
     * @param int $idBackendApplication - id BackendApplication na którą chcemy przetłumaczyć słownik
     * @return Base_Dictionary_Object
     */
    public function translate($idBackendApplication) {

        if($idBackendApplication == $this->idBackendApplication) throw new Base_Dictionary_Exception('Nie możesz  tłumaczyć słownika do samego siebie!');

        $cacheId = $this->_buildCacheId();
        
        if (!($dictionaryMapping = $this->_getTranslationsMappingFromCache($cacheId))) {
            $dictionaryMapping = $this->_getTranslationsMappingFromDb($idBackendApplication);
            $this->_saveTranslationsMappingInCache($dictionaryMapping, $cacheId);
        }

        $this->dictionaryMapping = $dictionaryMapping;
        $this->isTranslated = true;
        $this->translatedDictionaryBa = $idBackendApplication;
        return $this;
    }
    /** Pobieranie tłumaczenia określonej wartości słownikowej
     *
     * @param string $idEntry - identyfikator (ze słownika pobranego przez getDictionary() ) do przetłumaczenia
     * @return array - przetłumaczona wartość słownika tablica o kluczach id_entry, entry (pod warunkiem że tłumaczenie zostało dodane)
     */
    public function getTranslation($idEntry) {
        return $this->_getTranslation($idEntry);
    }

    /** Pobiera wartość entry z przetłumaczonego słownika
     *
     * @param string $idEntry - identyfikator (ze słownika pobranego przez getDictionary() ) do przetłumaczenia
     * @return string - wartość entry według mapowania na bazie
     */
    public function getTranslationEntry($idEntry) {
        $tmp = $this->_getTranslation($idEntry);
        return $tmp['entry'];
    }

    /**  Pobiera wartość id_entry z przetłumaczonego słownika
     *
     * @param string $idEntry - identyfikator (ze słownika pobranego przez getDictionary() ) do przetłumaczenia
     * @return string - wartość id_entry według mapowania na bazie
     */
    public function getTranslationIdEntry($idEntry) {
        $tmp = $this->_getTranslation($idEntry);
        return $tmp['id_entry'];
    }

    /** Zwraca id_entry podanej wartości słownika
     * @todo - dorobić wyszukiwanie po wartości jeżeli słownik jest przetłumaczony na inny,
     *         w tej chwili wyszuka po starym nie przetłumaczonym słowniku
     * @param string $entry
     * @return string|null - id_entry jeżeli taka wartość słownika istnieje, null jeżeli nie zostanie znaleziona
     */
    public function getByValueEntry($entry){
        $key = array_search($entry, $this->dictionaryTab);
        if($key === false) return null;
        else return $key;
    }

    public function toArray() {
        return $this->dictionaryTab;
    }

    protected function _getTranslation($idEntry) {
        if(!$this->isTranslated) throw new Base_Dictionary_Exception('Przed pobraniem tłumaczenia należy wcześniej przetłumaczyć słownik przez wywołanie metody translateTo()');

        if(array_key_exists($idEntry, $this->dictionaryMapping)) return $this->dictionaryMapping[$idEntry];
        elseif (array_key_exists($idEntry, $this->dictionaryTab) )  return array('id_entry' => $idEntry, 'entry' => $this->dictionaryTab[$idEntry]);
        else return array();
    }

    /** Pobiera tłumaczenia z bazy danych
     *
     * @param integer $idBackendApplication
     * @return array
     */
    protected function _getTranslationsMappingFromDb($idBackendApplication) {

        $idBackendApplication = intval($idBackendApplication);

        $entryIdIn = array();
        foreach($this->dictionaryTab AS $key => $dict) $entryIdIn[] = (string) $key;

        // jeżeli nie ma nic do tłumaczenia
        if(count($entryIdIn) == 0) return array();

        $model = new DictionaryTranslate();
        /*$select = $model->select()->
                from(array('dt' => 'dictionary_translate'), array('id_dictionary_entry', 'id_dictionary_entry_translated'))
                ->join(array('d1' => 'dictionary_entry'), 'dt.id_dictionary_entry = d1.id AND dt.ghost = false', array('entry AS entry', 'id_entry AS id_entry'))
                ->join(array('d2' => 'dictionary_entry'), 'dt.id_dictionary_entry_translated = d2.id AND dt.ghost = false', array('entry AS entry_translated', 'id_entry AS id_entry_translated'))
                ->join(array('dict' => 'dictionary'), 'd2.id_dictionary = dict.id', array())
                ->where('dict.id_backend_application = ?', $idBackendApplication)
                ->where('d1.id_entry IN (?)', $entryIdIn)
                ->setIntegrityCheck(false);*/

        $select = $model->select()->
                from(array('dt' => 'dictionary_translate'), array('id_entry', 'id_entry_translated'))
                ->join(array('dict' => 'dictionary'), 'dt.dictionary_code_translated = dict.code AND dt.id_backend_application_translated = dict.id_backend_application', array())
                ->join(array('de' => 'dictionary_entry'), 'de.id_dictionary = dict.id AND de.id_entry = dt.id_entry_translated', array('entry AS entry_translated'))
                ->where('dt.id_entry IN (?)', $entryIdIn)
                ->where('dt.dictionary_code = ?', $this->dictionaryCode )
                ->where('dt.id_backend_application = ?', $this->idBackendApplication)
                ->where('dt.id_backend_application_translated = ?', $idBackendApplication)
                ->where('dt.ghost = false')
                ->setIntegrityCheck(false);

        $dictionaryMapping = array();

        foreach($model->fetchAll($select) AS $map) {
            $dictionaryMapping[$map->id_entry] = array('entry' => $map->entry_translated, 'id_entry' => $map->id_entry_translated );
        }

        return $dictionaryMapping;
    }

    protected function _buildCacheId() {
        return $this->dictionaryHash.'TO'.$this->translatedDictionaryBa;
    }
    
    protected function _getTranslationsMappingFromCache($cacheId) {
        $cm = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getResource('cachemanager');
        $cache = $cm->getCache('dictcache');
        return $cache->load($cacheId);
    }

    protected function _saveTranslationsMappingInCache($data, $cacheId) {
        $cm = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getResource('cachemanager');
        $cache = $cm->getCache('dictcache');
        $cache->save($data, $cacheId);
    }

    /* implementacja metod interface'u arrayaccess */
    public function offsetExists($name) {
        if(!$this->isTranslated) 
            return array_key_exists($name, $this->dictionaryTab);
        else
            return array_key_exists($name, $this->dictionaryMapping);
    }

    public function offsetUnset ($name) {
        if(!$this->isTranslated)
            unset($this->dictionaryTab[$name]);
        else
            unset($this->dictionaryMapping[$name]);
    }

    public function offsetGet($name) {
        if($this->isTranslated && array_key_exists($name, $this->dictionaryMapping))
            return $this->dictionaryMapping[$name]['entry'];
        else
            return $this->dictionaryTab[$name];
    }

    public function offsetSet($name,$value) {
        if(!$this->isTranslated)
            $this->dictionaryTab[$name] = $value;
        else
            $this->dictionaryMapping[$name] = $value;
    }

    /* implementacja metod interface'u Iterator */

    public function rewind() {
        if($this->isTranslated) throw new Exception('W tej chwili iterowanie po przetłumaczonym słowniku jest niemożliwe, należy dopisać brakującą funkcjonalność');
        $this->_keyPositions = array_keys($this->dictionaryTab);
        $this->_iteratorPosition = 0;
    }

    public function current() {
        if($this->isTranslated) throw new Exception('W tej chwili iterowanie po przetłumaczonym słowniku jest niemożliwe, należy dopisać brakującą funkcjonalność');
        return $this->dictionaryTab[ $this->_keyPositions[$this->_iteratorPosition] ];
    }

    public function key() {
        if($this->isTranslated) throw new Exception('W tej chwili iterowanie po przetłumaczonym słowniku jest niemożliwe, należy dopisać brakującą funkcjonalność');
        return $this->_keyPositions[$this->_iteratorPosition];
    }

    public function next() {
        if($this->isTranslated) throw new Exception('W tej chwili iterowanie po przetłumaczonym słowniku jest niemożliwe, należy dopisać brakującą funkcjonalność');
        ++$this->_iteratorPosition;
    }

    public function valid() {
        if($this->isTranslated) throw new Exception('W tej chwili iterowanie po przetłumaczonym słowniku jest niemożliwe, należy dopisać brakującą funkcjonalność');
        return isset($this->_keyPositions[$this->_iteratorPosition]);
    }
}
