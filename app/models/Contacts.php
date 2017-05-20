<?php

use Phalcon\Validation;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
/**
 * This validator is only for use with Phalcon\Mvc\Collection. If you are using
 * Phalcon\Mvc\Model, please use the validators provided by Phalcon\Validation.
 *      (Specifically "Phalcon\Validation\Validator\Email")
 *             \\use Phalcon\Mvc\Model\Validator\Email as EmailValidator;
 */
use Phalcon\Validation\Validator\Email as EmailValidator;

class Contacts extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $id;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    protected $name;

    /**
     *
     * @var string
     * @Column(type="string", length=30, nullable=true)
     */
    protected $email;

    /**
     *
     * @var string
     * @Column(type="string", length=13, nullable=false)
     */
    protected $phone;

    /**
     *
     * @var string
     * @Column(type="string", length=45, nullable=false)
     */
    protected $type;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Method to set the value of field email
     *
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Method to set the value of field phone
     *
     * @param string $phone
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Method to set the value of field type
     *
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the value of field email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Returns the value of field phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Returns the value of field type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Validations and business logic
     *
     * @return boolean
     */
    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'name',
            new PresenceOf(
                [
                    'model'        => $this,
                    'message'      => 'Please enter the contact name',
                    'cancelOnFail' => true,
                ]
            )
        );

        $validator->add(
            'email',
            new PresenceOf(
                [
                    'model'        => $this,
                    'message'      => 'Please enter the contact email address',
                    'cancelOnFail' => true,
                ]
            )
        );

        $validator->add(
            'phone',
            new PresenceOf(
                [
                    'model'        => $this,
                    'message'      => 'Please enter the contact telephone number',
                    'cancelOnFail' => true,
                ]
            )
        );


        $validator->add(
            'type',
            new PresenceOf(
                [
                    'model'        => $this,
                    'message'      => 'Please enter the contact type',
                    'cancelOnFail' => true,
                ]
            )
        );



        $validator->add(
            "name",
            new StringLength(
                [
                    "min"            => 2,
                    "max"            => 20,
                    "messageMinimum" => "The name is too short",
                    "messageMaximum" => "The name is too long (max 20)",
                 ]
            )
        );

        $validator->add(
            'email',
            new EmailValidator(
                [
                    'model'        => $this,
                    'message'      => 'Please enter a valid email address',
                ]
            )
        );


        $validator->add(
            "phone",
            new StringLength(
                [
                    "min"            => 5,
                    "max"            => 14,
                    "messageMinimum" => "The telephone is too short",
                    "messageMaximum" => "The telephone is too long (max 14)",
                 ]
            )
        );


        return $this->validate($validator);
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("addybook");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {

    /**
     * If we need to map to a DIFFERENT table name we can use the below example:
     * public function getSource()
     * {
     * return "table_name_old_contacts";
     */

        return 'contacts';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Contacts[]|Contacts
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Contacts
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
