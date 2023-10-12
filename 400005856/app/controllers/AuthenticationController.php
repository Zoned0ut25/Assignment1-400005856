<?php

class AuthenticationController extends AbstractController
{
    protected $errors = [];

    protected function makeModel(): Model
    {
        return new AuthenticationModel("root", "", "user_management_system", "localhost");
    }

    protected function makeView() : View {
        $view = new View();
        return $view;
    }

    public function start(){
        $this->view = $this->makeModel();
    }

    public function isUserLoggedIn() : bool
    {
        session_start();
        if(!isset($_SESSION["session_user"])){
            session_write_close();
            return false;
        } else {
            session_write_close();
            return true;
        }
        
    }

    public function logOutUser()
    {
        session_start();
        $_SESSION = array();
        session_destroy();
        header("location:index.php");
    }

    public function setErrorMessages(array $errors)
    {
        if(!empty($errors))
        {
            $this->errors = $errors;
        }
    }
}