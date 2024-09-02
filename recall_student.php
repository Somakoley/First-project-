<?php require("config.php");
require("session.php");
if(isset($_POST['id'])){
    $std_id=$_POST['id'];
    $col_id=$_POST['col_id'];
    $seminar_date=$_POST['seminar_date'];
    $dept=$_POST['dept'];

    $_SESSION['std_id']=$std_id;
    $_SESSION['col_id']=$col_id;
    $_SESSION['seminar_date']=$seminar_date;
    $_SESSION['dept']=$dept;
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
            
            $srs=mysqli_query($conn, "SELECT s.*, c.col_name FROM STUDENT s INNER JOIN college c ON s.col_id=c.col_id WHERE std_id='$std_id'") or die(mysqli_error($con));
            $srec=mysqli_fetch_assoc($srs);
            
            ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Recall Student</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-6">
                        <form role="form" name="frmCSVImport" id="frmCSVImport" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="c_type">Certificate Type</label>
                                <input class="form-control" placeholder="Certificate Type" name="c_type" type="text" value="<?php echo $srec['c_type'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="col_name">Enter Awarded To</label>
                                <input class="form-control" placeholder="Enter Awarded To" name="awd_to" type="text"value="<?php echo $srec['awd_to'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="std_name">Name of Student</label>
                                <input class="form-control" placeholder="Name of Student" name="std_name" type="text" value="<?php echo $srec['std_name'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input class="form-control" placeholder="Email" name="email" type="email" value="<?php echo $srec['email'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="mobile">Mobile</label>
                                <input class="form-control" placeholder="Mobile" name="mobile" type="text" value="<?php echo $srec['mobile'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input class="form-control" placeholder="Subject" name="subject" type="text" value="<?php echo $srec['subject'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="dept">Department</label>
                                <input class="form-control" placeholder="Department" name="dept" type="text" value="<?php echo $srec['dept'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="col">Select college</label>
                                <select name="col_id" class="form-control" >
                                <option value="<?php echo $srec['col_id'] ?>"><?php echo $srec['col_name'] ?></option>
                                    <?php
                                    $src = "SELECT `col_id`,`col_name` FROM `college` ORDER BY `col_name`";
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
                                <label for="l_1">Certificate Line-1</label>
                                <input class="form-control" placeholder="Certificate Line-1" name="l_1" type="text" value="<?php echo $srec['l_1'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="l_2">Certificate Line-2</label>
                                <input class="form-control" placeholder="Certificate Line-2" name="l_2" type="text" value="<?php echo $srec['l_2'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="l_3">Certificate Line-3</label>
                                <input class="form-control" placeholder="Certificate Line-3" name="l_3" type="text" value="<?php echo $srec['l_3'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="seminar_date">Seminar Date</label>
                                <input class="form-control" placeholder="Seminar Date" name="seminar_date" type="text" value="<?php echo $srec['seminar_date'] ?>">
                            </div>
                            <input type="submit" name="del" value="Re-Call Student" class="btn btn-danger">
                            <!-- <a href="delete_student.php"  class="" value="Delete Student">Delete Student</a> -->
                        </form>
                        
                        <?php
                        if(isset($_POST['del'])){
                            $del=mysqli_query($conn,"UPDATE student SET active='1' WHERE std_id=".$std_id) or die(mysqli_error($conn));

                            if($del==1){
                                unset($_SESSION['std_id']);
                                $_SESSION['msg']='Student data restore successful';
                                ?>
                                <script>
                                    window.location = 'view_student.php';
                                </script>
                                <?php
                            }else{
                                $_SESSION['err']='Student data not restore successful';
                            ?>
                                <script>
                                    window.location = 'view_student.php';
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