ALTER DATABASE tbennett19 CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS clap;
DROP TABLE IF EXISTS article;
DROP TABLE IF EXISTS profile;

CREATE TABLE profile (
	profileId BINARY(16) NOT NULL,
	profileActivationToken CHAR(32),
	profileEmail VARCHAR(128) NOT NULL,
	profileHash CHAR(128) NOT NULL,
	profileName VARCHAR(32) NOT NULL,
	profileSalt CHAR(64) NOT NULL,
	UNIQUE(profileName),
	UNIQUE(profileEmail),
	PRIMARY KEY(profileId)
);

CREATE TABLE article (
	articleId BINARY(16) NOT NULL,
	articleProfileId BINARY(16) NOT NULL,
	articleContent VARCHAR(140) NOT NULL,
	articleDateTime DATETIME(6) NOT NULL,
	articleTitle VARCHAR(32) NOT NULL,
	INDEX(articleProfileId),
	FOREIGN KEY(articleProfileId) REFERENCES profile(profileId),
	PRIMARY KEY(articleId)
);

CREATE TABLE clap (
	clapId BINARY(16) NOT NULL,
	clapArticleId BINARY(16) NOT NULL,
	clapProfileId BINARY(16) NOT NULL,
	INDEX(clapProfileId),
	INDEX(clapArticleId),
	FOREIGN KEY(clapProfileId) REFERENCES profile(profileId),
	FOREIGN KEY(clapArticleId) REFERENCES article(articleId),
	PRIMARY KEY(clapId)
);


INSERT INTO profile (profileId, profileActivationToken, profileEmail, profileHash, profileName, profileSalt)
VALUES (UNHEX(REPLACE('a544cd25-710c-4a16-839c-b32f942e1539','-','')), '1', 'markLawson', '1a2b', 'Mark', '3c4d');

SELECT profileEmail
FROM profile
WHERE profileId = UNHEX(REPLACE('a544cd25-710c-4a16-839c-b32f942e1539','-',''));

UPDATE profile
SET profileHash = '33f7b2768dc230805ea073943708a02d4e4c70262ea2b7fb1c343aaeacb447447815fd78476976091a69d3f72ebe15402a5c9bbab0b11d758439eeff11376916',
	profileSalt = 'bdcd659f20e1b25d7cdf297256c8a6fa934829cf733496e75c9c83ac43f5b50d'
WHERE profileId = UNHEX(REPLACE('a544cd25-710c-4a16-839c-b32f942e1539','-',''));

SELECT profileHash
FROM profile
WHERE profileId = UNHEX(REPLACE('a544cd25-710c-4a16-839c-b32f942e1539','-',''));



INSERT INTO article (articleId, articleProfileId, articleContent, articleDateTime, articleTitle)
	VALUES (unhex(replace('63b9c8c9-9151-41fb-8213-0ffffe933c0a','-','')), UNHEX(REPLACE('a544cd25-710c-4a16-839c-b32f942e1539','-','')), 'Lawson and Sons', '2018-01-17 10:52:30.651024', 'L or S');
