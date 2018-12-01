<?php

class Bootstrap{
    private $controller;
    private $action;
    private $request;

    public function __construct($request){
      $this->request = $request;
      if($this->request['controller'] == ""){
          $this->controller = 'home';
      }else{
          $this->controller = $this->request['controller'];
      }
      if($this->request['action'] == ""){
          $this->action = 'index';
      }else{
            $this->action = $this->request['action'];
      }
      
    }

    public function createController(){
        //Checar clases
        if(class_exists($this->controller)){
            $parents = class_parents($this->controller);
            //Check Extend
            if(in_array("Controller", $parents)){
                if(method_exists($this->controller, $this->action)){
                    return new $this->controller($this->action, $this->request);
                } else {
                  //Method does not exists  
                  echo '<h1>Method does not Exist</h1>';
                  return;
                }
            } else {
                //Base controller does not exists  
                echo '<h1>Base Controller not found</h1>';
                return;
            }
            } else {
            //Controller does not exists  
            echo '<h1>Controller class does not Exist</h1>';
            return;
        }
    }
}