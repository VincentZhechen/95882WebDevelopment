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

if (isset($_POST['invite'])) {
    $emailaddress = $_POST['emailinvite'];
    if (strlen($emailaddress)==0) {
        echo "<script> alert('Your need to input a email');</script>";
        return;
    }
    echo "<script> alert('An invitation email has been sent to: ". $emailaddress." thank you!');</script>";


}

if (isset($_POST['addfriend'])) {
    $user1 = $_SESSION['user'];
    $user2 = $_POST['friendname'];
    if ($user1 == $user2) {
        echo "<script> alert('You will always be yourself friend');</script>";
        return;
    }
    $sql="SELECT user_id FROM users WHERE user_name='$user2'";
    $retval = mysqli_query($dbc, $sql);
    if (mysqli_num_rows($retval = mysqli_query($dbc, $sql))==0) {
        echo "<script> alert('This user: ". $user2." does not exist');</script>";
        return;
    }
    $sql="SELECT user2 FROM friendship WHERE user1='$user1'";
    $retval = mysqli_query($dbc, $sql);
    while($row=mysqli_fetch_array($retval)) {
        if ($row['user2'] == $user2) {
            echo "<script> alert('You are already friends');</script>";
            return;
        }
    }
    $sql2 = "INSERT INTO friendship (user1, user2, start_time) VALUES ('$user1', '$user2', now());";
    $retval = mysqli_query($dbc, $sql2);
    $sql3 = "INSERT INTO friendship (user1, user2, start_time) VALUES ('$user2', '$user1', now());";
    $retval = mysqli_query($dbc, $sql3);
    echo "<script> alert('Success add friends.');</script>";
}

if (isset($_POST['follow'])) {
    $user = $_SESSION['user'];
    $followed = $_POST['followname'];
    if ($user == $followed) {
        echo "<script> alert('You will always follow yourself.');</script>";
        return;
    }
    $sql="SELECT user_name FROM users WHERE user_name='$followed'";
    $retval = mysqli_query($dbc, $sql);
    if (mysqli_num_rows($retval = mysqli_query($dbc, $sql))==0) {
        echo "<script> alert('You cannot follow a people not exist.');</script>";
        return;
    }
    $sql="SELECT followed FROM followlist WHERE follower='$user'";
    $retval = mysqli_query($dbc, $sql);
    while($row=mysqli_fetch_array($retval)) {
        if ($row['followed'] == $followed) {
            echo "<script> alert('You have already followed this people');</script>";
            return;
        }
    }
    $sql2 = "INSERT INTO followlist (follower, followed, start_time) VALUES ('$user', '$followed', now());";
    $retval = mysqli_query($dbc, $sql2);
    echo "<script> alert('Successful follow a new people.');</script>";
}

mysqli_close($dbc);

?>