<?php
/**
 * Created by PhpStorm.
 * User: growlingflea
 * Date: 11/11/15
 * Time: 10:41 PM
 */
require_once "nusoap.php";

function getProd($category) {
    if ($category == "books") {
        return join(",", array(
            "The WordPress Anthology",
            "PHP Master: Write Cutting Edge Code",
            "Build Your Own Website the Right Way"));
    }
    else {
        return "No products listed under that category";
    }
}

$server = new soap_server();
$server->register("getProd");
$server->service($HTTP_RAW_POST_DATA);

?>