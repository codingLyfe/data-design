ALTER DATABASE tbennett19 CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS clap;
DROP TABLE IF EXISTS article;
DROP TABLE IF EXISTS profile;

CREATE TABLE profile (
	profileId BINARY(16) NOT NULL,
	profileActivationToken CHAR(32),
	profileName VARCHAR(32) NOT NULL,
	profileEmail VARCHAR(128) NOT NULL,
	profileHash CHAR(128) NOT NULL,
	profileSalt CHAR(64) NOT NULL,
	UNIQUE(profileName),
	UNIQUE(profileEmail),
	PRIMARY KEY(profileId)
);

CREATE TABLE article (
	articleId BINARY(16) NOT NULL,
	articleProfileId BINARY(16) NOT NULL,
	araticleTitle VARCHAR(32) NOT NULL,
	articleContent VARCHAR(140) NOT NULL,
	articleDateTime DATETIME(6) NOT NULL,
	INDEX(articleProfileId),
	FOREIGN KEY(articleProfileId) REFERENCES profile(profileId),
	PRIMARY KEY(articleId)
);

CREATE TABLE clap (
	clapId BINARY(16) NOT NULL,
	clapProfileId BINARY(16) NOT NULL,
	clapArticleId BINARY(16) NOT NULL,
	INDEX(clapProfileId),
	INDEX(clapArticleId),
	FOREIGN KEY(clapProfileId) REFERENCES profile(profileId),
	FOREIGN KEY(clapArticleId) REFERENCES article(articleId),
	PRIMARY KEY(clapId)
);