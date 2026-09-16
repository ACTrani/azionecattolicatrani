-- Local admin account for SMF + MKPortal admin panel.
-- Login: admin / admin123   (SMF 1.1 hash = sha1('admin'+'admin123'))
INSERT INTO smf_members (memberName, passwd, emailAddress, dateRegistered, ID_GROUP, lngfile, realName, memberIP, memberIP2)
VALUES ('admin', 'd60b772c6205311fae6fae9f8509986da1fe7029', 'admin@localhost.local', 1789508735, 1, 'italian', 'Amministratore', '127.0.0.1', '127.0.0.1');
