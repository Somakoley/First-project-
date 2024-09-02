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
                        <h1 class="page-header">Get Industrial Training & Internship Certificate</h1>
                        <a href="add_student_generate_certificate.php" class="btn btn-primary">Add Student for Certificate</a>
                        <br><br>
                        <form name="src_std" method="post">
                            <div class="col-lg-3">
                                <select name="col_id" id="col_name" class="form-control">
                                    <?php
                                    $src = "SELECT `col_id`,`col_name`,`status` FROM `college` WHERE status='1' ORDER BY `col_name`";
                                    $rs = mysqli_query($conn, $src);
                                    ?>
                                    <option value="">Select College</option>
                                    <?php
                                    while ($rec = mysqli_fetch_assoc($rs)) {
                                    ?>
                                        <option value="<?php echo $rec['col_id'] ?>"><?php echo $rec['col_name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <select name="issue_date" id="issue_date" class="form-control">
                                    <option value="">Select college first</option>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <select name="subject" id="subject" class="form-control">
                                    <option value="">Select issue date first</option>
                                </select>
                            </div>

                            <div class="col-lg-3">
                                <input type="submit" name="ok" value="Search" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-12">
                    <div class="col-6">
							<?php
							if(isset($_SESSION['msg'])){
								echo '<div class="alert alert-success">'.$_SESSION['msg'].'</div>';
								unset($_SESSION['msg']);
							}
							if(isset($_SESSION['err'])){
								echo '<div class="alert alert-danger">'.$_SESSION['err'].'</div>';
								unset($_SESSION['msg']);
							}
							?>
						</div>
                        <br>
                        <?php
                        if(isset($_POST['ok']) || isset($_SESSION['subject'])) {
							if(empty($_SESSION['subject'])){
								$col_id = $_POST['col_id'];
								$issue_date = $_POST['issue_date'];
								$subject = $_POST['subject'];
							}else{
							$subject=$_SESSION['subject'];
							$issue_date=$_SESSION['issue_date'];
							$col_id=$_SESSION['col_id'];
							unset($_SESSION['subject']);
							unset($_SESSION['issue_date']);
							unset($_SESSION['col_id']);
							}
                            if (!empty($col_id) && !empty($issue_date)) {
                                $sql = "SELECT s.*,c.col_name FROM certificate_table s INNER JOIN college c ON s.col_id=c.col_id WHERE s.col_id=$col_id AND s.issue_date='$issue_date' AND s.subject='$subject' AND s.std_status='1'";
                                $std_rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                if (mysqli_num_rows($std_rs) > 0) {
                        ?>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Sl No.</th>
                                                <th>Name</th>
                                                <th>College</th>
                                                <th>Subject</th>
                                                <th>Project Name</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Certificate No.</th>
                                                <th>Issue Date</th>
                                                <th>Certificate Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $sl = 1;
                                        while ($std_rec = mysqli_fetch_assoc($std_rs)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $sl; ?></td>
                                                <td>
													<form name="upd-student-<?php echo $i; ?>" method="post" action="update.php">
                                                    	<input type="hidden" name="id" value="<?php echo $std_rec['std_id'] ?>">
														<input type="hidden" name="col_id" value="<?php echo $std_rec['col_id'] ?>">
														<input type="hidden" name="issue_date" value="<?php echo $std_rec['issue_date'] ?>">
														<input type="hidden" name="subject" value="<?php echo $std_rec['subject'] ?>">
                                                    	<button type="submit" class="btn"><?php echo $std_rec['std_name'] ?></button>
                                                    </form>
												</td>
                                                <td><?php echo $std_rec['col_name'] ?></td>
                                                <td><?php echo $std_rec['subject'] ?></td>
                                                <td><?php echo $std_rec['project_name'] ?></td>
                                                <td><?php echo $std_rec['start_date'] ?></td>
                                                <td><?php echo $std_rec['end_date'] ?></td>
                                                <td><?php echo $std_rec['sl_no'] ?></td>
                                                <td><?php echo $std_rec['issue_date'] ?></td>
                                                <td><?php echo $std_rec['c_type'] ?></td>
                                            <td>
                                                    <?php
                                                    if ($std_rec['crt_status'] == 1) {
                                                    ?>
                                                        <a href="training_certificate.php?std_id=<?php echo $std_rec['std_id']; ?>" class="btn btn-warning">Already Generate</a>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <a href="training_certificate.php?std_id=<?php echo $std_rec['std_id']; ?>" class="btn btn-success">Generate</a>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>

                                            </tr>
                            <?php
                                            $sl++;
                                        }
                                    } else {
                                        echo "No Student Details Found";
                                    }
                                } else {
                                    echo "Please select college or issue Date";
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
    <script>
        $(document).ready(function() {
            $('#col_name').on('change', function() {
                var col_id = $(this).val();
                if (col_id) {
                    $.ajax({
                        type: 'POST',
                        url: 'ajax_certificate_date.php',
                        data: 'col_id=' + col_id,
                        success: function(html) {
                            $('#issue_date').html(html);
                        }
                    });
                } else {
                    $('#issue_date').html('<option value="">Select college first</option>');
                    $('#issue_date').html('<option value="">Select Certificate date first</option>');
                }
            });

            $('#issue_date').on('change', function() {
                var issue_date = $(this).val();
                var col_id = $("#col_name").val();
                //alert(col_id);
                if (issue_date) {
                    $.ajax({
                        type: 'POST',
                        url: 'ajax_subject.php',
                        data: {
                            col_id: col_id,
                            issue_date: issue_date
                        },
                        success: function(html) {
                            $('#subject').html(html);
                        }
                    });
                } else {
                    $('#subject').html('<option value="">Select issue date first</option>');
                }
            });
        });
    </script>

</body>

</html>