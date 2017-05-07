<?php
session_start();
// Turn off all error reporting
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>WelcomePage</title>

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
        /* Temporary fix for img-fluid sizing within the carousel */

        .carousel-item.active, {
            display: block;
        }

    </style>

    <script>
        var clink = "Search.php";

        function activateAccount(accountname)
        {
            document.getElementById("loginref").innerHTML = accountname;
            activateLink();
            disablelogin();
        }

        function activateVisitor()
        {
            document.getElementById("loginref").innerHTML = 'Visitor';
            activateLink();
            <?php
            $_SESSION['user']='Visitor';
            ?>
        }

        function activateLink()
        {
            document.getElementById("customerlink").href = clink;
          //  document.getElementById("businesslink").removeAttribute("href");
        }

        function disablelogin()
        {
            document.getElementById("loginref").removeAttribute("href");
            document.getElementById("loginref").removeAttribute("data-target");
        }


    </script>


</head>

<body>

    <div class="tagline-upper text-center text-heading text-shadow text-white mt-4 hidden-md-down">SUPER MATT</div>
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
                    <li class="nav-item active px-lg-4">
                        <a class="nav-link text-uppercase text-expanded" id="customerlink" >Customer Search <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item px-lg-4">
                        <a class="nav-link text-uppercase text-expanded" id="businesslink" href="Business.php">Business Supply</a>

                    </li>
                    <li class="nav-item px-lg-4">
                        <!-- Button trigger modal -->
                        <!-- 按钮触发模态框 -->
                        <a class="nav-link text-uppercase text-expanded" href="" data-toggle="modal" data-target="#myModal"  id="loginref">
                            Log in
                        </a>
                        <!-- 模态框（Modal） -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <form action="index.php" method="post">
                                            <fieldset>
                                                <h2> Please sign in </h2>
                                                <hr class="colorgraph">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Username</label>
                                                    <input type="text" name="username" id="username" class="form-control input-lg" placeholder="User Name"
                                                           required="required">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Password </label>
                                                    <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password"
                                                           required="required">
                                                </div>
                                                <hr class="colorgraph">
                                                <div class="row">
                                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                                        <button type="submit" name="sign" value="signin" class="btn btn-lg btn-success btn-block">Sign In</button>
                                                    </div>
                                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                                        <button type="submit" name="sign" value="register" class="btn btn-lg btn-primary btn-block">Register</button>
                                                    </div>
                                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                                        <a href="javascript:void(0);"  type = "button" class="btn btn-lg btn-info btn-block"
                                                           data-dismiss="modal" onclick="activateVisitor()">Visitor</a>
                                                    </div>
                                                </div>

                                            </fieldset>
                                        </form>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal -->
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <div class="container">
        <div class="bg-faded p-4 my-4">
            <!-- Image Carousel -->
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <img class="d-block img-fluid w-100" src="img/slide-1.jpg" alt="">
                        <div class="carousel-caption d-none d-md-block">
                            <h3 class="text-shadow">Food</h3>
                            <p class="text-shadow">Fresh fruit & vegetables.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block img-fluid w-100" src="img/slide-2.jpg" alt="">
                        <div class="carousel-caption d-none d-md-block">
                            <h3 class="text-shadow">Clothes</h3>
                            <p class="text-shadow">New coming clothes.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block img-fluid w-100" src="img/slide-3.jpg" alt="">
                        <div class="carousel-caption d-none d-md-block">
                            <h3 class="text-shadow">Coming...</h3>
                            <p class="text-shadow">New cool stuff.</p>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <!-- Welcome Message -->
            <div class="text-center mt-4">
                <div class="text-heading text-muted text-lg">welcome</div>
                <h2 class="my-2">Hi, this is matt! What you want to buy today? I can help you to check the supermarket nearby!</h2>
                <div class="text-heading text-muted text-lg text-right">from <strong>Matt</strong></div>
            </div>
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

    <?php
    switch ($_POST['sign']) {
        case 'signin': {
            $name = $_POST['username'];
            $pass = $_POST['password'];

            require('mysqli_connect.php');

            $sql = "SELECT password FROM users WHERE user_name = '$name'";
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not 
                        connect to MySQL: ' . mysqli_connect_error());
            $retval = mysqli_query($dbc, $sql);
            if ($row = mysqli_fetch_array($retval)) {
                if ($row['password']==$pass) {
                    $valid = true;
                    $_SESSION['user']= $name;
                    echo "<script> alert('Welcome back: ' + '$name')</script>";
                    echo "<script>activateAccount('$name')</script>";

                } else {
                    echo "<script> alert('Your password is not correct');</script>";
                }
                return;
            }
                echo "<script> alert('Your account does not exist');</script>";
            break;
        }

        case 'register': {
            $name = $_POST['username'];
            $pass = $_POST['password'];
            require('mysqli_connect.php');
            $sql = "SELECT password FROM users WHERE user_name = '$name'";
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not 
                        connect to MySQL: ' . mysqli_connect_error());
            $retval = mysqli_query($dbc, $sql);
            if ($row = mysqli_fetch_array($retval)) {
                echo "<script> alert('Sorry, this username: ' + '$name' + ' already exists.')</script>";
                return;
            }
            $sql = "INSERT INTO users(user_name, password, registration_date) VALUES ('$name', '$pass', now());";
            $retval = mysqli_query($dbc, $sql);
            if ($retval) {
                $_SESSION['user']= $name;
                echo "<script> alert('Welcome to our system, new friend: ' + '$name')</script>";
                echo "<script>activateAccount('$name')</script>";
                return;
            } else {
                echo "<script> alert('Error')</script>";
            }
            break;
        }
    }
    ?>

</body>

</html>


