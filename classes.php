<?php
include_once("mysqli_conn.php");

class Shortener{
    public $ID;
    public $link;
    public $short_link;
 

 public function createShortLink() {
    $charset = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    $base = strlen($charset);
    $result = '';

    $now = explode(' ', microtime())[1];
    while ($now >= $base){
        $i = $now % $base;
        $result = $charset[$i] . $result;
        $now /= $base;
    }
    $this->short_link = substr($result, -5);
}
 }
?>