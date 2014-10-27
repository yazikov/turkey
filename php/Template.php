<?php
/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 9/20/14
 * Time: 6:59 PM
 */

class Template {
    private $dao;
    private $active_menu;
    private $page_count;
    private $page_name;
    private $active_page;
    private $page_generate;
    private $text;
    private $texts;
    private $house;
    private $houses;

    function __construct($dao, $active_menu, $active_page, $page_count, $page_name, $text, $texts, $house, $houses)
    {
        $this->dao = $dao;
        $this->active_menu = $active_menu;
        $this->active_page = $active_page;
        $this->page_count = $page_count;
        $this->page_name = $page_name;
        if (strpos($this->page_name, '?') === false) {
            $this->page_generate = $page_name.'?page=';
        } else {
            if (strpos($this->page_name, '&page=')) {
                $this->page_name = str_replace('&page='.$active_page, '', $this->page_name);
            } else if (strpos($this->page_name, '&page=')) {
                $this->page_name = str_replace('page='.$active_page, '', $this->page_name);
            }
            $this->page_generate = $this->page_name.'&page=';
        }
        $this->text = $text;
        $this->house = $house;
        $this->texts = $texts;
        $this->houses = $houses;
    }

    public function buildContent() {
        if (isset($this->text)) {
            $this->printText($this->text);
        }
        if (isset($this->house)) {
            $this->printHouse($this->house);
        }
        if (isset($this->texts)) {
            $this->buildPaging(true);
            $this->buildTextList();
            $this->buildPaging(false);
        }
        if (isset($this->houses)) {
            $this->buildPaging(true);
            $this->buildHouseList();
            $this->buildPaging(false);
        }
    }

    public function buildPaging($top) {
        if ($this->page_count > 1) {
            if (!$top) {
                $this->printSeparator();
            }
            print '<div class="pag">';
            print '<ul class="pagination">';
            if ($this->page_count < 8) {
                for ($i = 1; $i <= $this->page_count; $i++) {
                    $this->printPage($i);
                }
            } else {
                if ($this->active_page < 5) {
                    for ($i = 1; $i < 5; $i++) {
                        $this->printPage($i);
                    }
                    if ($this->active_page == 4) {
                        $this->printPage($this->active_page + 1);
                    }
                    $this->printHellip();
                    $this->printPage($this->page_count - 1);
                    $this->printPage($this->page_count);
                } else if($this->active_page > $this->page_count - 4) {
                    $this->printPage(1);
                    $this->printPage(2);
                    $this->printHellip();
                    if ($this->active_page == $this->page_count - 4) {
                        $this->printPage($this->page_count - 5);
                    }
                    for ($i = $this->page_count - 3; $i <= $this->page_count; $i++) {
                        $this->printPage($i);
                    }
                } else {
                    $this->printPage(1);
                    $this->printPage(2);
                    $this->printHellip();
                    $this->printPage($this->active_page - 1);
                    $this->printPage($this->active_page);
                    $this->printPage($this->active_page + 1);
                    $this->printHellip();
                    $this->printPage($this->page_count - 1);
                    $this->printPage($this->page_count);
                }
            }
            print '</ul>';
            print '</div>';
            if ($top) {
                $this->printSeparator();
            }
        }
    }

    public function buildHouseList() {
        $count = count($this->houses);
        for($i = 0; $i < $count; $i++) {
            $this->printHouseInList($this->houses[$i]);
            if ($i != $count - 1 ) {
                $this->printSeparator();
            }
        }
    }

    /**
     * @param House $house
     */
    public function printHouse($house) {
        print '<div class="content_title"><b>'.$house->getTitle().'</b></div>';

        print '<div class="content_body">';

        print '<div class="content_slider">';
        print '<ul class="nav nav-tabs" role="tablist">';
        print '<li class="active"><a href="#image_tab" role="tab" data-toggle="tab">Изображения</a></li>';
        print '<li><a href="#map_tab" role="tab" data-toggle="tab">Карта</a></li>';
        print '</ul>';

        print '<div class="tab-content">';
        print '<div class="tab-pane active" id="image_tab">';
        print '<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">';
        print '<div class="carousel-inner">';

        $images = $house->getImages();
        $count = count($images);

        for ($i = 0; $i < $count; $i++) {
            $image = $images[$i];
            if ($i == 0) {
                print '<div class="item active">';
            } else {
                print '<div class="item">';
            }
            print '<a class="fancybox" href="'.$image->getUrl().'" data-fancybox-group="gallery">';
            print '<img src="'.$image->getUrl().'" alt="'.$image->getDescription().'">';
            print '</a>';
            print '</div>';
        }

        print '</div>';
        print '<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">';
        print '<span class="glyphicon glyphicon-chevron-left"></span>';
        print '</a>';

        print '<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">';
        print '<span class="glyphicon glyphicon-chevron-right"></span>';
        print '</a>';

        print '</div>';
        print '</div>';
        print '<div class="tab-pane" id="map_tab">';
        print $house->getMap();
        print '</div>';
        print '</div>';
        print '</div>';

        $this->printHouseDescription($house);

        print '</div>';
    }

    /**
     * @param House $house
     */
    public function printHouseInList($house) {
        print '<div class="content_title"><b>'.$house->getTitle().'</b></div>';

        print '<div class="content_body">';

        if (count($house->getImages()) > 0) {
            print '<div class="content_image">';
            print '<a class="fancybox" href="'.$house->getImages()[0]->getUrl().'" >';
            print '<img src="'.$house->getImages()[0]->getUrl().'" width="250px"/>';
            print '</a>';
            print '</div>';
        }

        $this->printHouseDescription($house);

        print '<div class="button_left"><a type="button" href="/house.php?id='.$house->getId().'" class="btn btn-default">Подробнее</a></div>';

        print '</div>';
    }

    /**
     * @param House $house
     */
    public function printHouseDescription($house) {
        print '<div class="content_text">';

        $type = $house->getType();
        if (isset($type)) {
            print '<p><b>Тип объявления: </b> ';
            if ($type == 1) {
                print 'Продажа';
            } else if ($type == 2) {
                print 'Аренда';
            }
            print '</p>';
        }

        $country = $house->getCountry();
        if (isset($country)) {
            print '<p><b>Страна: </b>'.$country->getName().'</p>';
        }

        $city = $house->getCity();
        if (isset($city)) {
            print '<p><b>Город: </b>'.$city->getName().'</p>';
        }

        $house_type = $house->getHouseType();
        if (isset($house_type)) {
            print '<p><b>Тип помещения: </b>'.$house_type->getName().'</p>';
        }

        $cost = $house->getCost();
        if (isset($cost)) {
            print '<p><b>Стоимость: </b>'.$cost.'$</p>';
        }

        $square = $house->getSquare();
        if (isset($square)) {
            print '<p><b>Площадь: </b>'.$square.'м<sup>2</sup></p>';
        }

        $to_sea = $house->getToSea();
        if (isset($to_sea)) {
            print '<p><b>Удаленность от моря: </b>'.$to_sea.'м</p>';
        }

        $room_number = $house->getRoomNumber();
        if (isset($room_number)) {
            print '<p><b>Количество спален: </b>'.$room_number.'</p>';
        }

        $floor = $house->getFloor();
        if (isset($room_number)) {
            print '<p><b>Этаж: </b>'.$floor.'</p>';
        }

        $floor_number = $house->getFloorNumber();
        if (isset($room_number)) {
            print '<p><b>Количество этажей: </b>'.$floor_number.'</p>';
        }

        $parking = $house->getParking();
        if (isset($parking) && $parking == true) {
            print '<p><b>Парковка</b></p>';
        }

        $swimming_pool = $house->getSwimmingPool();
        if (isset($swimming_pool) && $swimming_pool == true) {
            print '<p><b>Бассейн</b></p>';
        }

        $furniture = $house->getFurniture();
        if (isset($furniture) && $furniture == true) {
            print '<p><b>Мебель</b></p>';
        }

        $kitchen = $house->getKitchen();
        if (isset($kitchen) && $kitchen == true) {
            print '<p><b>Встроенная кухня</b></p>';
        }

        $sport = $house->getSport();
        if (isset($sport) && $sport == true) {
            print '<p><b>Спортивный зал</b></p>';
        }

        $bath = $house->getBath();
        if (isset($bath) && $bath == true) {
            print '<p><b>Банный комплекс</b></p>';
        }

        $appliances = "";

        $washer = $house->getWasher();
        if (isset($washer) && $washer == true) {
            if ($appliances != "") {
                $appliances .= ', ';
            }
            $appliances .= "стиральная машина";
        }

        $refrigerator = $house->getRefrigerator();
        if (isset($refrigerator) && $refrigerator == true) {
            if ($appliances != "") {
                $appliances .= ', ';
            }
            $appliances .= "холодильник";
        }

        $kitchen_range = $house->getKitchenRange();
        if (isset($kitchen_range) && $kitchen_range == true) {
            if ($appliances != "") {
                $appliances .= ', ';
            }
            $appliances .= "кухонная плита";
        }

        $microwave = $house->getMicrowave();
        if (isset($microwave) && $microwave == true) {
            if ($appliances != "") {
                $appliances .= ', ';
            }
            $appliances .= "микроволновая печь";
        }

        if ($appliances != "") {
            print '<p><b>Бытовая техника: </b>'.$appliances.'</p>';
        }


        $description = $house->getShortDescription();
        if (isset($description)) {
            print '<p><b>Описание: </b></p><p>'.$description.'</p>';
        }

        $description = $house->getDescription();
        if (isset($description)) {
            print '<p><b>Описание: </b></p><p>'.$description.'</p>';
        }

        print '</div>';
    }

    public function buildMenu() {
        print '<ul class="nav navbar-nav menu">';
        $active = "";
        if ($this->active_menu == 1) {
            $active = "menu_active";
        }
        print '<li class="'.$active.'"><a href="/">ГЛАВНАЯ</a></li>';
        $active = "";
        if ($this->active_menu == 2) {
            $active = "menu_active";
        }
        print '<li class="'.$active.'"><a href="/houses.php">КАТАЛОГ</a></li>';
        $active = "";
        if ($this->active_menu == 3) {
            $active = "menu_active";
        }
        print '<li class="'.$active.'"><a href="/service.php">УСЛУГИ</a></li>';
        $active = "";
        if ($this->active_menu == 4) {
            $active = "menu_active";
        }
        print '<li class="'.$active.'"><a href="/texts.php">СПРАВОЧНЫЕ МАТЕРИАЛЫ</a></li>';
        $active = "";
        if ($this->active_menu == 5) {
            $active = "menu_active";
        }
        print '<li class="'.$active.'"><a href="/contact.php">КОНТАКТЫ</a></li>';
        print '</ul>';
    }

    public function buildSearchMenu() {
        $countrys = $this->dao->getCountrys();

        print '<p><select id="inputCountry" class="combobox">';
        print '<option value="0" selected>Страна</option>';
        foreach($countrys as $country) {
            print '<option value="'.$country->getId().'">'.$country->getName().'</option>';
        }
        print '</select></p>';

        print '<p><select id="inputCity" class="combobox">';
        print '<option value="0" selected>Город</option>';
        foreach($countrys as $country) {
            $citys = $country->getCitys();
            foreach($citys as $city){
                print '<option value="'.$city->getId().'">'.$city->getName().'</option>';
            }
        }

        print '</select></p>';

        print '<script> var countrys = { ';

        $j = 0;
        foreach($countrys as $country) {
            $citys = $country->getCitys();
            print $country->getId().": { ";
            $i = 0;
            foreach($citys as $city){
                if ($i == count($citys) - 1) {
                    print $city->getId().': "'.$city->getName().'"';
                } else {
                    print $city->getId().': "'.$city->getName().'",';
                }
                $i++;
            }
            if ($j == count($countrys) - 1) {
                print " }, ";
            } else {
                print " }, ";
            }
            $j++;
        }

        print ' } </script>';

        print '<p><select id="inputType" class="combobox">';
        print '<option value="0" selected>Тип объявления</option>';
        print '<option value="1">Продажа</option>';
        print '<option value="2">Аренда</option>';
        print '</select></p>';

        print '<p><select id="inputHouseType" class="combobox">';
        print '<option value="0" selected>Тип недвижимости</option>';

        $house_types = $this->dao->getHouseTypes();

        foreach($house_types as $house_type) {
            print '<option value="' . $house_type->getId() . '">' . $house_type->getName() . '</option>';
        }
        print '</select></p>';

        print '<p>Стоимость</p>';
        print '<p>От <input id="inputCostMin" type="text" class="search_menu_input" value="0"/>';
        print ' До <input id="inputCostMax" type="text"  class="search_menu_input" value="0"/></p>';

        print '<p>Количество спален</p>';
        print '<p>От <input id="inputRoomMin" type="text" class="search_menu_input" value="0"/>';
        print ' До <input id="inputRoomMax" type="text"  class="search_menu_input" value="0"/></p>';

        print '<p>Количество этажей</p>';
        print '<p>От <input id="inputFloorMin" type="text" class="search_menu_input" value="0"/>';
        print ' До <input id="inputFloorMax" type="text"  class="search_menu_input" value="0"/></p>';

        print '<p><input id="inputParking" type="checkbox" /> Парковка</p>';
        print '<p><input id="inputSwimmingPool" type="checkbox" /> Бассейн</p>';
        print '<p><input id="inputFurniture" type="checkbox" /> Мебель</p>';
        print '<p><input id="inputKitchen" type="checkbox" /> Встроенная кухная</p>';
        print '<p><input id="inputSport" type="checkbox" /> Спортивный зал</p>';
        print '<p><input id="inputBath" type="checkbox" /> Банный комплекс</p>';
        print '<p><input id="inputWasher" type="checkbox" /> Стиральная машина</p>';
        print '<p><input id="inputRefrigerator" type="checkbox" /> Холодильник</p>';
        print '<div class="button_left">';
        print '<button id="btnSearch" type="button" class="btn btn-default">Найти</button>';
        print '</div>';

    }

    public function buildTextList() {
        $count = count($this->texts);
        for($i = 0; $i < $count; $i++) {
            $this->printTextInList($this->texts[$i]);
            if ($i != $count - 1 ) {
                $this->printSeparator();
            }
        }
    }

    private function printTextInList($text) {
        print '<div class="content_title"><b>'.$text->getTitle().'</b></div>';

        print '<div class="content_body">';

        print $text->getShortText();

        print '<div class="button_left"><a type="button" href="/text.php?id='.$text->getId().'" class="btn btn-default">Подробнее</a></div>';

        print '</div>';
    }

    private function printText($text) {
        print '<div class="content_title"><b>'.$text->getTitle().'</b></div>';

        print '<div class="content_body">';

        print $text->getText();

        $link = $text->getLink();
        if (isset($link)) {
            print '<br/><p><a href="'.$link.'"><b>Ссылка на оригинал</b></a></p>';
        }

        print '</div>';
    }

    private function printPage($page_number) {
        if ($page_number == $this->active_page) {
            print '<li class="active"><a href="'.$this->page_generate.$page_number.'">'.$page_number.'</a></li>';
        } else {
            print '<li><a href="'.$this->page_generate.$page_number.'">'.$page_number.'</a></li>';
        }
    }

    private function printHellip() {
        print '<li class="disabled"><a href="#">&hellip;</a></li>';
    }

    private function printSeparator() {
        print '<div class="separator" ></div>';
    }
} 