<?php session_start(); 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
?>
<?php include('header.php'); ?>
<section class="dashboard-wrapper wrapit">	
	<div class="currency-listing">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h1>Send</h1>
					
					<span style="font-size: 24px; padding-bottom: 20px; display: block;">Find user</span>

					<form action="send.php?go" method="post">

						<div class="row">	
							<div class="col-lg-8 form-group">
								<input type="text" name="nick" class="form-control" placeholder="Search by nickname...">
							</div>
							<div class="col-lg-4 submit-btn">
								<input type="submit" class="btn send_button btn-default" name="search" value="Search">
							</div>
						</div>
						 
					</form>
					
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12">
				
					<?php

					if(isset($_POST['search'])){

					  if(isset($_GET['go'])){

						  if(preg_match("/^[  a-zA-Z]+/", $_POST['nick'])){
							$name = $_POST['nick'];

							$stmt = " SELECT  * FROM ls_users WHERE nickname LIKE '%" . $name .  "%'; ";
							$result = $conn->query($stmt);
							while( $row = $result->fetch_assoc() ){

							$id = $row['id'];
							$firstname = $row['firstname'];
							$lastname = $row['lastname'];
							$name = $firstname . " " . $lastname;
							$nickname = $row['nickname'];
							$email = $row['email'];
							$label = $row['label'];
							$address = $row['address'];


							echo "<ul class='search_results' >";
							echo "<li>
							<a class='search_result' href='profile.php?id=$id'>"   .$nickname."</a>
							</li>";
							// echo "<li>
							// <a class='search_result' href='profile.php?id=$id'>"   .$nickname. " - " . $name .  "</a>
							// <a class='pull-right' href='send.php?id=$id'>Send</a>
							// </li>";
							echo "</ul>";
							}
						}
						else{
							echo  "<p>Please enter a search query</p>";
						}
					  }
					}

					?>

				</div>			
			</div>	
		</div>
	</div>

</section>

<?php include('footer.php'); ?>