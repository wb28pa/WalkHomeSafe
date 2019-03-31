<?php
?>
<html>
<head>
<title>Login Form Design</title>
     <link rel="stylesheet" type="text/css" href="style.css"> 
    </head>
<body>
    <div class="loginbox">
        <h1>Login Here</h1>
        <form action="login.php" method="post">
        <p>Username</p>
        <input type="text" name="" placeholder="Enter Username">
        <p>Password</p>
        <input type="password" name="" placeholder="Enter Password">
        <input type="submit" name="" value="Login"> 
        <a href= "index2.php">Don't have an Account?</a><br>
        </form>
    </div>
    <div id="my-login-button-target" />
    <script>
       window.snapKitInit = function () {
        var loginButtonIconId = 'my-login-button-target';
        // Mount Login Button
        snap.loginkit.mountButton(loginButtonIconId, {
          clientId: 'your-clientId',
          redirectURI: 'your-redirectURI',
          scopeList: [
            'user.display_name',
            'user.bitmoji.avatar',
          ],
          handleResponseCallback: function() {
            snap.loginkit.fetchUserInfo()
              .then(data => console.log('User info:', data));
          },
        });
      };

      // Load the SDK asynchronously
      (function (d, s, id) {
        var js, sjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "https://sdk.snapkit.com/js/v1/login.js";
        sjs.parentNode.insertBefore(js, sjs);
      }(document, 'script', 'loginkit-sdk'));
    </script>
</body>  
</html>