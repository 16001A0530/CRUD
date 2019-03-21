CREATE DATABASE StudentDetails;
USE StudentDetails;
CREATE TABLE Details (
    RollNumber CHAR(10) NOT NULL UNIQUE,
    StudentName VARCHAR(30) NOT NULL,
    Email VARCHAR(30) NOT NULL,
    PhoneNo VARCHAR(15) NOT NULL
);
