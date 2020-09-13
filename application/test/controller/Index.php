<?php 
namespace app\test\controller;
define('TOKEN', 'mytest');
/**
 * 
 */
class Jssdkceshi 
{
	
	public function Valid()
	{
		//接口配置信息修改的时候需要，正式上线不需要
		//$echoStr = $_GET['echostr'];
		if ($this->checkSignature()) {
			//echo $echoStr;
			exit;
		}


	}

	public function index()
	{
		$this->valid();
		$this->responseMsg();
		$this->creatCaidan();
	}

	public function responseMsg()
	{
		$postStr = $GLOBALS['HTTP_RAW_POST_DATA'];
		if (!empty($postStr)) {
			$postObj = simplexml_load_string($postStr,'SimpleXMLElement',LIBXML_NOCDATA);
			$
		}
	}
}

 ?>