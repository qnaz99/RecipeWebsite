<?php
include_once('../include.php');
//get connection from database.php
$conn=getConnection();

if($conn==null){
    //send response if connection error occurred.
    sendResponse(500,$conn,'Server Connection Error');
}else{
    $sql = "SELECT recipe_id, recipe_name, recipe_des, recipe_image, recipe_ingredient, recipe_instruction, date_taken FROM Recipe";
    $result = $conn->query($sql);
    
    //check if user list available 
    if ($result->num_rows > 0) {
        $recipes=array();
        while($row = $result->fetch_assoc()) {
            $recipe=array(
                "id" =>  $row["recipe_id"],
                "name" => $row["recipe_name"],
                "description" => $row["recipe_des"],
                "image" => $row["recipe_image"],
                "ingredient" => $row["recipe_ingredient"],
                "instruction" => $row["recipe_instruction"],
                "date" => $row["date_taken"],
            );
            array_push($recipes,$recipe);
        }
        sendResponse(200,$recipes,'Recipe List');
    } else {
        sendResponse(404,[],'Recipes not available');
    }
    //closing connection
    $conn->close();
}
?>
