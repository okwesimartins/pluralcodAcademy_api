<?php
 header('Access-Control-Allow-Origin:*');
 header('Content-Type:application/json');

 include_once('../database/config.php');
 include_once('../academyclass/post.php');

 $database = new Database();
 $pdo = $database->connect();
 $post= new Post($pdo);

 $post->community_name = isset($_POST['communityname']) ? $_POST['communityname'] : die();
 $post->community_description = isset($_POST['communitydescription']) ? $_POST['communitydescription'] : die();
 $post->community_image = isset($_POST['community_image']) ? $_POST['community_image'] : die();
 $post->community_link = isset($_POST['community_link']) ? $_POST['community_link'] : die();
 
 if(empty( $post->community_name ) || empty(  $post->community_description ) || empty(  $post->community_image ) || empty(  $post->community_link ) ){
     echo json_encode(array("message" => "All fields are required"));
 }
 else{
 if($post->create_community()){
     $array=array();
     $array_item=array("status" => "success", "message" => "community created");

     array_push($array, $array_item);

     echo json_encode($array);
    
 }}