<?php

class View
{
    private $vars = [];

    private $template = "";

    //store file name for template to be rendered
    public function setTemplate(string $filename)
    {
        //no file received
        if(empty($filename)){
            die('invalid filename received');
        }
        // file added does not exist
        if(!file_exists($filename))
        {
            die('HTML template does not exist');
        }
        $this->template = $filename;
    }

    //pass data to the template
    public function addVar($name, $value) 
    {
        $this->vars[$name] = $value;
    }

    public function addVars(array $variables){
        foreach($variables as $key => $value)
        {
            $this->vars[$key] = $value;
        }
    }

    //display view

    public function display() 
    {
        extract($this->vars);
        require $this->template;
    }
}
?>