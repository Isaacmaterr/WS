<?php
namespace Realtime;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class SocketService implements MessageComponentInterface
{
    public static $connections;

    public function __construct()
    {
        self::$connections = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $connection)
    {
        $queryParams = ConnectionInformationService::checkInformations($connection);

        if (!$queryParams) {
            $connection->close();
            return;
        }

        $user = UserService::getNewUser($connection, $queryParams);

        $connection->session = $user;
        self::$connections->attach($connection);
    }

    public function onMessage(ConnectionInterface $from, $message)
    {
        $usersByRoom = UserService::getUserByRoom($from->session->getRoom(), self::$connections);
        $messageContent = [
            'id' => $from->session->getIdBanco(),
            'nome' => $from->session->getName(),
            'imagem' => $from->session->getImage(),
            'hora' => (new \DateTime())->modify('-3 hours')->format('H:i:s'),
            'mensagem' => $message,
            'conexoes' => $usersByRoom->count()
        ];

        foreach ($usersByRoom as $user) {
            $user->send(json_encode($messageContent));
        }
    }

    public function onClose(ConnectionInterface $connection)
    {
        self::$connections->detach($connection);
    }

    public function onError(ConnectionInterface $connection, \Exception $e)
    {
        $connection->close();
    }
}