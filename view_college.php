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

    <title>Euphoria GenX - View College</title>

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
                        <h2 class="page-header">All Colleges</h2>
                        <a href="add_new_col.php" class="btn btn-primary">Add New College</a>
                        <?php
                        if (isset($_GET['msg'])) {
                        ?>
                            <script>
                                alert('<?php echo $_GET['msg']; ?>');
                            </script>
                        <?php
                        }
                        ?>
                        <br><br>
                    </div>
                    <div class="col-lg-12" style="height:400px;">
                        <?php
                        if (isset($_GET['pageno'])) {
                            $pageno = $_GET['pageno'];
                        } else {
                            $pageno = 1;
                        }
                        $no_of_records_per_page = 5;
                        $offset = ($pageno - 1) * $no_of_records_per_page;

                        $total_pages_sql = "SELECT COUNT(*) FROM college WHERE status='1'";
                        $result = mysqli_query($conn, $total_pages_sql);
                        $total_rows = mysqli_fetch_array($result)[0];
                        $total_pages = ceil($total_rows / $no_of_records_per_page);
                        $sql = "SELECT * FROM college WHERE status='1' ORDER BY col_name LIMIT $offset, $no_of_records_per_page";
                        $res_data = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($res_data) > 0) {
                        ?><table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>College name</th>
                                        <th>Update</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <?php
                                while ($row = mysqli_fetch_assoc($res_data)) {
                                ?>
                                    <tr>
                                        <td><?php echo $row['col_name']; ?></td>
                                        <td class="text-center"><a href="update_col.php?col_id=<?php echo $row['col_id'] ?>"><i class="far fa-edit"></i></a></td>
                                        <td class="text-center"><a href="javascript:void(0)" onClick="colDelete(<?php echo $row['col_id'] ?>)"><i class="fas fa-trash-alt text-danger"></i></a></td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <h4 class="text-center text-danger">No College details found</h4>
                            <?php
                            }
                            mysqli_close($conn);
                            ?>
                            </table>
                    </div>
                    <ul class="pagination">
                        <li class="<?php if ($pageno <= 1 && $pageno == 1) {
                                        echo 'disabled';
                                    } ?>"><a href="?pageno=1">First</a></li>
                        <li class="<?php if ($pageno <= 1) {
                                        echo 'disabled';
                                    } ?>">
                            <a href="<?php if ($pageno <= 1) {
                                            echo '#';
                                        } else {
                                            echo "?pageno=" . ($pageno - 1);
                                        } ?>">Prev</a>
                        </li>
                        <li class="<?php if ($pageno >= $total_pages) {
                                        echo 'disabled';
                                    } ?>">
                            <a href="<?php if ($pageno >= $total_pages) {
                                            echo '#';
                                        } else {
                                            echo "?pageno=" . ($pageno + 1);
                                        } ?>">Next</a>
                        </li>
                        <li class="<?php if ($pageno >= $total_pages) {
                                        echo 'disabled';
                                    } ?>"><a href="<?php echo "?pageno=" . $total_pages ?>">Last</a></li>
                    </ul>
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
    <script>
        function colDelete(college) {
            $.ajax({
                type: 'POST',
                url: 'delete_col.php',
                data: 'col_id=' + college,
                success: function(html) {
                    //$('#sem_date').html(html);
                    alert(html);
                    location.reload(true);
                }
            });
        }
    </script>

</body>

</html>