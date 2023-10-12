<?php

class CreateStudyController extends AbstractController
{
    protected $errors = [];

    protected function makeModel(): Model
    {
        return new Model("root", "", "user_management_system", "localhost");
    }

    protected function makeView() : View {
        $view = new View();
        $view->setTemplate(TEMPLATE_DIR.'/create_study.tpl.php');
        return $view;
    }

    public function start(){
        $this->view = $this->makeView();
        $auth = new AuthenticationController();

        if(!$auth->isUserLoggedIn()){
            header('location:../index.php');
        }
        $this->view->display();
    }
}