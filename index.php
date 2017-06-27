<?php
echo'
<!DOCTYPE html>
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
            <li><a href="index.php?city=Portland">Home</a></li>
            <li><a href="index.php"></a></li>
            <li><a href="index.php"></a></li>
            <li><a href="index.php"></a></li>
			<li><a href="index.php"></a></li>
			<li><a href="index.php"></a></li>
          </ul>
         
        </div><!--/.nav-collapse -->
      </div><!-- /.container -->
    </div> <!-- NavBar -->
	
'
?>
<div class="container">
    <!-- Example row of columns -->
    <div class="row">
        <div id = "equalheight">
            <div class="col-md-8 col-sm-4 align">

            <form>
                Enter Your City
                <input type="text" name="city" value="Portland">
                <input type="submit" value="Submit">
                <br>

            </form>
            <?php

            $CountryName = "United States";
            //Create the client object
            $soapclient = new SoapClient('http://www.webservicex.net/globalweather.asmx?WSDL');
            //Use the functions of the client, the params of the function are in
            //the associative array
            $params = array('CountryName' => "$CountryName", 'CityName' => $_GET['city']);

            $response = $soapclient->getWeather($params);
            if (is_soap_fault($response)) {

            echo "<br>";


            }else {

                echo "<h3>Hello $xml->Location</h3><br>";
                $xml = simplexml_load_string(preg_replace('/(<\?xml[^?]+?)utf-16/i', '$1utf-8', $response->GetWeatherResult));
                echo "The Temperature is <b>" . $xml->Temperature . "</b>";

                $temp = explode('F', $xml->Temperature);
                $temp = intval($temp[0]);
                echo "<br><br>";
                switch ($temp) {

                    case ($temp > 70):
                        echo "An ice cold beer is in order!";
                        break;
                    case ($temp < 70 && $temp > 45):
                        echo "Whiskey";
                        break;
                    case ($temp < 45):
                        echo "Hot Toddie";
                        break;
                }

            }


            ?>
            </div>
        </div>
    </div>
</div>




