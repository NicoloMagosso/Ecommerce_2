create database if not exists nicolo_magosso_ecommerce;
create table if not exists nicolo_magosso_ecommerce.products
(
    id int not null auto_increment primary key,
    nome varchar(50),
    prezzo float,
    marca varchar(50)
    );
insert into nicolo_magosso_ecommerce.products(nome, prezzo, marca)
values ('RossiPhone', 299.99, 'Rossi SRL'),
       ('Lanzichenecchi', 599.99, 'HRE'),
       ('Manuel Cecchetto', 5.99, 'Villadose'),
       ('PC', 459.99, 'Henry&Ale');