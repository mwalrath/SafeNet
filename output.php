<section id="output">
					<h3>Output</h3>
<?php  
	if (ctype_digit($ammount)) {
		withdrawl($ammount,$_SESSION['drawer'],$allocated, $returns);
	}
	else{
		echo "<h5>FAILURE:</h5> ".$ammount." is incorrect! Only whole numbers are allowed.";
	}


?>		
</section>