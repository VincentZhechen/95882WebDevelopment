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

<script>
    $(function () {
            $("[data-toggle='popover']").popover();
        }
    )

    function voteFunction(n) {
        var voteId = 'vote' + n;
        x = document.getElementById(voteId);
        x.innerHTML = 'vote...';
    }

    function markFunction(n){
        var markId = 'mark' + n;
        x = document.getElementById(markId);
        x.innerHTML = 'mark...';
    }
</script>


<!--//            require('mysqli_connect.php');-->
<!--            $sql = 'UPDATE goods-->
<!--            SET tag = "CN"-->
<!--            WHERE id=n';-->
<!--//            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not-->
<!--//            connect to MySQL: ' . mysqli_connect_error());-->
<!--//            $retval = mysqli_query($dbc, $sql);-->
<!--//            if(! $retval )-->
<!--//            {-->
<!--//                die('Could not update data: ' .mysqli_error());-->
<!--//            }-->


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
                    <a class="nav-link text-uppercase text-expanded" href="business.php">Business Page <span class="sr-only">(current)</span></a>
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


        <div class="row">
            <form action = "customer.php" method="post">
                <div class="form-group col-12">
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
            </form>


<!--                <div class="clearfix"></div>-->
                <div class="clearfix"></div>
                <div class="form-control col-lg-9">
                    <iframe name="vota" style="display:none;"></iframe>
                    <form action="tag.php" method="post" target="vota">

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Good</th>
                            <th>Supermarket</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Promote</th>
                                <th>Tag</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        switch ($_REQUEST['subject']) {
                            case 'name': {
                                $key = trim($_POST['good_name']);
                                //connect to the database
//                                require('mysqli_connect.php');

                                $sql = "SELECT id, good_name, supermarket, price, description,tag, promote FROM goods WHERE 
                                        good_name = '$key'ORDER BY promote DESC, price ASC";
                                // Make the connection
                                $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not
                        connect to MySQL: ' . mysqli_connect_error());
                                $retval = mysqli_query($dbc, $sql);
                                $count = mysqli_num_rows($retval);
                                while ($row = mysqli_fetch_array($retval)) {
                                        $des = substr($row['description'], 0, 12);
                                        $name = substr($row['good_name'],0,10);
                                        $super = substr($row['supermarket'],0,12);
                                        $price = substr($row['price'],0,8);
                                        $tag = substr($row['tag'],0,12);
                                        echo "<tr>";
                                        echo "<td>{$row['id']}";
                                        echo "<td>$name</td>";
                                        echo "<td>$super</td>";
                                        echo "<td>$price</td>";
                                        echo "<td title='{$row['description']}' data-container='body' data-toggle='popover'
                                                data-placement='top'>$des</td>";
                                        echo "<td> {$row['promote']}&nbsp;up ";
                                        echo "<td>$tag</td>";
                                        echo "<td>
                                                    <div class='btn-group dropup btn-group-sm'>
                                                        <button type=\"button\" class=\"btn btn-outline-info dropdown-toggle\" data-toggle=\"dropdown\">act 
                                                            <span class=\"caret\"></span>
                                                        </button>
                                                                <ul class='dropdown-menu' role=\"menu\">
                                                                    <li><button type='submit'class='btn-outline-info' onclick='voteFunction({$row['id']})' name='vote'
                                                                     value='{$row['id']}'  id='tag{$row['id']}'>&nbsp;vote</button></li>
                                                                    <li><button type='submit' class='btn-outline-info'onclick='markFunction({$row['id']})'
                                                                    id='mark{$row['id']}'name='mark' value='{$row['id']}'>mark</button></li>
                                                                    <li><input type=\"text\" name={$row['id']} class=\"col-lg-8\">
                                                                    <button type='submit'class='btn-outline-info' onclick='tagFunction({$row['id']})' name='tag'
                                                                     value='{$row['id']}'  id='tag{$row['id']}'>&nbsp;tag</button></li>
                                                                </ul>
                                                    </div>
                                            </td>";
                                        echo "</tr>";
                                }
                                mysqli_close($dbc); // Close the database connection.
                                if ($count == 0) {
                                    echo "<h2 align='center'> No results found</h2>";
                                    echo "<caption>Your search returned 0 results.";
                                    echo "<img class='figure-img w-25' src='img/sad2.png' align='right'></caption>";
                                } else {
                                    echo "<h2 align='center'> Results found</h2>";
                                    echo "<caption>Result: Successfully find $count results.";
                                    echo "<img class='figure-img w-25' src='img/find.jpg' align='right'></caption>";
                                }
                                break;
                            }
                            case 'type': {
                                $key = trim($_POST['good_type']);
                                //connect to the database
//                                require('mysqli_connect.php');
                                $sql = "SELECT id, good_name, supermarket, price, description,tag, promote FROM goods
                                        WHERE tag LIKE '$key'ORDER BY promote DESC, price ASC";
                                // Make the connection
                                $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not 
                        connect to MySQL: ' . mysqli_connect_error());
                                $retval = mysqli_query($dbc, $sql);
                                $count = mysqli_num_rows($retval);
                                while ($row = mysqli_fetch_array($retval)) {
                                        $des = substr($row['description'], 0, 12);
                                        $name = substr($row['good_name'],0,10);
                                        $super = substr($row['supermarket'],0,12);
                                        $price = substr($row['price'],0,8);
                                        $tag = substr($row['tag'],0,12);
                                        echo "<tr>";
                                        echo "<td>{$row['id']}</td>";
                                        echo "<td>$name</td>";
                                        echo "<td>$super</td>";
                                        echo "<td>$price</td>";
                                        echo "<td title='{$row['description']}' data-container='body' data-toggle='popover'
                                                data-placement='top'>$des</td>";
                                        echo "<td> {$row['promote']}&nbsp;up ";
                                        echo "<td>$tag</td>";
                                        echo "<td>
                                                    <div class='btn-group dropup btn-group-sm'>
                                                        <button type=\"button\" class=\"btn btn-outline-info dropdown-toggle\" data-toggle=\"dropdown\">act 
                                                            <span class=\"caret\"></span>
                                                        </button>
                                                                <ul class='dropdown-menu' role=\"menu\">
                                                                    <li><button type='submit'class='btn-outline-info' onclick='voteFunction({$row['id']})' name='vote'
                                                                     value='{$row['id']}'  id='tag{$row['id']}'>&nbsp;vote</button></li>
                                                                    <li><button type='submit' class='btn-outline-info'onclick='markFunction({$row['id']})'
                                                                    id='mark{$row['id']}'name='mark' value='{$row['id']}'>mark</button></li>
                                                                    <li><input type=\"text\" name={$row['id']} class=\"col-lg-8\">
                                                                    <button type='submit'class='btn-outline-info' onclick='tagFunction({$row['id']})' name='tag'
                                                                     value='{$row['id']}'  id='tag{$row['id']}'>&nbsp;tag</button></li>
                                                                </ul>
                                                    </div>
                                            </td>";
                                        echo "</tr>";
                                }
                                mysqli_close($dbc); // Close the database connection.
                                if ($count == 0) {
                                    echo "<h2 align='center'> No results found</h2>";
                                    echo "<caption>Your search returned 0 results.";
                                    echo "<img class='figure-img w-25' src='img/sad2.png' align='right'></caption>";
                                } else {
                                    echo "<h2 align='center'> Results found</h2>";
                                    echo "<caption>Result: Successfully find $count results.";
                                    echo "<img class='figure-img w-25' src='img/find.jpg' align='right'></caption>";
                                }
                                break;
                            }
                            case 'id': {

                                $key = trim($_POST['good_id']);
                                //connect to the database
//                                require('mysqli_connect.php');
                                $sql = "SELECT id, good_name, supermarket, price, description,tag, promote FROM goods WHERE id='$key'";
                                // Make the connection
                                $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not 
                        connect to MySQL: ' . mysqli_connect_error());
                                $retval = mysqli_query($dbc, $sql);
                                $count = mysqli_num_rows($retval);
                                if ($row = mysqli_fetch_array($retval)) {
                                        $des = substr($row['description'], 0, 12);
                                        $name = substr($row['good_name'],0,10);
                                        $super = substr($row['supermarket'],0,12);
                                        $price = substr($row['price'],0,8);
                                        $tag = substr($row['tag'],0,12);
                                        echo "<tr>";
                                        echo "<td>{$row['id']}";
                                        echo "<td>$name</td>";
                                        echo "<td>$super</td>";
                                        echo "<td>$price</td>";
                                        echo "<td title='{$row['description']}' data-container='body' data-toggle='popover'
                                                data-placement='top'>$des</td>";
                                        echo "<td> {$row['promote']}&nbsp;up ";
                                        echo "<td>$tag</td>";
                                        echo "<td>
                                                    <div class='btn-group dropup btn-group-sm'>
                                                        <button type=\"button\" class=\"btn btn-outline-info dropdown-toggle\" data-toggle=\"dropdown\">act 
                                                            <span class=\"caret\"></span>
                                                        </button>
                                                                <ul class='dropdown-menu' role=\"menu\">
                                                                    <li><button type='submit'class='btn-outline-info' onclick='voteFunction({$row['id']})' name='vote'
                                                                     value='{$row['id']}'  id='tag{$row['id']}'>&nbsp;vote</button></li>
                                                                    <li><button type='submit' class='btn-outline-info'onclick='markFunction({$row['id']})'
                                                                    id='mark{$row['id']}'name='mark' value='{$row['id']}'>mark</button></li>
                                                                    <li><input type=\"text\" name={$row['id']} class=\"col-lg-8\">
                                                                    <button type='submit'class='btn-outline-info' onclick='tagFunction({$row['id']})' name='tag'
                                                                     value='{$row['id']}'  id='tag{$row['id']}'>&nbsp;tag</button></li>
                                                                </ul>
                                                    </div>
                                            </td>";
                                        echo "</tr>";
                                    echo "<h2 align='center'> Results found</h2>";
                                    echo "<caption>Result: Successfully find $count results.";
                                    echo "<img class='figure-img w-25' src='img/find.jpg' align='right'></caption>";
                                }
                                else {
                                    echo "<h2 align='center'> No results found</h2>";
                                    echo "<caption>Your search returned 0 results.";
                                    echo "<img class='figure-img w-25' src='img/sad2.png' align='right'></caption>";
                                }
                                mysqli_close($dbc); // Close the database connection.

                            }
                        }
                        ?>
                        </tbody>
                    </table>
                    </form>
                </div>

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


</body>

</html>





