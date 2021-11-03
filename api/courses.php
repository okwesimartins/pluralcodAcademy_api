<?php
 header('Access-Control-Allow-Origin:*');
 header('Content-Type:application/json');

 include_once('../database/config.php');
 include_once('../academyclass/post.php');

 $database = new Database();
 $pdo = $database->connect();
 $post= new Post($pdo);

 $events=$post->pluralcode_courses();
 $results=$events->rowCount();
 if($results > 0){
     $array=array();

     while($row = $events->fetch(PDO::FETCH_ASSOC)){
         extract($row);
         $array_item= array(
             
             'image' => $row['name'],
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