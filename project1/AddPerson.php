<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fn = trim($_POST['FirstName']);
    $ln = trim($_POST['LastName']);
    $addr = trim($_POST['Address']);
    $city = trim($_POST['City']);

    //connect to the database
    require ('mysqli_connect.php');

    //Make the query
    $q = "INSERT INTO Persons (LastName, FirstName, Address, City) VALUES ('$ln', '$fn', '$addr', '$city');";
    $r = mysqli_query ($dbc, $q); // Run the query.

    if ($r) { // If it ran OK.
        // Print a message:
        echo '<h1>Thank you!</h1>';
    }
    //mysqli_close($dbc); // Close the database connection.
}
?>

<html>
<head>
    <title>
        Add a Person
    </title>
</head>
<body>
<form action = "AddPerson.php" method="post">
    <p>Last Name: <input type="text" name="LastName" /></p>
    <p>First Name: <input type="text" name="FirstName" /></p>
    <p>Address: <input type="text" name="Address" /></p>
    <p>City: <input type="text" name="City" /></p>
    <p><input type="submit" value="submit" name="submit"</p>
</form>
</body>
</html>
