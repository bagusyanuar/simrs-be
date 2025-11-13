<?php

namespace App\Schemas\Master\Staff;

use App\Commons\Libs\Http\BaseSchema;

class StaffSchema extends BaseSchema
{
    private $jobPositionId;
    private $jobDepartmentId;
    private $employeeNumber;
    private $fullName;
    private $birthDate;
    private $gender;
    private $email;
    private $phone;
    private $address;
    private $joinDate;
    private $isActive;

    protected function rules()
    {
        return [
            'job_position_id' => 'required|uuid',
            'job_department_id' => 'required|uuid',
            'employee_number' => 'required|string',
            'full_name' => 'required|string',
            'birth_date' => 'nullable|date',
            'gender' => 'required|in:male,female',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|address',
            'join_date' => 'nullable|date',
            'is_active' => 'required|boolean',
        ];
    }

    public function hydrateBody()
    {
        $jobPositionId = $this->body['job_position_id'];
        $jobDepartmentId = $this->body['job_department_id'];
        $employeeNumber = $this->body['employee_number'];
        $fullName = $this->body['full_name'];
        $gender = $this->body['gender'];
        $isActive = $this->body['is_active'];
        $birthDate = !empty(trim($this->body['birth_date'] ?? '')) ? $this->body['birth_date'] : null;
        $email = !empty(trim($this->body['email'] ?? '')) ? $this->body['email'] : null;
        $phone = !empty(trim($this->body['phone'] ?? '')) ? $this->body['phone'] : null;
        $address = !empty(trim($this->body['address'] ?? '')) ? $this->body['address'] : null;
        $joinDate = !empty(trim($this->body['join_date'] ?? '')) ? $this->body['join_date'] : null;
        $this->setJobPositionId($jobPositionId)
            ->setJobDepartmentId($jobDepartmentId)
            ->setEmployeeNumber($employeeNumber)
            ->setFullName($fullName)
            ->setGender($gender)
            ->setIsActive($isActive)
            ->setBirthDate($birthDate)
            ->setEmail($email)
            ->setPhone($phone)
            ->setAddress($address)
            ->setJoinDate($joinDate);
    }

    /**
     * Get the value of jobPositionId
     */
    public function getJobPositionId()
    {
        return $this->jobPositionId;
    }

    /**
     * Set the value of jobPositionId
     *
     * @return  self
     */
    public function setJobPositionId($jobPositionId)
    {
        $this->jobPositionId = $jobPositionId;

        return $this;
    }

    /**
     * Get the value of jobDepartmentId
     */
    public function getJobDepartmentId()
    {
        return $this->jobDepartmentId;
    }

    /**
     * Set the value of jobDepartmentId
     *
     * @return  self
     */
    public function setJobDepartmentId($jobDepartmentId)
    {
        $this->jobDepartmentId = $jobDepartmentId;

        return $this;
    }

    /**
     * Get the value of employeeNumber
     */
    public function getEmployeeNumber()
    {
        return $this->employeeNumber;
    }

    /**
     * Set the value of employeeNumber
     *
     * @return  self
     */
    public function setEmployeeNumber($employeeNumber)
    {
        $this->employeeNumber = $employeeNumber;

        return $this;
    }

    /**
     * Get the value of fullName
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Set the value of fullName
     *
     * @return  self
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get the value of birthDate
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set the value of birthDate
     *
     * @return  self
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

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
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @return  self
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     *
     * @return  self
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the value of joinDate
     */
    public function getJoinDate()
    {
        return $this->joinDate;
    }

    /**
     * Set the value of joinDate
     *
     * @return  self
     */
    public function setJoinDate($joinDate)
    {
        $this->joinDate = $joinDate;

        return $this;
    }

    /**
     * Get the value of isActive
     */
    public function isActive()
    {
        return $this->isActive;
    }

    /**
     * Set the value of isActive
     *
     * @return  self
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }
}
