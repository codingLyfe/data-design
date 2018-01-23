<?php
namespace Edu\Cnm\Tbennett19\DataDesign;

require_once("autoload.php");
require_once(dirname(__DIR__, 2) . "classes/autoload.php");

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
	 * Constructor for article
	 *
	 * @param string|Uuid $newArticleId of this article or null if a new article
	 * @param string|Uuid $newArticleProfileId of the profile that created this article
	 * @param string $newArticleContent string containing content
	 * @param \DateTime|string|null $newDateTime date and time article was created
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \Exception if some other exception occurs
	 * @throws \TypeError if data types violate type hints
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newArticleId, $newArticleProfileId, string $newArticleContent, $newArticleDateTime = null) {
		try {
			$this->setArticleId($newArticleId);
			$this->setArticleProfileId($newArticleProfileId);
			$this->setArticleContent($newArticleContent);
			$this->setDateTime($newArticleDateTime);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
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