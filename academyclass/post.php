<?php 
 class Post{
     private $conn;
     private $table= 'usersignup';
     private $table1= 'events';
     private $table2= 'courses';
     private $table3= 'category';
     private $table4= 'community';
     private $table5= 'studentpaymenttoken';
     private $table6= 'pluralcodestudents';

     public $name;
     public $category_name;
     public $email;
     public $phone;
     public $Updatename;
     public $Updateemail;
     public $Updateimage;
     public $UpdateLastname;
     public $Updatephone;
     public $image;
     public $Event_name;
     public $Event_description;
     public $Course_name;
     public $Course_description;
     public $time;
     public $ID;
     public $start_date;
     public $end_date;
     public $category_idfor_course;
     public $category_idfor_events;
     public $Course_name_search;
     public $Event_name_search;
     public $course_start_date;
     public $course_end_date;
     public $Global_search;
     public $Login_student;
     public $community_name;
     public $community_description;
     public $community_link;
     public $community_image;
     public $Lastname;
     public $payment_name;
     public $payment_lastname;
     public $payment_amount;
     public $payment_token;
     public $student_id;
     public $token_verified;
     public $paid_course;
     public $confirmed_name;
     public $confirmed_lastname;
     public $confirmed_amount;
     public $confirmed_id;
     public $confirmed_course;
     public $coursedetailsID
    public function __construct($pdo){
        $this->conn = $pdo;
    }

// app details for courses and events
public function course_details(){
    $query = 'SELECT
    c.id,
    c.category_name,
    c.image,
    c.name,
    c.description,
    c.price,
    c.startdate,
    c.enddate
    
    FROM

'.$this->table2.' c
WHERE id= :id
';

$stmt= $this->conn->prepare($query);

$stmt->bindValue(':id', $this->coursedetailsID);

$stmt->execute();
return $stmt;
   
}
//detail
public function admincourse_details(){
    $query = 'SELECT
    c.id,
    c.category_name,
    c.image,
    c.name,
    c.description,
    c.price,
    c.startdate,
    c.enddate
    
    FROM

'.$this->table2.' c
WHERE id= :id
';

$stmt= $this->conn->prepare($query);

$stmt->bindValue(':id', $this->coursedetailsID);

$stmt->execute();
return $stmt;
   
}
//sllect paid student
public function token_verify(){
    $query = 'SELECT
           s.student_id,
           s.name,
           s.lastname,
           s.coursename,
           s.amount,
           s.token
           
           FROM

       '.$this->table5.' s
       WHERE token=:token  
         
    
    
    
    ';
    
    $stmt= $this->conn->prepare($query);
    
    $stmt->bindValue(':token', $this->token_verified);

    $stmt->execute();
    return $stmt;
   
}
//app events details 
public function event_details(){
    $query = 'SELECT
           e.id,
           e.category_name,
           e.image,
           e.name,
           e.description,
           e.time,
           e.start_date,
           e.end_date,
           e.date_created
           FROM

       '.$this->table1.' e 
    WHERE id= :id  ORDER BY date_created DESC
    
    ';
    
    $stmt= $this->conn->prepare($query);
    
    $stmt->execute();
    return $stmt;
   
}
//payment 
public function create_payment(){
    $query = 'INSERT INTO

        '.$this->table5.'
           SET
           student_id=:id,
           name=:name,
           lastname=:lastname,
           coursename=:coursename,
           amount=:amount,
           token=:token
        
    
    
    
    ';
    
    $stmt= $this->conn->prepare($query);
    $stmt->bindValue(':id', $this->student_id);
    $stmt->bindValue(':name', $this->payment_name);
    $stmt->bindValue(':lastname', $this->payment_lastname);
    $stmt->bindValue(':coursename', $this->paid_course);
    $stmt->bindValue(':amount', $this->payment_amount);
    $stmt->bindValue(':token', $this->payment_token);
    


    if($stmt->execute()){
        return true;
    }
    printf("Error:%s.\n", $stmt->error);
    return false;

    

}
//verify payment token
public function token_verify(){
    $query = 'SELECT
           s.student_id,
           s.name,
           s.lastname,
           s.coursename,
           s.amount,
           s.token
           
           FROM

       '.$this->table5.' s
       WHERE token=:token  
         
    
    
    
    ';
    
    $stmt= $this->conn->prepare($query);
    
    $stmt->bindValue(':token', $this->token_verified);

    $stmt->execute();
    return $stmt;
   
}

//plural code students
public function confirmed_payment(){
    $query = 'INSERT INTO

        '.$this->table6.'
           SET
           student_id=:id,
           name=:name,
           last_name=:lastname,
           amount=:amount,
           course=:coursename
           
         
        
    
    
    
    ';
    
    $stmt= $this->conn->prepare($query);
    $stmt->bindValue(':id', $this->confirmed_id);
    $stmt->bindValue(':name', $this->confirmed_name);
    $stmt->bindValue(':lastname', $this->confirmed_lastname);
    $stmt->bindValue(':amount', $this->confirmed_amount);
    $stmt->bindValue(':coursename', $this->confirmed_course);

   
    


    if($stmt->execute()){
        return true;
    }
    printf("Error:%s.\n", $stmt->error);
    return false;

    

}
//community

public function create_community(){
    $query = 'INSERT INTO
        
        '.$this->table4.'
           SET
           name=:name,
           image=:image,
           description=:description,
           link=:link
        
    
    
    
    ';
    
    $stmt= $this->conn->prepare($query);
    
    $stmt->bindValue(':name', $this->community_name);
    $stmt->bindValue(':image', $this->community_image);
    $stmt->bindValue(':description', $this->community_description);
    $stmt->bindValue(':link', $this->community_link);
    


    if($stmt->execute()){
        return true;
    }
    printf("Error:%s.\n", $stmt->error);
    return false;

    

}
//end of community
//select community
public function sellect_community(){
    $query = 'SELECT
           c.name,
           c.image,
           c.description,
           c.link
           
           FROM

       '.$this->table4.' c
         
         
    
    
    
    ';
    
    $stmt= $this->conn->prepare($query);
 
    $stmt->execute();
    return $stmt;
   
}

//end community
//user signup pluralcode mobile app
    public function studentsignup_check(){
        $query = 'SELECT
               u.name,
               u.lastname,
               u.email,
               u.phone_number
              
               
               FROM

           '.$this->table.' u
         WHERE email= :email     
             
        
        
        
        ';
        
        $stmt= $this->conn->prepare($query);
        
       
        $stmt->bindValue(':email', $this->email);
      
    
    
        $stmt->execute();
        return $stmt;
       
    }

public function studentsignup(){
    $query = 'INSERT INTO
        
        '.$this->table.'
           SET
           name=:name,
           student_image= "http//",
           lastname= :lastname,
           email=:email,
           phone_number=:number
           
    
    
    
    ';
    
    $stmt= $this->conn->prepare($query);
    
    $stmt->bindValue(':name', $this->name);
    $stmt->bindValue(':lastname', $this->Lastname);
    $stmt->bindValue(':email', $this->email);
    $stmt->bindValue(':number', $this->phone);
 


    if($stmt->execute()){
        return true;
    }
    printf("Error:%s.\n", $stmt->error);
    return false;

    

}

//student profile update
public function students_update(){
    $query = 'UPDATE
          '.$this->table.'
           SET
           name=:name,
           student_image= :studentimage,
           lastname= :lastname,
           email=:email,
           phone_number=:number
    
      WHERE id=:id
    ';
    $stmt= $this->conn->prepare($query);
    $stmt->bindValue(':id', $this->ID);
    $stmt->bindValue(':name', $this->Updatename);
    $stmt->bindValue(':studentimage', $this->Updateimage);
    $stmt->bindValue(':lastname', $this->UpdateLastname);
    $stmt->bindValue(':email', $this->Updateemail);
    $stmt->bindValue(':number', $this->Updatephone);
    $stmt->execute();
    return $stmt;
}

public function students_info(){
    $query = 'SELECT
           u.id,
           u.name,
           u.lastname,
           u.email,
           u.phone_number
           
           
           FROM

       '.$this->table.' u
       
    ';
    
    $stmt= $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
   
}
//END of usersignup

//select events pluralcode mobile app
public function pluralcode_events(){
    $query = 'SELECT
           e.category_name,
           e.image,
           e.name,
           e.description,
           e.time,
           e.start_date,
           e.end_date,
           e.date_created
           FROM

       '.$this->table1.' e 
     ORDER BY date_created DESC
    
    ';
    
    $stmt= $this->conn->prepare($query);
    
    $stmt->execute();
    return $stmt;
   
}
//END of select events

//Select courses for pluralcode mobile app
public function pluralcode_courses(){
    $query = 'SELECT
           c.category_name,
           c.image,
           c.name,
           c.description,
           c.price,
           c.startdate,
           c.enddate
           
           FROM

       '.$this->table2.' c

    ';
    
    $stmt= $this->conn->prepare($query);
  


    $stmt->execute();
    return $stmt;
   
}
// END select courses


// Create courses plural code Admin only
public function create_courses(){
    $query = 'INSERT INTO
        
        '.$this->table2.'
           SET
           category_name = :id,
           
           image=:image,
           name=:name,
           description=:description,
           price = :price,
           startdate = :coursedate,
           enddate = :courseenddate
         
    
    
    
    ';
    
    $stmt= $this->conn->prepare($query);
    $stmt->bindValue(':id', $this->category_idfor_course);
    $stmt->bindValue(':image', $this->image);
    $stmt->bindValue(':name', $this->Course_name);
    $stmt->bindValue(':description', $this->Course_description);
    $stmt->bindValue(':price', $this->price);
    $stmt->bindValue(':coursedate', $this->course_start_date);
    $stmt->bindValue(':courseenddate', $this->course_end_date);


    if($stmt->execute()){
        return true;
    }
    printf("Error:%s.\n", $stmt->error);
    return false;

    

}
// END of create courses

//create pluralcode Events only admin
public function create_Event(){
    $query = 'INSERT INTO
        
        '.$this->table1.'
           SET
           category_name =:id,
           image=:image,
           name=:name,
           description=:description,
           time=:time,
           start_date=:startdate,
           end_date=:enddate

    ';
    
    $stmt= $this->conn->prepare($query);
    $stmt->bindValue(':id', $this->category_idfor_events);
    $stmt->bindValue(':image', $this->image);
    $stmt->bindValue(':name', $this->Event_name);
    $stmt->bindValue(':description', $this->Event_description);
    $stmt->bindValue(':time', $this->time);
    $stmt->bindValue(':startdate', $this->start_date);
    $stmt->bindValue(':enddate', $this->end_date);
    
    if($stmt->execute()){
        return true;
    }
    printf("Error:%s.\n", $stmt->error);
    return false;

    

}
//End pluralcode Event
//create category
public function create_category(){
    $query = 'INSERT INTO
        
        '.$this->table3.'
           SET       
           name=:name
          

    ';
    
    $stmt= $this->conn->prepare($query);
    $stmt->bindValue(':name', $this->category_name);
    
    
    if($stmt->execute()){
        return true;
    }
    printf("Error:%s.\n", $stmt->error);
    return false;

    

}
//end of create category admin only
//select category
public function pluralcode_courses_and_events_category(){
    $query = 'SELECT
           c.id,
           c.name
           
           FROM

       '.$this->table3.' c

    ';
    
    $stmt= $this->conn->prepare($query);
  


    $stmt->execute();
    return $stmt;
   
}
//global search
public function pluralcode_courses_search(){
    $query = 'SELECT
           c.category_name,
           c.image,
           c.name,
           c.description,
           c.price,
           c.startdate,
           c.enddate
           FROM

       '.$this->table2.' c
     WHERE name LIKE :name 
    ';
    
    $stmt= $this->conn->prepare($query);
    $stmt->bindValue(':name', "%$this->Global_search%");


    $stmt->execute();
    return $stmt;
   
}
public function pluralcode_events_search(){
    $query = 'SELECT
           e.category_name,
           e.image,
           e.name,
           e.description,
           e.time,
           e.start_date,
           e.end_date,
           e.date_created
           FROM

       '.$this->table1.' e 
     WHERE name LIKE :name ORDER BY date_created DESC
    
    ';
    
    $stmt= $this->conn->prepare($query);
    $stmt->bindValue(':name', "%$this->Global_search%");
    $stmt->execute();
    return $stmt;
   
}
 }