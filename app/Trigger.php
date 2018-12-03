<?php
namespace App;
use Pusher\Pusher;

class Trigger {

    public function send(String $channel,String $event,String $key, $message){
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
          );

        $pusher = new Pusher(
            '8aa55b1cf27e9a794548',
            '3d55b39dca6f8ecb66c6',
            '657201',
            $options
        );
        $data[$key] = $message;
        $pusher->trigger($channel, $event, $data);
    }
}
