<?php

namespace App\Schemas\Master\RoomBed;

use App\Commons\Libs\Http\BaseSchema;

class RoomBedSchema extends BaseSchema
{
    private $roomId;
    private $code;
    private $name;
    private $status;
    private $description;

    protected function rules()
    {
        return [
            'room_id' => 'required|uuid',
            'code' => 'required|string',
            'name' => 'required|string',
            'status' => 'required|in:available,occupied,maintenance',
            'description' => 'nullable|string',
        ];
    }

    public function hydrateBody()
    {
        $roomId = $this->body['room_id'];
        $code = $this->body['code'];
        $name = $this->body['name'];
        $status = $this->body['status'];
        $description = !empty(trim($this->body['description'] ?? '')) ? $this->body['description'] : null;
        $this
            ->setRoomId($roomId)
            ->setCode($code)
            ->setName($name)
            ->setStatus($status)
            ->setDescription($description);
    }



    /**
     * Get the value of roomId
     */
    public function getRoomId()
    {
        return $this->roomId;
    }

    /**
     * Set the value of roomId
     *
     * @return  self
     */
    public function setRoomId($roomId)
    {
        $this->roomId = $roomId;

        return $this;
    }

    /**
     * Get the value of code
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of code
     *
     * @return  self
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }
}
