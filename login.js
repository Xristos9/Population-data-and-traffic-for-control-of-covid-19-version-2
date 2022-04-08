function login(){
	const Username= document.getElementById("Username").value;
	const password= document.getElementById("Password").value;

	if(Username==''){
		alert('Please enter your Username!');
	}else if(password==''){
		alert('Please enter Password');
	}else{
		const upload = $.ajax({
			url: 'signIn.php',
			method: 'POST',
			data: {Username: Username, password: password},
			success: function(data) {
				console.log(data)
			},error: function (xhr, exception) {
				var msg = "";
				if (xhr.status === 0) {
					msg = "Not connect.\n Verify Network." + xhr.responseText;
				} else if (xhr.status == 404) {
					msg = "Requested page not found. [404]" + xhr.responseText;
				} else if (xhr.status == 500) {
					msg = "Internal Server Error [500]." +  xhr.responseText;
				} else if (exception === "parsererror") {
					msg = "Requested JSON parse failed.";
				} else if (exception === "timeout") {
					msg = "Time out error." + xhr.responseText;
				} else if (exception === "abort") {
					msg = "Ajax request aborted.";
				} else {
					msg = "Error:" + xhr.status + " " + xhr.responseText;
				}
				console.log(msg)
			}
		});
		upload.done(success);
	}
	function success(result){
		if(result == 0){
			window.location.assign("map.php")
		} else if(result == 1){
			window.location.assign("adminMap.php")
		}else if(result == 2){
			alert('Incorrect username or password')
		}else{
			alert('An unexpected error has occurred')
		}
	}
}