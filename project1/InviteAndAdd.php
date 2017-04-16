<?php
/**
 * Created by PhpStorm.
 * User: 于哲晨
 * Date: 2017/4/16
 * Time: 15:47
 */
session_start();
require('mysqli_connect.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not 
                        connect to MySQL: ' . mysqli_connect_error());

if ($_POST['addfriend']) {
    $user1 = $_SESSION['user'];
    $user2 = $_POST['friendname'];
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
            if ($row2['user_account'] == $account) {
                $marked = true;
            }
        }
    }


}

if ($_POST['invite']) {
    $emailaddress = $_POST['emailinvite'];
    if (strlen($emailaddress)==0) {
        echo "<script> alert('Your need to input a email');</script>";
        return;
    }
    echo "<script> alert('An invitation email has been sent to: ". $emailaddress." thank you!');</script>";
}




?>