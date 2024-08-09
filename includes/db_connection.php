<?php
/*
DATABASE SERVER
-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2020 at 02:49 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.31

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