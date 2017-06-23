# Create DB
CREATE DATABASE auter_checkmate;
# Create servers table
CREATE TABLE auter_checkmate.servers (serverid VARCHAR(30) NOT NULL PRIMARY KEY, servername VARCHAR(60) NOT NULL,IP VARCHAR(15) NOT NULL) DEFAULT CHARACTER SET utf8;
# Create statuses table
CREATE TABLE auter_checkmate.statuses (statusid INT NOT NULL AUTO_INCREMENT PRIMARY KEY, statusname VARCHAR(30) NOT NULL, statustext VARCHAR(60) NOT NULL, statusimage VARCHAR(100) NOT NULL) DEFAULT CHARACTER SET utf8;
# Create serverstatus table
create table auter_checkmate.serverstatus (serverid VARCHAR(30) NOT NULL, statusid INT NOT NULL, FOREIGN KEY (serverid) REFERENCES servers(serverid), FOREIGN KEY (statusid) REFERENCES statuses(statusid)) DEFAULT CHARACTER SET utf8;
#Insert default statuses in the statuses table
INSERT INTO auter_checkmate.statuses (statusname, statustext, statusimage) VALUES ('REGISTERED','REGISTERED','/var/www/auter-checkmate/statuses/registered.img'),('PENDING','PENDING','/var/www/auter-checkmate/statuses/pending.img'),('PATCHED','PATCHED','/var/www/auter-checkmate/statuses/patched.img'),('RUNNING','RUNNING','/var/www/auter-checkmate/statuses/running.img'),('REBOOTING','REBOOTING','/var/www/auter-checkmate/statuses/rebooting.img'),('FINALIZING','FINALIZING','/var/www/auter-checkmate/statuses/finalizing.img'),('FAIL','FAIL','/var/www/auter-checkmate/statuses/fail.img')
