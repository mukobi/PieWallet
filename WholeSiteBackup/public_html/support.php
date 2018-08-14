<?php session_start(); ?>
<?php include('header.php'); ?>
<?php
	$query = 'select * from ls_faqs order by id desc';
	$result = $conn->query($query);
?>
<section class="dashboard-wrapper">	
	<div class="currency-listing">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="">FAQ</h1>
					<!--faq accordian start-->
					<div class="container"> 
						<?php if ( $result->num_rows > 0 ) { 
							while($row = $result->fetch_assoc()){ 
								 ?>
					 	<div class="toggle">
							<div class="toggle-title">
								<h3>
								<i class="plus"></i>
								<span class="title-name"><?php echo $row['title']; ?></span>
								</h3>
							</div>
							<div class="toggle-inner">
								<?php echo utf8_decode($row['description']); ?>
							</div>
						</div><!-- END OF TOGGLE -->
						<?php 
							} 
						} ?>
					</div>
					<!--faq accordian close-->
				</div>
			</div>
		</div>
	</div>

</section>
<?php include('footer.php'); ?>