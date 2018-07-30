<?php session_start(); ?>
<?php include('header.php'); ?>
<style>
.toggle-title span, .toggle-inner p{
	text-align: left;
}
.actions{
	float:left;
	width:100%;
}
</style>
<?php
if (isset($_SESSION['ud_login']) && $_SESSION['ud_login']['pro_id']==1 ){
	
	$query = 'select * from ls_faqs order by id desc';
	$result = $conn->query($query);
?>
<section class="dashboard-wrapper">	
	<div class="currency-listing">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="c-page-heading">
						<h1 class="">Manage FAQ</h1>
						<div class="actions">
							<a class="btn add-faq-btn" href="add-faq.php" style="
						    position: absolute;
						    right: 15px;
						    bottom: 20px;
						">Add New</a>
					</div>
					</div>
					<?php if (!empty($_SESSION['msg'])) { ?>
					<p class="success-msg">
						<?php echo $_SESSION['msg']; unset($_SESSION['msg']); ?>
					</p>
					<?php } ?>
					
					<?php if (!empty($_SESSION['error'])) { ?>
					<p class="error-msg">
						<?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
					</p>
					<?php } ?>
					<!--faq accordian start-->
					<?php if (!empty($_SESSION['msg1'])) { ?>
					<p class="success-msg">
						<?php echo $_SESSION['msg1']; unset($_SESSION['msg1']); ?>
					</p>
					<?php } ?>
					
					<?php if (!empty($_SESSION['error1'])) { ?>
					<p class="error-msg">
						<?php echo $_SESSION['error1']; unset($_SESSION['error1']); ?>
					</p>
					<?php } ?>
					
					 
						<?php if ( $result->num_rows > 0 ) { 
							while($row = $result->fetch_assoc()){ ?>
						<div class="toggle">
							<div class="toggle-title">
								<h3>
								<a href="edit-faq.php?id=<?php echo $row['id']; ?>">
									<i class="fa fa-edit"></i>
								</a>
								<a href="add-faq.php?id=<?php echo $row['id']; ?>&action=delete">
									<i class="fa fa-trash"></i>
							 	</a>
								<i class="plus"></i>

								<span class="title-name"><?php echo $row['title']; ?></span>
								</h3>
							</div>
							<div class="toggle-inner">
								<?php echo utf8_decode($row['description']); ?>
							</div>
						</div>
						<?php 
							} 
						} ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php } ?>
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery(".toggle .toggle-title .plus").click(function(){
			if( jQuery(this).parents('.toggle-title').hasClass('active') ){
				jQuery(this).parents('.toggle-title').removeClass("active").closest('.toggle').find('.toggle-inner').slideUp(500);
			}
			else{	jQuery(this).parents('.toggle-title').addClass("active").closest('.toggle').find('.toggle-inner').slideDown(500);
			}
		});
	})
</script>
