<?php
 header('Access-Control-Allow-Origin:*');
 header('Content-Type:application/json');

 include_once('../database/config.php');
 include_once('../academyclass/post.php');

 $database = new Database();
 $pdo = $database->connect();
 $post= new Post($pdo);

 $result = $post->pluralcode_courses_and_events_category();
 $count = $result->rowCount();
  if ($count > 0){
      $array = array();
      while($row= $result->fetch(PDO::FETCH_ASSOC)){
          extract($row);
        $array_items = array(
              'id' => $row['id'],
              'name' => $row['name']

        );
   array_push($array, $array_items);
      }
      echo json_encode($array);
  }