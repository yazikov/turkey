<?php
/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 14.10.14
 * Time: 21:58
 */

class Country {
    private $id;
    private $name;
    private $citys;

    function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getCitys()
    {
        return $this->citys;
    }

    /**
     * @param mixed $citys
     */
    public function setCitys($citys)
    {
        $this->citys = $citys;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }


} 