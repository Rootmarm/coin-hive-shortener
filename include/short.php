<?php

/**
 * coin-hive-shortener Doc Comment
 *
 * @category dirty hack
 * @package  coin-hive-shortener
 * @author   rootmarm
 * @license  none
 * @link     http://www.github.com/rootmarm/coin-hive-shortener
 *
 */


require '../vendor/autoload.php';
require 'config.php';

$config = include 'config.php';

    //Checking for POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     
    //Variables
    $longUrl = $_POST['longurl'];
    $ch = curl_init();
    $hashes = $config['hashes'];
    $secret = $config['secret'];


    //Curl
    curl_setopt($ch, CURLOPT_URL, "https://api.coin-hive.com/link/create");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "url=$longUrl&hashes=$hashes&secret=$secret");
    curl_setopt($ch, CURLOPT_POST, 1);

    $headers = array();
    $headers[] = "Content-Type: application/x-www-form-urlencoded";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);

}
//Decode
$json = json_decode($result, true);
echo $json['url']
        ?>