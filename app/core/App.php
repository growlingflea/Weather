<?php

/**
 * Created by PhpStorm.
 * User: growlingflea
 * Date: 9/11/17
 * Time: 9:28 PM
 */
class App
{

    protected $defaultMethod = "index";
    protected $defaultController = "Home";
    protected $parameters = [];


    private $ctrl_str = '../app/controllers/';

    public function __construct()
    {
        $url = $this->processURL();
        $destination = $this->ctrl_str.$url[0].".php";

        if(file_exists($destination)){
            $this ->defaultController = $url[0];
            unset($url[0]);
        }


        require_once($this->ctrl_str.$this->defaultController.'.php');
    }





    public function processURL(){

        if(isset($_GET['url'])) {

            return $url = explode('/'.filter_var(rtrim( $_GET['url'] , '/'), FILTER_SANITIZE_URL));
        }

    }


}