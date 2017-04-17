<?php
/**
 * Created by PhpStorm.
 * User: 于哲晨
 * Date: 2017/4/13
 * Time: 14:28
 */
session_start();
require('mysqli_connect.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not 
                        connect to MySQL: ' . mysqli_connect_error());

if (isset($_POST['vote'])){
    $ID = $_POST['vote'];
    $count;
    $sql = "SELECT promote FROM goods WHERE id='$ID'";
    // Make the connection
    $retval = mysqli_query($dbc, $sql);
    $row = mysqli_fetch_array($retval);
    if ($row) {
        $count = $row['promote'] + 1;
        $sql = "UPDATE goods SET promote='$count' WHERE id='$ID'";
        $retval = mysqli_query($dbc, $sql);
    }
    mysqli_close($dbc);
}

if (isset($_POST['mark'])) {
    if ($_SESSION['user'] == 'Visitor') {
        return;
    }
    $account = $_SESSION['user'];
    $ID = $_POST['mark'];
    $sql="SELECT good_name, supermarket, price, description FROM goods WHERE id='$ID'";
    $retval = mysqli_query($dbc, $sql);
    $row = mysqli_fetch_array($retval);
    if ($row) {
        $name = $row['good_name'];
        $supermarket = $row['supermarket'];
        $price = $row['price'];
        $description = $row['description'];
        $sql = "SELECT user_account FROM privatelike WHERE good_id='$ID'";
        $retval = mysqli_query($dbc, $sql);
        $marked = false;
        while ($row2 = mysqli_fetch_array($retval)) {
            if ($row2['user_account'] == $account ) {
                $marked = true;
            }
        }
        if ($marked == false) {
            $sql = "INSERT INTO privatelike(good_id, good_name, supermarket, price, description, user_account, addtime) 
                      VALUES ('$ID', '$name', '$supermarket', '$price', '$description','$account',now());";
            $retval = mysqli_query($dbc, $sql);
            if ($retval) {
                echo "<script> alert('success mark')</script>";
            } else {
                echo "<script> alert('error mark')</script>";
            }

        }
    }
    mysqli_close($dbc);
}

if (isset($_POST['tag'])){
    $ID = $_POST['tag'];
    $content = $_REQUEST["$ID"];
    echo $content;
    $sql = "UPDATE goods SET tag='$content' WHERE id='$ID'";
    $retval = mysqli_query($dbc, $sql);
    mysqli_close($dbc);
}


?>