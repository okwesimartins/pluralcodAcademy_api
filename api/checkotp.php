<?php 
session_start();

header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');

include_once('../database/config.php');
include_once('../academyclass/post.php');

$otpcheck = isset($_POST['otpcheck']) ? $_POST['otpcheck'] : die();
 
if($_SESSION['otp'] == $otpcheck){
    echo json_encode(array("status" => "success", "message" => "otp verified"));
}else{
    echo json_encode(array("status" => "failed", "message" => "otp not verified"));
}