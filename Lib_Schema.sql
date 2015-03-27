create database Library;
use Library;

create table Patron
(


);

create table Staff
(

Position	varchar(255),

);

create table Branch
(

BranchName	varchar(255),
PhoneNo		int(10),
Address		varchar(255),
ManagerSIN	int(9),

);


create table Lib_event
(

EventName	varchar(255),
EDate		datetime,
Description	text,
BranchNum	int(3),

);

create table Book
(

PatronNo	int(8),
BranchNum	int(3),

);


create table Journal
(


);


create table Audio_Book
(

Narrator	varchar(255),

);


create table Author
(


);


create table Publisher
(
);


create table Publisher_Books
(

PublisherName	varchar(255),

);


create table Author_Books
(


);


create table Book_Holds
(

PatronNo	int(8),

);


create table Book_History
(

PatronNo	int(8),

);


create table Book_Ratings
(

PatronNo	int(8),

);


create table Event_Staff
(


);


create table Event_Attendance
(


);


create table Payments
(


);


create table Genre
(


);


create table Phone_No
(


);


create table M_Name
(

Fname	varchar(255)

);
