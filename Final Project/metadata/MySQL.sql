CREATE TABLE PROFESSOR(
	PSSN numeric(9) PRIMARY KEY NOT NULL,
	PNAME varchar(40) NOT NULL,
	PADDRESS varchar(20) NOT NULL,
	PCITY varchar(20) NOT NULL,
	PSTATE char(2) NOT NULL,
	PZIP char(5) NOT NULL,
	AREACODE numeric(3) NOT NULL,
	PTELEPHONE numeric(7) NOT NULL,
	SEX enum('M', 'F') NOT NULL,
	TITLE char(20) NOT NULL,
	SALARY numeric(65) NOT NULL
);

CREATE TABLE CDEGREES(
	PC_SSN numeric(9) NOT NULL,
	CDEGREES char(65) NOT NULL,
	PRIMARY KEY (PC_SSN, CDEGREES),
	FOREIGN KEY (PC_SSN) REFERENCES PROFESSOR(PSSN)
);

CREATE TABLE DEPARTMENT(
	NUMBER numeric(9) PRIMARY KEY NOT NULL,
	NAME char(40) NOT NULL,
	PHONE numeric(10),
	OFFLOCATION varchar(20) NOT NULL,
	CHAIRPERSON numeric(9) NOT NULL,
	FOREIGN KEY (CHAIRPERSON) REFERENCES PROFESSOR(PSSN)
);

CREATE TABLE COURSE(
	CNUM numeric(10) PRIMARY KEY NOT NULL,
	CNAME varchar(30) NOT NULL,
	TEXTBOOK varchar(50),
	UNITS tinyint NOT NULL,
	CDEPT numeric(9) NOT NULL,
	PREQS varchar(30),
	FOREIGN KEY (CDEPT) REFERENCES DEPARTMENT(NUMBER)
);


CREATE TABLE SECTION(
	PRIMARY KEY (ID, CSNUM, YEARS, SEMESTER),
	ID numeric(3) NOT NULL,
	CSNUM numeric(10) NOT NULL,
	CLASSROOM varchar(10) NOT NULL,
	SEATS numeric(50) NOT NULL,
	DAYS char(10) NOT NULL,
	STIME numeric(4) NOT NULL,
	ETIME numeric(4) NOT NULL,
	PROF numeric(9) NOT NULL,
	YEARS numeric(4) NOT NULL,
	SEMESTER varchar(10) NOT NULL,
	FOREIGN KEY (CSNUM) REFERENCES COURSE(CNUM),
	FOREIGN KEY (PROF) REFERENCES PROFESSOR(PSSN)
);

CREATE TABLE STUDENT(
	CWID numeric(9) PRIMARY KEY NOT NULL,
	FNAME varchar(20) NOT NULL,
	LNAME varchar(20) NOT NULL,
	STADDRESS varchar(20) NOT NULL,
	SCITY varchar(20) NOT NULL,
	SSTATE char(2) NOT NULL,
	SZIPCODE char(5) NOT NULL,
	TELEPHONE numeric(10) NOT NULL,
	MAJOR numeric(9) NOT NULL,
	MINOR numeric(9),
	FOREIGN KEY (MAJOR) REFERENCES DEPARTMENT(NUMBER),
	FOREIGN KEY (MINOR) REFERENCES DEPARTMENT(NUMBER)
);

CREATE TABLE ENROLL(
	PRIMARY KEY (STDNT, SSECTION, CSECTION, EYEARS, ESEMESTER),
	STDNT numeric(9) NOT NULL,
	SSECTION numeric(3) NOT NULL,
	CSECTION numeric(10) NOT NULL,
	GRADE enum('A+', 'A-', 'A', 'B+', 'B', 'B-', 'C+', 'C', 'C-','D+', 'D', 'D-', 'F+', 'F', 'F-', 'W', 'IP') NOT NULL,
	EYEARS numeric(4) NOT NULL,
	ESEMESTER varchar(10) NOT NULL,
	FOREIGN KEY (STDNT) REFERENCES STUDENT(CWID),
	FOREIGN KEY (SSECTION, CSECTION, EYEARS, ESEMESTER) REFERENCES SECTION(ID, CSNUM, YEARS, SEMESTER)
);