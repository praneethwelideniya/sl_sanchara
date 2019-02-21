<html>
  <head>
    <title>Welcome Email</title>
  </head>
  <body>
    <h2>Welcome to the SL sanchara {{$user['name']}}</h2>
    <br/>
    Your registered email-id is {{$user['email']}} , Please click on the below link to verify your email account
    <br/>
    <a href="{{url('user/verify', $token)}}">Verify Email</a>
  </body>
</html>