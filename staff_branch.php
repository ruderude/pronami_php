<?php

if(isset($_POST["add"])) {
    $staff_code = $_POST["staff_code"];
    header("Location:staff_add.php");
    exit;
}

if(isset($_POST["disp"])) {
    if(!isset($_POST["staff_code"])){
        header("Location:staff_ng.php?");
        exit;
    }
    $staff_code = $_POST["staff_code"];
    header("Location:staff_disp.php?staff_code=" . $staff_code);
    exit;
}

if(isset($_POST["edit"])) {
    if(!isset($_POST["staff_code"])){
        header("Location:staff_ng.php?");
        exit;
    }
    $staff_code = $_POST["staff_code"];
    header("Location:staff_edit.php?staff_code=" . $staff_code);
    exit;
}

if(isset($_POST["delete"])) {
    if(!isset($_POST["staff_code"])){
        header("Location:staff_ng.php?");
        exit;
    }
    $staff_code = $_POST["staff_code"];
    header("Location:staff_delete.php?staff_code=" . $staff_code);
    exit;
}