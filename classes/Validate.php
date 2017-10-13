<?php

class Validate {

    private $_errors = array(),
            $_passed = false;

    public function check($source, $items = array()) {

        foreach ($items as $item => $rules) {
            foreach ($rules as $rule => $rule_value) {

               $value = trim($source[$item]);
               $item = escape($item);

                if($rule === 'required' && empty($value)) {
                    $this->addError("{$item} is required", $item);
                } else if(!empty($value)) {
                    switch ($rule) {
                        case 'min':
                            if(strlen($value) < $rule_value) {
                                $this->addError("{$item} must be a minimum of {$rule_value} characters.", $item);
                            }
                            break;
                        case 'max':
                            if(strlen($value) > $rule_value) {
                                $this->addError("{$item} must be a maximum of {$rule_value} characters.", $item);
                            }
                            break;
                        case 'matches':
                            if($value != $source[$rule_value]) {
                                $this->addError("{$rule_value} must match {$item}", $item);
                            }
                            break;
                        case 'email':
                            $filterEmail = filter_var($value, FILTER_SANITIZE_EMAIL);
                            if(!filter_var($filterEmail, FILTER_VALIDATE_EMAIL)) {
                                $this->addError("{$item} is not a correct email address", $item);
                            }
                            break;
                    }
                }
             }
        }

        if(empty($this->_errors)) {
            $this->_passed = true;
        }
        return $this;
    }

    private function addError($error, $field) {
        $this->_errors[$field] = $error;

    }

    public function errors() {
        return $this->_errors;
    }

    public function passed() {
        return $this->_passed;
    }

}
















