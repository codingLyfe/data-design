<?php

namespace Edu\Cnm\Tbennett19\DataDesign;

require_once("autoload.php");
require_once(dirname(__DIR__, 2) . "../vendor/autoload.php");

use Ramsey\Uuid\Uuid;


/**
 * Cross section of Medium clap
 *
 * This is a cross section of what is likely stored when a profile "claps" for an article on Medium.
 *
 * @author Tristan Bennett <tbennett19@cnm.edu>
 * @author Dylan McDonald <dmcdonald21@cnm.edu>
 * @version 4.0.0
 * @package Edu\Cnm\DataDesign
 **/
class Clap implements \JsonSerializable{
	use ValidateDate;
	use ValidateUuid;

	/**
	 * id for clap : primary key
	 * @var Uuid $clapId
	 **/
	private $clapId;
	/**
	 * id of the article that this clap is for; this is a foreign key that references article
	 * @var Uuid $clapArticleId
	 **/
	private $clapArticleId;
	/**
	 * id of the Profile that sent this clap; this is a foreign key that references profile
	 * @var Uuid $clapProfiled
	 **/
	private $clapProfileId;


	/**
	 * accessor method for clap id
	 *
	 * @return Uuid value of clap id
	 **/
	public function getClapId(): Uuid {
		return ($this->clapId);
	}
	/**
	 * mutator method for clap id
	 *
	 * @param Uuid/string $newClapId new value of clap id
	 * @throws \RangeException if $newClapId is not positive
	 * @throws \TypeError if $newClapId is not a uuid or string
	 **/
	public function setClapId($newClapId): void {
		try {
			$uuid = self::validateUuid($newClapId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		//  store the clap id
		$this->clapId = $uuid;
	}



	/**
	 * accessor method for clap article id
	 *
	 * @return Uuid value of clap article id
	 **/
	public function getClapArticleId() : Uuid{
		return($this->clapArticleId);
	}
	/**
	 * mutator method for clap article id
	 *
	 * @param string | Uuid $newClapArticleId new value of clap article id
	 * @throws \RangeException if $newClapArticleId is not positive
	 * @throws \TypeError if $newClapArticleId is not an integer
	 **/
	public function setClapArticleId($newClapArticleId) : void {
		try {
			$uuid = self::validateUuid($newClapArticleId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the profile id
		$this->clapArticleId = $uuid;
	}

	/**
	 * accessor method for clap profile id
	 *
	 * @return Uuid value of clap profile id
	 **/
	public function getClapProfileId() : Uuid{
		return($this->clapProfileId);
	}
	/**
	 * mutator method for clap profile id
	 *
	 * @param string | Uuid $newClapProfileId new value of clap profile id
	 * @throws \RangeException if $newClapProfileId is not positive
	 * @throws \TypeError if $newClapProfileId is not an integer
	 **/
	public function setClapProfileId($newClapProfileId) : void {
		try {
			$uuid = self::validateUuid($newClapProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the profile id
		$this->clapProfileId = $uuid;
	}


	/**
	 * Constructor for article
	 *
	 * @param string|Uuid $newClapId of this clap or null if a there is no clap
	 * @param string|Uuid $newClapArticleId of the article that was claped, this is a foreign key referencing article
	 * @param string $newClapProfileId of the profile that claped, foreign key referencing profile
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \Exception if some other exception occurs
	 * @throws \TypeError if data types violate type hints
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newClapId, $newClapArticleId, $newClapProfileId) {
		try {
			$this->setClapId($newClapId);
			$this->setClapArticleId($newClapArticleId);
			$this->setClapProfileId($newClapProfileId);
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
		$fields["clapId"] = $this->clapId;
		$fields["clapArticleId"] = $this->clapArticleId;
		$fields["clapProfileId"] = $this->clapProfileId;
		return($fields);
	}


}