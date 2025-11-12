<?php

namespace App\Schemas\Master\HospitalUnit;

use App\Commons\Libs\Http\BaseSchema;

class HospitalUnitSchema extends BaseSchema
{
    private $hospitalInstallationId;
    private $code;
    private $name;
    private $description;

    protected function rules()
    {
        return [
            'hospital_installation_id' => 'required|uuid',
            'code' => 'required|string',
            'name' => 'required|string',
            'description' => 'string'
        ];
    }

    public function hydrateBody()
    {
        $code = $this->body['code'];
        $name = $this->body['name'];
        $hospitalInstallationId = $this->body['hospital_installation_id'];
        $description = !empty(trim($this->body['description'] ?? '')) ? $this->body['description'] : null;
        $this->setName($name)
            ->setCode($code)
            ->setHospitalInstallationId($hospitalInstallationId)
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
     * Get the value of hospitalInstallationId
     */
    public function getHospitalInstallationId()
    {
        return $this->hospitalInstallationId;
    }

    /**
     * Set the value of hospitalInstallationId
     *
     * @return  self
     */
    public function setHospitalInstallationId($hospitalInstallationId)
    {
        $this->hospitalInstallationId = $hospitalInstallationId;

        return $this;
    }
}
