<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Customer Search</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

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

<div class="tagline-upper text-center text-heading text-shadow text-white mt-4 hidden-md-down">Find Favorite</div>
<div class="tagline-lower text-center text-expanded text-shadow text-uppercase text-white mb-4 hidden-md-down">Carnegie Mellon University | Pittursburg, PA 15213 | Vincent & Sue

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
                    <a class="nav-link text-uppercase text-expanded" href="business.php">BusinessPage <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item px-lg-4">
                    <a class="nav-link text-uppercase text-expanded" data-toggle="modal" data-target="#myModal1">Favorite</a>
                    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">
                                        <?php echo $_SESSION['user'].' Personal Mark';?>
                                    </h4>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Supermarket</th>
                                            <th>Price</th>
                                            <th>Description</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            require('mysqli_connect.php');
                                            $account = $_SESSION['user'];
                                            $sql = "SELECT good_id, good_name, supermarket, price, description FROM privatelike WHERE 
                                           user_account ='$account'";
                                        // Make the connection
                                        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not 
                        connect to MySQL: ' . mysqli_connect_error());
                                        $retval = mysqli_query($dbc, $sql);
                                        while ($row = mysqli_fetch_array($retval)) {
                                            $des = substr($row['description'], 0, 12);
                                            $name = substr($row['good_name'],0,10);
                                            $super = substr($row['supermarket'],0,12);
                                            $price = substr($row['price'],0,8);
                                            echo "<tr>";
                                            echo "<td>{$row['good_id']}";
                                            echo "<td>$name</td>";
                                            echo "<td>$super</td>";
                                            echo "<td>$price</td>";
                                            echo "<td>$des</td>";
                                            echo "</tr>";
                                        }
                                        mysqli_close($dbc); // Close the database connection.

                                        ?>
                                        </tbody>
                                    </table>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Confirm
                                    </button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal -->
                    </div>
                </li>
                <li class="nav-item px-lg-4">
                    <a class="nav-link text-uppercase text-expanded" href="personal.php"><?php echo $_SESSION['user'];?></a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">

    <div class="bg-faded p-4 my-4">
        <img class='figure-img w-100' src='img/supermarket.jpg' align='center'>

        <hr class="divider">
        <h2 class="text-center text-lg text-uppercase my-0"><strong>Search Page</strong></h2>
        <hr class="divider">
        <form action = "customer.php" method="post">
            <div class="row">
                <div class="form-group col-4">
                    <div class="col">
                        <label class="text-heading" >Goods' Name</label>
                        <input type="text" name="good_name" class="form-control">
                        <br>
                        <button type="submit" name="subject" value="name" class="btn btn-secondary">
                            Search Name
                        </button>
                        <br>
                        <br>
                    </div>
                    <div class="form-group col-lg-12">
                        <label class="text-heading">Goods' Type</label>
                        <input type="text" name="good_type" class="form-control">
                        <br>
                        <button type="submit" name="subject" value="type" class="btn btn-secondary">
                            Search Type
                        </button>
                    </div>
                    <div class="form-group col-lg-12">
                        <label class="text-heading">Goods' ID</label>
                        <input type="text" name="good_id" class="form-control">
                        <br>
                        <button type="submit" name="subject" value="id" class="btn btn-secondary">
                            Search ID
                        </button>
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="form-control col-lg-8">
                    <h3> &nbsp&nbspWelcome to our search system, you can type your need in the left blank:</h3>
                    <br>
                    <h4> &nbsp Search by Name</h4>
                    <h4> &nbsp Search by Tag</h4>
                <img class='figure-img w-25' id='welPic'src='img/welcome.png' align='right'>
                    <table class="table table-striped">
                        <tbody>
                        </tbody>
                    </table>
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



