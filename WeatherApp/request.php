<?php
/**
 * Created by PhpStorm.
 * User: growlingflea
 * Date: 6/29/17
 * Time: 1:31 PM
 */
Class Request{
// GET http://api.wunderground.com/api/7e2cca72990f20eb/features/settings/q/query.format

    public $connection;
    private $key = "7e2cca72990f20eb";

    function ___construct(){



    }



    public function list_cities_by_state($state){

    }

    public function list_city_by_zip($zip){

    }

    public function get_weather_by_state($state){



    }

    public function get_weather_by_city($city){


    }

    public function get_state_by_city($city){


    }


    public function getWeather($features = "conditions",  $q = 'q', $query = "OR/Portland" ){

        $link = "http://api.wunderground.com/api/$this->key/$features/$q/$query.json";
        $json_string = file_get_contents($link);
        return $json_string;

    }










}

$request = new Request();

?>