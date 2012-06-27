<?php
	require 'env.php';
	
	if (!isset($_GET['service'])) {
		return false;
	}
	$clazz = $_GET['service'];
	
	if (!isset($_GET['cmd'])) {
		return false;
	}
	$func = $_GET['cmd'];
	
	$args = isset($_GET['args']) ? $_GET['args'] : null;
	
	$data = call_user_func_array(array(new $clazz, $func), explode(',', $args));
	if(!$data) {
		return "";
	}
	echo json_encode($data);
	
    
