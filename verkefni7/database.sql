CREATE TABLE `users` (
  `id` int(10) not null auto_increment PRIMARY KEY,
  `nafn` varchar(20)NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL
);
create table images 
(
  id int not null auto_increment PRIMARY KEY,
  image_name varchar(45) not null,
  image_path varchar(25) not null,
  image_text varchar(120) default null
);
insert into images(id,image_name,image_path)
values(1,'Kisa','kisa.jpg');

insert into images(id,image_name,image_path)
values(1,'Gullfiskur','gulli.jpg');