<?php
namespace Edu\Cnm\Tbennett19\DataDesign;

require_once("autoload.php");
require_once(dirname(__DIR__, 2) . "../vendor/autoload.php");

use Ramsey\Uuid\Uuid;



/**
 * Cross Section of a "Medium" article
 *
 *This is a cross section of what is likely stored when a user posts an article on Medium.
 *
 * @author Tristan Bennett <tbennett19@cnm.edu>
 * @author Dylan McDonald <dmcdonald21@cnm.edu>
 * @version 4.0.0
 * @package Edu\Cnm\DataDesign
 **/
class Article implements \JsonSerializable{
	use ValidateDate;
	use ValidateUuid;
	/**
	 * id for this article: primary key
	 * @var Uuid $articleID
	 **/
	private $articleId;
	/**
	 * this is the profile Id associated with this article: foreign key that references profile
	 * @var Uuid $articleProfileId
	 **/
	private $articleProfileId;
	/**
	 * text content of the article
	 * @var string $articleContent
	 **/
	private $articleContent;
	/**
	 * date and time the article was published in a PHP date time object
	 * @var \DateTime $articleDate
	 **/
	private $articleDateTime;
	/**
	 * title of the published article
	 * @var string $articleTitle
	 **/
	private $articleTitle;
	/**
	 * accessor method for Article id
	 *
	 * @return Uuid value of Article id
	 **/

	/**
	 * Constructor for article
	 *
	 * @param string|Uuid $newArticleId of this article or null if a new article
	 * @param string|Uuid $newArticleProfileId of the profile that created this article
	 * @param string $newArticleContent string containing content
	 * @param \DateTime|string|null $newArticleDateTime date and time article was created
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \Exception if some other exception occurs
	 * @throws \TypeError if data types violate type hints
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newArticleId, $newArticleProfileId, string $newArticleContent, $newArticleDateTime = null, string $newArticleTitle) {
		try {
			$this->setArticleId($newArticleId);
			$this->setArticleProfileId($newArticleProfileId);
			$this->setArticleContent($newArticleContent);
			$this->setArticleDateTime($newArticleDateTime);
			$this->setArticleTitle($newArticleTitle);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}


	public function getArticleId(): Uuid {
		return ($this->articleId);
	}
	/**
	 * mutator method for article id
	 *
	 * @param Uuid/string $newArticleId new value of article id
	 * @throws \RangeException if $newArticleId is not positive
	 * @throws \TypeError if $newArticleId is not a uuid or string
	 **/
	public function setArticleId($newArticleId): void {
		try {
			$uuid = self::validateUuid($newArticleId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		//  store the article id
		$this->articleId = $uuid;
	}


	/**
	 * accessor method for the profile id attached to the article
	 *
	 * @return Uuid value of the profile id attached to the article
	 **/
	public function getArticleProfileId(): Uuid {
		return ($this->articleProfileId);
	}
	/**
	 * mutator method for the profile id attached to the article
	 *
	 * @param string | Uuid $newArticleProfileId new value of article author's profile id
	 * @throws \RangeException if $newProfileId is not positive
	 * @throws \TypeError if $newArticleProfileId is not a string
	 **/
	public function setArticleProfileId($newArticleProfileId): void {
		try {
			$uuid = self::validateUuid($newArticleProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the profile id
		$this->articleProfileId = $uuid;
	}

	/**
	 * accessor method for article content
	 *
	 * @return string value of article content
	 **/
	public function getArticleContent(): string {
		return ($this->articleContent);
	}

	/**
	 * mutator method for article content
	 *
	 * @param string $newArticleContent new value of article content
	 * @throws \InvalidArgumentException if $enwArticleContent is not a string or insecure
	 * @throws \RangeException if $newArticleContent is > 500 characters
	 * @throws \TypeError if $newArticleContent is not a string
	 **/
	public function setArticleContent(string $newArticleContent): void {
		// verify the article content is secure
		$newArticleContent = trim($newArticleContent);
		$newArticleContent = filter_var($newArticleContent, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newArticleContent) === true) {
			throw(new \InvalidArgumentException("Article content is empty or insecure"));
		}
		// verify the article content will fit in the database
		if(strlen($newArticleContent) > 500) {
			throw(new \RangeException("Article content too large"));
		}
		// store the article content
		$this->articleContent = $newArticleContent;
	}


	/**
	 * accessor method for article date
	 *
	 * @return \DateTime value of article date
	 **/
	public function getArticleDateTime(): \DateTime {
		return ($this->articleDateTime);
	}

	/**
	 * mutator method for article date
	 *
	 * @param \DateTime|string|null $newArticleDateTime article date as a DateTime object or string (or null to load the current DateTime)
	 * @throws \InvalidArgumentException if $newArticleDateTime is not a valid object or string
	 * @throws \RangeException if $newArticleDateTime is a date that does not exist
	 **/
	public function setArticleDateTime($newArticleDateTime = null): void {
		// base case: if the date is null, use the current date and time
		if($newArticleDateTime === null) {
			$this->articleDateTime = new \DateTime();
			return;
		}
		// store the like date using the ValidateDate trait
		try {
			$newArticleDateTime = self::validateDateTime($newArticleDateTime);
		} catch(\InvalidArgumentException | \RangeException $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->articleDateTime = $newArticleDateTime;
	}


	/**
	 * accessor method for article title
	 *
	 * @return string value of article title
	 **/
	public function getArticleTitle(): string {
		return ($this->articleTitle);
	}

	/**
	 * mutator method for article title
	 *
	 * @param string $newArticleTitle new value of article title
	 * @throws \InvalidArgumentException if $enwArticleTitle is not a string or insecure
	 * @throws \RangeException if $newArticleTitle is > 64 characters
	 * @throws \TypeError if $newArticleTitle is not a string
	 **/
	public function setArticleTitle(string $newArticleTitle): void {
		// verify the article title is secure
		$newArticleTitle = trim($newArticleTitle);
		$newArticleTitle = filter_var($newArticleTitle, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newArticleTitle) === true) {
			throw(new \InvalidArgumentException("Article title is empty or insecure"));
		}
		// verify the article title will fit in the database
		if(strlen($newArticleTitle) > 64) {
			throw(new \RangeException("Article title too long"));
		}
		// store the article title
		$this->articleTitle = $newArticleTitle;
	}

	/**
	 * inserts a new article into mySQL
	 * @param \PDO $pdo connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo): void {

		// creates the query template. Ready to be formatted and inserted
		$query = "INSERT INTO article(articleId, articleProfileId, articleContent, articleDateTime, articleTitle) VALUES (:articleId, :articleProfileId, :articleContent, :articleDateTime, :articleTitle)";

		// stops direct insert for security reasons. Allows for further formatting.
		$statement = $pdo->prepare($query);

		// bind values of variables to respective placeholders in template
		$formattedDateTime = $this->articleDateTime->format("Y-m-d H:i:s.u");
		$parameters = ["articleId" => $this->articleId->getBytes(), "articleProfileId" => $this->articleProfileId->getBytes(), "articleContent" => $this->articleContent, "articleDateTime" => $this->$formattedDateTime, "articleTitle => $this->articleTitle"];
		$statement->execute($parameters);
	}

	/**
	 * Deletes selected article from mySQL
	 *
	 * @param \PDO $pdo connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo): void {

		// create query template
		$query = "DELETE FROM article WHERE articleId = :articleId";

		// stops direct deletion
		$statement = $pdo->prepare($query);

		// binds binary value of articleId to placeholder for profileId
		$parameters = ["articleId" => $this->articleId->getBytes()];
		$statement->execute($parameters);
	}

	/**
	 * Updates selected article from mySQL
	 *
	 * @param \PDO $pdo connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo): void {
		// create query template
		$query = "UPDATE article SET articleContent = :articleContent, articleDateTime = :articleDateTime, articleTitle = :articleTitle WHERE articleId = :articleId";

		// stops direct update. Allows for formatting and for security
		$statement = $pdo->prepare($query);

		//binds values to placeholders for updating
		$parameters = ["articleContent" => $this->articleContent, "articleDateTime" => $this->articleDateTime, "articleTitle" => $this->articleTitle];
		$statement->execute($parameters);
	}

	/**
	 * gets article by article id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $articleId Article id to search by
	 * @return Article|null Article found or null if not found
	 * @throws \PDOException when mySQL related error occurs
	 * @throws \TypeError when a variable is not the correct data type
	 **/
	public static function getArticleByArticleId(\PDO $pdo, $articleId): ?Article {
		// sanitize the article id before searching
		try {
			$articleId = self::validateUuid($articleId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create query template
		$query = "SELECT articleId, articleProfileId, articleContent, articleDateTime, articleTitle FROM article WHERE articleId = :articleId";

		// stops direct access to database for formatting
		$statement = $pdo->prepare($query);

		// bind the profile id to the place holder in the template
		$parameters = ["articleId" => $articleId->getBytes()];
		$statement->execute($parameters);

		// grab the profile from mySQL
		try {
			$article = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$article = new Article($row["articleId"], $row["articleProfileId"], $row["articleContent"], $row["articleDateTime"], $row["articleTitle"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow the exception
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($article);
	}

	/**
	 * gets article by profile profile id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param \SplFixedArray SplFixedArray of articles by profile id
	 * @return \SplFixedArray SplFixedArray of articles by a profile id or null if none found
	 * @throws \PDOException when mySQL related error occurs
	 * @throws \TypeError when a variable is not the correct data type
	 **/
	public static function getArticleByProfileId(\PDO $pdo, $articleProfileId) : \SplFixedArray {

		// sanitize the article profile id before searching
		try {
			$articleProfileId = self::validateUuid($articleProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create query template
		$query = "SELECT articleId, articleProfileId, articleContent, articleDateTime, articleTitle FROM article WHERE articleProfileId = :articleProfileId";
		$statement = $pdo->prepare($query);

		// bind the profile activation token to the place holder in the template
		$parameters = ["articleProfileId" => $articleProfileId];
		$statement->execute($parameters);

		// build an array of profiles with profile activation tokens
		$articles = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$article = new Article($row["articleId"], $row["articleProfileId"], $row["articleContent"], $row["articleDateTime"], $row["articleTitle"]);
				$articles[$articles->key()] = $article;
				$articles->next();
			} catch(\Exception $exception) {
				// if row couldn't be converted, rethrow the exception
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($articles);
	}


















	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		$fields["articleId"] = $this->articleId;
		$fields["articleProfileId"] = $this->articleProfileId;
		$fields["articleContent"] = $this->articleContent;
		$fields["articleTitle"] = $this->articleTitle;
		//format the date so that the front end can consume it
		$fields["articleDateTime"] = round(floatval($this->articleDateTime->format("U.u")) * 1000);
		return($fields);
	}

}