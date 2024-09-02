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
						<h1 class="page-header">Prarticipation, Workshop, Industry Visit Certificate</h1>
						<a href="add_student.php" class="btn btn-primary">Add Student</a>
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
								<select name="seminar_date" id="sem_date" class="form-control">
									<option value="">Select college first</option>
								</select>
							</div>
							<div class="col-lg-3">
								<select name="dept" id="dept" class="form-control">
									<option value="">Select seminar date first</option>
								</select>
							</div>

							<div class="col-lg-3">
								<input type="submit" name="ok" value="Search" class="btn btn-primary">
							</div>
						</form>
					</div>
					<!-- /.col-lg-12 -->
					<div class="col-lg-12">
						<br>
						<?php
						if (isset($_POST['ok'])) {
							$col_id = $_POST['col_id'];
							$seminar_date = $_POST['seminar_date'];
							$dept = $_POST['dept'];
							if (!empty($col_id) && !empty($seminar_date)) {
								$sql = "SELECT s.*,c.col_name FROM student s INNER JOIN college c ON s.col_id=c.col_id WHERE s.col_id=$col_id AND s.seminar_date='$seminar_date' AND s.dept='$dept' AND s.active='1'";
								$std_rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
								if (mysqli_num_rows($std_rs) > 0) {
						?>
									<table class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>Sl No.</th>
												<th>Type</th>
												<th>Awarded</th>
												<th>Name</th>
												<th>Email</th>
												<th>Mobile</th>
												<th>Subject</th>
												<th>Department</th>
												<th>College</th>
												<th>Line-1</th>
												<th>Line-2</th>
												<th>Line-3</th>
												<th>Seminar Date</th>
												<th>Action</th>
											</tr>
										</thead>
										<?php
										$sl = 1;
										while ($std_rec = mysqli_fetch_assoc($std_rs)) {
										?>
											<tr>
												<td><?php echo $sl; ?></td>
												<td><?php echo $std_rec['c_type']; ?></td>
												<td><?php echo $std_rec['awd_to']; ?></td>
												<td><?php echo $std_rec['std_name'] ?></td>
												<td><?php echo $std_rec['email'] ?></td>
												<td><?php echo $std_rec['mobile'] ?></td>
												<td><?php echo $std_rec['subject'] ?></td>
												<td><?php echo $std_rec['dept'] ?></td>
												<td><?php echo $std_rec['col_name'] ?></td>
												<td><?php echo $std_rec['l_1'] ?></td>
												<td><?php echo $std_rec['l_2'] ?></td>
												<td><?php echo $std_rec['l_3'] ?></td>
												<td><?php echo $std_rec['seminar_date'] ?></td>
												<td>
													<?php
													if ($std_rec['std_status'] == 1) {
													?>
														<a href="c_pdf.php?std_id=<?php echo $std_rec['std_id']; ?>" class="btn btn-warning">Already Generate</a>
													<?php
													} else {
													?>
														<a href="c_pdf.php?std_id=<?php echo $std_rec['std_id']; ?>" class="btn btn-success">Generate</a>
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
									echo "Please select college or Seminar Date";
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
						url: 'ajax_seminar.php',
						data: 'col_id=' + col_id,
						success: function(html) {
							$('#sem_date').html(html);
						}
					});
				} else {
					$('#sem_date').html('<option value="">Select college first</option>');
					$('#sem_date').html('<option value="">Select semianr date first</option>');
				}
			});

			$('#sem_date').on('change', function() {
				var sem_date = $(this).val();
				var col_id = $("#col_name").val();
				//alert(col_id);
				if (sem_date) {
					$.ajax({
						type: 'POST',
						url: 'ajax_dept.php',
						data: {
							col_id: col_id,
							seminar_date: sem_date
						},
						success: function(html) {
							$('#dept').html(html);
						}
					});
				} else {
					$('#dept').html('<option value="">Select seminar date first</option>');
				}
			});
		});
	</script>

</body>

</html>