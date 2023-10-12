<?php

class CreateResearcherController extends AbstractController
{
    protected $errors = [];
    protected $success = [];


    protected function makeModel(): Model
    {
        return new CreateResearcherModel("root", "", "user_management_system", "localhost");
    }

    protected function makeView() : View {
        $view = new View();
        $view->setTemplate(TEMPLATE_DIR.'/create_researcher.tpl.php');
        return $view;
    }

    public function start(){
        $this->model = $this->makeModel();
        $this->view = $this->makeView();
        $auth = new AuthenticationController();

        if(!$auth->isUserLoggedIn()){
            header('location:../index.php');
        }

        if($_SESSION["session_user"] && $_SESSION["session_user"]["role"] !== "Research Group Manager"){
            header('location:../index.php');
        }

        if(isset($_POST["create"])){
            $this->register($_POST);
        }
        
        $this->view->addVar('errors', $this->errors);
        $this->view->addVar('success', $this->success);
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
            // header("location:create.php");
            $_POST = array();
            $this->setSuccessMessages(['success'=>'Account was created successfully.']);
        }
    }

    public function setErrorMessages(array $errors)
    {
        if(!empty($errors))
        {
            $this->errors = $errors;
        }
    }

    public function setSuccessMessages(array $success)
    {
        if(!empty($success))
      {
        $this->success = $success;
      }
    }
}