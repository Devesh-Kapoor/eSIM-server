<?php
require "DataBase.php";
$db = new DataBase();
if (isset($_POST['status'])) {
    if ($db->dbConnect()) {
        if ($db->activate_sim("esim")) {
            echo "Changed Sim Status to Active"; 
        } else echo "Error: Code";
    } else echo "Database connection error";
} else echo "All fields are required";
?>
