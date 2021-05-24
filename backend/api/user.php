<?php
include_once('../include.php');
//get connection from database.php
$conn=getConnection();

if($conn==null){
    //send response if connection error occurred.
    sendResponse(500,$conn,'Server Connection Error');
}else{
    $sql = "SELECT user_id, user_name, user_email,user_password FROM User";
    $result = $conn->query($sql);
    
    //check if user list available 
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
        sendResponse(200,$users,'User List');
    } else {
        sendResponse(404,[],'User not available');
    }
    //closing connection
    $conn->close();
}
?>