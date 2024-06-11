<?php
require "DataBase.php";
$db = new DataBase();
if (isset($_POST['Activation_code'])) {
    if ($db->dbConnect()) {
        if ($db->esim_activate("esim", $_POST['Activation_code'])) {
            echo "Activation Success";
        } else echo "Wrong code try again";
    } else echo "Error: Database connection";
} else echo "All fields are required";
?>
