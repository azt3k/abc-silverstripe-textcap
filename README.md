Setup
-----



1. Add the following to your composer.json

````json
"require": {
    "azt3k/abc-silverstripe-textcap" : "*@stable"
}
````

2. run `composer install`

3. go to `http://textcaptcha.com/` and sign up for an api key

4. Configure API Key (this is now optional)

Insert the following into your `project/_config.php` file replacing `your-api-key` with the api key you got in step 3

````php
AbcTextCap::set_text_captcha_api_key('your-api-key')
````
- OR -

Insert the following into your `project/_config/config.yml` file

````yaml
AbcTextCap:
  text_captcha_api_key: your-api-key
````

5. Add a captcha field to your form

````php
<?php

class ContactForm extends Form {

    public function __construct($controller, $name){

        $fields = new FieldList;

        $fields->push(new TextField('Name', 'Your Name'));
        $fields->push(new EmailField('Email', 'Your Email'));
        $fields->push(new TextField('Subject'));
        $fields->push(new TextareaField('Message', 'Message'));
        $fields->push(new AbcTextCapField('Captcha','Are you a human?'));

        // Actions
        $actions = new FieldList(new FormAction("doProcessForm", 'Send'));

        // Validator
        $required = new RequiredFields('Name', 'Email', 'Captcha');

        // Construct
        parent::__construct($controller, $name, $fields, $actions, $required);
    }

    public function doProcessForm($data, $form){

        // default success value
        $success = false;

        // load the data
        $form->loadDataFrom($data);

        // validate using existing validators
        if ($valid = $form->validate()) {

            // save a record etc

        }

        if (!$valid) $form->sessionMessage("Sorry there were some problems with your submission", 'bad');
        else $form->sessionMessage("Your message has been sent", 'good');

        // go back to the last location
        $this->Controller()->redirectBack();
        return;

    }

}
````
