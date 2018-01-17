ALTER DATABASE tbennett19 CHARACTER SET utf8 COLLATE utf8_unicode_ci;

-- DROP TABLE IF EXISTS clap;
-- DROP TABLE IF EXISTS article;
-- DROP TABLE IF EXISTS profile;

-- creating profile table
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

-- creating article table
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

-- creating clap table
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



-- Inserting into profile
INSERT INTO profile (profileId, profileActivationToken, profileEmail, profileHash, profileName, profileSalt)
VALUES (UNHEX(REPLACE('a544cd25-710c-4a16-839c-b32f942e1539','-','')), '1', 'markLawson', '1a2b', 'Mark', '3c4d');


SELECT profileName
FROM profile
WHERE profileId = UNHEX(REPLACE('a544cd25-710c-4a16-839c-b32f942e1539','-',''));


INSERT INTO profile (profileId, profileActivationToken, profileEmail, profileHash, profileName, profileSalt)
VALUES (UNHEX(REPLACE('3e0fd4d7-0504-4d04-aa3a-db1bb11eb788', '-', '')), '2', 'john@msn.com', '86042d0a93ec4bcbe80ca789f84d1294a7adb80b0f6e3550a5801c1141b4c944fb6d968c08b203f8c92242974c8c1a106352229559bd3953ba310f0c503b725f', 'john', '68c9aecb073c922da1900559cc5cbb037cb724c12e0be9685937b46572986946');


SELECT profileEmail
FROM profile
WHERE profileId = UNHEX(REPLACE('3e0fd4d7-0504-4d04-aa3a-db1bb11eb788','-',''));

SELECT profileEmail
FROM profile;

UPDATE profile
SET profileHash = '33f7b2768dc230805ea073943708a02d4e4c70262ea2b7fb1c343aaeacb447447815fd78476976091a69d3f72ebe15402a5c9bbab0b11d758439eeff11376916',
	profileSalt = 'bdcd659f20e1b25d7cdf297256c8a6fa934829cf733496e75c9c83ac43f5b50d'
WHERE profileId = UNHEX(REPLACE('a544cd25-710c-4a16-839c-b32f942e1539','-',''));



-- Inserting into article
INSERT INTO article (articleId, articleProfileId, articleContent, articleDateTime, articleTitle)
	VALUES (unhex(replace('63b9c8c9-9151-41fb-8213-0ffffe933c0a','-','')), UNHEX(REPLACE('a544cd25-710c-4a16-839c-b32f942e1539','-','')), 'Lawson and Sons', '2018-01-17 10:52:30.651024', 'L or S');

UPDATE article
SET articleContent = 'New Content'
WHERE articleId = unhex(replace('63b9c8c9-9151-41fb-8213-0ffffe933c0a','-',''));

SELECT articleContent
FROM article
WHERE articleId = unhex(replace('63b9c8c9-9151-41fb-8213-0ffffe933c0a','-',''));




-- Inserting into clap
INSERT INTO clap (clapId, clapArticleId, clapProfileId)
	VALUES (unhex(replace('e2eb5c9b-5bd9-4388-9395-cc8c5d29f18e','-','')), unhex(replace('63b9c8c9-9151-41fb-8213-0ffffe933c0a','-','')), UNHEX(REPLACE('a544cd25-710c-4a16-839c-b32f942e1539','-','')));

SELECT clapArticleId
FROM clap
WHERE clapId = unhex(replace('e2eb5c9b-5bd9-4388-9395-cc8c5d29f18e','-',''));


-- Join command
SELECT  profileName, clapProfileId
FROM clap
INNER JOIN profile ON profile.profileId = clap.clapProfileId
WHERE clapId = unhex(replace('e2eb5c9b-5bd9-4388-9395-cc8c5d29f18e','-',''));



-- Delete commands
DELETE FROM clap
WHERE clapId = unhex(replace('e2eb5c9b-5bd9-4388-9395-cc8c5d29f18e','-',''));

DELETE FROM article
WHERE articleId = unhex(replace('63b9c8c9-9151-41fb-8213-0ffffe933c0a','-',''));

DELETE FROM profile
WHERE profileId = UNHEX(REPLACE('a544cd25-710c-4a16-839c-b32f942e1539','-',''));