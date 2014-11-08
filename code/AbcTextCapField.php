<?php

class AbcTextCapField extends TextField {

	protected $capData = null;
	protected $template	= 'AbcTextCapField';
	protected $isValid = null;

	public function __construct($name, $title = null, $value = '', $maxLength = null, $form = null) {
		parent::__construct($name, $title, $value, $maxLength, $form);
	}

	public function getQuestion(){
		if (empty($this->capData)) $this->capData = AbcTextCap::getCapData();
		return $this->capData->q;
	}

	public function validate($validator) {

		// extract the value
		$value = empty($this->value) ? $_REQUEST[$this->name] : $this->value;

		// validate and save the validation result in case validate gets called twice
		if ($this->isValid === null) $this->isValid = AbcTextCap::validate($value);

		// push validation error
		if (!$this->isValid) {
			$validator->validationError(
				$this->name,
				'You answered the question incorrectly',
				"validation",
				false
			);
		}

		// reset the question
		$this->capData = AbcTextCap::getCapData();

		return $this->isValid;

	}

}