create database d04k15_project1;
use d04k15_project1;
create table admins (
id int primary key auto_increment,
name varchar(30) not null,
email varchar(255) not null unique,
password varchar(50) not null
);

create table customers(
id int primary key auto_increment,
name varchar(30),
email varchar(255) not null unique,
password varchar(50) not null,
phone varchar(10),
address varchar(200)
);

create table product_types(
id int primary key auto_increment,
name varchar(30),
description varchar(100)
);

create table products (
id int primary key auto_increment,
product_code varchar(20),
name varchar(100),
buy_price int,
type_id int,
description varchar(500),
image varchar(1000),
foreign key (type_id) references product_types(id)
);
create table orders(
id int primary key auto_increment,
customer_id int,
admin_id int,
total_price int,
order_date date,
status tinyint,
foreign key (customer_id) references customers(id),
foreign key (admin_id) references admins(id)
);
create table order_details(
id int primary key auto_increment,
order_id int,
product_id int,
price int,
quantity int,
foreign key (order_id) references orders(id),
foreign key (product_id) references products(id)
);

-- 0:chua duyet 1:da duyet -1:da huy, 2:thanh cong