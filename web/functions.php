<?php


/******************/

// modified https://www.php.net/manual/en/mysqli-stmt.bind-param.php#100879
function execSQL($sql, $params, $close){
	
		// echo $sql;
           $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
          
           $stmt = $mysqli->prepare($sql) or die ('{ "success": "false", "message": "Failed to prepared the statement!" }');
          
		   if( !empty($params) ){
			   call_user_func_array(array($stmt, 'bind_param'), refValues($params));
		   }
          
           $stmt->execute();
          
           if($close){
               $result = $mysqli->affected_rows;
           } else {
               $meta = $stmt->result_metadata();
           
               while ( $field = $meta->fetch_field() ) {
                   $parameters[] = &$row[$field->name];
               } 
       
            call_user_func_array(array($stmt, 'bind_result'), refValues($parameters));
              
			//
				$results = array();
			//
            while ( $stmt->fetch() ) { 
               $x = array(); 
               foreach( $row as $key => $val ) { 
                  $x[$key] = $val; 
               } 
               $results[] = $x; 
            }

            $result = $results;
           }
          
           $stmt->close();
           $mysqli->close();
          
           return  $result;
}

function refValues($arr){
	if (strnatcmp(phpversion(),'5.3') >= 0){ //Reference is required for PHP 5.3+
		$refs = array();
		foreach($arr as $key => $value)
			$refs[$key] = &$arr[$key];
		return $refs;
	}
	return $arr;
}


/******************/

function getDefaultBalance(){
	$defaultBalance = 5000;
	return $defaultBalance;
}


function reset_cards_and_balance(){
	setBalance( getDefaultBalance() );
	execSQL('UPDATE tbl_card_vouchers SET is_used=0', '', true);
	return 1;
}

function setBalance($x){
	execSQL('UPDATE moneyz SET balance=?', array('i', $x), true);
	return 1;
}

function getAmountFromVoucher($x){
	$result = execSQL('SELECT amount FROM tbl_card_vouchers WHERE voucher_no=? AND is_used=0 LIMIT 1', array('s', $x), false);
	$amount = 0;
	if(!empty($result[0])){
		$amount = $result[0]['amount'];
	}
	return (int)$amount;
}

function getBalance(){
	$result = execSQL('SELECT balance FROM moneyz', '', false);
	$amount = 0;
	if(!empty($result)){
		$amount = $result[0]['balance'];
	}
	return (int)$amount;
}

function setCardIsUsed($x){
	execSQL('UPDATE tbl_card_vouchers SET is_used=1 WHERE voucher_no=?', array('s', $x), true);
}

function getUnusedVouchers(){
	$rows = execSQL('SELECT voucher_no FROM tbl_card_vouchers WHERE is_used=0', '', false);
	$vouchers = '';
	if(!empty($rows[0])){
		//$vouchers .= "<ul>";
		$count = 1;
		foreach($rows as $row){
			$vouchers .= "<li>".$row['voucher_no']." <button type='button' data-placement='right' data-clipboard-text='".$row['voucher_no']."' class='btn btn-info btn-tooltip'><span class='far fa-copy'></span></button></li><br>";
			$count++;
		}
		//$vouchers .= "</ul>";
	}
	return $vouchers;
}


?>