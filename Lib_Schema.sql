create database Library;
use Library;

create table Patron
(

Card_No	int(8) Primary key,
FName	varchar(255),
LName	varchar(255),
Email	varchar(255),
Address	varchar(255),
city	varchar(255),
Pcode	varchar(255),
CrdExp	date not null,
Accnt_Type	varchar(255) not null

);

create table Staff
(

SIN	int(9) Primary Key,
FName	varchar(255),
LName	varchar(255),
Email	varchar(255),
Address	varchar(255),
city	varchar(255),
Pcode	varchar(255),
Wage	int(255),
Position	varchar(255),
SuperSIN int(9),
foreign key (SuperSIN) references Staff(SIN)

);

create table Branch
(

BranchNo	int(3) Primary Key,
BranchName	varchar(255),
PhoneNo		int(10),
Address		varchar(255),
ManagerSIN	int(9),
foreign key	(ManagerSIN) references Staff(SIN)

);


create table Lib_event
(

EventName	varchar(255),
EDate		datetime,
Description	text,
BranchNum	int(3),
foreign key (BranchNum) references Branch(BranchNo)

);

create table Book
(

BookNo	int(10) primary key,
ISBN	int(13),
CallNo	varchar(255),
Title	varchar(255),
Summary	text,
PatronNo	int(8),
foreign key (PatronNo) references Patron(CardNo),
DueDate	date,
BranchNum	int(3),
foreign key (BranchNum) references Branch(BranchNo)

);


create table Journal
(

JBookNo	int(10) primary key,
foreign key (JBookNo) references Book(BookNo),
Institution	varchar(255)

);


create table Audio_Book
(

ABookNo	int(10) primary key,
foreign key (ABookNo) references Book(BookNo),
Narrator	varchar(255),
length	time

);


create table Author
(

Fname	varchar(255),
MName	varchar(255),
LName	varchar(255)

);


create table Publisher
(
PublisherName	varchar(255) primary key
);


create table Publisher_Books
(

PublisherName	varchar(255),
foreign key (PublisherName) references Publisher(PublisherName),
BookNo	int(10),
foreign key (BookNo) references Book(BookNo),
constraint Publisher_PK primary key(PublisherName, BookNo)

);


create table Author_Books
(

Fname	varchar(255),
MName	varchar(255),
LName	varchar(255),
BookNo	int(10),
foreign key (BookNo) references Book(BookNo)

);


create table Book_Holds
(

BookNo	int(10),
foreign key (BookNo) references Book(BookNo),
PatronNo	int(8),
foreign key (PatronNo) references Patron(CardNo)

);


create table Book_History
(

BookNo	int(10),
foreign key (BookNo) references Book(BookNo),
PatronNo	int(8),
foreign key (PatronNo) references Patron(CardNo),
ReturnDate	date

);


create table Book_Ratings
(

BookNo	int(10),
foreign key (BookNo) references Book(BookNo),
PatronNo	int(8),
foreign key (PatronNo) references Patron(CardNo),
rating	int(1)

);


create table Event_Staff
(

Fname	varchar(255)

);


create table Event_Attendance
(

Fname	varchar(255)

);


create table Payments
(

Fname	varchar(255)

);


create table Genre
(

Fname	varchar(255)

);


create table Phone_No
(

Fname	varchar(255)

);


create table M_Name
(

Fname	varchar(255)

);

