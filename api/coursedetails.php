<?php
 header('Access-Control-Allow-Origin:*');
 header('Content-Type:application/json');

 include_once('../database/config.php');
 include_once('../academyclass/post.php');

 $database = new Database();
 $pdo = $database->connect();
 $post= new Post($pdo);

$post->coursedetailsID = isset($_POST['id']) : $_POST['id'] ? die();
 $events=$post->course_details();
 $results=$events->rowCount();
 if($results > 0){
     $array=array();

     while($row = $events->fetch(PDO::FETCH_ASSOC)){
         extract($row);
         $array_item= array(
             'name' => $row['name'],
             'description' => $row['description'],
             'price' => $row['price'],
             'start_date' => $row['startdate'],
             'end_date' => $row['enddate']
             
         );

        array_push($array,  $array_item);
     }
     echo json_encode($array);
 }