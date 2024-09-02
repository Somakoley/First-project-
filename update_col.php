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
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
                        <h1 class="page-header">Update College Details</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-6">
                        <?php

                        $src = mysqli_query($conn, "SELECT * FROM `college` WHERE `col_id`=" . $_GET['col_id']) or die(mysqli_error($conn));
                        $col_rec = mysqli_fetch_assoc($src);
                        ?>
                        <form role="form" name="add_col_frm" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="col_name">College name</label>
                                <input class="form-control" placeholder="Enter college name" name="col_name" type="text" autofocus required value="<?php echo $col_rec['col_name']; ?>">
                            </div>
                            <input type="submit" name="ok" value="Update College" class="btn btn-success">
                        </form>

                        <?php
                        if (isset($_POST['ok'])) {
                            $col_name = $_POST['col_name'];
                            $upd = mysqli_query($conn, "UPDATE `college` SET `col_name`='$col_name' WHERE col_id=" . $_GET['col_id']) or die(mysqli_error($conn));
                            if ($upd == 1) {
                        ?>
                                <script>
                                    window.location = 'view_college.php?msg=College data update successful';
                                </script>
                            <?php
                            } else {
                            ?>
                                <script>
                                    window.location = 'view_college.php?msg=College data not update successful';
                                </script>
                            <?php
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