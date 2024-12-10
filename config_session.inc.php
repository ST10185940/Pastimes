<?php
  ini_set('session.use_only_cookies',1);
  ini_set('session.use_strict_mode',1);
  session_set_cookie_params([
    'lifetime' => 1800,
    'domain'=> 'localhost',
    'path'=> '/',
    'secure'=> true,
    'httponly' => true
  ]);

session_start();

    if(isset($_SESSION["uid"])){
        if(!isset($_SESSION["last_regeneration"])){
            regen_session_id_loggedin_();
        } else {
            $interval = 60*30;
            if(time() - $_SESSION["last_regeneration"] >= $interval){
                regen_session_id_loggedin_();
            }
        }
    }else{
        //checks if a sesssion variable exists and generates session cookie
        if(!isset($_SESSION["last_regeneration"])){
            regen_session_id();
        } else {
            $interval = 60*30;
            if(time() - $_SESSION["last_regeneration"] >= $interval){
                regen_session_id();
            }
        }
    }
      
    function regen_session_id(){
        session_regenerate_id(true);
        $_SESSION["last_regeneration"] = time();
    }

    function regen_session_id_loggedin_(){
        session_regenerate_id(true);
        $uid = $_SESSION["uid"];
        $newSessionId = session_create_id();
        $sessionId = $newSessionId. "_" .$uid;
        session_id($sessionId);

        $_SESSION["last_regeneration"] = time();
    }
?>