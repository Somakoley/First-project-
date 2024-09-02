<?php require("config.php");
require("session.php");
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Euphoria GenX - Certificate Generation</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/startmin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php require('menu_bar.php') ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Add New College</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-6">
                        <form role="form" name="add_col_frm" method="post">
                            <div class="form-group">
                                <label for="col_name">Enter college name</label>
                                <input class="form-control" placeholder="Enter college name" name="col_name" type="text" autofocus required>
                            </div>
                            <!-- <div class="form-group">
                                <label for="col_logo">Select college logo</label>
                                <input class="form-control" placeholder="Enter college name" name="ff" type="file" required>
                            </div> -->
                            <input type="submit" name="ok" value="Add College" class="btn btn-success">
                        </form>

                        <?php
                        if (isset($_POST['ok'])) {
                            $col_name = $_POST['col_name'];
                            $sql1 = "SELECT `col_name` FROM `college` WHERE `col_name`='$col_name' AND `status`='1'";
                            $rs = mysqli_query($conn, $sql1) or die(mysqli_error($conn));
                            if (mysqli_num_rows($rs) > 0) {
                                echo 'The college name already exists';
                                exit;
                            } else {
                                $sql = "INSERT INTO `college` (`col_name`) VALUE ('$col_name')";
                                $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                if ($res == 1) {
                                    echo "College add successfull";
                                } else {
                                    echo "College add unsucessful.";
                                }
                                    
                            }
                        }
                        ?>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/startmin.js"></script>

</body>

</html>