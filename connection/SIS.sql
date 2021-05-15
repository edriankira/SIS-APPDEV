Create database SISAPPDEV;
user SISAPPDEV;


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

)

INSERT INTO `images` (`id`, `title`, `description`, `path`, `uploaded_date`) VALUES
(1, 'hotdog', 'hotdog', 'images/hotdog.jpg', '2021-05-13 01:18:18'),
(12, 'bcp', 'bp', 'gallery/bcp7.jpg', '2021-05-13 19:59:57'),
(13, 'bcp', 'bcp', 'gallery/bcp3.jpg', '2021-05-13 20:01:11'),
(14, 'ga', 'fas', 'gallery/bcp2.jpg', '2021-05-13 20:01:28'),
(15, 'clinic', 'clinic', 'gallery/clinic.jpg', '2021-05-13 20:02:18');

ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

