<?php
include "vendor/autoload.php";
date_default_timezone_set('Europe/Amsterdam');

if(!defined("DEBUG")){
	$GLOBALS["sock"] = array();
}

register_shutdown_function(array("Socks", 'end'));

class Socks{

	public static function info( $msg, $room = "default" ){

		$result = Array();
		$result['msg'] = $msg;

		return self::call($result, $room);
	}

	public static function debug( $msg, $room = "default" ){

		$result = Array();

		$result['msg'] = $msg;

		$result = self::addDetails( $result );

		return self::call($result, $room);
	}

	public static function start( ){
		$GLOBALS['sock']['start'] = microtime(true);
// 		return self::debug("The script start ".date("Y-m-d H:i:s") , "perfomance");
	}

	public static function end( ){
		$GLOBALS['sock']['end'] = microtime(true);

		$milliseconds = $GLOBALS['sock']['start'] - $GLOBALS['sock']['end'];

		return self::debug("You script took {$milliseconds} to be executed", "perfomance");
	}

	public static function call($message, $room = "default"){

		$msg = array("message" => $message, "room" => $room);

// 		$msg = json_encode($msg);

		try {
			$loop = new React\EventLoop\StreamSelectLoop();
			$dnode = new DNode\DNode($loop);
			$dnode->connect('localhost', 7070, function($remote, $connection) use ($msg) {
				// Remote is a proxy object that provides us all methods
				// from the server
				$remote->debug($msg, function($n) use ($connection) {
					if($n){
// 						echo "THE ERROR";
					}
	// 				echo "n = {$n}\n";
					// Once we have the result we can close the connection
					$connection->end();
				});
			});
			$loop->run();
		} catch (Exception $e){
			echo "Debugger cannot send the request";
			var_dump($e);
		}
	}

	private static function addDetails( $result ){

		$arr = array();

		$arr['session'] = Array();
		if ( isset($_SESSION) ){
			$arr['session'] = $_SESSION;
		}
		$arr['server'] = Array();
		if ( isset($_SERVER) ){
			$arr['server'] = $_SERVER;
		}
		$arr['request'] = Array();
		if ( isset($_REQUEST) ){
			$arr['request'] = $_REQUEST;
		}

		$result = array_merge_recursive( $result, $arr );

		return $result;
	}
}