<?php
//connect to the database
require ('mysqli_connect.php');

if (isset($_POST['supply'])) {
    $sup = trim($_POST['supermarket']);
    $na = trim($_POST['good_name']);
    $pr = trim($_POST['price']);
    $des = trim($_POST['description']);


    //Make the query
    $q = "INSERT INTO goods(good_name, supermarket, price, description, addtime) VALUES ('$na', '$sup', '$pr', '$des', now());";
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not
                        connect to MySQL: ' . mysqli_connect_error());
    if ($r= mysqli_query ($dbc, $q)) { // If it ran OK.
        // Print a message:
        echo"<script>alert('Supply Success!')</script>";
    }else {
        echo "<script>alert('Supply Error..')</script>";
    }
    mysqli_close($dbc); // Close the database connection.
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Business Management</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/business-casual.css" rel="stylesheet">

    <!-- Temporary navbar container fix -->
    <style>
        .navbar-toggler {
            z-index: 1;
        }

        @media (max-width: 576px) {
            nav > .container {
                width: 100%;
            }
        }
    </style>

</head>

<body>

<div class="tagline-upper text-center text-heading text-shadow text-white mt-4 hidden-md-down">Supply New Goods</div>
<div class="tagline-lower text-center text-expanded text-shadow text-uppercase text-white mb-4 hidden-md-down">Carnegie Mellon University | Pittsburgh, PA 15213 | Vincent & Sue
</div>

    
<!-- Navigation -->
<nav class="navbar navbar-toggleable-md navbar-light navbar-custom bg-faded py-lg-4">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarExample" aria-controls="navbarExample" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="container">
        <a class="navbar-brand text-uppercase text-expanded font-weight-bold hidden-lg-up" href="#">Start</a>
        <div class="collapse navbar-collapse" id="navbarExample">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item px-lg-4">
                    <a class="nav-link text-uppercase text-expanded" href="index.php">Back to home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item px-lg-4">
                    <a class="nav-link text-uppercase text-expanded" href="">..</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    function changeText() {
        element = document.getElementById('descript');
        if (element.getAttribute("rows") == "1") {
            element.rows = "4";
        }
        else {
            element.rows = "1";
        }

    }

</script>

<div class="container">


    <div class="bg-faded p-4 my-4">
        <img class='figure-img w-100' src='img/supply.jpg' align='center'>
        <br>
        <br>
        <h2 class="text-center text-lg text-uppercase my-0"><strong>Supply Form</strong></h2>
        <hr class="divider">
        <form action = "Business.php" method="post">
            <div class="row">
                <div class="form-group col-lg-4">
                    <label class="text-heading">Supermarket Name</label>
                    <input type="text" name="supermarket" required="required" class="form-control">
                </div>
                <div class="form-group col-lg-4">
                    <label class="text-heading">Product Name</label>
                    <input type="text" name="good_name" required="required" class="form-control">
                </div>
                <div class="form-group col-lg-4">
                    <label class="text-heading">Price</label>
                    <input type="number" min="0" step=0.01 name="price" required="required" class="form-control">
                </div>
                <div class="clearfix"></div>
                <div class="form-group col-lg-12">
                    <label class="text-heading" >Description</label>
                    <textarea class="form-control" id="descript" onclick="changeText()" name="description" rows="1"></textarea>
                </div>
                <div class="form-group col-lg-12">
                    <button type="submit" name="supply" value="supply" class="btn btn-secondary">Supply</button>
                </div>
            </div>
        </form>
    </div>

</div>
<!-- /.container -->

<footer class="bg-faded text-center py-5">
    <div class="container">
        <p class="m-0">Copyright &copy; Bootstrap & Vincent, Sue</p>
    </div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/tether/tether.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>


</body>

</html>
