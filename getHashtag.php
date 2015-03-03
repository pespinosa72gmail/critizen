<?php
require "twitteroauth/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;

$consumer = "jAAFKASjToghbnpXc4H7QKlOs";
$consumersecret = "3ZeFajgeVaZDSsvDN4ChYA5ttVDjqybUq4eqZRE7JzLNwj4Qwk";
$accesstoken = "297911663-MyqSJvcRqrBiZe5xRZsTvjeVbAPqMeOp7ULLzHI4";
$accesstokensecret = "vPL9yYKbLNcPR7T7cOy2ky9f4ceIR9xhh3OS5tVl3HMUZ";

$connection = new TwitterOAuth($consumer, $consumersecret, $accesstoken, $accesstokensecret);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Critizen Test</title>
    </head>
    <body>
        <form action="" method="POST">
            <label><input type="text" name="keyword"></label>
        </form>
        <?php
        if (isset($_POST['keyword'])) {
            $tweets = $connection->get("search/tweets", array("q" => "#" . $_POST['keyword']));
            foreach ($tweets as $tweet) {
                //var_dump($tweet);
                foreach ($tweet as $t) {
                    if (is_object($t))
                        echo '<img src=' . $t->user->profile_image_url . '/>' . $t->text . "<br>";
                }
            }
        }
        ?>
    </body>
</html>