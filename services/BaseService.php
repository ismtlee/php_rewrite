<?php
class BaseService {
	protected $session;
	
	function __construct() {
		$this->init();
	}
	
	protected function init() {
		$this->session = JSession::instance();
		$this->pre_do();
		$this->post_do();
	}
	protected function pre_do() {
		if(!($this->session->uid)) {
			throw new Exception('您尚未登陆.');
		}
	}
	
	protected function post_do() {
	}
}
