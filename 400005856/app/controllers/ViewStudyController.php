<?php

class ViewStudyController extends AbstractController
{
    protected $errors = [];

    protected function makeModel(): Model
    {
        return new ViewStudyModel("root", "", "user_management_system", "localhost");
    }

    protected function makeView() : View {
        $view = new View();
        $view->setTemplate(TEMPLATE_DIR.'/dashboard.tpl.php');
        return $view;
    }

    public function start(){
        $vars = [];
        $this->model = $this->makeModel();
        $this->view = $this->makeView();
        $auth = new AuthenticationController();

        if(!$auth->isUserLoggedIn()){
            header('location: ../index.php');
        }

        if(isset($_GET["study_id"])){
            $data = $this->model->find("studies", $_GET);
            $this->view->addVar('data', $data);
        }

        if(isset($_SESSION["session_user"]) && ($_SESSION["session_user"]["role"] === "Research Group Manager" || $_SESSION["session_user"]["role"] === "Research Study Manager")){
            if(isset($_GET["delete"]) && isset($_POST["confirm"])){
                $this->model->del(["studies"], $_GET);
            }
        }
        $this->view->display();
    }
}