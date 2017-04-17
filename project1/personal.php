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

<?php
require('mysqli_connect.php');

$user1 = $_SESSION['user'];
if (isset($_POST['classmate'])) {
    $user2 = $_POST['classmate'];
    $sql="UPDATE friendship SET g='classmate' WHERE user1='$user1' AND user2='$user2'";
    $retval = mysqli_query($dbc, $sql);
}

if (isset($_POST['famous'])) {
    $user2 = $_POST['famous'];
    $sql="UPDATE friendship SET g='famous' WHERE user1='$user1' AND user2='$user2'";
    $retval = mysqli_query($dbc, $sql);
}

if (isset($_POST['default'])) {
    $user2 = $_POST['default'];
    $sql="UPDATE friendship SET g='default' WHERE user1='$user1' AND user2='$user2'";
    $retval = mysqli_query($dbc, $sql);
}

if (isset($_POST['family'])) {
    $user2 = $_POST['family'];
    $sql="UPDATE friendship SET g='family' WHERE user1='$user1' AND user2='$user2'";
    $retval = mysqli_query($dbc, $sql);
}
mysqli_close($dbc); // Close the database connection.
?>

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
                    <a class="nav-link text-uppercase text-expanded" href="Search.php">Back to Search <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item px-lg-4">
                    <a class="nav-link text-uppercase text-expanded" data-toggle="modal" data-target="#myModal2">Friends</a>
                    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">
                                        <?php echo $_SESSION['user'].' Friend List';?>
                                    </h4>
                                </div>
                                <div class="modal-body">
<!--                                    <iframe name="vota3" style="display:none;"></iframe>-->
                                    <form action="Personal.php" method="post">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>

                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>&nbsp;Motto&nbsp;</th>
                                            <th>Group</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php

                                        $account = $_SESSION['user'];
                                        $sql = "SELECT g, user2 FROM friendship WHERE user1 ='$account'";
                                        // Make the connection
                                        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not
                        connect to MySQL: ' . mysqli_connect_error());
                                        $retval = mysqli_query($dbc, $sql);
                                        $count = mysqli_num_rows($retval);
                                        while ($row = mysqli_fetch_array($retval)) {
                                            $group = $row['g'];
                                            $friend = $row['user2'];
                                            $sql2 = "SELECT gender, motto FROM users WHERE user_name ='$friend'";
                                            $retval2 = mysqli_query($dbc, $sql2);
                                            if ($row2 = mysqli_fetch_array($retval2)) {
                                                echo "<tr>";
                                                echo "<td>$friend</td>";
                                                echo "<td>{$row2['gender']}</td>";
                                                echo "<td>{$row2['motto']}</td>";
                                                echo "<td>$group</td>";
                                                echo "<td><div class='btn-group btn-group'>
                                                            <button type=\"button\" class=\"btn btn-link dropdown-toggle\" 
                                                                    data-toggle=\"dropdown\">
                                                               $group<span class=\"caret\"></span>
                                                            </button>
                                                            <ul class=\"dropdown-menu\" role=\"menu\">
                                                                <li><button class = 'btn-link' name='family' value='$friend'>family</button></li>
                                                                <li><button class = 'btn-link' name='classmate' value='$friend'>classmate</button></li>
                                                                <li><button class = 'btn-link' name='famous' value='$friend'>famous</button></li>
                                                                <li><button class = 'btn-link'name='default' value='$friend'>default</button></li>
                                                            </ul>
                                                       </div></td>";
                                                echo "</tr>";

                                            }
                                        }
                                        mysqli_close($dbc); // Close the database connection.
                                        ?>
                                        </tbody>
                                    </form>
                                    </table>
                                    <hr class="colorgraph">
                                    <iframe name="vota" style="display:none;"></iframe>
                                    <form action="PersonalBackEnd.php" method="post"target="vota">
                                        <div class="form-group">
                                            <label>Add a new friend</label>
                                            <div class="row col-lg-12">
                                                <input type="text" name="friendname" class="form-control input-lg col-sm-9" placeholder="Trump" align="center">
                                                <button type="submit" name="addfriend" value="addfriend" class="btn btn-info">&nbsp;Add&nbsp;</button>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label">Invite a new friend </label>
                                            <div class="row col-lg-12">
                                                <input type="email" name="emailinvite" class="form-control input-lg col-sm-9" placeholder="Email@outlook.com">
                                                <button type="submit" name="invite" value="invitefriend" class="btn btn-info">Send</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal -->
                    </div>

                </li>
                <li class="nav-item px-lg-4">
                    <a class="nav-link text-uppercase text-expanded" data-toggle="modal" data-target="#myModal1">Favorite</a>
                    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
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
                    <a class="nav-link text-uppercase text-expanded" href="" data-toggle="modal" data-target="#myModal4"  id="loginref">
                        Follow
                    </a>
                    <!-- 模态框（Modal） -->
                    <div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-body">

                                    <iframe name="vota2" style="display:none;"></iframe>
                                    <form action="PersonalBackEnd.php" method="post" target="vota2">
                                    <fieldset>
                                        <h2> Follow and find what he/she likes!</h2>

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
                                            $account = $_SESSION['user'];
                                            $sql = "SELECT followed FROM followlist WHERE follower ='$account'";
                                            // Make the connection
                                            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not
                        connect to MySQL: ' . mysqli_connect_error());
                                            $retval = mysqli_query($dbc, $sql);
                                            $count = mysqli_num_rows($retval);
                                            while ($row = mysqli_fetch_array($retval)) {
                                                $followed = $row['followed'];
                                                $sql2 = "SELECT gender, motto FROM users WHERE user_name ='$followed'";
                                                $retval2 = mysqli_query($dbc, $sql2);
                                                if ($row2 = mysqli_fetch_array($retval2)) {
                                                    echo "<tr>";
                                                    echo "<td>$followed</td>";
                                                    echo "<td>{$row2['gender']}</td>";
                                                    echo "<td>{$row2['motto']}</td>";
                                                    echo "</tr>";
                                                }
                                            }
                                            mysqli_close($dbc); // Close the database connection.
                                            ?>
                                            </tbody>
                                        </table>

                                        <h2> Who follows you</h2>
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
                                            $account = $_SESSION['user'];
                                            $sql = "SELECT follower FROM followlist WHERE followed ='$account'";
                                            // Make the connection
                                            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not
                        connect to MySQL: ' . mysqli_connect_error());
                                            $retval = mysqli_query($dbc, $sql);
                                            $count = mysqli_num_rows($retval);
                                            while ($row = mysqli_fetch_array($retval)) {
                                                $follower = $row['follower'];
                                                $sql2 = "SELECT gender, motto FROM users WHERE user_name ='$follower'";
                                                $retval2 = mysqli_query($dbc, $sql2);
                                                if ($row2 = mysqli_fetch_array($retval2)) {
                                                    echo "<tr>";
                                                    echo "<td>$follower</td>";
                                                    echo "<td>{$row2['gender']}</td>";
                                                    echo "<td>{$row2['motto']}</td>";
                                                    echo "</tr>";
                                                }
                                            }
                                            mysqli_close($dbc); // Close the database connection.
                                            ?>
                                            </tbody>
                                        </table>

                                        <hr class="colorgraph">
                                        <div class="form-group">
                                            <label">Follow a people </label>
                                            <div class="row col-lg-12">
                                                <input type="text" name="followname" class="form-control input-lg col-sm-9" placeholder="Vincent">
                                                <button type="submit" name="follow" value="followpeople" class="btn btn-info">Follow</button>
                                            </div>
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
                    <a class="nav-link text-uppercase text-expanded" href="" data-toggle="modal" data-target="#myModal3"  id="loginref">
                        Update Profile
                    </a>
                    <!-- 模态框（Modal） -->
                    <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <form action="Personal.php" method="post">
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
            </ul>
        </div>
    </div>
</nav>

<div class="container">

    <div class="bg-faded p-4 my-4">
        <img class='figure-img w-100' src='img/social.png' align='center'>
        <hr class="divider">
        <h2 class="text-center text-lg text-uppercase my-0"><strong>Personal Page</strong></h2>
        <hr class="divider">



        <div class="row">
            <form action = "Personal.php" method="post">
                <div class="col-lg-8">
                    <?php
                        echo "<h2 class='text-uppercase text-expanded'>";
                        echo "Name.{$_SESSION['user']}";
                        echo "</h2>";

                        $account = $_SESSION['user'];
                        $sql = "SELECT gender FROM users WHERE user_name ='$account'";
                        // Make the connection
                        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not
                        connect to MySQL: ' . mysqli_connect_error());
                        $retval = mysqli_query($dbc, $sql);
                        if ($row = mysqli_fetch_array($retval)) {
                            if ($row['gender'] == 'male') {
                                echo "<img class=\"img-fluid\" src=\"img/boy.jpg\"align = \"right\"><!--PROFILE IMAGE-->";
                            } else if ($row['gender' == 'female']) {
                                echo "<img class=\"img-fluid\" src=\"img/girl.jpg\"align = \"right\"><!--PROFILE IMAGE-->";
                            } else {
                                echo "<img class=\"img-fluid\" src=\"img/other.jpg\"align = \"right\"><!--PROFILE IMAGE-->";
                            }
                        } else {
                            echo "<img class=\"img-fluid\" src=\"img/other.jpg\"align = \"right\"><!--PROFILE IMAGE-->";
                        }
                        mysqli_close($dbc); // Close the database connection.
                    ?>
                    <h3 align='right'>SuperMatt&nbsp;Membership</h3>
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
                        $sql = "SELECT user2 FROM friendship WHERE user1='$user'";
                        $retval = mysqli_query($dbc, $sql);
                        $count = mysqli_num_rows($retval);
                        echo "<li><span>Friends:&nbsp;</span>";
                        echo "$count </li>";
                        $sql = "SELECT followed FROM followlist WHERE follower='$user'";
                        $retval = mysqli_query($dbc, $sql);
                        $count = mysqli_num_rows($retval);
                        echo "<li><span>Follow:&nbsp;</span>";
                        if ($row=mysqli_fetch_array($retval)) {
                            echo "$count</li>";
                        } else {
                            echo "0</li>";
                        }
                        $sql = "SELECT follower FROM followlist WHERE followed='$user'";
                        $retval = mysqli_query($dbc, $sql);
                        $count = mysqli_num_rows($retval);
                        echo "<li><span>Follower:&nbsp;</span>";
                        if ($row=mysqli_fetch_array($retval)) {
                            echo "$count</li>";
                        } else {
                            echo "0</li>";
                        }
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
<!--                    <img class='img-fluid w-100' src='img/divider.jpg' align='center'>-->
                    <br>
                    <h3> &nbsp&nbspHave a look at what your followed people recently like:</h3>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Followed</th>
                            <th>Name</th>
                            <th>ID</th>
                            <th>Supermarket</th>
                            <th>Price</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $follower=$_SESSION['user'];
                        $sql = "SELECT followed FROM followlist WHERE follower = '$follower'";
                        // Make the connection
                        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not
                        connect to MySQL: ' . mysqli_connect_error());
                        $retval = mysqli_query($dbc, $sql);
                        while ($row = mysqli_fetch_array($retval)) {
                            $followed=$row['followed'];
                            $sql2 = "SELECT good_name, supermarket, price, description, good_id FROM privatelike WHERE user_account = '$followed'
                            ORDER BY addtime DESC LIMIT 2";
                            $retval2 = mysqli_query($dbc, $sql2);
                            while ($row2 = mysqli_fetch_array($retval2)) {
                                $des = substr($row2['description'], 0, 12);
                                $name = substr($row2['good_name'], 0, 10);
                                $super = substr($row2['supermarket'], 0, 12);
                                $price = substr($row2['price'], 0, 8);
                                $id = $row2['good_id'];
                                echo "<tr>";
                                echo "<td>$followed</td>";
                                echo "<td>$name</td>";
                                echo "<td>$id</td>";
                                echo "<td>$super</td>";
                                echo "<td>$price</td>";
                                echo "<td>$des</td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                        </tbody>
                    </table>

                </div>



        </div>


    </div>
</div>
<!-- /.container -->
<?php
if (isset($_POST['update'])) {
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





