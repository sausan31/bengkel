<?php
	include("sess_check.php");
		$id = $_GET['js'];	
		$sql = "DELETE FROM barangjasa WHERE id_brg='". $id ."'";
		$ress = mysqli_query($conn, $sql);
		header("location: ../jasa.html?act=delete&msg=success");
?>