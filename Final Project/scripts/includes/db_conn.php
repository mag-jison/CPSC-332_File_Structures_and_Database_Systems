<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$db = "university_database";

$link = mysqli_connect($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n". $link->error);
