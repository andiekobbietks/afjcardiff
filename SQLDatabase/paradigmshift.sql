CREATE TABLE home (
    home_id INT AUTO_INCREMENT PRIMARY KEY,
    memberuser_id INT(11) NOT NULL,
    session_id INT(11) NOT NULL,
    session_type VARCHAR(255) NOT NULL,
    expected_startdatetime DATETIME NOT NULL,
    expected_enddatetime DATETIME NOT NULL,
    topic VARCHAR(255) NOT NULL,
    discussion VARCHAR(500) NOT NULL,
    complete_status VARCHAR(11) NOT NULL,
    response_time DATETIME NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

CREATE TABLE classes (
    class_id INT AUTO_INCREMENT PRIMARY KEY,
    code_basedtitle VARCHAR(255) NOT NULL,
    class_title VARCHAR(255) NOT NULL,
    class_description VARCHAR(255) NOT NULL,
    class_image VARCHAR(255) NOT NULL,
    expected_startdatetime datetime NOT NULL,
    expected_enddatetime datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


CREATE TABLE `login` (
  `login_id` int(11) NOT NULL AUTO_INCREMENT,
  `memberuser_id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(150) NOT NULL,
  `user_type` enum('user','master') NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `lastname` varchar(150) NOT NULL,
  `profile_image` varchar(150) NOT NULL,
  `d_o_b` date NOT NULL,
  `position` varchar(150) NOT NULL,
  `address` varchar(150) NOT NULL,
  `postcode` varchar(150) NOT NULL,
  `phone_number` varchar(150) NOT NULL,
  `user_status` enum('Active','Inactive') NOT NULL,
  `user_activation_code` varchar(250) NOT NULL,
  `user_email_status` enum('not verified','verified') NOT NULL,
  PRIMARY KEY (`login_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

CREATE TABLE reviews (
    review_id INT AUTO_INCREMENT PRIMARY KEY,
    code_basedtitle VARCHAR(255) NOT NULL,
    recipient_email VARCHAR(255) NOT NULL,
    sender_email VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message VARCHAR(255) NOT NULL,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    profile_image VARCHAR(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

