<?php

DEFINE('DEFAULT_OPTION_LABEL', '-- select --');
DEFINE('DEFAULT_EMPTY_MSG', 'Wypełnij pole');
DEFINE('DEFAULT_MINLEN_MSG', 'Wpisz przynajmniej  %min% znaków');
DEFINE('DEFAULT_MAXLEN_MSG', 'Wpisz maksymalnie  %max% znaków');
DEFINE('DEFAULT_FORMAT_MSG', 'Niepoprawny format');
DEFINE('DEFAULT_MINNUM_MSG', 'Liczba musi być większa niż %min%');
DEFINE('DEFAULT_MAXNUM_MSG', 'Liczba musi być mniejsza niż %max%');

abstract class Base_Form_Abstract extends Zend_Form {

    public function __construct($options = null) {
        parent::__construct($options);
    }
    
    protected function prepButton($name, $button_group_name = "action_buttons") {
        $e = $this->getElement($name);
        $e->setIgnore(true);
        $e->setDecorators(array(
            'ViewHelper',
            array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'button'))
        ));

        if ($b = $this->getDisplayGroup('button_actions')) {
            $b->addElement($e);
        } else {
            $this->addDisplayGroup(array($name), 'button_actions',array(
                'decorators' => array(
                    'FormElements',
                        array(array('data' => 'HtmlTag'), array('tag' => 'div', 'style' => 'clear: both;'))
                )
            ));
            $this->clear();
        }
    }
    
    public function submit($fieldname='submit', $label='Save' , $class = 'button1') {
        $this->addElement('submit', $fieldname, array('label' => $label, 'class' => $class));
        $this->prepButton($fieldname);
    }

    public function cancel($fieldname= 'cancel', $label='Cancel', $class = 'button1') {
        $this->submit($fieldname, $label, $class);
    }
    
    public function clear() {
        $id = rand(1, 1024);
        $this->addElement('hidden','clear'.$id,array(
            'ignore' => 'true',
            'decorators' => array(
                'FormElements',
                array(array('data' => 'HtmlTag'), array('tag' => 'div', 'class' => 'clear'))
            )
        ));
    }
//    public function search($acl = false, $fieldname= 'search', $label='Search') {
//        $this->submit($acl, $fieldname, $label);
//    }
//
//    public function reset($acl = false, $fieldname= 'reset', $label='Clear', $class = 'button1') {
//        $method = $acl?'addSupervisedElement':'addElement';
//        $this->$method('reset', $fieldname, array('label' => $label, 'class' => $class));
//        $this->prepButton($fieldname);
//    }

    public function addPhoneValidators($elementName, $message=DEFAULT_FORMAT_MSG) {
        if ($elem = $this->getElement($elementName)) {
            $v = new Zend_Validate_Regex('/^\d{9}$/');
            $v->setMessage("Wrong phone format", Zend_Validate_Regex::NOT_MATCH);
            $elem->addFilter('PregReplace', array('match' => '[ ]', 'replace' => ''));
            $elem->addFilter('StringTrim');
            $elem->addValidator($v);
        }
    }
//
//    public function addPhoneValidatorsShort($elementName, $message=DEFAULT_FORMAT_MSG) {
//        if ($elem = $this->getElement($elementName)) {
//            $v = new Zend_Validate_Regex('/^\d{9}$/');
//            $v->setMessage("Wrong phone format", Zend_Validate_Regex::NOT_MATCH);
//            $elem->addFilter('PregReplace', array('match' => '[ ]', 'replace' => ''));
//            $elem->addFilter('StringTrim');
//            $elem->addValidators(array($v, array('StringLength', false, array(0, 20))));
//        }
//    }
//
//    public function login($acl = false, $fieldname= 'login', $label='Login') {
//        $method = $acl?'addSupervisedElement':'addElement';
//        $this->$method('text', $fieldname, array(
//            'filters' => array(array('StringToUpper', array('encoding' => 'UTF-8'))),
//            'validators' => array(
//                array('Regex', true, array('/[a-zA-Z_]{1,30}/')),
//                array('StringLength', true, array(1, 30))
//            ),
//            'required' => $this->default_policy,
//            'label' => $label,
//        ));
//        $this->notEmpty('login');
//    }
//
//    public function int($acl = false, $fieldname = 'int', $label = "int", $required = null) {
//        $method = $acl?'addSupervisedElement':'addElement';
//        $this->$method('text', $fieldname, array(
//            'validators' => array(
//                array('Int')
//            ),
//            'label' => $label,
//            'required' => (is_null($required) ? $this->default_policy : $required),
//        ));
//    }
//
//    public function name($acl = false, $fieldname='first_name', $label='Imię:', $force_required = null) {
//        $required = ($force_required !== null) ? $force_required : $this->default_policy;
//
//        $method = $acl?'addSupervisedElement':'addElement';
//        $this->$method('text', $fieldname, array(
//            'filters' => array(
//                array('PregReplace', array('match' => '/[ ]+/', 'replace' => ' ')),
//                array('StringTrim', array('charlist' => ' ')),
//            ),
//            'validators' => array(
//                array('StringLength', true, array(2, 40))
//            ),
//            'required' => $required,
//            'label' => $label,
//        ));
//        if($required)
//            $this->notEmpty($fieldname);
//    }
//
//    public function surname($acl = false, $fieldname='surname', $label='Nazwisko:', $force_required = null) {
//        $required = ($force_required !== null) ? $force_required : $this->default_policy;
//
//        $method = $acl?'addSupervisedElement':'addElement';
//        $this->$method('text', $fieldname, array(
//            'filters' => array(
//                array('PregReplace', array('match' => '/[ ]+/', 'replace' => ' ')),
//                array('StringTrim', array('charlist' => ' ')),
//            ),
//            'validators' => array(
//                array('StringLength', true, array(2, 40))
//            ),
//            'required' => $required,
//            'label' => $label,
//        ));
//        if($required)
//            $this->notEmpty($fieldname);
//    }

    public function pesel($fieldname = 'pesel', $label = 'Pesel :',$force_validator = null) {
        $this->addElement('text', $fieldname, array(
            'filters' => array(array('PregReplace', array('match' => '[ ]', 'replace' => ''))),
            'validators' => array(
                array('Pesel', true, array('HH:II'))
            ),
//            'required' => $this->default_policy,
            'label' => $label,
        ));
//        if ( !($this->default_policy || $force_validator)) {
//            $this->getElement('pesel')->removeValidator('pesel');
//        }
    }

    public function notEmpty($elementName, $message=DEFAULT_EMPTY_MSG) {
    	$this->getElement($elementName)->addValidator('NotEmpty',true);
    }
    
    public function email($fieldname = 'email', $label = 'Email:') {
        $v = new Zend_Validate_Regex('/^[a-zA-Z0-9.\-_]+@[a-zA-Z0-9\-.]+\.[a-zA-Z]{2,4}$/');
        $v->setMessage("Email format is incorrect", Zend_Validate_Regex::NOT_MATCH);
        $this->addElement('text', $fieldname, array(
            'filters' => array(array('PregReplace', array('match' => '[ ]', 'replace' => ''))),
            'required' => true,
            'label' => $label,
        ));
        $this->getElement($fieldname)->addFilter('StringTrim')->addValidator($v);
        $this->notEmpty($fieldname);
    }

    public function phone($fieldname = 'phone', $label = 'Phone:'){
        $this->addElement('text', $fieldname, array(
            'required'   => false,
            'label'      => $label,
        ));
        $this->addPhoneValidators('phone');
    }

    public function cellphone($fieldname = 'cell_phone', $label = 'Mobile phone:'){
        $this->addElement('text', $fieldname, array(
//            'required'   => false,
            'label'      => $label,
        ));
        $this->addPhoneValidators('cell_phone');
    }
    
    public function sex($fieldname = 'sex', $label = 'Sex:') {
        $dict = new Base_Dictionary();
        $this->addElement('select', $fieldname, array(
            'label' => $label,
//            'required' => $this->default_policy,
            'MultiOptions' => $this->addClearStart($dict->setSource('sex')->getDictionary())
        ));
        $this->notEmpty($fieldname);
    }

//    public function title($acl = false, $fieldname='title' , $label='Tytuł:' , $required = null) {
//        $dict = new Base_Dictionary();
//        $method = $acl?'addSupervisedElement':'addElement';
//        $this->$method('select', $fieldname, array(
//            'label' => $label,
//            'required' => ($required !== null) ? $required : $this->default_policy,
//            'MultiOptions' => $this->addClearStart($dict->setSource('zwrot')->getDictionary())
//        ));
//        $this->notEmpty('title');
//    }

    public function datee($fieldname = 'date', $label = 'Data:', $required = null, $additionalOptions = array()) {
        /**
         * @todo: podpiąć datepickera!! 
         */
        $options = array_merge(array(
                'validators' => array(
                    array('Date', true, array('YYYY-MM-DD'))
                ),
                'required' => (is_null($required) ? $this->default_policy : $required),
                'label' => $label,
                'class' => 'datepicker',
            ), $additionalOptions);
        $this->addElement('text', $fieldname, $options);
        $this->notEmpty($fieldname);
    }

    public function timee($fieldname = 'time', $label = 'Godzina:', $required=null, $additionalOptions = array()) {
        $options = array_merge(array(
                'validators' => array(
                    array('Date', true, array('HH:II'))
                ),
                'required' => (is_null($required) ? $this->default_policy : $required),
                'label' => $label,
            ), $additionalOptions);
        $this->addElement('text', $fieldname, $options);
        $this->notEmpty($fieldname);
    }

    public function postcode($fieldname = 'zip_code', $label = 'Postcode:', $required=null) {
        $this->addElement('text', $fieldname, array(
            'filters' => array(array('PregReplace', array('match' => '[ ]', 'replace' => ''))),
            'validators' => array(
                array('Regex', true, array('/[0-9]{2}-\d{3}$/'))
            ),
            'required' => (is_null($required) ? $this->default_policy : $required),
            'label' => $label,
        ));
        $this->notEmpty($fieldname);
    }

    protected function addEmptyStart($arrSelectOptions, $strStart = DEFAULT_OPTION_LABEL) {
        $temp[0] = $strStart;
        if (is_array($arrSelectOptions))
            foreach ($arrSelectOptions as $key => $val) {
                $temp[$key] = $val;
            }
        return $temp;
    }

    protected function addClearStart($arrSelectOptions, $strStart = DEFAULT_OPTION_LABEL) {
        $temp[''] = $strStart;
        if (is_array($arrSelectOptions))
            foreach ($arrSelectOptions as $key => $val) {
                $temp[$key] = $val;
            }
        return $temp;
    }

//    protected function street($acl = false, $fieldname='street', $label='Ulica:' , $required=null) {
//        $method = $acl?'addSupervisedElement':'addElement';
//        $this->$method('text', $fieldname, array(
//            'filters' => array(array('PregReplace', array('match' => '/[ ]+/', 'replace' => ' ')), array('StringTrim', array('charlist' => ' ')), array('StringToUpper', array('encoding' => 'UTF-8'))),
//            'validators' => array(
//                array('StringLength', true, array(2, 35))
//            ),
//            'required' => (is_null($required) ? $this->default_policy : $required),
//            'label' => $label,
//        ));
//        $this->notEmpty($fieldname);
//    }
//
//    protected function street_pref($acl = false, $fieldname='street_prefix', $label='Prefiks:', $required=null) {
//        $dict = new Base_Dictionary();
//
//        $method = $acl?'addSupervisedElement':'addElement';
//        $this->$method('select', $fieldname, array(
//            'required' => (is_null($required) ? $this->default_policy : $required),
//            'label' => $label,
//            'MultiOptions' => $dict->setSource('street_pref', array('id_dictionary != 5'), 'id_dictionary asc')->getDictionary(),
//            'default' => 1,
//        ));
//    }
//
//    protected function houseNumber($acl = false, $fieldname='house_no', $label='Nr domu:', $required=null) {
//        $method = $acl?'addSupervisedElement':'addElement';
//        $this->$method('text', $fieldname, array(
//            'filters' => array(array('PregReplace', array('match' => '/[ ]/', 'replace' => '')), array('StringToUpper', array('encoding' => 'UTF-8'))),
//            'validators' => array(
//                array('StringLength', true, array(1, 10))
//            ),
//            'required' => (is_null($required) ? $this->default_policy : $required),
//            'label' => $label,
//        ));
//        $this->notEmpty($fieldname);
//        $v = $this->getElement($fieldname)->getValidator('StringLength');
//        $v->setMessages(array(
//            Zend_Validate_StringLength::TOO_SHORT =>
//            "Wpisz przynajmniej %min% cyfrę",
//            Zend_Validate_StringLength::TOO_LONG =>
//            "Wpisz maxymalnie %max% cyfr"
//        ));
//    }
//
//    protected function apartmentNumber($acl = false, $fieldname='apartment_no', $label='Nr mieszkania:', $required=null) {
//        $method = $acl?'addSupervisedElement':'addElement';
//        $this->$method('text', $fieldname, array(
//            'filters' => array(array('PregReplace', array('match' => '/[ ]/', 'replace' => '')), array('StringToUpper', array('encoding' => 'UTF-8'))),
//            'required' => ($required),
//            'label' => $label,
//        ));
//        $this->notEmpty($fieldname);
//    }
//
//    protected function city($acl = false, $fieldname='city', $label='Miasto:', $required=null) {
//        $method = $acl?'addSupervisedElement':'addElement';
//        $this->$method('text', $fieldname, array(
//            'filters' => array(array('PregReplace', array('match' => '/[ ]+/', 'replace' => ' ')), array('StringTrim', array('charlist' => ' ')), array('StringToUpper', array('encoding' => 'UTF-8'))),
//            'validators' => array(
//                array('StringLength', true, array(2, 24))
//            ),
//            'required' => (is_null($required) ? $this->default_policy : $required),
//            'label' => $label,
//        ));
//        $this->notEmpty($fieldname);
//    }

//    public function id($acl = false, $fieldname='id', $label='', $required=null) {
//        $method = $acl?'addSupervisedElement':'addElement';
//        $this->$method('hidden', $fieldname, array(
//            'required'  => (is_null($required) ? $this->default_policy : $required),
//        ));
//    }

    public function hideField($fieldName) {
        if($field = $this->getElement($fieldName))
            if($decorator = $field->getDecorator('row'))
                $decorator->setOption('style', 'display:none;');
    }

    public function showField($fieldName) {
        if($field = $this->getElement($fieldName))
            if($decorator = $field->getDecorator('row'))
                $decorator->setOption('style', 'display:block;');
    }

    public function isCancelled($data) {
        if (is_array($data)) {
            foreach ($data as $dataKey => $dataValue) {
                if(is_array($dataValue)) {
                    if(isset($dataValue['cancel'])) {
                        return isset($dataValue['cancel']) ? $data['cancel'] : null;
                    }
                } else {
                    if($dataKey == 'cancel') {
                        return isset($dataKey) ? $data['cancel'] : null;
                    }
                }
            }
        }
        return null;
    }

    public function checkIfIsCancelled($data) {
        return isset($data['cancel'])?true: false;
    }
}
