create database msw;

use msw;

create table category
(
	categoryID int auto_increment primary key,
    categoryName varchar(30) not null unique
);

create table product
(
	productID varchar(10) not null primary key,
    productName varchar(50) not null,
    productPrice int not null,
    productImage varchar(20) null,
    productDetails varchar(500) null,
    categoryID int not null,
    constraint fk_catid foreign key (categoryID) 
                        references category(categoryID)    
);


insert into category (categoryName) values
('LG'), ('Samsung'), ('Apple'), ('HTC'), 
('Motorola'), ('Sony'), ('Nexus');

insert into product values
('P001', 'Checkered Floral Frame', 80, 'product01.jpg', 'Our best-selling Impact cases—the ones ... ', 3),
('P002', 'Butterfly Aurora', 82, 'product02.jpg', 'updating .... ', 3),
('P003', 'Aqua Smiley Transparent', 70, 'product03.jpg', 'updating .... ', 3),
('P004', 'House Slytherin Sticker Case', 75, 'product04.jpg', 'updating .... ', 2),
('P005', 'Stars Black', 78, 'product05.jpg', 'updating .... ', 2),
('P006', 'MY SUCCULENT GARDEN', 85, 'product06.jpg', 'updating .... ', 2),
('P007', 'Groovy Pattern Clear', 65, 'product07.jpg', 'updating .... ', 1),
('P008', 'House Slytherin Sticker Case', 55, 'product08.jpg', 'updating .... ', 1),
('P009', 'White Butterfly', 66, 'product09.jpg', 'updating .... ', 6),
('P010', 'Magic Mushrooms', 77, 'product10.jpg', 'updating .... ', 6);

select *from product;