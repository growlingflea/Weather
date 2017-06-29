<!DOCTYPE html>
<?php require_once("request.php") ?>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>What Should I Drink</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dist/starter-template.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dist/grid.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don\'t actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">What Should I Drink?</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Home</a></li>
                <li><a href="index.php"></a></li>
                <li><a href="index.php"></a></li>
                <li><a href="index.php"></a></li>
                <li><a href="index.php"></a></li>
                <li><a href="index.php"></a></li>
            </ul>

        </div><!--/.nav-collapse -->
    </div><!-- /.container -->
</div> <!-- NavBar -->



<div class="container">
    <!-- Example row of columns -->
    <div class="row">
        <div id = "equalheight">
            <div class="col-md-8 col-sm-4 align">
                <table border="1">
                    <form>

                        <tr><td> City</td><td><input type="text" name="city" value=""></td></tr>
                        <tr><td> State</td><td>  <input type="text" name="state" value=""></td></tr>
                        <tr><td> Zipcode</td><td><input type="text" name="zip" value=""></td></tr>

                        <tr><td><input type="submit" value="Submit"></td></tr>

                    </form>
                </table>
                <?php

                if($_GET['city'] && $_GET['state']){

                    $locale = $_GET['state']."/".$_GET['city'];

                }else if (isset($_GET['zip'])){

                    $locale = $_GET['zip'];
                }else{

                    $locale = "97214";
                }

                $request = new Request();

                $json_string = $request -> getWeather("conditions", 'q', $locale );
                $parsed_json = json_decode($json_string);
                $location = $parsed_json->{'current_observation'}->{'display_location'}->{'full'};
                $temp_f = $parsed_json->{'current_observation'}->{'temp_f'};
                echo "Current temperature in $location is: $temp_f\n";

                //make sure that there are no SOAP failures
                if (!$location) {

                    echo "<br> <b>Please enter either a zipcode or a City and State</b> <br>";


                }else if($location) { //Check to see if there is a location.  If there isn't a location, there must be an issue.

                    echo "<h3>Hello $response->Location</h3><br>";

                    echo "The Temperature is <b>" . $temp_f . "</b>";

                    echo "<br><br>";
                    switch ($temp_f) {
                        case($temp_f > 90):
                            echo "Whoa tiger, I see iced Rum drinks and nakedness in your future!";
                        case ($temp_f > 70):
                            echo "An ice cold beer is in order!";
                            break;
                        case ($temp_f < 70 && $temp_f > 45):
                            echo "If you're gonna warm up you better finish that bottle of Whiskey";
                            break;
                        case ($temp_f < 45 && $temp_f > 0):
                            echo "6 Hot Toddies and a Cinnamon Stick";
                            break;
                        case($temp_f < 0):
                            echo "don't freeze your ass off, two bottles of Vodka and a hottub";
                    }

                    //The Location isn't valid.  We will list the locations that match most of the entry.
                    //If there isn't a match afterwards we can display an error
                    //todo: we can make this international
                }else if(0){

                    $xml = $soapclient->getCitiesByCountry("United States");


                }


                ?>
            </div>
        </div>
    </div>
</div>




