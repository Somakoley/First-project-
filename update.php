<?php require("config.php");
require("session.php");
if(isset($_POST['id'])){
    $std_id=$_POST['id'];
    $col_id=$_POST['col_id'];
    $issue_date=$_POST['issue_date'];
    $subject=$_POST['subject'];

    $_SESSION['std_id']=$std_id;
    $_SESSION['col_id']=$col_id;
    $_SESSION['issue_date']=$issue_date;
    $_SESSION['subject']=$subject;
}else{
    $std_id=$_SESSION['std_id'];
}
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
    <script src="tinymce/tinymce.min.js"></script>
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
            <?php
            
            $srs=mysqli_query($conn, "SELECT s.*, c.col_name FROM certificate_table s INNER JOIN college c ON s.col_id=c.col_id WHERE s.std_id='$std_id'") or die(mysqli_error($con));
            $srec=mysqli_fetch_assoc($srs);
            
            ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Update Student</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-12">
                        <form role="form" name="frmCSVImport" id="frmCSVImport" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                                <label for="std_name">Name of Student</label>
                                <input class="form-control" placeholder="Name of Student" name="std_name" type="text" value="<?php echo $srec['std_name'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="col">Select college</label>
                                <select name="col_id" class="form-control" >
                                <option value="<?php echo $srec['col_id'] ?>"><?php echo $srec['col_name'] ?></option>
                                    <?php
                                    $src = "SELECT `col_id`,`col_name` FROM `college` WHERE status='1' ORDER BY `col_name`";
                                    $rs = mysqli_query($conn, $src);
                                    while ($rec = mysqli_fetch_assoc($rs)) {
                                    ?>
                                        <option value="<?php echo $rec['col_id'] ?>"><?php echo $rec['col_name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input class="form-control" placeholder="Subject" name="subject" type="text" value="<?php echo $srec['subject'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="project_name">Project Name</label>
                                <input class="form-control" placeholder="Project Name" name="project_name" type="text" value="<?php echo $srec['project_name'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input class="form-control" placeholder="Start Date" name="start_date" type="text" value="<?php echo $srec['start_date'] ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input class="form-control" placeholder="End Date" name="end_date" type="text" value="<?php echo $srec['end_date'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="issue_date">Issue Date</label>
                                <input class="form-control" placeholder="Issue Date" name="issue_date" type="text" value="<?php echo $srec['issue_date'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="c_type">Certificate Type</label>
                                <input class="form-control" placeholder="Certificate Type" name="c_type" type="text" value="<?php echo $srec['c_type'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="col_name">Enter Awarded To</label>
                                <input class="form-control" placeholder="Enter Awarded To" name="awd_to" type="text"value="<?php echo $srec['awd_to'] ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="l_1">Certificate Line-1</label>
                                <textarea class="form-control" placeholder="Certificate Line-1" name="l_1" type="text" ><?php echo $srec['l_1'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="l_2">Certificate Line-2</label>
                                <textarea class="form-control" placeholder="Certificate Line-2" name="l_2" type="text" ><?php echo $srec['l_2'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="l_3">Certificate Line-3</label>
                                <textarea  class="form-control" placeholder="Certificate Line-3" name="l_3" type="text" ><?php echo $srec['l_3'] ?></textarea>
                            </div>
                            
                            <input type="submit" name="ok" value="Update Student" class="btn btn-success">
                            <input type="submit" name="del" value="Delete Student" class="btn btn-danger">
                            <!-- <a href="delete_student.php"  class="" value="Delete Student">Delete Student</a> -->
                        </form>
                        
                        <?php
                        if(isset($_POST['del'])){
                            $del=mysqli_query($conn,"UPDATE certificate_table SET std_status='0' WHERE std_id=".$std_id) or die(mysqli_error($conn));

                            if($del==1){
                                unset($_SESSION['std_id']);
                                $_SESSION['msg']='Student data delete successful';
                                ?>
                                        <script>
                                            window.location = 'get_certificate.php';
                                        </script>
                                    <?php
                            } else {
                                $_SESSION['err']='Student data not delete successful';
                            ?>
                                <script>
                                    window.location = 'get_certificate.php';
                                </script>
                            <?php
                            }
                        }
                        if (isset($_POST['ok'])) {
                            $c_type=$_POST['c_type'];
                            $awd_to=$_POST['awd_to'];
                            $std_name=$_POST['std_name'];
                            $col_id = $_POST['col_id'];
                            $subject=$_POST['subject'];
                            $project_name=$_POST['project_name'];
                            $start_date=$_POST['start_date'];
                            $end_date=$_POST['end_date'];
                            $issue_date=$_POST['issue_date'];
                            $l_1=$_POST['l_1'];
                            $l_2=$_POST['l_2'];
                            $l_3=$_POST['l_3'];
                            $upd = mysqli_query($conn, "UPDATE certificate_table SET c_type='".mysqli_real_escape_string($conn,$c_type)."',awd_to='".mysqli_real_escape_string($conn,$awd_to)."',std_name='".mysqli_real_escape_string($conn,$std_name)."',col_id='$col_id',subject='".mysqli_real_escape_string($conn,$subject)."',project_name='".mysqli_real_escape_string($conn,$project_name)."',start_date='".mysqli_real_escape_string($conn,$start_date)."',end_date='".mysqli_real_escape_string($conn,$end_date)."',issue_date='".mysqli_real_escape_string($conn,$issue_date)."',l_1='".mysqli_real_escape_string($conn,$l_1)."',l_2='".mysqli_real_escape_string($conn,$l_2)."',l_3='".mysqli_real_escape_string($conn,$l_3)."' WHERE std_id=".$std_id) or die(mysqli_error($conn));
                            if ($upd == 1) {
                                $_SESSION['msg']='Student data update successful';
                                ?>
                                        <script>
                                            window.location = 'get_certificate.php';
                                        </script>
                                    <?php
                                    } else {
                                        $_SESSION['err']='Student data not update successful';
                                    ?>
                                        <script>
                                            window.location = 'get_certificate.php';
                                        </script>
                                    <?php
                                    }
                        }
                        ?>
                        <div id="response" class="<?php if (!empty($type)) {
                                                        echo $type . " display-block";
                                                    } ?>"><?php if (!empty($message)) {
                                                                echo $message;
                                                            } ?></div>
                    </div>
                   
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

    <script type="text/javascript">
        $(document).ready(function() {
            $("#frmCSVImport").on("submit", function() {

                $("#response").attr("class", "");
                $("#response").html("");
                var fileType = ".csv";
                var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
                if (!regex.test($("#file").val().toLowerCase())) {
                    $("#response").addClass("error");
                    $("#response").addClass("display-block");
                    $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
                    return false;
                }
                return true;
            });
        });
    </script>

</body>

</html>