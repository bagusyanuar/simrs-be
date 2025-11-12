<?php

namespace App\Schemas\Master\HospitalInstallation;

use App\Commons\Libs\Http\BaseSchema;

class HospitalInstallationSchema extends BaseSchema
{
    private $code;
    private $name;
    private $type;
    private $description;

    protected function rules()
    {
        return [
            'code' => 'required|string',
            'name' => 'required|string',
            'type' => 'required|in:service,support,administration',
            'description' => 'string'
        ];
    }

    public function hydrateBody()
    {
        $code = $this->body['code'];
        $name = $this->body['name'];
        $type = $this->body['type'];
        $description = !empty(trim($this->body['description'] ?? '')) ? $this->body['description'] : null;
        $this->setName($name)
            ->setCode($code)
            ->setType($type)
            ->setDescription($description);
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
