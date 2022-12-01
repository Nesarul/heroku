<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

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
    <h1>Bismillahir Rahmanir Rahim</h1>
</body>
</html>