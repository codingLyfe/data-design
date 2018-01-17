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
FROM profile;

INSERT INTO article (articleId, articleProfileId, articleContent, articleDateTime, articleTitle)
	VALUES (unhex(replace('63b9c8c9-9151-41fb-8213-0ffffe933c0a','-','')), 'mark1', 'Lawson and Sons', DATE (), 'L or S');
