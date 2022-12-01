	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Document</title>
		<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

		<!-- CSS only -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

		<script src="https://www.google.com/recaptcha/api.js?render=6LcIu0gjAAAAAKvA4UxSEWNtWl_U5nWHhj9Y_1By"></script>
		<script>
		function onClick(e) {
			e.preventDefault();
			grecaptcha.ready(function() {
				//   grecaptcha.execute('6LcIu0gjAAAAAKvA4UxSEWNtWl_U5nWHhj9Y_1By', {action: 'submit'}).then(function(token) {
				grecaptcha.execute('6LcIu0gjAAAAAKvA4UxSEWNtWl_U5nWHhj9Y_1By', {action: 'homepage'}).then(function(token) {
					console.log(token);
				});
				});
		}
	</script>
	</head>
	<body>
		<div class="container">
			<div class="row">
			<div class="col">
				<h1>Bismillahir Rahmanir Rahim</h1>
				<h2>Alah Hu Akbar</h2>
			</div>
			</div>
			<div class="row">
			<div class="col-sm-6 offset-sm-3">
				<form>
				<div class="mb-3">
					<label for="exampleInputEmail1" class="form-label">Email address</label>
					<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
					<div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
				</div>
				<div class="mb-3">
					<label for="exampleInputPassword1" class="form-label">Password</label>
					<input type="password" class="form-control" id="exampleInputPassword1">
				</div>
				<div class="mb-3 form-check">
					<input type="checkbox" class="form-check-input" id="exampleCheck1">
					<label class="form-check-label" for="exampleCheck1">Check me out</label>
				</div>
				<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
			</div>
		</div>
		
	</body>
	</html>