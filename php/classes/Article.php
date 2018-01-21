<?php
namespace Edu\Cnm\DataDesign;

require_once("autoload.php");
require_once(dirname(__DIR__) . "autoload.php");

// TODO: get Ramsey to work
//use Ramsey\Uuid\Uuid;
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
class Article {
	use ValidateDate;
	use ValidateUuid;
	/**
	 * id for this article: primary key
	 * @var Uuid $articleID
	 **/
	private $articleId;
	/**
	 * this is the profile Id associated with this article: foreign key
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
	private $articleDate;


//TODO: add constructor


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
		// verify the tweet content is secure
		$newArticleContent = trim($newArticleContent);
		$newArticleContent = filter_var($newArticleContent, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newArticleContent) === true) {
			throw(new \InvalidArgumentException("article content is empty or insecure"));
		}
		// verify the article content will fit in the database
		if(strlen($newArticleContent) > 500) {
			throw(new \RangeException("article content too large"));
		}
		// store the article content
		$this->articleContent = $newArticleContent;
	}












}