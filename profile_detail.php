<?php
require "DataBase.php";
$db = new DataBase();
if (isset($_POST['profile_name']) && isset($_POST['iccid']) && isset($_POST['imsi']) && isset($_POST['mno'])) {
    if ($db->dbConnect()) {
        if ($db->get_profile("esim_profile", $_POST['profile_name'], $_POST['iccid'], $_POST['imsi'], $_POST['mno'])) {
            echo "Successfully downloaded profile";
        } else echo "Error: Profile not found";
    } else echo "Error: Database connection";
} else echo "All fields are required";
?>
