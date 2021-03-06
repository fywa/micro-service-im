<?php
/**
 * Created by PhpStorm.
 * User: liuxiaodong
 * Date: 2018/12/19
 * Time: 22:36
 */

namespace App\Boot;


use Swoft\App;
use Swoft\Bean\Annotation\SwooleListener;
use Swoft\Bootstrap\Listeners\Interfaces\CloseInterface;
use Swoft\Bootstrap\Listeners\Interfaces\ConnectInterface;
use Swoft\Bootstrap\Listeners\Interfaces\ReceiveInterface;
use Swoft\Bootstrap\Listeners\Interfaces\WorkerStartInterface;
use Swoft\Bootstrap\SwooleEvent;
use Swoft\Socket\Bean\Annotation\SocketListener;
use Swoole\Server;

/**
 * Class TcpListener
 * @package App\Listener
 * @SwooleListener({
 *    SwooleEvent::ON_CONNECT,
 *    SwooleEvent::ON_RECEIVE,
 *    SwooleEvent::ON_CLOSE,
 * }
 * )
 */
class TcpListener implements ReceiveInterface,CloseInterface,ConnectInterface
{
    public function onConnect(Server $server, int $fd, int $reactorId)
    {
        //var_dump(\Swoft::$server);
        //var_dump($server);
        echo "socket---".$reactorId.PHP_EOL;
        // TODO: Implement onConnect() method.
    }
    public function onReceive(Server $server, int $fd, int $reactorId, string $data)
    {
        $dispatcher = App::getBean('ServiceDispatcher');
        $dispatcher->dispatch($server, $fd, $reactorId, $data);
        // TODO: Implement onReceive() method.
    }
    public function onClose(Server $server, int $fd, int $reactorId)
    {
        echo "socket---".$reactorId.PHP_EOL;
        // TODO: Implement onClose() method.
    }

}