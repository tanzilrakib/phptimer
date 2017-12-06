CREATE DATABASE phptimer;

use phptimer;

CREATE TABLE initializers (
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	fontsize INT(10),
	cbcolor VARCHAR(20),
	cbimage VARCHAR(50),
	ccolor VARCHAR(20),
	lcolor VARCHAR(20)
);


CREATE TABLE timersaver (
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	finish_at DATETIME,
	start_from TIMESTAMP
);