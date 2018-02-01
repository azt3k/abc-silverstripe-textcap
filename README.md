Setup
-----



1. Add the following to your composer.json

````json
"require": {
    "azt3k/abc-silverstripe-textcap" : "*@stable"
}
````

2. run `composer install`

3. go to `http://textcaptcha.com/` and sign up for an api key (this is now optional)

4. Configure API Key (this is now optional)

Insert the following into your `project/_config.php` file replacing `your-api-key` with the api key you got in step 3

````php
AbcTextCap::set_text_captcha_api_key('your-api-key');
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

License
-------

Copyright (c) 2018 Aaron Latham-Ilari

All rights reserved.

Redistribution and use in source and binary forms, with or without modification, are permitted (subject to the limitations in the disclaimer below) provided that the following conditions are met:

* Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
* Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
* Neither the name of [Owner Organization] nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission.

NO EXPRESS OR IMPLIED LICENSES TO ANY PARTY'S PATENT RIGHTS ARE GRANTED BY THIS LICENSE. THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
