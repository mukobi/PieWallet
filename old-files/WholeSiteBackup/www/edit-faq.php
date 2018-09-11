<?php 
session_start(); 
include('header.php');
if (isset($_SESSION['ud_login']) && $_SESSION['ud_login']['pro_id']==1 ){
?>
<style>
.about-us-wrapper form{
	max-width:700px;
}
</style>
<?php
    // add faq code
    if(!empty($_POST) && $_POST['action']=="edit_faq"){
        //echo "<pre>"; print_r($_POST);die;
        $stmt = $conn->prepare("update ls_faqs set title=?, description=?, created=? where id=?");
        $stmt->bind_param("ssss", $title, $description, $created,$id);
        $title = $_POST['title'];
        $description = $_POST['description'];
        $created = date('Y-m-d H:i:s');
        $id = $_POST['id'];
        if($stmt->execute()){
            $_SESSION['msg']="Faq updated successfully";
        }
        else{
            $_SESSION['error'] = 'Some error occured';
        }
        header("Location:http://www.paypeer.io/manage-faq.php");
    }
    if(isset($_GET['id']) && !empty($_GET['id'])){
	$query = 'select * from ls_faqs where id='.$_GET['id'];
	$result = $conn->query($query);
	$row = $result->fetch_assoc();
?>
<script src="https://cdn.ckeditor.com/4.9.0/standard/ckeditor.js"></script>
<script src="//cdn.ckeditor.com/4.4.3/basic/adapters/jquery.js"></script>
<section class="about-us-wrapper">
	<div class="container" id="login-block">
		<h1>Add FAQ</h1>
		<p class="error-msg"><?php if (isset($_SESSION['msg'])) {
		echo $_SESSION['msg'];
		unset($_SESSION['msg']);
		} ?></p>
		<p class="success-msg"><?php if (isset($_SESSION['msg-success'])) {
		echo $_SESSION['msg-success'];
		unset($_SESSION['msg-success']);
		} ?></p>	
		<form name="faqForm" action="edit-faq.php" method="post">
			<input type="hidden" name="action" value="edit_faq">
			<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
			<div class="row">
				<div class="col-sm-12 mb-12 form-group">
					<input  type="text" name="title" class="form-control" placeholder="Enter Title" value="<?php echo $row['title']; ?>" id="title">
					<div id="title-msg" style="color:red;"></div>
				</div>
				<div class="col-sm-12 mb-12 form-group">
					<textarea name="description"><?php echo $row['description']; ?></textarea>
					<div id="description-msg" style="color:red;"></div>
					<script>
						CKEDITOR.replace( 'description' );
					</script>
				</div>
				<div class="col-sm-12 submit-btn">
					<input type="submit" class="btn btn-default" name="edit_faq" value="Submit">
				</div>
			</div>
		</form>
	</div>
</section>
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery("form").submit( function(e) {
			var title = jQuery('#title').val();
			if(title==''){
				jQuery('#title-msg').html("Enter a title.");
				jQuery('#title').focus();
                e.preventDefault();
			}
			else{
				jQuery('#title-msg').html("");
			}
            var messageLength = CKEDITOR.instances['description'].getData().replace(/<[^>]*>/gi, '').length;
            if( !messageLength ) {
            	jQuery('#description-msg').html('Please enter a description');
                e.preventDefault();
            }
            else{
            	jQuery('#description-msg').html("");
            }
        });
	})
</script>
<?php 
include('footer.php'); 
}
else{
	header("Location:http://www.paypeer.io/manage-faq.php");
}
}
?>