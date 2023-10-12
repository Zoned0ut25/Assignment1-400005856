<?php

class Validation {
    protected $errors = [];

    //get error messages for display
    public function getErrorMessages() {
        return $this->errors;
    }

    //set error messages to be displayed
    public function setErrorMessages(string $field_name, string $err_msg) {
        if(empty($field_name)){
            trigger_error('Invalid field name used. Cannot be empty', E_USER_ERROR);
        }

        if(empty($err_msg)){
            trigger_error('Cannot create an empty error message', E_USER_ERROR);
        }
        $this->errors[$field_name] = $err_msg;
    }

    public function checkEmail(string $email) : bool 
    {
        if(empty($email))
        {
            $this->setErrorMessages('email','Missing email');
            return false;
        }
        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $this->setErrorMessages('email','Invalid email');
            return false;
        }
        return true;
    }

    public function checkPassword(string $password) : bool
    {
        $uppercasePassword = "/(?=.*?[A-Z])/";
        $lowercasePassword = "/(?=.*?[a-z])/";
        $digitPassword = "/(?=.*?[0-9])/";
        $spacesPassword = "/^$|\s+/";

        if(empty($password)){
            $this->setErrorMessages('password','Missing password');
            return false;
        }

        if(strlen($password) < 10){
        $this->setErrorMessages('password','Password too short');
        return false;
        }

        if (!preg_match($uppercasePassword,$password) || !preg_match($lowercasePassword,$password) || !preg_match($digitPassword,$password) || preg_match($spacesPassword,$password)) 
        {
            $this->setErrorMessages('password','Password must have at least one uppercase letter, lowercase letter, digit, a special character and no spaces');
            return false;
        } 
        return true;
        }
    }
