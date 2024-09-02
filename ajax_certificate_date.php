<?php require("config.php");
require("session.php");
$col_id = $_POST['col_id'];
//$src=;
$rs = mysqli_query($conn, "SELECT DISTINCT `issue_date` FROM `certificate_table` WHERE `col_id`=$col_id") or die(mysqli_error($con));
if (mysqli_num_rows($rs) > 0) {
?>
    <option value="">Select Certificate Date</option>
    <?php
    while ($rec = mysqli_fetch_assoc($rs)) {
    ?>
        <option value="<?php echo $rec['issue_date'] ?>"><?php echo $rec['issue_date'] ?></option>
<?php
    }
} else {
    echo '<option value="">Issue Date is not available</option>';
}
?>