create database library;
use library;
create table Patron
(
CardNo int(9) primary key,
FName varchar(255),
LName varchar(255),
Email varchar(255),
Address varchar(255),
City varchar(255),
PCode varchar(255),
CrdExp date,
Accnt_Type varchar(255) not null,
Password varchar(20) not null
);
create table Branch
(
BranchNo int(3) primary key,
BranchName varchar(255),
PhoneNo int(10),
Address varchar(255),
City varchar(255),
PCode varchar(255),
ManagerSIN int(9)
);
create table Staff
(
SIN int(9) primary key,
FName varchar(255),
LName varchar(255),
Email varchar(255),
Address varchar(255),
City varchar(255),
PCode varchar(255),
Wage int(255),
Position varchar(255),
BranchNo int(3),
SuperSIN int(9),
Password varchar(20) not null,
foreign key (BranchNo) references Branch(BranchNo),
foreign key (SuperSIN) references Staff(SIN)
);

alter table Branch
add constraint foreign key (ManagerSIN) references Staff(SIN);

create table Lib_event
(
EventName varchar(255) primary key,
EDate datetime,
Description text,
BranchNum int(3),
foreign key (BranchNum) references Branch(BranchNo)
);
create table Book
(
Barcode int(10) primary key,
ISBN int(13),
CallNo varchar(255),
Title varchar(255) not null,
Summary text,
BranchNum int(3),
foreign key (BranchNum) references Branch(BranchNo)
);
create table Journal
(
JBookNo int(10) primary key,
Institution varchar(255),
foreign key (JBookNo) references Book(Barcode)
);
create table Audio_Book
(
ABookNo int(10) primary key,
Narrator varchar(255),
length time,
foreign key (ABookNo) references Book(Barcode)
);
create table Author
(
AuthorID int(10) primary key,
FName varchar(255),
LName varchar(255)
);
create table Publisher
(
PublisherName varchar(255) primary key
);
create table Publisher_Books
(
PublisherName varchar(255),
BookNo int(10),
foreign key (BookNo) references Book(Barcode),
foreign key (PublisherName) references Publisher(PublisherName),
constraint Publisher_PK primary key(PublisherName, BookNo)
);
create table Author_Books
(
AuthorID int(10),
BookNo int(10),
foreign key (BookNo) references Book(Barcode),
foreign key (AuthorID) references Author(AuthorID),
constraint Author_Books_PK primary key (AuthorID, BookNo)
);
create table Book_Holds
(
BookNo int(10),
PatronNo int(9),
foreign key (BookNo) references Book(Barcode),
foreign key (PatronNo) references Patron(CardNo),
constraint Book_Holds_PK primary key (BookNo, PatronNo)
);
create table Borrows
(
BookNo int(10),
PatronNo int(9),
ReturnDate date,
DueDate date,
foreign key (BookNo) references Book(Barcode),
foreign key (PatronNo) references Patron(CardNo),
constraint Book_History_PK primary key (BookNo, PatronNo)
);
create table Book_Ratings
(
BookNo int(10),
PatronNo int(9),
rating int(1) not null,
foreign key (BookNo) references Book(Barcode),
foreign key (PatronNo) references Patron(CardNo),
constraint Book_Ratings_PK primary key (BookNo, PatronNo)
);
create table Event_Staff
(
EName varchar(255),
Staff int(9),
foreign key (EName) references Lib_event(EventName),
foreign key (Staff) references Staff(SIN),
constraint Event_Staff_PK primary key (EName, Staff)
);
create table Event_Attendance
(
EventName varchar(255),
PatronNo int(9),
foreign key (EventName) references Lib_event(EventName),
foreign key (PatronNo) references Patron(CardNo),
constraint Event_Attnd_PK primary key (EventName, PatronNo)
);
create table Payments
(
BranchNo int(3),
PatronNo int(9),
PaymentDate date not null,
Amount float(4) not null,
PaymentType varchar(255) not null,
foreign key (PatronNo) references Patron(CardNo),
foreign key (BranchNo) references Branch(BranchNo),
constraint Payments_PK primary key (BranchNo, PatronNo)
);
create table Genre
(
Genre varchar(255),
BookNo int(10),
foreign key (BookNo) references Book(Barcode),
constraint Genre_PK primary key (Genre, BookNo)
);
create table Patron_PhoneNo
(
PhoneNo int(10),
PatronNo int(9),
foreign key (PatronNo) references Patron(CardNo),
constraint Phone_No_PK primary key (PhoneNo, PatronNo)
);
create table Staff_PhoneNo
(
PhoneNo int(10),
SIN int(9),
foreign key (SIN) references Staff(SIN),
constraint Phone_No_PK primary key (PhoneNo, SIN)
);