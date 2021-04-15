<?php

class CardModel extends Model
{

    public $id, $name, $damage, $img, $type;

    public function __construct($id, $name, $damage, $img, $type)
    {
        $this->id = $id;
        $this->name = $name;
        $this->damage = $damage;
        $this->img = $img;
        $this->type = $type;
    }

    public function getData()
    {
        return $this->toArray();
    }

    public function __toString()
    {
        print_r($this->toArray());
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'damage' => $this->damage,
            'img' => $this->img,
            'type' => $this->type,
        ];
    }
}
