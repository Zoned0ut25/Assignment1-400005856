<?php

class ResearchDashboardController extends AbstractController
{
    protected $errors = [];

    protected function makeModel(): Model
    {
        return new Model("root", "", "user_management_system", "localhost");
    }

    protected function makeView() : View {
        $view = new View();
        $view->setTemplate(TEMPLATE_DIR.'/research.tpl.php');
        return $view;
    }

    public function start(){
        $this->view = $this->makeView();
        $auth = new AuthenticationController();

        if(!$auth->isUserLoggedIn()){
            header('location:../index.php');
        }

        if($_SESSION["session_user"] && $_SESSION["session_user"]["role"] === "Research Study Manager"){
            header('location:../index.php');
        }

        if($_SESSION["session_user"] && $_SESSION["session_user"]["role"] === "Researcher"){
            header('location:../index.php');
        }
        $this->view->display();
    }
}