<?php
function encrypt_decrypt($string, $action = 'e', $sk = S_KEY, $iv = IV_KEY){
    $secret_key = $sk;
    $secret_iv = $iv;
 
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
 
    if($action == 'e'){
        $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
    }
    elseif($action == 'd'){
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
 
    return $output;
}

function check_session($type = 0, $redirect = true){
	if(strcmp((string)$type, "0") == 0){
		if(!empty($_SESSION['username']) && !empty($_SESSION['hashedUsername'])){
			if($_SESSION['username'] == encrypt_decrypt($_SESSION['hashedUsername'], 'd')){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}else{
		return false;
	}
}

function filter($con, $zmienna){
	if($con == "no_db"){
		return htmlspecialchars(trim($zmienna));
	}elseif(!empty($con)){
		return mysqli_real_escape_string($con, htmlspecialchars(trim($zmienna)));
	}
}

function filter_array($con, array $var){
	$i = 0;
	
	foreach($var as $value){
		if($con == "no_db"){
			$var[$i] = htmlspecialchars(trim($var[$i]));
		}elseif(!empty($con)){
			$var[$i] = mysqli_real_escape_string($con, htmlspecialchars(trim($var[$i])));
		}
		
		$i++;
	}
	
	return $var;
}

function getUserIP(){
	$ip = Array(
		'client' => $_SERVER['HTTP_CLIENT_IP'],
		'forward' => null,
		'remote' => $_SERVER['REMOTE_ADDR']
	);
	
    if(array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        if(strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') > 0){
            $ip['forward'] = explode(",", $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
        }else{
            $ip['forward'] = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    }
	
	if(filter_var($ip['client'], FILTER_VALIDATE_IP)){
        $return = $ip['client'];
    }elseif(filter_var($ip['forward'], FILTER_VALIDATE_IP)){
        $return = $ip['forward'];
    }else{
        $return = $ip['remote'];
    }
	
	return $return;
}
?>