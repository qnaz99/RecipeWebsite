<?php
include_once('../include.php');
include_once('../encipher.php');
// $user = json_decode(file_get_contents("php://input"));
if($_POST['user_name']==NULL){
    sendResponse(400, [] , 'User name Required !');  
}else if($_POST['user_password']==NULL){
    sendResponse(400, [] , 'Password Required !');        
}else{
    $conn=getConnection();
    if($conn==null){
        sendResponse(500,$conn,'Server Connection Error !');
    }else{
        $password=doEncrypt($_POST['user_password']);
        $sql = "SELECT user_id, user_name, user_email, user_password FROM User WHERE user_name='";
        $sql.=$_POST['user_name']."' AND user_password = '".$password."'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $users=array();
            while($row = $result->fetch_assoc()) {
                $user=array(
                    "id" =>  $row["user_id"],
                     "name" => $row["user_name"],
                     "email" => $row["user_email"],
                     "password" => $row["user_password"],
                );
                array_push($users,$user);
            }
            sendResponse(200,$users,'User Details');
        } else {
            sendResponse(404,[],'User not available. Incorrect Username or Password');
        }
        $conn->close();
    }
}