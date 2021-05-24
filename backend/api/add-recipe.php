<?php
include_once('../include.php');
include_once('../encipher.php');
//method file_get_contents() get all data send via API call.
//json_decode() decodes data as json and assign to variable $user.
// $recipe = json_decode(file_get_contents("php://input"));
if($_POST['recipe_name']==NULL){
    sendResponse(400, [] , 'Name Required !');  
}else if($_POST['recipe_des']==NULL){
    sendResponse(400, [] , 'Description Required !');  
}else if($_POST['recipe_image']==NULL){
    sendResponse(400, [] , 'Image Required !');  
}else if($_POST['recipe_ingredient']==NULL){
    sendResponse(400, [] , 'Ingredient Required !');  
}
else if($_POST['recipe_instruction']==NULL){
    sendResponse(400, [] , 'Instruction Required !');  
}else{
    $conn=getConnection();
    if($conn==null){
        sendResponse(500, $conn, 'Server Connection Error !');
    }else{
        $sql="INSERT INTO Recipe(recipe_name, recipe_des, recipe_image, recipe_ingredient, recipe_instruction)";
        $sql .= "VALUES ('".$_POST['recipe_name']."','".$_POST['recipe_des']."','".$_POST['recipe_image']."','".$_POST['recipe_ingredient']."','".$_POST['recipe_instruction']."')";
        $result = $conn->query($sql); //$result = true/false on success or error respectively.
        if ($result) {
            sendResponse(200, $result , 'Recipe Added Successful.');
        } else {
            sendResponse(404, [] ,'Recipe Not Added.');
        }
        //close connection
        $conn->close();
    }
}
?>