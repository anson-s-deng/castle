<?php

require_once("config.php");

class UserSession
{

  public static function initSession($username=null, $password=null)
  {
    session_start();

    if(self::isUserLoggedIn())
    {
        return;
    }
    elseif(isset($username) && isset($password))
    {
        $user = self::authenticateUser(trim($username), trim($password));
        if(isset($user))
        {
            $_SESSION['userContext'] = $user;
            return;
        }
        else
        {
            // invalid username and password combination
            header("Location:login-fail.php");
            exit;
        }
    }
    else
    {
        // session timeout
        header("Location:session-timeout.php");
        exit;
    }
  }

  private static function authenticateUser($username, $password)
  {

    require_once("castle-php/lib/Castle.php");
    Castle::setApiKey(CASTLE_API_SECRET);

    $logon_user = null;
    // check if user exists
    $users = $GLOBALS['users'];
    $key = array_search($username, array_column($users, 'username'));
    
    if($key === FALSE)
    {
        // user does not exist
        // send information to Catsle for tracking
        Castle::track(array(
            'event' => '$login.failed',
            'user_id' => null,
            'user_traits' => array(
            'email' => null,
            'registered_at' => null
            )
        ));
    }
    else
    {
        if($users[$key]['password'] === $password)
        {
            $logon_user = $users[$key];
            try 
            {
                // Put this after the user's password has been validated, but before you
                // create the login session

                $verdict = Castle::authenticate
                (
                    array
                    (
                        'event' => '$login.succeeded',
                        'user_id' => $logon_user['user_id'],
                        'user_traits' => array
                        (
                            'email' => $logon_user['user_email'],
                            'registered_at' => $logon_user['registered_at']
                        )
                    )
                );
    
                // evaluate the verdict
                if ($verdict->action == 'allow') {
                    // good. continue to login.
                } else if ($verdict->action == 'challenge') {
                    // catha or two factor authentication goes here
                    file_put_contents( 'castle-verdict.log' , 'challenge---'.$logon_user['user_id'] . '---'. date("D M j G:i:s T Y").PHP_EOL, FILE_APPEND);
                    $_SESSION['user_challenge'] = array('user_id' => $logon_user['user_id'], 'favorite_movie' => $logon_user['favorite_movie']);
                    header("Location:challenge.php");
                    exit;
                } else if ($verdict->action == 'deny') {
                    // deny
                    file_put_contents( 'castle-verdict.log' , 'deny---'.$logon_user['user_id']. '---'. date("D M j G:i:s T Y").PHP_EOL, FILE_APPEND);
                    header("Location:login-deny.php");
                    exit;
                }
    
            } catch (Castle_Error $e) 
            {
                // print_r($e);
            } 
        }
        else
        {
            // incorrect password, send information to Catsle
            Castle::track(array(
                'event' => '$login.failed',
                'user_id' => $users[$key]['user_id'],
                'user_traits' => array(
                'email' => $users[$key]['user_email'],
                'registered_at' => $users[$key]['registered_at']
                )
            ));
        }
    }
    return $logon_user;
  }

  public static function initSessionFromChallenge($access_code)
  {
    session_start();

    // back to login page if user is not redirected from condition of 'challenge' verdict
    if(!isset($_SESSION['user_challenge']))
    {
        header("Location:index.php");
        exit;
    }

    // validate the user favorite movie and then create user session
    $users = $GLOBALS['users'];
    $key = array_search($_SESSION['user_challenge']['user_id'], array_column($users, 'user_id'));
    if($users[$key]['favorite_movie'] === trim($access_code))
    {
        unset($_SESSION['user_challenge']);
        $_SESSION['userContext'] = $users[$key];
        return;
    }
    else
    {
        // fail to login which is same as a 'deny' verdict is returned
        header("Location:login-deny.php");
        exit;
    }
  }
  public static function isUserLoggedIn()
  {
    return isset($_SESSION['userContext']); 
  }
  public static function endSession()
  {
    session_start();
    unset($_SESSION['userContext']);
  }

  public static function getUserContext()
  {
    return $_SESSION['userContext'];
  }
}
?>