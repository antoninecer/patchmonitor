
CREATE USER 'librarian'@'localhost' IDENTIFIED BY 'heslo';
create database library;
GRANT ALL PRIVILEGES ON *.* TO ''brarian@localhost IDENTIFIED BY 'heslo';
GRANT ALL PRIVILEGES ON library.* TO librarian@localhost;
FLUSH PRIVILEGES;

use library;

sloupecky v db:

description > os
actual > patchlevel
hotovo > done
stemp > stamp

nazev db:
proces > process
ukaz > preview

DROP TABLE IF EXISTS inventory;
CREATE TABLE inventory (
id INT NOT NULL AUTO_INCREMENT,
hostname VARCHAR(30),
os VARCHAR(255) null,
kernel VARCHAR(30) null,
patchlevel VARCHAR(30) null,
done VARCHAR(30) null,
stamp datetime null,
PRIMARY KEY (id)
); 


DROP TABLE IF EXISTS process;
CREATE TABLE process (
id INT NOT NULL AUTO_INCREMENT,
hostname VARCHAR(30),
os VARCHAR(255) null,
kernel VARCHAR(30) null,
patchlevel VARCHAR(30) null,
done VARCHAR(30) null,
stamp datetime null,
PRIMARY KEY (id)
);

DROP TABLE IF EXISTS exclude;
CREATE TABLE exclude (
id INT NOT NULL AUTO_INCREMENT,
hostname VARCHAR(30),
excluded BOOLEAN null,
excludedby VARCHAR(55) null,
note VARCHAR(255) null,
stamp datetime null,
PRIMARY KEY (id)
);

DROP TABLE IF EXISTS users;
CREATE TABLE users (
id INT NOT NULL AUTO_INCREMENT,
username VARCHAR(30),
password VARCHAR(55) null,
admin VARCHAR(1) null,
PRIMARY KEY (id)
);
MariaDB [library]> insert into users (username,password,admin) values ('tonda','Heslo12345','Y');
MariaDB [library]> insert into users (username,password,admin) values ('david','UztamBudem','Y');
MariaDB [library]> insert into users (username,password,admin) values ('sirovy','UztamJsme','Y');
MariaDB [library]> insert into users (username,password,admin) values ('michal','Hudly1','Y');

DROP view IF EXISTS preview;
create view preview as
select i.hostname,i.os as curros,i.kernel as currkernel,i.patchlevel as currpatch,p.kernel as newkernel, p.patchlevel as newpatch,p.os as newos,p.stamp,p.done,d.excluded,d.excludedby,d.note, d.stamp as exclude from inventory i left outer join process p on i.hostname=p.hostname left outer join exclude d on i.hostname=d.hostname order by i.os i.hostname;




insert into users (username,password,admin) values ('user','user','N');
