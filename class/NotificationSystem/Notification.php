<?php
namespace NotificationSystem;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Notification implements MessageComponentInterface {
    protected $clients;
    private $users;
    private $conn_to_users;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        $this->users = [];
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";

    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $data = json_decode($msg);
        var_dump($data);
        if($data->msg_type === "initialization") {
            echo 'Initialized-';
            echo $data->id.'-';
            $this->users[$data->id] = $from;
            echo $this->users[$data->id]->resourceId;
        } else {
            // Get the id of the recepient
            // Check if the user corresponding to that id is connected to the server
            // If so send him the notification
            
            $sender_id = array_search($from, $this->users);
            $recepient_id = $data->recepient_id;
            echo 'Sender ID: '.$sender_id;
            echo 'Recepient ID: '.$recepient_id;
            
            // User shouldn't receive a notification from him/herself
            if($sender_id == $recepient_id)
                return;

            if(!isset($this->users[$recepient_id])) {
                echo 'ID not found, returning...';
                return;
            }
            $recepient_conn = $this->users[$recepient_id];
            $recepient_conn->send(json_encode(array("content" => $data->content, "sender_id" => $sender_id, "sender_name" => $data->full_name, "msg_type" => $data->msg_type))); 
            
        }
    }

    public function onClose(ConnectionInterface $conn) {
    
        $this->clients->detach($conn);

        // On closing, get the id of the closing connection and unset it
        $id_of_conn = array_search($conn, $this->users);
        unset($this->users[$id_of_conn]);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}
?>