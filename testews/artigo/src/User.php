<?php

namespace Realtime;


class User
{
    private $id;
    private $idBanco;
    private $name;
    private $image;
    private $room;

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return urldecode($this->name);
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setIdBanco($idBanco)
    {
        $this->idBanco = $idBanco;
        return $this;
    }

    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIdBanco()
    {
        return $this->idBanco;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function addRoom($room)
    {
        //$room = str_replace(' ', '', $room);
        //$room = strtolower($room);

        $this->room = $room;
    }

    public function getRoom()
    {
        return $this->room;
    }

    public function expose()
    {
        return get_object_vars($this);
    }
}