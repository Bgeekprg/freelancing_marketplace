<?php

namespace App;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use Session;
use App\Models\Order;

class Chat implements MessageComponentInterface
{
    protected $clients;
    protected $users=array();
   
    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        // $this->users=[];
        
    }

    public function onOpen(ConnectionInterface $conn)
    {
            
            // $userid=$conn->resourceId;
            $user=Session('user');
            $this->users[$user]=$conn;
            $this->clients->attach($conn);
            echo "New connection! ({$conn->resourceId})\n";
           
        
        
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {  
      
        
        foreach ($this->clients as $client) {
            if ($from !== $client) {

                $client->send($users);
                
            }
        }


        // $data=json_decode($msg);
        // $this->users[$data['to']]->send($data->msg);       
        // echo "to:".$data->to;
        // echo "from:".$data->from;
        // print_r($this->users);
        // foreach($users as $key=>$i)
        // {
        //     echo $key;
        // }
        
        // if (isset($this->users[$data['to']])) {
            // $us=$data->to;
            // $this->users[$us]->send($data->msg);
            // echo "not set";
        // }
      
        //  foreach ($this->clients as $client) {
        
                // $client->send($msg);
        
            // }
        // }
        

        // $data=json_decode($msg,true);
        // $recepientId=$data['rid'];
        // $content=$data['content'];
        // if(isset($this->connections[$recepientId]))
        // {
        //     $recepient=$this->connections[$recepientId];
        //     $recepient->send($content);
        // }


    }

    public function onClose(ConnectionInterface $conn)
    {
        // $user = array_search($conn, $this->users);
        // unset($this->users[$user]);
        $this->clients->detach($conn);
        
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}
