<?php
/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 9/14/14
 * Time: 2:48 PM
 */

class DAO {

    private $connection;

    private $cond;

    function __construct($cond)
    {
        $ini_array = parse_ini_file("connection.ini");
        $this->connection = new mysqli($ini_array['host'], $ini_array['user'],$ini_array['password'],$ini_array['dbname']);
        if ($this->connection->connect_errno) {
            die('Ошибка соединения'.$this->connection->error);
        }
        $this->connection->set_charset('utf8');

        if ($cond != "") {
            $this->cond = $cond;
        }
    }

    public function getTextCount() {
        $count = 0;
        $connection = $this->connection;
        $sql = 'select count(*) c from texts ';
        $res = $connection->query($sql);
        if($row = $res->fetch_assoc()) {
            $count = $row['c'];
        }
        $res->free();
        return $count;
    }

    public function getTextPage($page) {
        $text_list = array();
        $start = ($page - 1) * 5;
        $connection = $this->connection;
        $sql = 'SELECT * FROM texts order by id desc limit '.$start.', 5 ';
        $res = $connection->query($sql);
        if ($this->connection->connect_errno) {
            die('Ошибка соединения'.$this->connection->error);
        }
        if (isset($res)) {
            while($row = $res->fetch_assoc()) {
                $text = new Text($row['id']);
                $text->setTitle($row['title']);
                $text->setShortText($row['short_text']);
                array_push($text_list, $text);
            }
            $res->free();
        }
        return $text_list;
    }

    public function getTextById($id) {
        $text = null;
        $connection = $this->connection;
        $sql = 'SELECT * FROM texts where id='.$id;
        $res = $connection->query($sql);
        if ($this->connection->connect_errno) {
            die('Ошибка соединения'.$this->connection->error);
        }
        if (isset($res)) {
            if($row = $res->fetch_assoc()) {
                $text = new Text($row['id']);
                $text->setMetaTag($row['meta_tag']);
                $text->setTitle($row['title']);
                $text->setText($row['text']);
                $text->setLink($row['link']);
            }
            $res->free();
        }
        return $text;
    }

    public function getSysTextById($id) {
        $text = null;
        $connection = $this->connection;
        $sql = 'SELECT * FROM sys_texts where id='.$id;
        $res = $connection->query($sql);
        if ($this->connection->connect_errno) {
            die('Ошибка соединения'.$this->connection->error);
        }
        if (isset($res)) {
            if($row = $res->fetch_assoc()) {
                $text = new Text($row['id']);
                $text->setMetaTag($row['meta_tag']);
                $text->setTitle($row['title']);
                $text->setText($row['text']);
            }
            $res->free();
        }
        return $text;
    }

    public function getHouseCount() {
        $count = 0;
        $connection = $this->connection;
        $sql = 'select count(*) c from houses h JOIN citys c ON h.id_city = c.id JOIN countrys co ON c.id_country = co.id ';
        if (isset($this->cond)) {
            $sql .= 'where '.$this->cond.' ';
        }
        $res = $connection->query($sql);
        if($row = $res->fetch_assoc()) {
            $count = $row['c'];
        }
        $res->free();
        return $count;
    }

    public function getHousePage($page)
    {
        $house_list = array();
        $start = ($page - 1) * 5;
        $connection = $this->connection;
        $sql = 'SELECT h.* , t.id tid, t.name tname, c.id cid, c.name cname, co.id coid, co.name coname FROM houses h JOIN house_types t ON h.id_house_type = t.id JOIN citys c ON h.id_city = c.id JOIN countrys co ON c.id_country = co.id ';
        if (isset($this->cond)) {
            $sql .= 'where '.$this->cond.' ';
        }
        $sql .= 'order by id desc limit '.$start.', 5 ';
        $res = $connection->query($sql);
        if ($this->connection->connect_errno) {
            die('Ошибка соединения'.$this->connection->error);
        }
        if (isset($res)) {
            while($row = $res->fetch_assoc()) {
                $house = new House($row['id']);
                $house->setType($row['type']);
                $house->setCountry(new Country($row['coid'], $row['coname']));
                $house->setCity(new City($row['cid'], $row['cname']));
                $house->setHouseType(new HouseType($row['tid'], $row['tname']));
                $house->setTitle($row['title']);
                $house->setShortDescription($row['short_description']);
                $house->setCost($row['cost']);
                $house->setSquare($row['square']);
                $house->setToSea($row['to_sea']);
                $house->setImages($this->getImagesById($row['id']));
                array_push($house_list, $house);
            }
            $res->free();
        }
        return $house_list;
    }

    public function getHouseById($id) {
        $house = null;
        $connection = $this->connection;
        $sql = 'SELECT h.* , t.id tid, t.name tname, c.id cid, c.name cname, co.id coid, co.name coname FROM houses h JOIN house_types t ON h.id_house_type = t.id JOIN citys c ON h.id_city = c.id JOIN countrys co ON c.id_country = co.id where h.id = '.$id;
        if (isset($this->cond)) {
            $sql .= ' and '.$this->cond.' ';
        }
        $res = $connection->query($sql);
        if ($this->connection->connect_errno) {
            die('Ошибка соединения'.$this->connection->error);
        }
        if (isset($res)) {
            if($row = $res->fetch_assoc()) {
                $house = new House($row['id']);
                $house->setType($row['type']);
                $house->setCountry(new Country($row['coid'], $row['coname']));
                $house->setCity(new City($row['cid'], $row['cname']));
                $house->setHouseType(new HouseType($row['tid'], $row['tname']));
                $house->setTitle($row['title']);
                $house->setDescription($row['description']);
                $house->setCost($row['cost']);
                $house->setSquare($row['square']);
                $house->setToSea($row['to_sea']);
                if (isset($row['room_number'])) {
                    $house->setRoomNumber($row['room_number']);
                }
                if (isset($row['floor_number'])) {
                    $house->setFloorNumber($row['floor_number']);
                }
                if (isset($row['floor'])) {
                    $house->setFloor($row['floor']);
                }
                if (isset($row['furniture'])) {
                    if ($row['furniture'] == 1) {
                        $house->setFurniture(true);
                    }
                }
                if (isset($row['swimming_pool'])) {
                    if ($row['swimming_pool'] == 1) {
                        $house->setSwimmingPool(true);
                    }
                }
                if (isset($row['washer'])) {
                    if ($row['washer'] == 1) {
                        $house->setWasher(true);
                    }
                }
                if (isset($row['refrigerator'])) {
                    if ($row['refrigerator'] == 1) {
                        $house->setRefrigerator(true);
                    }
                }
                if (isset($row['kitchen_range'])) {
                    if ($row['kitchen_range'] == 1) {
                        $house->setKitchenRange(true);
                    }
                }
                if (isset($row['microwave'])) {
                    if ($row['microwave'] == 1) {
                        $house->setMicrowave(true);
                    }
                }
                if (isset($row['parking'])) {
                    if ($row['parking'] == 1) {
                        $house->setParking(true);
                    }
                }
                if (isset($row['map'])) {
                    $house->setMap($row['map']);
                }
                $house->setImages($this->getImagesById($row['id']));
            }
            $res->free();
        }
        return $house;
    }

    public function getCountrys() {
        $country_list = array();
        $connection = $this->connection;
        $sql = 'SELECT * FROM countrys ';
        $res = $connection->query($sql);
        if ($this->connection->connect_errno) {
            die('Ошибка соединения'.$this->connection->error);
        }
        if (isset($res)) {
            while($row = $res->fetch_assoc()) {
                $country = new Country($row['id'], $row['name']);
                $country->setCitys($this->getCitysById($row['id']));
                array_push($country_list, $country);
            }
            $res->free();
        }
        return $country_list;
    }

    public function getHouseTypes() {
        $house_type_list = array();
        $connection = $this->connection;
        $sql = 'SELECT * FROM house_types ';
        $res = $connection->query($sql);
        if ($this->connection->connect_errno) {
            die('Ошибка соединения'.$this->connection->error);
        }
        if (isset($res)) {
            while($row = $res->fetch_assoc()) {
                $house_type = new HouseType($row['id'], $row['name']);
                array_push($house_type_list, $house_type);
            }
            $res->free();
        }
        return $house_type_list;
    }

    public function getCitysById($id) {
        $citys = array();
        $connection = $this->connection;
        $res = $connection->query('SELECT * FROM citys WHERE id_country = '.$id);
        while($row = $res->fetch_assoc()) {
            $city = new City($row['id'], $row['name']);
            array_push($citys, $city);
        }
        $res->free();
        return $citys;
    }

    public function getImagesById($id) {
        $images = array();
        $connection = $this->connection;
        $res = $connection->query('SELECT * FROM images WHERE id_house = '.$id);
        while($row = $res->fetch_assoc()) {
            $image = new Image($row['id'], $row['url']);
            $image->setDescription($row['description']);
            array_push($images, $image);
        }
        $res->free();
        return $images;
    }

    public function close() {
        $this->connection->close();
    }
}