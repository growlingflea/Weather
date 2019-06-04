<?php
/**
 * Created by PhpStorm.
 * User: growlingflea
 * Date: 6/29/17
 * Time: 1:31 PM
 */

//todo:fix the city/state thing.
Class Request{
// GET http://api.wunderground.com/api/7e2cca72990f20eb/features/settings/q/query.format

    public $connection;
    private $key = "16413eb1525e00184c3961ef13f66968";

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

        //$link = "http://api.wunderground.com/api/$this->key/$features/$q/$query.json";
        $link = "http://api.openweathermap.org/data/2.5/weather?zip=$query,us&APPID=$this->key";
        $json_string = file_get_contents($link);
        return $json_string;

    }

    public function getCity($json_string){

        return $json_string->name;


    }

    public function getTempF($json_string){

        $k = $json_string->main->temp;
        $f = ($k - 273.15) * 9/5 + 32;
        return ceil($f);
    }

    public function getTempC($json_string){

        $k = $json_string->main->temp;
        $c = ($k - 273.15);
        return ceil($c);
    }








}

$request = new Request();

?>