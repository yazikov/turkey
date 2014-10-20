<?php
/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 12.10.14
 * Time: 14:12
 */

class House {
    private $id;
    private $country;

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }
    private $city;
    private $house_type;
    /**
     * @var int тип объявления
     */
    private $type;
    private $meta_tag;
    private $title;
    private $short_description;
    private $description;
    private $cost;
    private $square;
    private $to_sea;
    private $room_number;
    private $floor_number;
    private $floor;
    private $swimming_pool;
    private $parking;
    private $furniture;
    private $washer;
    private $refrigerator;
    private $kitchen_range;
    private $microwave;
    private $images;
    private $map;

    /**
     * @return mixed
     */
    public function getMap()
    {
        return $this->map;
    }

    /**
     * @param mixed $map
     */
    public function setMap($map)
    {
        $this->map = $map;
    }

    /**
     * @return mixed
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param mixed $images
     */
    public function setImages($images)
    {
        $this->images = $images;
    }

    function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @param mixed $cost
     */
    public function setCost($cost)
    {
        $this->cost = $cost;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getFloor()
    {
        return $this->floor;
    }

    /**
     * @param mixed $floor
     */
    public function setFloor($floor)
    {
        $this->floor = $floor;
    }

    /**
     * @return mixed
     */
    public function getFloorNumber()
    {
        return $this->floor_number;
    }

    /**
     * @param mixed $floor_number
     */
    public function setFloorNumber($floor_number)
    {
        $this->floor_number = $floor_number;
    }

    /**
     * @return mixed
     */
    public function getFurniture()
    {
        return $this->furniture;
    }

    /**
     * @param mixed $furniture
     */
    public function setFurniture($furniture)
    {
        $this->furniture = $furniture;
    }

    /**
     * @return mixed
     */
    public function getHouseType()
    {
        return $this->house_type;
    }

    /**
     * @param mixed $house_type
     */
    public function setHouseType($house_type)
    {
        $this->house_type = $house_type;
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
    public function getKitchenRange()
    {
        return $this->kitchen_range;
    }

    /**
     * @param mixed $kitchen_range
     */
    public function setKitchenRange($kitchen_range)
    {
        $this->kitchen_range = $kitchen_range;
    }

    /**
     * @return mixed
     */
    public function getMetaTag()
    {
        return $this->meta_tag;
    }

    /**
     * @param mixed $meta_tag
     */
    public function setMetaTag($meta_tag)
    {
        $this->meta_tag = $meta_tag;
    }

    /**
     * @return mixed
     */
    public function getMicrowave()
    {
        return $this->microwave;
    }

    /**
     * @param mixed $microwave
     */
    public function setMicrowave($microwave)
    {
        $this->microwave = $microwave;
    }

    /**
     * @return mixed
     */
    public function getParking()
    {
        return $this->parking;
    }

    /**
     * @param mixed $parking
     */
    public function setParking($parking)
    {
        $this->parking = $parking;
    }

    /**
     * @return mixed
     */
    public function getRefrigerator()
    {
        return $this->refrigerator;
    }

    /**
     * @param mixed $refrigerator
     */
    public function setRefrigerator($refrigerator)
    {
        $this->refrigerator = $refrigerator;
    }

    /**
     * @return mixed
     */
    public function getRoomNumber()
    {
        return $this->room_number;
    }

    /**
     * @param mixed $room_number
     */
    public function setRoomNumber($room_number)
    {
        $this->room_number = $room_number;
    }

    /**
     * @return mixed
     */
    public function getShortDescription()
    {
        return $this->short_description;
    }

    /**
     * @param mixed $short_description
     */
    public function setShortDescription($short_description)
    {
        $this->short_description = $short_description;
    }

    /**
     * @return mixed
     */
    public function getSquare()
    {
        return $this->square;
    }

    /**
     * @param mixed $square
     */
    public function setSquare($square)
    {
        $this->square = $square;
    }

    /**
     * @return mixed
     */
    public function getSwimmingPool()
    {
        return $this->swimming_pool;
    }

    /**
     * @param mixed $swimming_pool
     */
    public function setSwimmingPool($swimming_pool)
    {
        $this->swimming_pool = $swimming_pool;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getToSea()
    {
        return $this->to_sea;
    }

    /**
     * @param mixed $to_sea
     */
    public function setToSea($to_sea)
    {
        $this->to_sea = $to_sea;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }



    /**
     * @return mixed
     */
    public function getWasher()
    {
        return $this->washer;
    }

    /**
     * @param mixed $washer
     */
    public function setWasher($washer)
    {
        $this->washer = $washer;
    }


} 