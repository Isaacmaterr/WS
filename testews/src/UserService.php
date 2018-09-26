<?php

namespace Realtime;

use Ratchet\ConnectionInterface;

abstract class UserService
{
    public function getNewUser(ConnectionInterface $connection, $param)
    {
        $user = new User();
        $user->addRoom(RoomService::getInstance($param->room));
        $user->setName($param->name);
        $user->setId($connection->resourceId);
        $user->setIdBanco($param->id);
        $user->setImage($param->image);
        return $user;
    }
    
    public function getUserByRoom($room, $connections)
    {
        $users = new \SplObjectStorage;
        foreach($connections as $connection) {
            if($connection->session->getRoom() != $room) continue;

            $users->attach($connection);
        }
        return $users;
    }
}