<?php require_once "dbconfig.php";
if (isset($_SESSION['login'])) {
} else {
	header("location:login.php");
}

?>
<!DOCTYPE HTML>
<html>
<?php include "head.php"; ?>

<body>
	<div class="page-container">
		<div class="left-content">
			<div class="inner-content">
				<?php //include"header.php";
				?>
				<div class="outter-wp">
					<!-- <div class="sub-heard-part">
						<ol class="breadcrumb m-b-0">
							<li><a href="index.html">Home</a></li>
						</ol>
					</div> -->
					<div class="graph-visual tables-main">
						<div class="graph">
							<div class="block-page">
								<center>
									<h1>Admin Dashboard</h1>
									<p>***only admin can access this Dashboard*** </p>
								</center>
							</div>

						</div>

					</div>
				</div>
				<?php include "footer.php" ?>
			</div>
		</div>
		<?php include "side_bar.php"; ?>
	</div>
	<?php include "footer_script.php"; ?>
</body>

</html>