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
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
        $data[$key] = $message;
        $pusher->trigger($channel, $event, $data);
    }
}
