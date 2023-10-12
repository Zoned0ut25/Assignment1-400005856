<?php

class DashboardController extends AbstractController
{
    protected $errors = [];

    protected function makeModel(): Model
    {
        return new DashboardModel("root", "", "user_management_system", "localhost");
    }

    protected function makeView() : View {
        $view = new View();
        $view->setTemplate(TEMPLATE_DIR.'/dashboard.tpl.php');
        return $view;
    }

    public function start(){
        $this->model = $this->makeModel();
        $this->view = $this->makeView();
        $auth = new AuthenticationController();

        if(!$auth->isUserLoggedIn()){
            header('location: ../index.php');
        }

        // $data = $this->model->findall("studies");
        // $this->view->addVar('data', $data);

        if(isset($_SESSION["session_user"]) && ($_SESSION["session_user"]["role"] === "Research Group Manager" || $_SESSION["session_user"]["role"] === "Research Study Manager")){
            if(isset($_GET["delete"]) && isset($_POST["confirm"])){
                $this->model->del(["studies"], $_GET);
            }
        }
        $this->view->display();
    }
}