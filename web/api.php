<?php

include 'db_connect.php';
include 'functions.php';

header("Content-type: application/json");

if( 'B' == $level ){
	if(session_status() == PHP_SESSION_NONE){
		//session has not started
		session_start();
	}
	if(isset($_GET['login'])){
		session_regenerate_id();
		$_SESSION['loggedIn'] = true;
		$response = '{ "success": "true", "message": "Logged In Successfully"}';
		die($response);
	}
	if(!isset($_SESSION['loggedIn'])){
		$response = '{ "success": "false", "message": "Must be Logged In"}';
		die($response);
	}
}

if(isset($_GET['reset'])){
	if( reset_cards_and_balance() ){
		if( 'B' == $level ){
			session_regenerate_id();
			session_destroy();
		}
		$response = '{"success": "true"}';
		die($response);
	}
}

if(isset($_GET['vouchers'])){
	$vouchers = getUnusedVouchers();
	$response = '{ "success": "true", "message": "' . $vouchers . '" }';
	die($response);
}

if(isset($_GET['balance'])){
	$balance = getBalance();
	$response = '{ "success": "true", "message": "' . $balance . '" }';
	die($response);
}

if(isset($_GET['buyMegaBox'])){
	$balance = getBalance();
	$required = getDefaultBalance() + 401;
	$difference = $required - $balance;
	$success = 'false';
	$message = 'You do not have enough balance! Need ' . $difference .' more to buy the Mega Box.';
	if( $balance > $required ){
		$success = 'true';
		$message = 'Success, your flag is: {🚀_Boom_Boom_🚀}';
	}
	$response = '{ "success": "'.$success.'", "message": "' . $message . '" }';
	die($response);
}

if( empty($_GET['card']) ){
	$response = '{"success": "false", "message":"Please Enter Voucher code" }';
	die($response);
}

$card = $_GET['card'];

$balanceToBeAdded = getAmountFromVoucher($card);

if($balanceToBeAdded!='0'){
	$response = '{ "success": "true", "message":"';
	$response .= 'Balance to be added: '.$balanceToBeAdded.'<br>';
	$currentBalance = getBalance();
	$response .= 'Previous Balance: '.$currentBalance.'<br>';
	$newBalance = $currentBalance + $balanceToBeAdded;
	if(setBalance($newBalance)){
		setCardIsUsed($card);
		$response .= 'New balance is: '.getBalance();
		$response .= '" }';
		die($response);
	}
} else {
	$response = '{"success": "false", "message":"Card doesnt exist or has been used. Your Current Balance is: '.getBalance().'" }';
    die($response);
}

?>