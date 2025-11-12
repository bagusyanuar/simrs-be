<?php

namespace App\Schemas\Master\HospitalUnit;

use App\Commons\Libs\Http\BaseSchema;

class HospitalUnitSchema extends BaseSchema
{
    private $hospitalUnitId;
    private $code;
    private $name;
    private $description;

    protected function rules()
    {
        return [
            'hospital_unit_id' => 'required|uuid',
            'code' => 'required|string',
            'name' => 'required|string',
            'description' => 'string'
        ];
    }

    public function hydrateBody()
    {
        $code = $this->body['code'];
        $name = $this->body['name'];
        $hospitalUnitId = $this->body['hospital_unit_id'];
        $description = !empty(trim($this->body['description'] ?? '')) ? $this->body['description'] : null;
        $this->setName($name)
            ->setCode($code)
            ->setHospitalUnitId($hospitalUnitId)
            ->setDescription($description);
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
}
