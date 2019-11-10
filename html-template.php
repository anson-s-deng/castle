<?php

require_once('config.php');
require_once('user-session.php');

class HtmlTemplate
{
  public static function displayHtmlHeader()
  {
    $script_str = "";
    if(UserSession::isUserLoggedIn())
    {
      $userContext = UserSession::getUserContext();
      $script_str = "<script>_castle('identify', '". $userContext['user_id'] . "');</script>";
    }
    echo '
    <html lang="en">
    <head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Castle Tech Challenge</title>

    <script src="https://d2t77mnxyo7adj.cloudfront.net/v1/c.js?' . CASTLE_APP_ID .'"></script>
    
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
   
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">' . $script_str . '
    
    </head>

    <body>

    <div class="container">
    ';
  }

  public static function displayHtmlFooter()
  {
    echo '</div></body></html>';
  }

  public static function displayLoginForm()
  {
    echo'
    <div class="login-form">
        <form action="login.php" onSubmit="addCastleClientId(this);" method="post">
            <div class="media">
                <svg viewBox="0 0 318 84" fill="none" xmlns="http://www.w3.org/2000/svg" class="media">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M79 42C79 62.4345 62.4345 79 42 79C21.5655 79 5 62.4345 5 42C5 21.5655 21.5655 5 42 5C62.4345 5 79 21.5655 79 42ZM84 42C84 65.196 65.196 84 42 84C18.804 84 0 65.196 0 42C0 18.804 18.804 0 42 0C65.196 0 84 18.804 84 42ZM129.424 70C142.123 70 150.848 62.6725 153.809 52.4141L147.031 49.9459C144.772 57.4276 138.851 63.0582 129.424 63.0582C119.374 63.0582 109.791 55.7307 109.791 41.4614C109.791 27.1922 119.374 19.9418 129.424 19.9418C138.461 19.9418 144.538 24.5697 146.641 32.8227L153.731 30.3545C150.926 19.7875 142.045 13 129.424 13C115.712 13 102 23.1813 102 41.4614C102 59.7415 115.166 70 129.424 70ZM159.263 58.8931C159.263 64.7551 164.171 70 171.806 70C178.506 70 182.245 66.452 183.882 63.8295C183.882 66.529 184.115 67.9173 184.271 68.8429L184.271 68.843H191.439C191.283 67.9175 190.971 65.9892 190.971 62.7497V44.161C190.971 36.9107 186.608 30.5859 175.39 30.5859C167.287 30.5859 160.821 35.5223 160.042 42.6184L167.053 44.2382C167.521 39.9188 170.403 36.7564 175.545 36.7564C181.233 36.7564 183.648 39.7645 183.648 43.3897C183.648 44.7009 183.025 45.8579 180.765 46.1664L170.637 47.6319C164.171 48.5575 159.263 52.2598 159.263 58.8931ZM172.819 63.9066C169.079 63.9066 166.742 61.2842 166.742 58.5074C166.742 55.1908 169.079 53.4168 172.195 52.954L183.648 51.2571V52.954C183.648 61.0528 178.818 63.9066 172.819 63.9066ZM198.84 59.2016C199.463 63.4438 203.826 70 214.11 70C223.381 70 227.822 63.7524 227.822 58.5074C227.822 53.0311 224.238 48.9432 217.46 47.4777L211.383 46.1664C208.501 45.5494 207.098 43.9296 207.098 41.6928C207.098 39.1475 209.591 36.7564 213.331 36.7564C219.252 36.7564 220.81 40.9986 221.122 42.9269L227.588 40.5359C226.809 37.2192 223.615 30.5859 213.331 30.5859C206.007 30.5859 200.009 35.9851 200.009 42.3099C200.009 47.5548 203.514 51.4885 209.358 52.7226L215.746 54.111C218.862 54.8051 220.576 56.5792 220.576 58.8931C220.576 61.5156 218.317 63.8295 214.188 63.8295C208.89 63.8295 205.93 60.7442 205.462 56.8877L198.84 59.2016ZM247.377 20.0189H240.677V26.0352C240.677 29.2747 238.963 31.7429 234.911 31.7429H232.886V38.2991H240.053V58.6617C240.053 65.3721 244.105 69.2287 250.493 69.2287C252.986 69.2287 254.856 68.7659 255.479 68.5345V62.364C254.856 62.5183 253.531 62.6725 252.597 62.6725C248.779 62.6725 247.377 60.9756 247.377 57.5819V38.2991H255.479V31.7429H247.377V20.0189ZM272.541 68.843V13H265.218V68.843H272.541ZM289.759 46.475C290.07 41.6928 293.81 36.9878 299.965 36.9878C306.587 36.9878 310.093 41.1529 310.249 46.475H289.759ZM311.339 56.1164C309.937 60.2815 306.899 63.5981 300.822 63.5981C294.511 63.5981 289.681 58.9702 289.525 52.3369H317.728C317.806 51.8742 317.884 50.9486 317.884 50.023C317.884 38.4533 311.417 30.5859 299.887 30.5859C290.46 30.5859 281.968 38.5304 281.968 50.1773C281.968 62.7497 290.772 70 300.822 70C309.547 70 315.546 64.8322 317.65 58.276L311.339 56.1164ZM25.1348 25.7808V20.8262H30.1258V25.7808H35.1169V20.8262H40.108V25.7808H45.0991V20.8262H50.0902V25.7808H55.0813V20.8262H60.0723V25.7808V27.1964V30.7354L55.0813 35.69V54.0929L60.0723 59.0475V64.0021H25.1348V59.0475L30.1258 54.0929V35.69L25.1348 30.7354V27.1964V25.7808ZM37.969 42.2962C37.969 39.8204 40.044 37.8134 42.6035 37.8134C45.163 37.8134 47.2381 39.8206 47.2381 42.2962V51.2617H37.969V42.2962Z" fill="#2A21A4"></path>
                </svg>
            </div>    
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Username" name="username" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" name="password" required="required">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Sign in</button>
            </div>     
        </form>
    </div>';
  echo "<script>
  function addCastleClientId(myForm) {
		// The token is continously updated so fetch it right before form submit
		var clientId = _castle('getClientId');

		// Populate a hidden field called `castle_client_id`
		var hiddenInput = document.createElement('input');
		hiddenInput.setAttribute('type', 'hidden');
		hiddenInput.setAttribute('name', 'castle_client_id');
		hiddenInput.setAttribute('value', clientId);

		// Add the `castle_client_id` into the form so it gets sent to the server
		myForm.appendChild(hiddenInput);
  };
  </script>";
  }

  // redirect user to login screen
  // $msg is the message to be displayed before redirect
  // $m_secs is milliseconds for the
  public static function redictToLogin($msg, $m_secs=5000)
  {
    echo'
    <script type="text/javascript">
      document.write("' . $msg .'"); 
      setTimeout(\'window.location="index.php"\', '. $m_secs . ');   
    </script>
    ';
  }

  public static function displayWelcome($user)
  {
    echo '<div class="user-menu">';
    echo 'Welcome, '. $user['first_name'] . ' ' . $user['last_name'] . '!';
    echo '<a href="logoff.php">Sign Out</a>';
    echo '<a href="user-profile.php">Profile</a>';
    echo '<a href="home.php">Home</a>';
    echo '</div>';
  }

  public static function displayUserProfile($user)
  {
    self::displayWelcome($user);

    echo'<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">User information</h3>
    </div>
    <div class="panel-body">
        <div>
            <strong>' . $user['first_name'] . ' '. $user['last_name']. '</strong>
            <div class="div-separator"></div>
            <table class="table">
                <tbody>
                <tr>
                    <td>Email:</td>
                    <td>' . $user['user_email'] . '</td>
                </tr>
                <tr>
                    <td>Registered since:</td>
                    <td>' . $user['registered_at'] . '</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>';
  }

  public static function displayLoginChallengeForm()
  {
    echo'
    <div class="login-form">
        <form action="challenge-login.php" method="post">
            <div class="media">
                <svg viewBox="0 0 318 84" fill="none" xmlns="http://www.w3.org/2000/svg" class="media">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M79 42C79 62.4345 62.4345 79 42 79C21.5655 79 5 62.4345 5 42C5 21.5655 21.5655 5 42 5C62.4345 5 79 21.5655 79 42ZM84 42C84 65.196 65.196 84 42 84C18.804 84 0 65.196 0 42C0 18.804 18.804 0 42 0C65.196 0 84 18.804 84 42ZM129.424 70C142.123 70 150.848 62.6725 153.809 52.4141L147.031 49.9459C144.772 57.4276 138.851 63.0582 129.424 63.0582C119.374 63.0582 109.791 55.7307 109.791 41.4614C109.791 27.1922 119.374 19.9418 129.424 19.9418C138.461 19.9418 144.538 24.5697 146.641 32.8227L153.731 30.3545C150.926 19.7875 142.045 13 129.424 13C115.712 13 102 23.1813 102 41.4614C102 59.7415 115.166 70 129.424 70ZM159.263 58.8931C159.263 64.7551 164.171 70 171.806 70C178.506 70 182.245 66.452 183.882 63.8295C183.882 66.529 184.115 67.9173 184.271 68.8429L184.271 68.843H191.439C191.283 67.9175 190.971 65.9892 190.971 62.7497V44.161C190.971 36.9107 186.608 30.5859 175.39 30.5859C167.287 30.5859 160.821 35.5223 160.042 42.6184L167.053 44.2382C167.521 39.9188 170.403 36.7564 175.545 36.7564C181.233 36.7564 183.648 39.7645 183.648 43.3897C183.648 44.7009 183.025 45.8579 180.765 46.1664L170.637 47.6319C164.171 48.5575 159.263 52.2598 159.263 58.8931ZM172.819 63.9066C169.079 63.9066 166.742 61.2842 166.742 58.5074C166.742 55.1908 169.079 53.4168 172.195 52.954L183.648 51.2571V52.954C183.648 61.0528 178.818 63.9066 172.819 63.9066ZM198.84 59.2016C199.463 63.4438 203.826 70 214.11 70C223.381 70 227.822 63.7524 227.822 58.5074C227.822 53.0311 224.238 48.9432 217.46 47.4777L211.383 46.1664C208.501 45.5494 207.098 43.9296 207.098 41.6928C207.098 39.1475 209.591 36.7564 213.331 36.7564C219.252 36.7564 220.81 40.9986 221.122 42.9269L227.588 40.5359C226.809 37.2192 223.615 30.5859 213.331 30.5859C206.007 30.5859 200.009 35.9851 200.009 42.3099C200.009 47.5548 203.514 51.4885 209.358 52.7226L215.746 54.111C218.862 54.8051 220.576 56.5792 220.576 58.8931C220.576 61.5156 218.317 63.8295 214.188 63.8295C208.89 63.8295 205.93 60.7442 205.462 56.8877L198.84 59.2016ZM247.377 20.0189H240.677V26.0352C240.677 29.2747 238.963 31.7429 234.911 31.7429H232.886V38.2991H240.053V58.6617C240.053 65.3721 244.105 69.2287 250.493 69.2287C252.986 69.2287 254.856 68.7659 255.479 68.5345V62.364C254.856 62.5183 253.531 62.6725 252.597 62.6725C248.779 62.6725 247.377 60.9756 247.377 57.5819V38.2991H255.479V31.7429H247.377V20.0189ZM272.541 68.843V13H265.218V68.843H272.541ZM289.759 46.475C290.07 41.6928 293.81 36.9878 299.965 36.9878C306.587 36.9878 310.093 41.1529 310.249 46.475H289.759ZM311.339 56.1164C309.937 60.2815 306.899 63.5981 300.822 63.5981C294.511 63.5981 289.681 58.9702 289.525 52.3369H317.728C317.806 51.8742 317.884 50.9486 317.884 50.023C317.884 38.4533 311.417 30.5859 299.887 30.5859C290.46 30.5859 281.968 38.5304 281.968 50.1773C281.968 62.7497 290.772 70 300.822 70C309.547 70 315.546 64.8322 317.65 58.276L311.339 56.1164ZM25.1348 25.7808V20.8262H30.1258V25.7808H35.1169V20.8262H40.108V25.7808H45.0991V20.8262H50.0902V25.7808H55.0813V20.8262H60.0723V25.7808V27.1964V30.7354L55.0813 35.69V54.0929L60.0723 59.0475V64.0021H25.1348V59.0475L30.1258 54.0929V35.69L25.1348 30.7354V27.1964V25.7808ZM37.969 42.2962C37.969 39.8204 40.044 37.8134 42.6035 37.8134C45.163 37.8134 47.2381 39.8206 47.2381 42.2962V51.2617H37.969V42.2962Z" fill="#2A21A4"></path>
                </svg>
            </div>    
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Favorite Moive" name="favorite_movie" required="required">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Sign in</button>
            </div>     
        </form>
    </div>';
  }
}
?>