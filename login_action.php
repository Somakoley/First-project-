<?php require("config.php");?>
<?php
if(isset($_POST['ok'])){
	$email=$_POST['email'];
	$pass=$_POST['pass'];
	$src="SELECT * FROM `user` WHERE `email`='".$email."' AND `pass`='".$pass."'";
	$rs=mysqli_query($conn,$src)or die(mysqli_error($conn));
	if(mysqli_num_rows($rs)>0){
		$rec=mysqli_fetch_assoc($rs);
		$_SESSION['a_info']=$rec;
		header('location:index.php');
		exit;
	}else{
	   // echo $rs;
	    header('location:login.php?msg=Invalid email or password');
		exit;
	}
}
?>