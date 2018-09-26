<?php
namespace Realtime;

abstract class RoomService
{
    static public function getInstance($name)
    {
        $room = new Room();
        $room->setName($name);
        return $room;
    }
}