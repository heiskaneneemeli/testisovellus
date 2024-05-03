<!-- yhteys tietokantaan -->

<?php
    if (!defined('HOSTNAME')) {
        define('HOSTNAME', 'db');
    }

    if (!defined('USERNAME')) {
        define('USERNAME', 'rfwhzjke');
    }

    if (!defined('PASSWORD')) {
        define('PASSWORD', 'n5+JwC35*niV1Z');
    }

    if (!defined('DATABASE')) {
        define('DATABASE', 'rfwhzjke');
}

?>

<?php

    $connection = mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DATABASE);

    if(!$connection)
    {
        die("Yhteys epäonnistui");
    }

?>