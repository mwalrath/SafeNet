<?php 
session_start();

include('header.php');
include_once('functions.php');
if($_POST){
    if(isset($_POST['restock'])){
        R($_SESSION['drawer']);
        //echo "Restocked!";
    }
}


 ?>
	<div class="container">
	<header>
		<img src="primary-logo.png" alt="SafeNet">
		<h1>ATM</h1>
	</header>
	<div id="col1" class="col-md-6">
		<?php 
			include('atm.php');
		 ?>
		<?php 
			
			$ammount = isset($_POST["ammount"]) ? $_POST["ammount"] : '';
			$ammount = cleaner($ammount);
			
			if ($ammount != NULL) {
				include('output.php');
			} else {
				
			}
		 ?>
		
	</div><!--end col1 -->
	<div id="col2" class="col-md-6">
		<?php include('admin.php') ;?>
	</div><!--end col2 -->
<?php 
	include('footer.php');
 ?>