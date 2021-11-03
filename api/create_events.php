<?php
 header('Access-Control-Allow-Origin:*');
 header('Content-Type:application/json');

 include_once('../database/config.php');
 include_once('../academyclass/post.php');

 $database = new Database();
 $pdo = $database->connect();
 $post= new Post($pdo);

 $json= file_get_contents('php://input');
$data=json_decode($json,true);

 if($_SERVER['REQUEST_METHOD']==='POST'){
     
   
$post->category_idfor_events=$data['category_name'];
$post->image = $data['image'];
$post->Event_name = $data['name'];
$post->Event_description  = $data['description'];
$post->time = $data['time'];
$post->start_date = $data['startdate'];
$post->end_date = $data['enddate'];
/*
 $post->category_idfor_events = isset($_POST['category_name']) ? $_POST['category_name'] : die();
 $post->image = isset($_POST['image']) ? $_POST['image'] : die();
 $post->Event_name = isset($_POST['name']) ? $_POST['name'] : die();
 $post->Event_description = isset($_POST['description']) ? $_POST['description'] : die();
 $post->time = isset($_POST['time']) ? $_POST['time'] : die();
 $post->start_date = isset($_POST['startdate']) ? $_POST['startdate'] : die();
 $post->end_date = isset($_POST['enddate']) ? $_POST['enddate'] : die();
*/
 if(empty(  $post->category_idfor_events  ) || empty( $post->image ) || empty(  $post->Event_name) || empty(    $post->Event_description   ) || empty(  $post->time ) || empty(   $post->start_date ) || empty(  $post->end_date )){
    echo json_encode(array("status" =>"failed","message" => "All fields are required"));
  }
  else{
 if($post->create_Event()){
    $array=array();
    $array_item=array("status" => "success", "message" => "Event created");

    array_push($array, $array_item);

    echo json_encode($array);
   
}}}