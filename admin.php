<section id="admin">
		<h2>Admin Console
		<button id="tog" type="button" class="btn btn-default" aria-label="Left Align" >
  			<span id="togs" class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>
		</button>
		</h2>
		<div id="hidden">
		<?php echo balance($_SESSION['drawer']); ?>
		<form name="admin" method="POST">
			<input type="submit" value="Restock" name="restock">
			<!--<input type="submit" value="Inventory" name="inventory">-->
			<fieldset>
				<h4>Inventory for specific bills</h4>
				<label>$100<input type="checkbox" name="bill[]" value="100" /></label>
				<label>$50<input type="checkbox" name="bill[]" value="50" /></label>
				<label>$20<input type="checkbox" name="bill[]" value="20" /></label>
				<label>$10<input type="checkbox" name="bill[]" value="10" /></label>
				<label>$5<input type="checkbox" name="bill[]" value="5" /></label>
				<label>$1<input type="checkbox" name="bill[]" value="1" /></label>
			</fieldset>
			<input type="submit" value="Inventory" name="inventory">
		</form>
		<?php 
		if($_POST){
    		if(isset($_POST['inventory'])){
        		$bills = $_POST['bill'];
        		
        		echo I($bills, $_SESSION['drawer'] );
        	}
        }
     	?>
		</div><!--end of Hide dive -->
</section>