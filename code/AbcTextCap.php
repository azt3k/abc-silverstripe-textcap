<?php

class AbcTextCap {

	/**
     * @config
     */
    private static $text_captcha_api_key = null;

	/**
	 * Sets the API Key
	 * @param [type] $key [description]
	 */
	public static function set_text_captcha_api_key($key = null) {
		static::$text_captcha_api_key = $key;
	}

	/**
	 * [getCapData description]
	 */
	public static function getCapData(){

		// API Key
		$key = Config::inst()->get('AbcTextCap', 'text_captcha_api_key');
		if (!$key) $key = uniqid();

		// try to use the text captcha service
		$response = file_get_contents('http://api.textcaptcha.com/' . $key . '.xml');
		if ($response) {
			$document = new DOMDocument();
			if ($document->loadXML($response)) {
				$data = (object) array(
					'q'	=> $entries = $document->getElementsByTagName('question')->item(0)->nodeValue,
					'a'	=> array()
				);
				$answers = $document->getElementsByTagName('answer');
				foreach ($answers as $a) {
					$data->a[] = $a->nodeValue;
				}

			}
		}

		// fall back to the internal "database" of questions
		if (empty($data->q) || empty($data->a) || (Session::get("AbcTextCap") && $data->q == Session::get("AbcTextCap")->q) ){
			$data = (object) AbcTextCapData::getChallenge();
			$as = array();
			foreach ($data->a as $a) {
				$as[] = md5(strtolower(trim($a)));
			}
			$data->a = $as;
		}

		// save the cap data
		Session::set("AbcTextCap", $data);

		// return
		return $data;
	}

	public static function validate($answer) {
		$data = Session::get("AbcTextCap");
		foreach ($data->a as $a) {
			if (md5(strtolower(trim($answer))) == $a) return true;
		}
		return false;
	}

}
