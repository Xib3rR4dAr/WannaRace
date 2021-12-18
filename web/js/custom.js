loggedIn = '';

function showAfterLoginItems(){
	$( "#login" ).hide();
	$( "#unused-vouchers" ).show();
	$( "#available-balance" ).show();
	$( "#voucher-code" ).show();
	$( "#recharge-voucher" ).show();
	$( "#buy-mega-box" ).show();
	$( "#reset-data" ).show();
}

function showAfterLogoutItems(){
	$( "#login" ).show();
	$( "#unused-vouchers" ).hide();
	$( "#available-balance" ).hide();
	$( "#voucher-code" ).hide();
	$( "#recharge-voucher" ).hide();
	$( "#buy-mega-box" ).hide();
	$( "#reset-data" ).hide();
}

function delCookies(){
	eraseCookie('PHPSESSID');
	eraseCookie('challenge');
	eraseCookie('logged_in');
}

if( 'B' == getCookie('challenge') ){
	$( "#challenge" ).text("B");
	loggedIn = getCookie('logged_in');
	if(loggedIn){
		showAfterLoginItems();
	} else {
		showAfterLogoutItems();
	}
} else {
	$( "#challenge" ).text("A");
	showAfterLoginItems();
}

$(window).on('hashchange', function() {
	if( '#challenge2' == window.location.hash ){
		setCookie('challenge', 'B');
		$( "#challenge" ).text("B");
		showAfterLogoutItems();
	} else if ( '#challenge1' == window.location.hash ) {
		$( "#challenge" ).text("A");
		eraseCookie('PHPSESSID');
		eraseCookie('challenge');
		eraseCookie('logged_in');
		showAfterLoginItems();
	}
});

$( "#unused-vouchers" ).click(function() {

	var request = "/api.php?vouchers";
	$.get(request, function(data, status){
	  if (data.success=="true") {
		  vouchers = data.message;
		  if(data.message==''){
			  vouchers = 'No Vouchers Available';
		  }
		Swal.fire(
		  'Available Vouchers',
		  vouchers
		)
	  } else {
		Swal.fire({
		  icon: 'error',
		  title: 'Oops...',
		  text: data.message
		})
	  }
	});
	
});

$( "#available-balance" ).click(function() {

	var request = "/api.php?balance";
	$.get(request, function(data, status){
	  if (data.success=="true") {
		Swal.fire(
		  'Available Balance',
		  data.message
		)
	  } else {
		Swal.fire({
		  icon: 'error',
		  title: 'Oops...',
		  text: data.message
		})
	  }
	});
	
});

$( "#recharge-voucher" ).click(function() {

	var card = $( "#voucher-code" ).val();
	var request = "/api.php?card="+card;
	$.get(request, function(data, status){
	  if (data.success=="true") {
		Swal.fire(
		  'Success',
		  data.message,
		  'success'
		)
	  } else {
		Swal.fire({
		  icon: 'error',
		  title: 'Oops...',
		  text: data.message
		})
	  }
	});
	
});

$( "#buy-mega-box" ).click(function() {

	var request = "/api.php?buyMegaBox";
	$.get(request, function(data, status){
	  if (data.success=="true") {
		Swal.fire(
		  'Success',
		  data.message,
		  'success'
		)
	  } else {
		Swal.fire({
		  icon: 'error',
		  title: 'Oops...',
		  text: data.message
		})
	  }
	});
	
});

$( "#login" ).click(function() {

	var request = "/api.php?login";
	$.get(request, function(data, status){
	  if (data.success=="true") {
		Swal.fire(
		  'Authentication',
		  data.message
		)
		setCookie('logged_in', 1);
		setCookie('challenge', 'B');
		$('#voucher-code').val('');
		showAfterLoginItems();
	  } else {
		Swal.fire({
		  icon: 'error',
		  title: 'Oops...',
		  text: data.message
		})
	  }
	});
	
});

$( "#reset-data" ).click(function() {

	Swal.fire({
	  title: 'Are you sure?',
	  text: "You won't be able to revert this!",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Yes, reset it!'
	}).then((result) => {
	  if (result.value) {
		
		$.get("/api.php?reset", function(data, status){
		  if (data.success=="true") {
			Swal.fire(
			  'Reset!',
			  'Date has been reset successfully.',
			  'success'
			)
			$('#voucher-code').val('');
			window.location.href = '#challenge1';
			delCookies();
		  } else {
			Swal.fire({
			  icon: 'error',
			  title: 'Oops...',
			  text: data.message
			})
		  }
		});
	  }
	})
	
});