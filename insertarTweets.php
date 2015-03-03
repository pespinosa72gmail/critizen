<?php

if (empty($argv[1])){
    echo "Por favor, introduce un hashtag para ejecutar el script.\n";
    exit();
}

require "twitteroauth/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;

$consumer = "jAAFKASjToghbnpXc4H7QKlOs";
$consumersecret = "3ZeFajgeVaZDSsvDN4ChYA5ttVDjqybUq4eqZRE7JzLNwj4Qwk";
$accesstoken = "297911663-MyqSJvcRqrBiZe5xRZsTvjeVbAPqMeOp7ULLzHI4";
$accesstokensecret = "vPL9yYKbLNcPR7T7cOy2ky9f4ceIR9xhh3OS5tVl3HMUZ";

function insertarTweets($tweet) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "critizen";

// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO tweets (body, picture) VALUES ('".addslashes($tweet->text)."', '".addslashes($tweet->user->profile_image_url)."')";

    if ($conn->query($sql) === TRUE) {
        echo "Insertado tweet...\n";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

$connection = new TwitterOAuth($consumer, $consumersecret, $accesstoken, $accesstokensecret);
echo "Conectando a twitter...search/tweets...buscando#" . $argv[1];
$tweets = $connection->get("search/tweets", array("q" => "#" . $argv[1]));
foreach ($tweets as $tweet) {
    //var_dump($tweet);
    foreach ($tweet as $t) {
        if (is_object($t)) {
            insertarTweets($t);
        }
    }
}
?>