<?php
include_once('../include.php');
include_once('../encipher.php');
//method file_get_contents() get all data send via API call.
//json_decode() decodes data as json and assign to variable $user.
// $user = json_decode(file_get_contents("php://input"));
if($_POST['user_name']==NULL){
    sendResponse(400, [] , 'Name Required !');  
}else if($_POST['user_email']==NULL){
        sendResponse(400, [] , 'Email Required !');  
}
else if($_POST['user_password']==NULL){
    sendResponse(400, [] , 'Password Required !');        
}else{
    //method doEncrypt() of encipher.php which convert plain text to encrypted text.
    $password = doEncrypt($_POST['user_password']);
    $conn=getConnection();
    if($conn==null){
        sendResponse(500, $conn, 'Server Connection Error !');
    }else{
        $sql="INSERT INTO User(user_name, user_email, user_password)";
        $sql .= "VALUES ('".$_POST['user_name']."','".$_POST['user_email']."','";
        $sql .= $password."')";

        $result = $conn->query($sql); //$result = true/false on success or error respectively.
        if ($result) {
            sendResponse(200, $result , 'User Registration Successful.');
        } else {
            sendResponse(404, [] ,'User not Registered');
        }
        //close connection
        $conn->close();
    }
}
?>