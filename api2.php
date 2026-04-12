<?php
 


 if($_SERVER["REQUEST_METHOD"]==="OPTIONS"){
    http_response_code(200);
    exit();
 }

 include "db1.php";

 if($_SERVER["REQUEST_METHOD"]==="GET"){
    $result=$conn->query("SELECT * from users");
    if($result){
        echo json_encode(["error"=>$conn->error]);
    }
    $data=[];
    while($row=result->fetch_assoc()){
        $data[]=$row;
    }
    echo json_encode($data);
 }

 if($_SERVER["REQUEST_METHOD"]==="DELETE"){
    $id=$_GET["id"];
    $stmt=$conn->prepare("DELETE FROM users WHERE id=? ");
    $stmt->bind_params("i",$id);
    $stmt->execute();
    echo json_encode(["message"=>"deleted successfully"]);


 }
 if($_SERVER["REQUEST_METHOD"]==="POST"){
    $data=json_decode(file_get_contents("php://input"));
    $name=$data->name;
    $email=$data->email;
    $stmt=$conn->prepare("INSERT INTO users (name,email) VALUES (?,?)");
    $stmt->bind_params("ss",$name,$email);
    $stmt->execute();

    echo json_encode(["message"=>"inserted successfully"]);


 }

 if($_SERVER["REQUEST_METHOD"]==="GET"){
   $page=isset($_GET["page"])?$_GET["page"]:1;
   $limit=5;
   $offset=($page-1)*limit;

   $stmt=$conn->prepare("SELECT * FROM users LIMIT ? OFFSET ?");
   $stmt->bind_params("ii",$page,$limit);
   $stmt->execute();
   $result=$stmt->get_result();
   $data=[];
   while($row=$result->fetch_assoc()){
       $data=$row;
   }
   echo json_encode($data);

 }


?>