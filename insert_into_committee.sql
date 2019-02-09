#Committee inserts
Insert Into `committee_members` values ("Michael", "Krakovsky", 1);
Insert Into `committee_members` values ("Andrew", "Greb", 2);
Insert Into `committee_members` values ("Matthew", "Nat", 3);
Insert Into `committee_members` values ("John", "Krack", 4);
Insert Into `committee_members` values ("Chris", "Wallace", 5);
Insert Into `committee_members` values ("Two", "Pac", 6);
Insert Into `committee_members` values ("Tom", "Brady", 7);
Insert Into `committee_members` values ("Michael", "Jordan", 8);
Insert Into `committee_members` values ("Michael", "Shue", 9);
Insert Into `committee_members` values ("The nameless", "The nameless", 10);

#Committee List
Insert into `committee_list` values ("AI Committee", 3);
Insert into `committee_list` values ("The Goat Communitte", 7);
Insert into `committee_list` values ("Stellar", 1);
Insert into `committee_list` values ("SuperBowl Committee", 7);

#Membership inserts
Insert into `membership` values ("The Goat Communitte", 2);
Insert into `membership` values ("Stellar", 3);
Insert into `membership` values ("SuperBowl Committee", 1);
Insert into `membership` values ("The Goat Communitte", 1);
Insert into `membership` values ("The Goat Communitte", 10);
Insert into `membership` values ("Stellar", 9);
Insert into `membership` values ("SuperBowl Committee", 5);
Insert into `membership` values ("The Goat Communitte", 5);
Insert into `membership` values ("AI Committee", 3);
Insert into `membership` values ("The Goat Communitte", 7);
Insert into `membership` values ("Stellar", 1);
Insert into `membership` values ("SuperBowl Committee", 7);
Insert into `membership` values ("The Goat Communitte", 6);
Insert into `membership` values ("Stellar", 4);
Insert into `membership` values ("SuperBowl Committee", 4);

# Hotel Room
insert into HotelRoom values ("205A", 2);
insert into HotelRoom values ("212A", 2);

# Students
insert into Students values (123123, "Dude 1", "nooooooo", "205A");
insert into Students values (124324, "Dude 2", "another", "205A");
insert into Students values (123421, "Person 2", "last", "205A");
insert into Students values (1234243, "Girl 1", "meee", "205A");
insert into Students values (1309342, "Girl 31", "andi", "212A");
insert into Students values (18765, "Damn 31", "andi", "212A");

# Session
insert into `Session` values ('2019-02-08 12:00:00', '2019-02-08 12:30:00', "Big Room", "Learn", 123456);
insert into `Session` values ('2019-02-08 13:00:00', '2019-02-08 13:30:00', "Small Room", "Learn more", 98456);
insert into `Session` values ('2019-02-09 16:00:00', '2019-02-08 16:30:00', "Big Room", "Closing", 743456);

# Student_Session_Schedule
insert into Student_Session_Schedule values (123123, 743456);
insert into Student_Session_Schedule values (18765, 743456);

insert into Student_Session_Schedule values (18765, 98456);
insert into Student_Session_Schedule values (123421, 98456);
insert into Student_Session_Schedule values (123421, 123456);
insert into Student_Session_Schedule values (1309342, 123456);

#Sponsors
insert into Sponsors values ("Platinum", 3, 35345, "The company");
insert into Sponsors values ("Gold", 4, 92348, "Dominate");
insert into Sponsors values ("Silver", 1, 1293, "Goat");
insert into Sponsors values ("Bronze", 2, 7534, "Sacrafice");

# Job Adds
insert into JobAdds values (35345, "Manager", "To", 23);
insert into JobAdds values (92348, "Clegery", "Atl", 53);
insert into JobAdds values (92348, "CEO", "LA", 67);
insert into JobAdds values (7534, "CFO", "por", 65);

#Sponsor Attendee
insert into Sponsor_Attendee values (2000, 35345, "Tony", "TheTiger");
insert into Sponsor_Attendee values (2001, 92348, "Rudolph", "TheRedNosedReindeer");
insert into Sponsor_Attendee values (2002, 1293, "Bob", "TheBuilder");
insert into Sponsor_Attendee values (2003, 7534, "Margarita", "Lamborghini");

#Sponsor Session Schedule
insert into Sponsor_Session_Schedule values (2000, 123456);
insert into Sponsor_Session_Schedule values (2001, 123456);
insert into Sponsor_Session_Schedule values (2002, 98456);
insert into Sponsor_Session_Schedule values (2003, 743456);

#Speakers
insert into Speakers values ("Wendy","Powley", 4000);
insert into Speakers values ("Michael","Krakovspee", 4001);
insert into Speakers values ("Matt","RoccoNicNicastro", 4002);

#SpeakersAttendees
insert into Speaker_Session_Schedule values (4000, 123456);
insert into Speaker_Session_Schedule values (4001, 98456);
insert into Speaker_Session_Schedule values (4002, 743456);

#Professionals
insert into Professionals values (30000, "Terry", "Larry");

#Professional Session Schedule
insert into Professional_Session_Schedule values (30000, 123456);

