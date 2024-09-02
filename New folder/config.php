<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "certificatedb");

if (!$conn) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	die();
}
