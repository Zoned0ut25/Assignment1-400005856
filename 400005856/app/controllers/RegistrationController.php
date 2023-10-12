<?php

class RegistrationController extends AbstractController {
    protected $errors = [];

    protected function makeModel(): Model
    {
        return new RegistrationModel("root", "", "user_management_system", "localhost");
    }

    protected function makeView(): View
    {
        $view = new View();
        $view->setTemplate(TEMPLATE_DIR.'/registration.tpl.php');
        return $view;
    }

    public function start()
    {
        $this->model = $this->makeModel();
        $this->view = $this->makeView();
        $this->view->addVar('errors', $this->errors);
        

        if(isset($_POST["register"])){
            $this->register($_POST);
        } 

        $this->view->display();
    }


    private function register(array $data)
    {
        $vars=[];

        if(empty($data))
        {
            trigger_error('Empty parameter passed to register()', E_USER_ERROR);
        }        
        
        $usernameExist = $this->model->find("users", $data);

        $validate = new Validation();
        if(sizeof($usernameExist) > 0){
            $validate->setErrorMessages('username','This username already exist!');
        }

        if(empty($data['username'])){
            $validate->setErrorMessages('username','Missing username');
        }
        
        $validate->checkEmail($data['email']);
        $validate->checkPassword($data['password']);
        $this->setErrorMessages($validate->getErrorMessages());

        $vars=['errors'=> $this->errors];

        $this->view->addVars($vars);

        if(empty($validate->getErrorMessages())){
            $this->model->add("users", $data);
            header("location:index.php");
        }
    }


    public function setErrorMessages(array $errors)
    {
        if(!empty($errors))
      {
        $this->errors = $errors;
      }
    }
}