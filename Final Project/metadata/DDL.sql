INSERT INTO PROFESSOR
VALUES(PSSN, PROF, Street, City, State, Zip, Area_Code, PTELEPHONE, Sex, Title, Salary);
/* add more */

INSERT INTO CDEGREES
VALUES((SELECT PSSN from PROFESSOR WHERE PSSN = C.SSN), Degree);
/* add more */

INSERT INTO DEPARTMENT
VALUES(DNUM, DNAME, DTELEPHONE, DADDRESS, (SELECT PSSN from PROFESSOR WHERE PSSN = D.SSN));
/* add more */

INSERT INTO COURSE
VALUES(CNUM, CNAME, Textbook, Units, (select DNUM from DEPARTMENT where DNAME = CD.NAME), PREQS);
/* add more */

INSERT INTO SECTION
VALUES(ID, (select CNUM from COURSE where CNAME = CSNUM), Classroom, Seats, Days, Start_Time, End_Time, (SELECT PSSN from PROFESSOR WHERE PNAME = S.SSN), YEAR, SEMESTER);
/* add more */

INSERT INTO STUDENT
VALUES(CWID, First_Name, Last_Name, Street, City, State, Zip, STELEPHONE, (select DNUM from DEPARTMENT where DNAME = SD.NAME), Minor);
/* add more */

INSERT INTO ENROLL
VALUES((select CWID from STUDENT where FNAME = EF.NAME and LNAME = EL.NAME), (select ID from SECTION where ID = E.ID), (select CSNUM from SECTION where ID = E.ID), Grade, (select YEAR from SECTION where ID = E.ID), (select SEMESTER from SECTION where ID = E.ID));
/* add more */
