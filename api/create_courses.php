<?php
 header('Access-Control-Allow-Origin:*');
 header('Content-Type:application/json');

 include_once('../database/config.php');
 include_once('../academyclass/post.php');

 $database = new Database();
 $pdo = $database->connect();
 $post= new Post($pdo);
 /*
 $post->category_idfor_course = isset($_POST['category_name']) ? $_POST['category_name'] : die();
 $post->image = isset($_POST['image']) ? $_POST['image'] : die();
 $post->Course_name = isset($_POST['course_name']) ? $_POST['course_name'] : die();
 $post->Course_description = isset($_POST['course_description']) ? $_POST['course_description'] : die();
 $post->price = isset($_POST['price']) ? $_POST['price'] : die();
 $post->course_start_date = isset($_POST['startdate']) ? $_POST['startdate'] : die();
 $post->course_end_date = isset($_POST['enddate']) ? $_POST['enddate'] : die();
 */

$json= file_get_contents('php://input');
$data=json_decode($json,true);

 if($_SERVER['REQUEST_METHOD']==='POST'){
    $post->category_idfor_course = $data['categoryname'];
    $post->image = $data['image'];
    $post->Course_name = $data['coursename'];
    $post->Course_description = $data['coursedescription'];
    $post->price = $data['price'];
    $post->course_start_date = $data['startdate'];
    $post->course_end_date =  $data['startdate'];


 if(empty($post->category_idfor_course) || empty($post->image) || empty($post->Course_name) || empty($post->Course_description) || empty( $post->price ) || empty($post->course_start_date)  || empty($post->course_end_date) ){
    echo json_encode(array("status" =>"failed","message" => "All fields are required"));
  }
 else{
 if($post->create_courses()){
     $array=array();
     $array_item=array("status" => "success", "message" => "course created");
     array_push($array, $array_item);                                        
     echo json_encode($array);
    
 }}}