<?php

namespace App\Schemas\Master\Clinic;

use App\Commons\Libs\Http\BaseSchema;

class ClinicSchema extends BaseSchema
{
    private $hospitalUnitId;
    private $code;
    private $name;
    private $alias;
    private $type;
    private $bpjsMappingCode;
    private $active;

    protected function rules()
    {
        return [
            'hospital_unit_id' => 'required|uuid',
            'code' => 'required|string',
            'name' => 'required|string',
            'alias' => 'nullable|string',
            'type' => 'required|in:polyclinic,department',
            'bpjs_mapping_code' => 'nullable|string',
            'active' => 'required|boolean'
        ];
    }

    public function hydrateBody()
    {
        $hospitalUnitId = $this->body['hospital_unit_id'];
        $code = $this->body['code'];
        $name = $this->body['name'];
        $type = $this->body['type'];
        $active = $this->body['active'];
        $alias = !empty(trim($this->body['alias'] ?? '')) ? $this->body['alias'] : null;
        $bpjsMappingCode = !empty(trim($this->body['bpjs_mapping_code'] ?? '')) ? $this->body['bpjs_mapping_code'] : null;
        $this
            ->setHospitalUnitId($hospitalUnitId)
            ->setCode($code)
            ->setName($name)
            ->setType($type)
            ->setActive($active)
            ->setAlias($alias)
            ->setBpjsMappingCode($bpjsMappingCode);
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
     * Get the value of alias
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set the value of alias
     *
     * @return  self
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get the value of type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of bpjsMappingCode
     */
    public function getBpjsMappingCode()
    {
        return $this->bpjsMappingCode;
    }

    /**
     * Set the value of bpjsMappingCode
     *
     * @return  self
     */
    public function setBpjsMappingCode($bpjsMappingCode)
    {
        $this->bpjsMappingCode = $bpjsMappingCode;

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
}
