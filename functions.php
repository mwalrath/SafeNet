	<?php 
		
		// an array to hold the values for the withdrawn money
		$returns = array(array(100,0),
					  array(50,0),
					  array(20,0),
					  array(10,0),
					  array(5,0),
					  array(1,0),
					);
		
		//initial values for the atm "Cash Drawer"
		$cash = array(array(100,10),
					  array(50,10),
					  array(20,10),
					  array(10,10),
					  array(5,10),
					  array(1,10),
					);

   	// saves the "cash drawer" as a session variable so it does not reset when page is reloaded
	if (!isset($_SESSION['drawer'])) {
		$_SESSION['drawer']=$cash;
	}
	
	$allocated = 0;
	$ammount = 0;

	// gets the total of all the money in a "cash drawer" array
	function getDrawerTotal($draw) {
		$total = 0;
		for ($i=0; $i < 6; $i++) { 
			$total+=($draw[$i][0]*$draw[$i][1]);
			
		}
		return $total;
	}

	function W($amount) {
		withdrawl($amount,$_SESSION['drawer']);
	}
	
	//does the heavy lifting of figuring out if there is enough money or enough bills
	function withdrawl($amount,&$drawer,$allocated,$returns){
		if (getDrawerTotal($drawer)>=$amount) {
			$enough = true;
			$drawerCopy = $drawer;
			while ($allocated < $amount) {
				for ($i=0; $i < 6; $i++) { 
					$rem=($amount-$allocated)%$drawerCopy[$i][0];
					$bills=(($amount-$allocated)-$rem)/$drawerCopy[$i][0];
					if ($bills>$drawerCopy[$i][1]){
						$bills=$drawerCopy[$i][1];
					}
					
					$allocated+=($returns[$i][0]*$bills);
					if (($i==5)&&($allocated<$amount)) {
						$enough = false;
						break 2;
					}
					$returns[$i][1]=$bills;
					$drawerCopy[$i][1]-=$bills;
				}
			}

			if ($enough){
				echo "Success: Dispensed $".$amount."<br>";
				TakeOut($drawer,$drawerCopy);
				echo balance($drawer);

			}
			else {
				echo "Failure: insufficient funds <br>";
			}
		}

		else {
			echo "Failure: insufficient funds <br>";
		}

	}	
	

	//returns balance of a "cash drawer" array;
	function balance($drwr){
	echo "Machine balance: <br>";
	for ($i=0; $i < 6; $i++){
		
		echo "$".$drwr[$i][0]." - ".$drwr[$i][1]."<br>";

	}

	}


	//restocks the cash drawer
	function R(&$draw){
		for ($i=0; $i < 6; $i++){
			$draw[$i][1]=10;
		}
		
	}

	//returns the inventory for requested bills
	function I($inv,$draw){
		foreach ($inv as $bill) {
			for ($i=0; $i < 6; $i++){
				if ($bill == $draw[$i][0]) {
					echo "$".$draw[$i][0]." - ".$draw[$i][1]."<br>";
				}
			}
		}
	}


	//cleans the input incase of anyone tries something
	function cleaner($input){
		$input = trim($input);
		$input = stripcslashes($input);
		$input = htmlspecialchars($input);
		return $input;
	}

	
	//if there is enough bills for the transaction it takes removes them from the main array.
	function TakeOut(&$draw1, &$draw2){
		for ($i=0; $i < 6; $i++){
			$draw1[$i][1]=$draw2[$i][1];
		}
	}
	?>