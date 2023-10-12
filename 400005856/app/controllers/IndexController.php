<?php

class IndexController extends AbstractController
{
    protected $errors = [];

    protected function makeModel(): Model
    {
        return new IndexModel("root", "", "user_management_system", "localhost");
    }

    protected function makeView() : View {
        $view = new View();
        $view->setTemplate(TEMPLATE_DIR.'/index.tpl.php');
        return $view;
    }

    public function start(){
        $this->model = $this->makeModel();
        $this->view = $this->makeView();
        $this->view->addVar('errors', $this->errors);

        $auth = new AuthenticationController();

        if($auth->isUserLoggedIn()){
            header("location: ./dashboard");
        }
        

        if(isset($_POST["login"])){
            $this->loginUser($_POST);
        } 

        $this->view->display();
    }

    public function loginUser(array $data) {
        $vars=[];
        if(empty($data)){
            trigger_error('Invalid parameter value recieved', E_USER_ERROR);
            return false;
        }

        $validate = new Validation();

        $validate->checkEmail($data['email']);
        $validate->checkPassword($data['password']);
        //query if user exist
        $user = $this->model->find("users", $data);
        
        //if user does not exist return error
        if(sizeof($user) < 1 || !password_verify($data['password'], $user['password'])){
            $validate->setErrorMessages('user','Email/Password incorrect.');
        }
        
        $this->setErrorMessages($validate->getErrorMessages());
        $vars=['errors'=> $this->errors];
        
        $this->view->addVars($vars);
        // continue if no validation errors
        if(empty($validate->getErrorMessages())){
            session_start();
            $_SESSION["session_user"]["username"] = $user["username"];
            $_SESSION["session_user"]["email"] = $user["email"];
            $_SESSION["session_user"]["role"] = $user["role"];
            session_write_close();
            header("location:./dashboard");
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