drop database if exists bank;
create database bank;
use bank;

drop table if exists accounts;
drop table if exists transactions;
drop table if exists transaction_types;
drop table if exists account_types;
drop table if exists branch_types;
drop table if exists customers;
drop table if exists addresses;

create table addresses (
  id int not null primary key auto_increment,
  line1 varchar(100),
  line2 varchar(100),
  city varchar(100),
  state varchar(20),
  zip varchar(11),
  country varchar(50)
);

create table branch_types (
  type_code int not null primary key auto_increment,
  type_description varchar(50) unique
);

create table branches (
  id int not null primary key auto_increment,
  address_id int,
  branch_type_code int,
  foreign key (address_id) references addresses (id),
  foreign key (branch_type_code) references branch_types (type_code)
);

create table customers (
  id int not null primary key auto_increment,
  branch_id int,
  address_id int,
  foreign key (branch_id) references branches (id),
  foreign key (address_id) references addresses (id),
  gender varchar(1),
  phone varchar(10)
);

create table account_types (
  type_code int not null primary key auto_increment,
  type_description varchar(50) unique
);

create table accounts (
  id int not null primary key auto_increment,
  customer_id int,
  account_type_code int,
  foreign key (customer_id) references customers (id),
  foreign key (account_type_code) references account_types (type_code),
  current_balance decimal
);

create table transaction_types (
  type_code int not null primary key auto_increment,
  type_description varchar(50) UNIQUE
);

create table transactions (
  id int not null primary key auto_increment,
  account_id int,
  transaction_type_code int,
  foreign key (account_id) references accounts (id),
  foreign key (transaction_type_code) references transaction_types (type_code),
  transaction_amount decimal,
  transaction_date timestamp
);