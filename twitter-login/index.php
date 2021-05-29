<?php 
// Include configuration file 
require_once 'config.php'; 
 
// Include User class 
require_once 'User.class.php'; 
 
// If OAuth token not matched 
if(isset($_REQUEST['oauth_token']) && $_SESSION['token'] !== $_REQUEST['oauth_token']){ 
    //Remove token from session 
    unset($_SESSION['token']); 
    unset($_SESSION['token_secret']); 
} 
 
// If user already verified  
if(isset($_SESSION['status']) && $_SESSION['status'] == 'verified' && !empty($_SESSION['request_vars'])){ 
   
    //Retrive variables from session 
    $username         = $_SESSION['request_vars']['screen_name']; 
    $twitterId        = $_SESSION['request_vars']['user_id']; 
    $oauthToken       = $_SESSION['request_vars']['oauth_token']; 
    $oauthTokenSecret = $_SESSION['request_vars']['oauth_token_secret']; 
    $name             = $_SESSION['userData']['first_name'].' '.$_SESSION['userData']['last_name']; 
    $profilePicture   = $_SESSION['userData']['picture']; 
     
    /* 
     * Prepare output to show to the user 
     */ 
    $twClient = new Abraham\TwitterOAuth\TwitterOAuth(TW_CONSUMER_KEY, TW_CONSUMER_SECRET, $oauthToken, $oauthTokenSecret); 
    echo "Retrive variables from session 1 ";
    //If user submits a tweet to post to twitter 
    if(isset($_POST["updateme"])){ 
        $my_update = $twClient->post('statuses/update', array('status' => $_POST["updateme"])); 
    } 
     
    // Display username and logout link 
    $output = '<div class="welcome_txt">Welcome <strong>'.$username.'</strong> (Twitter ID : '.$twitterId.'). <a href="logout.php">Logout</a>!</div>'; 
     
    // Display profile iamge and tweet form 
    $output .= '<div class="tweet_box">'; 
    $output .= '<div class="left">'; 
    $output .= '<img src="'.$profilePicture.'" width="120" height="110"/>'; 
    $output .= '<p>'.$name.'</p>'; 
    $output .= '</div>'; 
    $output .= '<form method="post" action=""><table width="200" border="0" cellpadding="3">'; 
    $output .= '<tr>'; 
    $output .= '<td><textarea name="updateme" cols="60" rows="4"></textarea></td>'; 
    $output .= '</tr>'; 
    $output .= '<tr>'; 
    $output .= '<td><input type="submit" value="Tweet" /></td>'; 
    $output .= '</tr></table></form>'; 
    $output .= '</div>'; 
     
    // Get latest tweets 
    $myTweets = $twClient->get('statuses/user_timeline', array('screen_name' => $username, 'count' => 5)); 
     
    // Display the latest tweets 
    $output .= '<div class="tweet_list"><strong>Latest Tweets : </strong>'; 
    $output .= '<ul>'; 
    foreach($myTweets  as $tweet){ 
        $output .= '<li>'.$tweet->text.' <br />-<i>'.$tweet->created_at.'</i></li>'; 
    } 
    $output .= '</ul></div>'; 
}elseif(isset($_REQUEST['oauth_token']) && $_SESSION['token'] == $_REQUEST['oauth_token']){ 
    echo "Retrive variables from session 2 ";
    // Call Twitter API 
    $twClient = new Abraham\TwitterOAuth\TwitterOAuth(TW_CONSUMER_KEY, TW_CONSUMER_SECRET, $_SESSION['token'] , $_SESSION['token_secret']); 
     
    // Get OAuth token 
    //$access_token = $twClient->getAccessToken($_REQUEST['oauth_verifier']); 
    $access_token = $twClient->oauth('oauth/access_token', array('oauth_verifier' => $_REQUEST['oauth_verifier']));
     
    // If returns success 
   // if($twClient->http_code == '200'){ 
        // Storing access token data into session 
        $_SESSION['status'] = 'verified'; 
        $_SESSION['request_vars'] = $access_token; 
         
        // Get user profile data from twitter 
        $userInfo = $twClient->get('account/verify_credentials', ['include_email' => 'true']); 
        //$userInfo = $twClient->get('/account/verify_credentials.json');//get('account/verify_credentials'); 
         
        // Initialize User class 
        $user = new User(); 
         
        // Getting user's profile data 
        $name = explode(" ",$userInfo->name); 
        $fname = isset($name[0])?$name[0]:''; 
        $lname = isset($name[1])?$name[1]:''; 
        $profileLink = 'https://twitter.com/'.$userInfo->screen_name; 
        $twUserData = array( 
            'oauth_uid'     => $_SESSION['request_vars']['user_id'], 
            'first_name'    => $fname, 
            'last_name'     => $lname, 
            'locale'        => $userInfo->lang, 
            'picture'       => $userInfo->profile_image_url, 
            'link'          => $profileLink, 
            'username'      => $userInfo->screen_name,
            'email'         => $userInfo->email 
        );
        echo "Error!!".$_REQUEST['oauth_verifier'];
        echo json_encode($userInfo);
        echo var_dump($access_token);
        // Insert or update user data to the database 
        $twUserData['oauth_provider'] = 'twitter'; 
        $userData = $user->checkUser($twUserData); 
         
        // Storing user data into session 
        $_SESSION['userData'] = $userData; 
         
        // Remove oauth token and secret from session 
        unset($_SESSION['token']); 
        unset($_SESSION['token_secret']); 
         
        // Redirect the user back to the same page 
       exit;
        header('Location: ./'); 
    //}else{ 
        $output = '<h3 style="color:red">Some problem occurred, please try again.</h3>'; 
    //} 
}else{ 
    echo "Retrive variables from session 3 ";
    // Fresh authentication 
    $twClient = new Abraham\TwitterOAuth\TwitterOAuth(TW_CONSUMER_KEY, TW_CONSUMER_SECRET); 
    $request_token = $twClient->getRequestToken(TW_REDIRECT_URL); 
    //$request_token = $twClient->oauth('oauth/request_token', array('oauth_callback' => TW_REDIRECT_URL));
    echo var_dump($request_token); 
    echo "Received token info from twitter";
    $_SESSION['token']       = $request_token['oauth_token']; 
    $_SESSION['token_secret']= $request_token['oauth_token_secret']; 
     
    // If authentication returns success 
   // if($twClient->http_code == '200'){ 
        // Get twitter oauth url 
        $authUrl = $twClient->getAuthorizeURL($request_token['oauth_token']); 
         // $authUrl = $twClient->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
         
         echo "Display twitter login button";
         echo $output = '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><img src="twitter_button.png" /></a>'; 
    //}else{ 
     //   $output = '<h3 style="color:red">Error connecting to Twitter! Try again later!</h3>'; 
    //} 
} 
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<title>Login with Twitter</title>
<meta charset="utf-8">
</head>
<body>
<div class="container">
    <!-- Display login button / Twitter profile information -->
    <?php if(isset($_SESSION["twitter"])){echo var_dump($_SESSION["twitter"]);}?>
    <?php echo $output; ?>
</div>
</body>
</html>