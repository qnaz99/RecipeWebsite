<?php
function getConnection(){
    $servername= "localhost";
    $username = "id15610108_judy12";
    $password = "2cmOPImR>)vveS~q";
    $databasename = "id15610108_recipe";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $databasename);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}
?>