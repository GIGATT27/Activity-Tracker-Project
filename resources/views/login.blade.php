<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Activity Tracker Registration Form </title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <div class="title">Login</div>
    <div class="content">
      <form action="/login" method="POST">
        @csrf
        <div class="user-details">
          <div class="input-box">
            <span class="details">Username</span>
            <input name="loginname" type="text" placeholder="Enter your username" required>
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input name='loginpassword' type="password" placeholder="Enter your password" required>
          </div>
          
        </div>
        <div class="button">
          <input type="submit" value="login">
        </div>
      </form>
    </div>
  </div>

</body>
</html>
