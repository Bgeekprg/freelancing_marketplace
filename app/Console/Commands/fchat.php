<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\Chat;
// use App\Http\Controllers\socketcontroller;
class fchat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'freelance:chat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {   
        // require dirname(__DIR__).'vendor.autoload.php';
        try {
            $server = IoServer::factory(
                new HttpServer(
                    new WsServer(
                        // new socketcontroller()
                        new Chat()
                    )
                ),
                8090
            );
            
            $server->run();
        } catch (\Throwable $th) {
            throw $th;
        }
      
        // return Command::SUCCESS;
    }
}
