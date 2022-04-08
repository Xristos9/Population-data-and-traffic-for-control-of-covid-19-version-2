//email expression code
function ValidateEmail(mail) {
	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)){
		return false
	}else{
		return true
	}
}
function registration(){
	const name= document.getElementById("t1").value;
	const email= document.getElementById("t2").value;
	const password= document.getElementById("t3").value;
	const strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
	if(name==''){
		alert('Please enter your Userame.');
	}else if(email==''){
		alert('Please enter your email');
	}else if (ValidateEmail(email)){
		alert('Invalid email');
	}else if(password==''){
		alert('Please enter Password');
	}else if(!strongRegex.test(password)){
		alert('Upper case, Lower case, Special character and Numeric letter are required in Password');
	}else{
		const upload = $.ajax({
			url: 'signUp.php',
			method: 'POST',
			data: {username: name, password: password,email:email}
			,
			success: function(data) {
				console.log(data)
			}
		});
		upload.done(success);
	}
	function success(result){
		if(result == 0){
			alert('This username is used, try another one')
		} else if(result == 1){
			alert('This email is used, try another one')
		}else if(result == 2){
			alert('Account has been created successfully')
		}else if(result == 3){
			alert('An unexpected error has occurred')
		}
	}
}