
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Covid Declaration</title>
</head>
<body>

<br/><br/>
	<div class="page-wrapper">
		<label>
			When did u test positive for covid:
			<input type="date" id="covid" min="2021-10-01" max="2022-12-31" required>
		</label>
		<br><br>
		<button class="button" onclick="onSubmit()">Submit</button>
	</div>

<script>

	const currentDate = new Date();

	function onSubmit(){
		const declareDate = new Date(document.getElementById('covid').value)
		const findDate =  $.ajax({
			url: 'declareSelect.php',
			method: 'GET',
			dataType: 'json',
			success: function(data){
				// console.log(data)
			}
		})

		findDate.done(checkDate)

		function checkDate(result){
			og = new Date(result[0])
			var future = new Date(og.getTime());
			future.setDate(future.getDate()+14);
			if(declareDate> currentDate){
				alert('Please dont select future dates')
			} else if(declareDate<future && declareDate>=og){
				alert('Please wait 14 days before you can declare again')
			} else if(declareDate<og){
				alert('You have to choose a date thats after your last declaration')
			}else{
				var date = declareDate.getFullYear()+'-'+(declareDate.getMonth()+1)+'-'+declareDate.getDate();
				// console.log(de_date)
				$.ajax({
					url: 'declareBack.php',
					method: 'POST',
					data: { date: date },
					success: function(data) {
						console.log(data)
						alert("Thank you")
					}
				});
			}
		}
	}
</script>
</body>
</html>