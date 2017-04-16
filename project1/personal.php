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
<div class="tagline-lower text-center text-expanded text-shadow text-uppercase text-white mb-4 hidden-md-down">Carnegie Mellon University | Pittursburg, PA 15213 | Vincent & Sue</div>


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
                    <a class="nav-link text-uppercase text-expanded" href="customerEmpty.php">Back to Search <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item px-lg-4">
                    <a class="nav-link text-uppercase text-expanded" data-toggle="modal" data-target="#myModal2">Friends</a>
                    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">
                                        <?php echo $_SESSION['user'].' Friend List';?>
                                    </h4>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Motto</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        require('mysqli_connect.php');
                                        $account = $_SESSION['user'];
                                        $sql = "SELECT user2 FROM friendship WHERE user1 ='$account'";
                                        // Make the connection
                                        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not
                        connect to MySQL: ' . mysqli_connect_error());
                                        $retval = mysqli_query($dbc, $sql);
                                        $count = mysqli_num_rows($retval);
                                        while ($row = mysqli_fetch_array($retval)) {
                                            $friend = $row['user2'];
                                            $sql2 = "SELECT gender, motto FROM users WHERE user_name ='$friend'";
                                            $retval2 = mysqli_query($dbc, $sql2);
                                            if ($row2 = mysqli_fetch_array($retval2)) {
                                                echo "<tr>";
                                                echo "<td>$friend</td>";
                                                echo "<td>{$row2['gender']}</td>";
                                                echo "<td>{$row2['motto']}</td>";
                                                echo "</tr>";
                                            }
                                        }
                                        mysqli_close($dbc); // Close the database connection.
                                        echo "<caption>You have not add any friends.</caption>";
                                        ?>
                                        </tbody>
                                    </table>

                                </div>
                                <div class="modal-footer">
                                    <div>
                                        <button type="button" class="btn btn-primary">confirm</button>
                                    </div>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal -->
                    </div>

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
                    <!-- Button trigger modal -->
                    <!-- 按钮触发模态框 -->
                    <a class="nav-link text-uppercase text-expanded" href="" data-toggle="modal" data-target="#myModal3"  id="loginref">
                        Update Profile
                    </a>
                    <!-- 模态框（Modal） -->
                    <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <form action="personal.php" method="post">
                                        <fieldset>
                                            <h2> Update Your Data </h2>
                                            <hr class="colorgraph">
                                            <div class="form-group">
                                                <label for="gender">Gender</label><br>
                                                <input type="radio" name="gender" value="male" align="left"> Male&nbsp;
                                                <input type="radio" name="gender" value="female" align="center"> Female&nbsp;
                                                <input type="radio" name="gender" value="other" align="right"> Other<br>
                                            </div>
                                            <div class="form-group">
                                                <label for="birth">Birthday</label><br>
                                                <input type="date" name="birthday" class="text-expanded"><br>
                                            </div>
                                            <div class="form-group">
                                                <label for="motto">Motto</label>
                                                <input type="text" name="motto" id="motto" class="form-control input-lg" placeholder="My heart is in the work">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" name="update" value="update" class="btn btn-primary">Update</button>
                                                <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                                            </div>

                                        </fieldset>
                                    </form>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal -->
                    </div>
                </li>
                <li class="nav-item px-lg-4">
                    <!-- Button trigger modal -->
                    <!-- 按钮触发模态框 -->
                    <a class="nav-link text-uppercase text-expanded" href="" data-toggle="modal" data-target="#myModal4"  id="loginref">
                        Find&Invite
                    </a>
                    <!-- 模态框（Modal） -->
                    <div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <iframe name="vota" style="display:none;"></iframe>
                                    <form action="InviteAndAdd.php" method="post" target="vota">
                                        <fieldset>
                                            <h2> Find your friends or invite!</h2>
                                            <hr class="colorgraph">
                                            <div class="form-group">
                                                <label>Add a new friend</label>
                                                <div class="row col-lg-12">
                                                    <input type="text" name="friendname" class="form-control input-lg col-sm-10" placeholder="Trump" align="center">
                                                    <button type="submit" name="addfriend" value="addfriend" class="btn btn-info">Add</button>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label">Invite a new friend </label>
                                                <div class="row col-lg-12">
                                                    <input type="email" name="emailinvite" class="form-control input-lg col-sm-10" placeholder="Email@outlook.com">
                                                    <button type="submit" name="invite" value="invitefriend" class="btn btn-info">Send</button>
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
        <img class='figure-img w-100' src='img/social.jpg' align='center'>
        <hr class="divider">
        <h2 class="text-center text-lg text-uppercase my-0"><strong>Personal Page</strong></h2>
        <hr class="divider">



        <div class="row">
            <form action = "personal.php" method="post">
                <div class="col-lg-8">
                    <?php
                        echo "<h2 class='text-uppercase' align='right'>";
                        echo "{$_SESSION['user']}";
                        echo "</h2>";
                    ?>

                    <img class="img-fluid" src="img/profile-thum.png"align = "right"><!--PROFILE IMAGE-->
                    <h3 align="right">SuperMatt&nbsp;Membership</h3>
                </div><!--/#namecard-->

                <div>
                    <!--PAGE MENU-->
                    <ul class="nav-menu no-padding">
                        <?php
                        $user = $_SESSION['user'];

                        // Make the connection
                        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not
                        connect to MySQL: ' . mysqli_connect_error());

                        $sql = "SELECT good_id FROM privatelike WHERE user_account='$user'";
                        $retval = mysqli_query($dbc, $sql);
                        $count = mysqli_num_rows($retval);
                        echo  "<li><span>Favorite:&nbsp;</span>";
                        echo "$count </li>";
                        echo "<li><span>Friends:&nbsp;0</span></li>";
                        $sql = "SELECT registration_date FROM users WHERE user_name ='$user'";
                        $retval = mysqli_query($dbc, $sql);
                        if ($row = mysqli_fetch_array($retval)) {
                            echo "<li><span>Registration:&nbsp;</span>";
                            echo "{$row['registration_date']}</li>";
                        }
                        ?>
                    </ul><!--/.nav-menu __PAGE MENU ENDS-->

                </div><!--#menu-container-->

            </form>

                <div class="form-control col-lg-8">
                    <h3> &nbsp&nbspWelcome , come to see the top 3 goods:</h3>
                    <br>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Rank</th>
                            <th>Promote</th>
                            <th>Name</th>
                            <th>Supermarket</th>
                            <th>Price</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql = "SELECT promote, id, good_name, supermarket, price, description FROM goods ORDER BY promote DESC";
                        // Make the connection
                        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not
                        connect to MySQL: ' . mysqli_connect_error());
                        $retval = mysqli_query($dbc, $sql);
                        $count = 1;
                        while ($row = mysqli_fetch_array($retval)) {
                            if ($count > 3) break;
                            $des = substr($row['description'], 0, 12);
                            $name = substr($row['good_name'],0,10);
                            $super = substr($row['supermarket'],0,12);
                            $price = substr($row['price'],0,8);
                            echo "<tr>";
                            echo "<td>$count</td>";
                            echo "<td>{$row['promote']}";
                            echo "<td>$name</td>";
                            echo "<td>$super</td>";
                            echo "<td>$price</td>";
                            echo "<td>$des</td>";
                            echo "</tr>";
                            $count++;
                        }
                        mysqli_close($dbc); // Close the database connection.
                        ?>
                        </tbody>
                    </table>
                </div>



        </div>


    </div>
</div>
<!-- /.container -->
<?php
    if ($_POST['update']) {
        $user = $_SESSION['user'];
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not
                        connect to MySQL: ' . mysqli_connect_error());

        $sql = "SELECT good_id FROM privatelike WHERE user_account='$user'";
        $retval = mysqli_query($dbc, $sql);

        if (isset($_POST['gender'])) {
            $gender = $_POST['gender'];
            $sql = "UPDATE users SET gender='$gender'WHERE user_name='$user'";
            $retval = mysqli_query($dbc, $sql);
        }

        if (isset($_POST['birthday'])) {
            $date = $_POST['birthday'];
            $sql = "UPDATE users SET birthday='$date'WHERE user_name='$user'";
            $retval = mysqli_query($dbc, $sql);
        }
        if (isset($_POST['motto'])) {
            $mot = $_POST['motto'];
            $sql = "UPDATE users SET motto='$mot'WHERE user_name='$user'";
            $retval = mysqli_query($dbc, $sql);
        }
    }

    if ($_POST['addfriend']) {


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





