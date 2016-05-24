use calendar;
CREATE TABLE calendar
(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(150),
description VARCHAR(400),
category VARCHAR(20),
eventDay INT(2),
eventMonth INT(2),
eventYear INT(4)
);

CREATE TABLE category
(
category VARCHAR(20)
);

INSERT INTO category (category) VALUES ('school');

INSERT INTO calendar (title, description, eventDay, eventMonth, eventYear)
VALUES ('today', 'hello world', 8, 2, 2015);
INSERT INTO calendar (title, description, eventDay, eventMonth, eventYear) VALUES  ('tomorrow', 'hello world',9,2, 2015);

SELECT * FROM calendar;

SELECT eventDay FROM calendar WHERE eventDay = 8;