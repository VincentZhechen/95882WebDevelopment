<?php
/**
 * Created by PhpStorm.
 * User: 于哲晨
 * Date: 2017/4/13
 * Time: 14:28
 */

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
    $ID = $_POST['mark'];
    echo 'mark';
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