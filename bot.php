<?php

if (!file_exists('madeline.php')) {
    copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
}

include 'madeline.php';

$MadelineProto = new \danog\MadelineProto\API('session.madeline');
class EventHandler extends \danog\MadelineProto\EventHandler
{
    public function __construct($MadelineProto)
    {
        parent::__construct($MadelineProto);
    }
    public function onUpdateNewChannelMessage($update)
    {
        $this->onUpdateNewMessage($update);
    }
    public function onUpdateNewMessage($update)
    {
        if (isset($update['message']['out']) && $update['message']['out']) {
            return;
        }
        if (isset($update['message']['data']) && $update['message']['date'] + 5 < time()) {
            return;
        }
       
        $msg = isset($update['message']['message']) ? $update['message']['message'] : '';
		$chatID = isset($update['message']['chatID']) ? $update['message']['chatID'] : '';
		$userID = isset($update['message']['userID']) ? $update['message']['userID'] : '';

try {
	
if ($msg == "بوت"){
      $this->messages->sendMessage([
      "peer"=>$update,
      "message"=>"البوت يعمل ... ✅",
      "parse_mode"=>"Markdown",
    ]);
}

	
	
} catch (Exception $e) {
    echo$e->getMessage();
	}
  }
}

$MadelineProto->start();
$MadelineProto->setEventHandler('\EventHandler');
$MadelineProto->loop();
