<?php

namespace App\Schemas\Master\JobDepartment;

use App\Commons\Libs\Http\BaseSchema;

class JobDepartmentSchema extends BaseSchema
{
    private $code;
    private $name;
    private $isMedical;
    private $description;

    protected function rules()
    {
        return [
            'code' => 'required|string',
            'name' => 'required|string',
            'is_medical' => 'required|boolean',
            'description' => 'string'
        ];
    }

    public function hydrateBody()
    {
        $code = $this->body['code'];
        $name = $this->body['name'];
        $isMedical = $this->body['is_medical'];
        $description = !empty(trim($this->body['description'] ?? '')) ? $this->body['description'] : null;
        $this->setName($name)
            ->setCode($code)
            ->setIsMedical($isMedical)
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
     * Get the value of isMedical
     */
    public function isMedical()
    {
        return $this->isMedical;
    }

    /**
     * Set the value of isMedical
     *
     * @return  self
     */
    public function setIsMedical($isMedical)
    {
        $this->isMedical = $isMedical;

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
