create database Library;
use Library;

create table Patron
(

Card_No         int(8)          primary key,
FName           varchar(255),
LName           varchar(255),
Email           varchar(255),
Address         varchar(255),
city            varchar(255),
Pcode           varchar(255),
CrdExp          date            not null,
Accnt_Type	varchar(255)    not null,
Password        varchar(20)     not null

);

create table Staff
(

SIN             int(9)          primary key,
FName           varchar(255),
LName           varchar(255),
Email           varchar(255),
Address         varchar(255),
city            varchar(255),
Pcode           varchar(255),
Wage            int(255),
Position	varchar(255),
SuperSIN        int(9),
Password        varchar(20)     not null
foreign key     (SuperSIN)      references Staff(SIN)

);

create table Branch
(

BranchNo	int(3)          primary key,
BranchName	varchar(255),
PhoneNo		int(10),
Address		varchar(255),
ManagerSIN	int(9),
foreign key	(ManagerSIN)    references Staff(SIN)

);


create table Lib_event
(

EventName	varchar(255),
EDate		datetime,
Description	text,
BranchNum	int(3),
foreign key     (BranchNum)     references Branch(BranchNo)

);

create table Book
(

BookNo          int(10)         primary key,
ISBN            int(13),
CallNo          varchar(255),
Title           varchar(255)    not null,
Summary         text,
PatronNo	int(8),
DueDate         date,
BranchNum	int(3),
foreign key     (PatronNo)      references Patron(CardNo),
foreign key     (BranchNum)     references Branch(BranchNo)

);


create table Journal
(

JBookNo         int(10)         primary key,
Institution	varchar(255),
foreign key     (JBookNo)       references Book(BookNo),

);


create table Audio_Book
(

ABookNo         int(10)         primary key,
Narrator	varchar(255),
length          time
foreign key     (ABookNo)       references Book(BookNo),

);


create table Author
(

FName           varchar(255),
MName           varchar(255),
LName           varchar(255),
constraint      Author_PK       primary key (FName, MName, LName)

);


create table Publisher
(

PublisherName	varchar(255)    primary key

);


create table Publisher_Books
(

PublisherName	varchar(255),
BookNo          int(10),
foreign key     (BookNo)        references Book(BookNo),
foreign key     (PublisherName) references Publisher(PublisherName),
constraint      Publisher_PK    primary key(PublisherName, BookNo)

);


create table Author_Books
(

FName           varchar(255),
MName           varchar(255),
LName           varchar(255),
BookNo          int(10),
foreign         key (BookNo)                references Book(BookNo),
foreign         key (FName, MName, LName)   references Author(FName, MName, LName),
constraint      Author_Books_PK             primary key (FName, MName, LName,BookNo)

);


create table Book_Holds
(

BookNo          int(10),
PatronNo	int(8),
Queue           int(3)          not null,
foreign key     (BookNo)        references Book(BookNo),
foreign key     (PatronNo)      references Patron(CardNo),
constraint      Book_Holds_PK   primary key (BookNo, PatronNo)

);


create table Book_History
(

BookNo          int(10),
PatronNo	int(8),
ReturnDate	date            not null,
foreign key     (BookNo)        references Book(BookNo),
foreign key     (PatronNo)      references Patron(CardNo),
constraint      Book_History_PK primary key (BookNo, CardNo)

);


create table Book_Ratings
(

BookNo          int(10),
PatronNo	int(8),
rating          int(1)          not null
foreign key     (BookNo)        references Book(BookNo),
foreign key     (PatronNo)      references Patron(CardNo),
constraint      Book_Ratings_PK primary key (BookNo, PatronNo)

);


create table Event_Staff
(

EventName       varchar(255),
SIN             int(9),
foreign key     (EventName)     references Lib_event(EventName),
foreign key     (SIN)           references Staff(SIN),
constraint      Event_Staff_PK  primary key (EventName, SIN)

);


create table Event_Attendance
(

EventName       varchar(255),
PatronNo        int(8),
foreign key     (EventName)     references Lib_event(EventName),
foreign key     (PatronNo)      references Patron(CardNo),
constraint      Event_Attnd_PK  primary key (EventName, PatronNo)

);


create table Payments
(


SIN             int(9),
PatronNo        int(8),
PaymentDate     date            not null,
Amount          float(4)        not null,
PaymentType     varchar(255)    not null,
foreign key     (PatronNo)      references Patron(CardNo),
foreign key     (SIN)           references Staff(SIN),
constraint      Payments_PK     primary key (SIN, PatronNo)

);


create table Genre
(

Genre           varchar(255),
BookNo          int(10),
foreign key     (BookNo)        references Book(BookNo),
constraint      Genre_PK        primary key (Genre, BookNo)

);


create table Phone_No
(

PhoneNo         int(10),
PatronNo        int(8),
foreign key     (PatronNo)      references Patron(CardNo),
constraing      Phone_No_PK     primary key (PhoneNo, PatronNo)

);
