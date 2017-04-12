



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
        if (x.innerHTML == '&nbsp;vote') {
            x.innerHTML = 'unvote';
        }
        else {
            x.innerHTML = '&nbsp;vote';
        }
    }

    function markFunction(n){
        var markId = 'mark' + n;
        x = document.getElementById(markId);
        if (x.innerHTML == 'mark') {
            x.innerHTML = 'unmark';
        }
        else {
            x.innerHTML = 'mark';
        }

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
                    <a class="nav-link text-uppercase text-expanded" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item px-lg-4">
                    <a class="nav-link text-uppercase text-expanded" href="business.php">Business Page</a>
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
                <div class="col">
                    <div class="form-group col-12">
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
                <div class="form-control col-lg-9">

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
                                $count = 0;
                                //connect to the database
                                require('mysqli_connect.php');

                                $sql = 'SELECT id, good_name, supermarket, price, description,tag, promote FROM goods
                                        ORDER BY promote DESC, price ASC';
                                // Make the connection
                                $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not 
                        connect to MySQL: ' . mysqli_connect_error());
                                $find = false;
                                $retval = mysqli_query($dbc, $sql);
                                while ($row = mysqli_fetch_array($retval)) {
                                    if ($key == $row['good_name']) {
                                        $find = true;
                                        $count = $count + 1;
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
                                                                    <li><button type='button'class='btn-outline-info'onclick='voteFunction({$row['id']})'
                                                                    id='vote{$row['id']}'>&nbsp;vote</button></li>
                                                                    <li><button type='button' class='btn-outline-info'onclick='markFunction({$row['id']})'
                                                                    id='mark{$row['id']}'>mark</button></li>
                                                                    <li><button type='button'class='btn-outline-info' onclick='tagFunction({$row['id']})'
                                                                    id='tag{$row['id']}'>&nbsp;&nbsp;tag</button></li>
                                                                </ul>
                                                    </div>
                                            </td>";
                                        echo "</tr>";
                                    }
                                }
                                mysqli_close($dbc); // Close the database connection.
                                if ($find == false) {
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
                                $count = 0;
                                //connect to the database
                                require('mysqli_connect.php');

                                $sql = 'SELECT id, good_name, supermarket, price, description,tag, promote FROM goods
                                        ORDER BY promote DESC, price ASC';
                                // Make the connection
                                $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not 
                        connect to MySQL: ' . mysqli_connect_error());
                                $find = false;
                                $retval = mysqli_query($dbc, $sql);
                                while ($row = mysqli_fetch_array($retval)) {
                                    if ($key == $row['tag']) {
                                        $find = true;
                                        $count = $count + 1;
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
                                                                    <li><button type='button'class='btn-outline-info'onclick='voteFunction({$row['id']})'
                                                                    id='vote{$row['id']}'>&nbsp;vote</button></li>
                                                                    <li><button type='button' class='btn-outline-info'onclick='markFunction({$row['id']})'
                                                                    id='mark{$row['id']}'>mark</button></li>
                                                                    <li><button type='button'class='btn-outline-info' onclick='tagFunction({$row['id']})'
                                                                    id='tag{$row['id']}'>&nbsp;&nbsp;tag</button></li>
                                                                </ul>
                                                    </div>
                                            </td>";
                                        echo "</tr>";
                                    }
                                }
                                mysqli_close($dbc); // Close the database connection.
                                if ($find == false) {
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
                                $count = 0;
                                //connect to the database
                                require('mysqli_connect.php');

                                $sql = "SELECT id, good_name, supermarket, price, description,tag, promote FROM goods WHERE id='$key'";
                                // Make the connection
                                $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not 
                        connect to MySQL: ' . mysqli_connect_error());
                                $find = false;
                                $retval = mysqli_query($dbc, $sql);
                                while ($row = mysqli_fetch_array($retval)) {
                                        $find = true;
                                        $count = $count + 1;
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
                                                                    <li><button type='button'class='btn-outline-info'onclick='voteFunction({$row['id']})'
                                                                    id='vote{$row['id']}'>&nbsp;vote</button></li>
                                                                    <li><button type='button' class='btn-outline-info'onclick='markFunction({$row['id']})'
                                                                    id='mark{$row['id']}'>mark</button></li>
                                                                    <li><button type='button'class='btn-outline-info' onclick='tagFunction({$row['id']})'
                                                                    id='tag{$row['id']}'>&nbsp;&nbsp;tag</button></li>
                                                                </ul>
                                                    </div>
                                            </td>";
                                        echo "</tr>";
                                }
                                mysqli_close($dbc); // Close the database connection.
                                if ($find == false) {
                                    echo "<h2 align='center'> No results found</h2>";
                                    echo "<caption>Your search returned 0 results.";
                                    echo "<img class='figure-img w-25' src='img/sad2.png' align='right'></caption>";
                                } else {
                                    echo "<h2 align='center'> Results found</h2>";
                                    echo "<caption>Result: Successfully find $count results.";
                                    echo "<img class='figure-img w-25' src='img/find.jpg' align='right'></caption>";
                                }

                            }

                            case 'tag':{

                                break;
                            }
                            case 'promote':{

                            }
                            case 'mark': {

                            }
                        }
                        ?>
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


<!--create table goods(-->
<!--id INT NOT NULL AUTO_INCREMENT,-->
<!--good_name VARCHAR(100) NOT NULL,-->
<!--supermarket VARCHAR(100) NOT NULL,-->
<!--price DOUBLE NOT NULL,-->
<!--description VARCHAR(255),-->
<!--tag VARCHAR(100) DEFAULT NULL,-->
<!--promote INT DEFAULT 0,-->
<!--PRIMARY KEY ( id )-->
<!--);-->


