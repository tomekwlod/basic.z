<?php 
class Team_Add extends Base_Form_Abstract {

    public function init() {
        $dict = new Base_Dictionary();
        
        $this->setAttrib('id', 'team_addteam_form');
        
        // dyscipline
        $this->addElement('select','discipline',array(
            'label' => 'Discipline',
            'required' => true,
            'multioptions' => $this->addClearStart($dict->setSource(new Discipline(),array('id_discipline_group = '.DisciplineGroup::TeamDiscipline),'title asc','id',array('title'))->getDictionary())
        ));
        
        // team title
        $this->addElement('text','title',array(
            'label' => 'Title',
            'required' => true,
            'style' => 'width: 500px;',
            'filters' => array('StringTrim'),
            'validators' => array(
                array(
                    'StringLength',
                    false,
                    array(5, 256)),
            ),
        ));
        
        // team description
        /**
         * @todo: zrobić licznik wpisanych znaków
         */
        $this->addElement('textarea','description',array(
            'label' => 'Description',
            'required' => false,
            'style' => 'width: 500px; height: 100px; resize: none;',
            'filters' => array('StringTrim'),
            'validators' => array(
                array(
                    'StringLength',
                    false,
                    array(0, 1000)),
            ),
        ));
        
        //preferred gender
        $this->addElement('select','sex',array(
            'label' => 'Preferred gender',
            'required' => false,
            'multioptions' => $this->addClearStart($dict->setSource('sex')->getDictionary(),'-- no matter --'),
            'filters' => array('StringTrim'),
        ));
    
        $this->addElement('select','level',array(
            'label' => 'Team level',
            'required' => true,
            'multioptions' => $dict->setSource('team_level')->getDictionary(),
        ));

//        $this->addElement('text','localization',array(
//            'label' => 'Localization',
//            'required' => true,
//            'style' => 'width: 500px;',
//            'filters' => array('StringTrim'),
//        ));
//
//        $this->addElement('text','cyclicality',array(
//            'label' => 'Cyclicality',
//            'required' => true,
//            'filters' => array('StringTrim'),
//        ));
//
//        $this->addElement('text','max_members',array(
//            'label' => 'Maximum number of members on the team',
//            'required' => true,
//            'style' => 'width: 50px;',
//            'maxlength' => 3,
//            'filters' => array('StringTrim'),
//        ));
//        
//        $this->addElement('text','curr_members',array(
//            'label' => 'Current number of members on the team',
//            'required' => false,
//            'style' => 'width: 50px;',
//            'maxlength' => 3,
//            'filters' => array('StringTrim'),
//        ));
//        
//        /**
//         * @todo: validator DOUBLE 
//         */
//        $this->addElement('text','payment_rate',array(
//            'label' => 'Payment rate',
//            'required' => true,
//            'maxlength' => 5,
//            'filters' => array('StringTrim'),
//        ));
        
//        if ($type == DisciplineGroup::SingleDiscipline) {
//            $this->addElement('select','payment_currency',array(
//                'required' => true,
//                'multioptions' => $dict->setSource('currency')->getDictionary()
//            ));
//        }
        
//        $this->addElement('select','payment_type',array(
//            'label' => 'Payment type',
//            'required' => true,
//            'multioptions' => $this->addClearStart($dict->setSource('payment_type')->getDictionary())
//        ));

        $this->submit('save','OK');
		$this->cancel();
    }
}