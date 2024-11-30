<!DOCTYPE html>
<head>
<title> Output from the Plant Gallery Database </title>
<link rel='stylesheet' type='text/css' href='css/galleryStyle.css'>
</head>
<body>
<?php
require_once __DIR__ . '/vendor/autoload.php';


use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
 
//2: connect to collection (that exists):
try {

    
//1: connect to mongodb atlas
$client = new MongoDB\Client($_ENV['MONGO_URI']);

$collection = $client->CART351->plantItems;

$result = $collection->find([]);
echo("valid connection");
 echo ("</br>");
        echo "<h3> Query Results:::</h3>";
 
        echo "<div id='back'>";
 
        foreach ($result as $galleryItem) {
 
            //go through each doc
 
            echo "<div class ='outer'>";
            echo "<div class ='content'>";
 
            foreach ($galleryItem as $key => $value) {
                if ($key != "imagePath" && $key != "birthDate") {
 
                    echo ("<p>" . $key . " : " . $value . "</p>");
                }
 
                if ($key == "birthDate") {
                    $dateTime = $value->toDateTime();
                    echo ("<p>" . $key . " :" . $dateTime->format('r') . "</p>");
 
                }
 
 
            }
            //end content
            // put image in last
            echo "</div>";
            $imagePath = $galleryItem["imagePath"];
            echo "<img src = $imagePath \>";
 
            //end outer
            echo "</div>";
 
        }
        //end back
        echo "</div>";

        

}
catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
?>
</body>
</html>
