<?php
include 'vendor/autoload.php';
class Socks{

	public static function debug( $msg, $room = "default" ){

		$result['session'] = Array();
		if ( isset($_SESSION) ){
			$result['session'] = $_SESSION;
		}
		$result['server'] = Array();
		if ( isset($_SERVER) ){
			$result['server'] = $_SERVER;
		}
		$result['request'] = Array();
		if ( isset($_REQUEST) ){
			$result['request'] = $_REQUEST;
		}

		$result['msg'] = $msg;
		return self::call($result, $room);
	}

	public static function call($message, $room = "default"){

		$msg = array("message" => $message, "room" => $room);

// 		$msg = json_encode($msg);

		try {
			$loop = new React\EventLoop\StreamSelectLoop();
			$dnode = new DNode\DNode($loop);
			$dnode->connect('192.168.33.11', 7070, function($remote, $connection) use ($msg) {
				// Remote is a proxy object that provides us all methods
				// from the server
				$remote->debug($msg, function($n) use ($connection) {
					if($n){
						echo "THE ERROR";
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
}