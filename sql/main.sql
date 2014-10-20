drop table house_types;
drop table citys;
drop table sys_texts;
drop table texts;
drop table houses;
drop table images;
create table house_types(
    id int(11) AUTO_INCREMENT,
    name varchar(512) NOT NULL,
    PRIMARY KEY(id)
);
create table countrys(
  id int(11) AUTO_INCREMENT,
  name varchar(512) NOT NULL,
  PRIMARY KEY(id)
);
create table citys(
    id int(11) AUTO_INCREMENT,
    name varchar(512) NOT NULL,
    id_country int(11) NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(id_country) REFERENCES countrys(id)
);
create table sys_texts(
  id int(11) AUTO_INCREMENT,
  title varchar(256),
  text text NOT NULL,
  meta_tag varchar(1024),
  PRIMARY KEY(id)
);
create table texts(
  id int(11) AUTO_INCREMENT,
  title varchar(256),
  short_text varchar(2048),
  text text NOT NULL,
  meta_tag varchar(1024),
  category int(11) NOT NULL,
  link varchar(512),
  PRIMARY KEY(id)
);
create table houses(
  id int(11) AUTO_INCREMENT,
  title VARCHAR(256),
  meta_tag varchar(1024),
  short_description varchar(2048),
  description text,
  id_city int(11) NOT NULL,
  id_house_type int(11) NOT NULL,
  type int(1) NOT NULL,
  cost int(11) NOT NULL,
  square int(11),
  to_sea int(11),
  room_number int(2),
  floor_number int(2),
  floor int(2),
  swimming_pool int(1),
  parking int(1),
  furniture int(1),
  washer int(1),
  refrigerator int(1),
  kitchen_range int(1),
  microwave int(1),
  map text,
  PRIMARY KEY(id),
  FOREIGN KEY(id_city) REFERENCES citys(id),
  FOREIGN KEY(id_house_type) REFERENCES house_types(id)
);
create table images(
  id int(11) AUTO_INCREMENT,
  url varchar(512) NOT NULL,
  description VARCHAR(2048),
  id_house int(11),
  PRIMARY KEY(id),
  FOREIGN KEY(id_house) REFERENCES houses(id)
);