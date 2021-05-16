Create database sisappdev;
use sisappdev;


CREATE TABLE adm_adminUser(

adm_AdminId INT NOT NULL  PRIMARY KEY AUTO_INCREMENT,
adm_adminUserNum int NOT NULL,
adm_fname VARCHAR(100) NOT NULL,
adm_lname VARCHAR(100) NOT NULL,
adm_mname VARCHAR(100),
adm_bday DATE NOT NULL,
adm_gender varchar(15) not null,
adm_email VARCHAR(100) NOT NULL UNIQUE,
adm_mobile VARCHAR(30) NOT NULL UNIQUE,
adm_address TEXT NOT NULL,
adm_username VARCHAR(100) NOT NULL UNIQUE,
adm_password VARCHAR(255) NOT NULL,
adm_admitCT TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
adm_status varchar(15) not null
);

CREATE TABLE adm_announcement(
adm_anID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
adm_anNum VARCHAR(100) NOT NULL,
adm_anCreator VARCHAR(50) NOT NULL,
adm_title TEXT NOT NULL,
adm_description TEXT NOT NULL,
adm_anTime_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
adm_anRole VARCHAR(40) NOT NULL
);

CREATE TABLE adm_events(
adm_evtID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
adm_evtNum VARCHAR(100) NOT NULL,
adm_evtCreator VARCHAR(50) NOT NULL,
adm_evtTitle TEXT NOT NULL, 
adm_evtDescription TEXT NOT NULL,
adm_evtRole VARCHAR(100) NOT NULL,
adm_evtTime_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE adm_listCourse(
adm_lcID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
adm_lcNum VARCHAR(100) NOT NULL,
adm_lcCourseT TEXT NOT NULL, 
adm_lcCourseD TEXT NOT NULL,
`adm_CourseTD` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()

);

CREATE TABLE `images` (
  `id` int(11) NOT NULL PRIMARY KEY;
  `title` text NOT NULL,
  `description` text NOT NULL,
  `path` text NOT NULL,
  `uploaded_date` datetime NOT NULL DEFAULT current_timestamp()

);

CREATE TABLE noun (
  `id` int(11) NOT NULL PRIMARY KEY;
  `notice` text not null,
  `date` datetime NOT NULL DEFAULT current_timestamp()

);

INSERT INTO `images` (`id`, `title`, `description`, `path`, `uploaded_date`) VALUES
(1, 'hotdog', 'hotdog', 'images/hotdog.jpg', '2021-05-13 01:18:18'),
(12, 'bcp', 'bp', 'gallery/bcp7.jpg', '2021-05-13 19:59:57'),
(13, 'bcp', 'bcp', 'gallery/bcp3.jpg', '2021-05-13 20:01:11'),
(14, 'ga', 'fas', 'gallery/bcp2.jpg', '2021-05-13 20:01:28'),
(15, 'clinic', 'clinic', 'gallery/clinic.jpg', '2021-05-13 20:02:18');

ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
  
  
CREATE TABLE `tbl_frontdesk_users` (
  `id` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `pwd` varchar(200) NOT NULL,
  `bdate` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `tbl_holidays` (
  `id` int(10) NOT NULL,
  `date` varchar(20) NOT NULL,
  `reason` varchar(100) NOT NULL,
  `bdate` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `tbl_holidays` (`id`, `date`, `reason`, `bdate`) VALUES
(5, '2021-05-17', 'pahingaaaa day!', '2021-05-15 01:38:38');


CREATE TABLE `tbl_reservations` (
  `id` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  `ucount` int(10) NOT NULL,
  `rdate` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  `comments` varchar(250) NOT NULL,
  `bdate` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `tbl_reservations` (`id`, `uid`, `ucount`, `rdate`, `status`, `comments`, `bdate`) VALUES
(9, 16, 20, '2021-05-16 06:00', 'DENIED', '', '2021-05-15 01:30:54'),
(10, 17, 10, '2021-05-22 18:30', 'APPROVED', '', '2021-05-15 02:24:44');


CREATE TABLE `tbl_users` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `pwd` varchar(200) NOT NULL,
  `address` varchar(250) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `type` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `bdate` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tbl_users` (`id`, `name`, `pwd`, `address`, `phone`, `email`, `type`, `status`, `bdate`) VALUES
(16, 'admin', '12345', 'Brgy Batasan', '09616230097', 'francis22ts@gmail.com', 'admin', 'active', '1999-22-12'),
(17, 'sirlee', '54321', 'Gwapo St brgy pogi', '091234566789', 'sirlee@mail.com', 'teacher', 'active', '2021-05-15 01:35:05'),
(18, 'Jeffyqt', 'S121212', 'kyut st brgy kyut', '09123455678', 'kyut@mail.com', 'student', 'active', '2021-05-15 01:37:09');


ALTER TABLE `tbl_frontdesk_users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tbl_holidays`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `tbl_reservations`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tbl_frontdesk_users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `tbl_holidays`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `tbl_reservations`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `tbl_users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
  

