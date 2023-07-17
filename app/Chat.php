<?php

namespace App;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use Illuminate\Support\Facades\Config;



class Chat implements MessageComponentInterface
{
    protected $clients;
    protected $users;
    protected $sessions;
    
    

   
    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        $this->connect=[];
        $this->users=[]; 
    }

    public function onOpen(ConnectionInterface $conn)
    {   
        
        $sessionId = null;
        $cookies = explode('; ', $conn->httpRequest->getHeader('Cookie'));
        foreach ($cookies as $cookie) {
            $parts = explode('=', $cookie);
            if ($parts[0] == session_name()) {
                $sessionId = $parts[1];
                break;
            }
        }

        // Set the session ID for the current request
        if ($sessionId) {
            Session::setId($sessionId);
        }

        // Start the session
        Session::start();
        


        $user = $session->get('user');
           
            
            $this->users[$user]=$conn;
            
            
            
            $this->clients->attach($conn);
          
            echo "New connection! ({$conn->resourceId})\n";
           
        
        
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {  
        // echo $this->sessions->read('user');
        $data=json_decode($msg);
        foreach ($this->clients as $client) {
            if ($from !== $client) {
               
               
                        // foreach($this->users as $key => $val)
                        // {
                         
                        //     // $client->send($key);
                        //     echo $key;
                        //     // break;
                        // }
                    }
                                }   
            $this->users[$data->to]->send($data->msg);
            // echo $this->sessions->read('user');
            // echo "hello";
           
        


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
