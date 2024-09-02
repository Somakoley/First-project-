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
    <script src="tinymce/tinymce.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script>
        // tinymce.init({
        //     selector: 'textarea',
        //     plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown',
        //     toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        //     tinycomments_mode: 'embedded',
        //     tinycomments_author: 'Author name',
        //     ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
        //     branding: false,
        //     statusbar: false,
        //     menubar:false,
        //     height: 125,
        // });
        </script>
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
                        <h1 class="page-header">Add Student for Internship or Training Certificate</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-12">
                        <form role="form" name="frmCSVImport" id="frmCSVImport" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                                <label for="col_name">Certificate Type</label>
                                <input class="form-control" placeholder="Certificate Type" name="c_type" type="text">
                            </div>
                            <div class="form-group">
                                <label for="col_name">Enter Awarded To</label>
                                <input class="form-control" placeholder="Enter Awarded To" name="awd_to" type="text">
                            </div>
                            <div class="form-group">
                                <label for="col">Select college</label>
                                <select name="col_id" class="form-control">
                                    <?php
                                    $src = "SELECT `col_id`,`col_name` FROM `college` ORDER BY `col_name`";
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
                                <div class="form-group">
                                <label for="l_1">Certificate Line-1</label>
                                <textarea class="form-control" placeholder="Certificate Line-1" name="l_1"  ></textarea>
                            </div>
                            <div class="form-group">
                                <label for="l_2">Certificate Line-2</label>
                                <textarea class="form-control" placeholder="Certificate Line-2" name="l_2" ></textarea>
                            </div>
                            <div class="form-group">
                                <label for="l_3">Certificate Line-3</label>
                                <textarea class="form-control" placeholder="Certificate Line-3" name="l_3" ></textarea>
                            </div>
                            
                            <!--<div class="form-group">
                            	<label for="col_name">Enter Subject</label>
                               <input class="form-control" placeholder="Enter subject name" name="subject" type="text" required>
                            </div>-->
                            <div class="form-group">
                                <label for="col_name">Select a CSV file</label>
                                <input class="form-control" placeholder="Enter college name" name="file" type="file" required accept=".csv">
                            </div>
                            <input type="submit" name="ok" value="Upload Student" class="btn btn-success">
                        </form>
                        <img src="img/img.png" width="800">
                        <?php
                        if (isset($_POST['ok'])) {
                            $col_id = $_POST['col_id'];
                            $c_type=$_POST['c_type'];
                            $awd_to=$_POST['awd_to'];
                            $l_1=$_POST['l_1'];
                            $l_2=$_POST['l_2'];
                            $l_3=$_POST['l_3'];
                            $fileName = $_FILES["file"]["tmp_name"];
                            if ($_FILES["file"]["size"] > 0) {

                                $file = fopen($fileName, "r");

                                while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
                                    $sqlInsert = "INSERT into certificate_table(std_name, subject, project_name, start_date, end_date, sl_no, issue_date, col_id, c_type, awd_to, l_1, l_2, l_3) VALUES ('" . $column[0] . "','" . mysqli_real_escape_string($conn, $column[1]) . "','" . mysqli_real_escape_string($conn,$column[2]) . "','" . $column[3] . "','" . $column[4] . "','" . $column[5] . "','" . $column[6] . "','" . $col_id . "','" . mysqli_real_escape_string($conn,$c_type) . "','" . mysqli_real_escape_string($conn,$awd_to) . "','" .mysqli_real_escape_string($conn, $l_1) . "','" . mysqli_real_escape_string($conn,$l_2) . "','" . mysqli_real_escape_string($conn,$l_3) . "')";
                                    $result = mysqli_query($conn, $sqlInsert);
                                    if (!empty($result)) {
                                        $type = "success";
                                        $message = "CSV Data Imported into the Database";
                                    } else {
                                        $type = "error";
                                        $message = "Problem in Importing CSV Data";
                                    }
                                }
                            }
                        }
                        ?>
                        <div id="response" class="<?php if (!empty($type)) {
                                                        echo $type . " display-block";
                                                    } ?>"><?php if (!empty($message)) {
                                                                echo $message;
                                                            } ?></div>
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