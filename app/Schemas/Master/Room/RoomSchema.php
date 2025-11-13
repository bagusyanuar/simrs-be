<?php

namespace App\Schemas\Master\Room;

use App\Commons\Libs\Http\BaseSchema;

class RoomSchema extends BaseSchema
{
    private $hospitalUnitId;
    private $roomClassId;
    private $code;
    private $name;
    private $floor;
    private $gender;
    private $isolation;
    private $active;
    private $description;

    protected function rules()
    {
        return [
            'hospital_unit_id' => 'required|uuid',
            'room_class_id' => 'required|uuid',
            'code' => 'required|string',
            'name' => 'required|string',
            'floor' => 'required|string',
            'gender' => 'required|in:male,female,mixed',
            'isolation' => 'required|boolean',
            'active' => 'required|boolean',
            'description' => 'nullable|string',
        ];
    }

    public function hydrateBody()
    {
        $hospitalUnitId = $this->body['hospital_unit_id'];
        $roomClassId = $this->body['room_class_id'];
        $code = $this->body['code'];
        $name = $this->body['name'];
        $floor = $this->body['floor'];
        $gender = $this->body['gender'];
        $isolation = $this->body['isolation'];
        $active = $this->body['active'];
        $description = !empty(trim($this->body['description'] ?? '')) ? $this->body['description'] : null;
        $this
            ->setHospitalUnitId($hospitalUnitId)
            ->setRoomClassId($roomClassId)
            ->setCode($code)
            ->setName($name)
            ->setFloor($floor)
            ->setGender($gender)
            ->setIsolation($isolation)
            ->setActive($active)
            ->setDescription($description);
    }

    /**
     * Get the value of hospitalUnitId
     */
    public function getHospitalUnitId()
    {
        return $this->hospitalUnitId;
    }

    /**
     * Set the value of hospitalUnitId
     *
     * @return  self
     */
    public function setHospitalUnitId($hospitalUnitId)
    {
        $this->hospitalUnitId = $hospitalUnitId;

        return $this;
    }

    /**
     * Get the value of roomClassId
     */
    public function getRoomClassId()
    {
        return $this->roomClassId;
    }

    /**
     * Set the value of roomClassId
     *
     * @return  self
     */
    public function setRoomClassId($roomClassId)
    {
        $this->roomClassId = $roomClassId;

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
     * Get the value of floor
     */
    public function getFloor()
    {
        return $this->floor;
    }

    /**
     * Set the value of floor
     *
     * @return  self
     */
    public function setFloor($floor)
    {
        $this->floor = $floor;

        return $this;
    }

    /**
     * Get the value of gender
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set the value of gender
     *
     * @return  self
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get the value of isolation
     */
    public function isIsolation()
    {
        return $this->isolation;
    }

    /**
     * Set the value of isolation
     *
     * @return  self
     */
    public function setIsolation($isolation)
    {
        $this->isolation = $isolation;

        return $this;
    }

    /**
     * Get the value of active
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * Set the value of active
     *
     * @return  self
     */
    public function setActive($active)
    {
        $this->active = $active;

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
