<?php

class AbcTextCapField extends TextField {
	
	protected $capData = null;
	protected $template	= 'AbcTextCapField';
	
	public function __construct($name, $title = null, $value = '', $maxLength = null, $form = null) {
		
		parent::__construct($name, $title, $value, $maxLength, $form);
		
	}
	
	public function getQuestion(){
		if (empty($this->capData)) $this->capData = AbcTextCap::getCapData();
		return $this->capData->q;
	}
	
	public function validate($validator) {
				
		$value = empty($this->value) ? $_REQUEST[$this->name] : $this->value ;
		
		if (!$isValid = AbcTextCap::validate($value)) {
			$validator->validationError(
				$this->name, 
				'You answered the question incorrectly', 
				"validation", 
				false
			);			
		}
		
		// reset the question
		$this->capData = AbcTextCap::getCapData();	 		
		
		return $isValid;
		
	}
	
}