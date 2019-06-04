<?php
/**
 * Created by PhpStorm.
 * User: growlingflea
 * Date: 7/11/17
 * Time: 2:30 PM
 */
?>
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
                } else {

                    $locale = false;
                }

                if($locale) {
                    $request = new Request();

                    $json_string = $request->getWeather("conditions", 'q', $locale);
                    $parsed_json = json_decode($json_string);
                    $location = $request->getCity($parsed_json);
                    $temp_f = $request->getTempF($parsed_json);
                    echo "Current temperature in $location is: $temp_f\n";

                    //make sure that there are no SOAP failures
                    if (!$location) {

                        echo "<br> <b>Please enter either a zipcode or a City and State</b> <br>";


                    } else if ($location) { //Check to see if there is a location.  If there isn't a location, there must be an issue.

                        echo "<h3>Hello $location </h3><br>";

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
                    } else if (0) {

                        $xml = $soapclient->getCitiesByCountry("United States");


                    }

                }else{

                    echo "No request made";
                }


                ?>