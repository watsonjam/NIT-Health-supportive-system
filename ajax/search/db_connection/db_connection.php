<?php
/*
DATABASE SERVER
  => Server: 127.0.0.1 via TCP/IP
  => Server type: MariaDB
  => Server version: 10.1.13-MariaDB - mariadb.org binary distribution
  => Protocol version: 10
  => User: root@localhost
  => Server charset: UTF-8 Unicode (utf8)

SET DEFAULT TIMEZONE*/
date_default_timezone_set('Africa/Nairobi');

 /*DATABASE CONNECTION */
$servername = "127.0.0.1";
$username = "root";
$password = "";
$db_name='nit_health_supportive';

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
/*DATABASE SELECTION*/
$select_db=mysqli_select_db($conn,$db_name);
if(!$select_db){
	echo'Unable to select database'.mysql_error();
}
?>