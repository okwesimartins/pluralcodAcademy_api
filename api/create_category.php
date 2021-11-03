<?php
 header('Access-Control-Allow-Origin:*');
 header('Content-Type:application/json');

 include_once('../database/config.php');
 include_once('../academyclass/post.php');

 $database = new Database();
 $pdo = $database->connect();
 $post= new Post($pdo);

 $post->category_name = isset($_POST['category_name']) ? $_POST['category_name'] : die();
 
 if($post->create_category()){
    $array= array();
      $arrayitem= array(
          "success" => "category have been created successfully"
      );
      array_push($array, $arrayitem);

      echo json_encode($array);
 }