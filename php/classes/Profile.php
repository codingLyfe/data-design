<?php

namespace Edu\Cnm\Tbennett19\DataDesign;

require_once("autoload.php");
require_once(dirname(__DIR__, 2) . "../vendor/autoload.php");

use Ramsey\Uuid\Uuid;


/**
 * Cross section of a "Medium" profile
 *
 * This Profile can be considered an example of what might be stored in a User's Profile on Medium.
 *
 * @author Tristan Bennett <tbennett19@cnm.edu>
 * @author Dylan McDonald <dmcdonald21@cnm.edu>
 * @version 4.0.0
 * @package Edu\Cnm\DataDesign
 */


class Profile implements \JsonSerializable {
	use ValidateDate;
	use ValidateUuid;
	/**
	 * Id for this Profile; this is a primary key
	 * @var Uuid $profileId
	 */
	private $profileId;

	/**
	 * verification token to verify email on profile
	 * @var string $profileActivationToken
	 */
	private $profileActivationToken;

	/**
	 * email linked to profile
	 * @var string $profileEmail
	 */
	private $profileEmail;

	/**
	 * Hash for Profile password
	 * @var string $profileHash
	 */
	private $profileHash;

	/**
	 * Name associate with the Profile
	 * @var string $profileName
	 */
	private $profileName;

	/**
	 * Salt for Profile password
	 * @var string $profileSalt
	 */
	private $profileSalt;


	/**
	 * Constructor for profile
	 *
	 * @param string|Uuid $newProfileId of this profile or null if a new profile
	 * @param string|null $newProfileActivationToken, can be null
	 * @param string $newProfileEmail string containing email address
	 * @param string $newProfileHash associated with password
	 * @param string $newProfileName name attached to profile
	 * @param string $newProfileSalt associated with password
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \Exception if some other exception occurs
	 * @throws \TypeError if data types violate type hints
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newProfileId, $newProfileActivationToken, string $newProfileEmail, $newProfileHash, $newProfileName, $newProfileSalt) {
		try {
			$this->setProfileId($newProfileId);
			$this->setProfileActivationToken($newProfileActivationToken);
			$this->setProfileEmail($newProfileEmail);
			$this->setProfileHash($newProfileHash);
			$this->setProfileName($newProfileName);
			$this->setProfileSalt($newProfileSalt);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor for ProfileId
	 * @return Uuid for ProfileId
	 */
	public function getProfileId() : Uuid {
		return ($this->profileId);
	}

	/**
	 * mutator for ProfileId
	 * @param Uuid|string $newProfileId is a new value for ProfileId
	 * @throws \RangeException if $newProfileId is not positive
	 * @throws \TypeError if $newProfileId is not a Uuid or string
	 */
	public function setProfileId($newProfileId) : void {
		try {
			$uuid = self::validateUuid($newProfileId);
			} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
			//convert and store profileId
			$this->profileId = $uuid;
		}

	/**
	 * accessor method for account activation token
	 *
	 * @return string value of the activation token, can be null
	 */
	public function getProfileActivationToken() : ?string {
		return ($this->profileActivationToken);
	}

	/**
	 * mutator method for account activation token
	 *
	 * @param string $newProfileActivationToken
	 * @throws \InvalidArgumentException  if the token is not a string or insecure
	 * @throws \RangeException if the token is not exactly 32 characters
	 * @throws \TypeError if the activation token is not a string
	 */
	public function setProfileActivationToken(?string $newProfileActivationToken): void {
		if($newProfileActivationToken === null) {
			$this->profileActivationToken = null;
			return;
		}
		$newProfileActivationToken = strtolower(trim($newProfileActivationToken));
		if(ctype_xdigit($newProfileActivationToken) === false) {
			throw(new\RangeException("User activation is not valid"));
		}
		//make sure user activation token is only 32 characters
		if(strlen($newProfileActivationToken) !== 32) {
			throw(new\RangeException("User activation token has to be 32 characters"));
		}
		$this->profileActivationToken = $newProfileActivationToken;
	}



	/**
	 * accessor method for Profile Email
	 *
	 * @return string value of profileEmail
	 **/
	public function getProfileEmail(): string {
		return $this->profileEmail;
	}
	/**
	 * mutator method for email
	 *
	 * @param string $newProfileEmail new value of email
	 * @throws \InvalidArgumentException if $newEmail is not a valid email or insecure
	 * @throws \RangeException if $newEmail is > 128 characters
	 * @throws \TypeError if $newEmail is not a string
	 **/
	public function setProfileEmail(string $newProfileEmail): void {
		// verify the email is secure
		$newProfileEmail = trim($newProfileEmail);
		$newProfileEmail = filter_var($newProfileEmail, FILTER_SANITIZE_EMAIL);
		if(empty($newProfileEmail) === true) {
			throw(new \InvalidArgumentException("Profile Email is empty or insecure"));
		}
		// verify the email will fit in the database
		if(strlen($newProfileEmail) > 128) {
			throw(new \RangeException("Profile Email is too large"));
		}
		// store the email
		$this->profileEmail = $newProfileEmail;
	}

	/**
	 * accessor method for profileHash
	 *
	 * @return string value of hash
	 **/
	public function getProfileHash(): string {
		return $this->profileHash;
	}
	/**
	 * mutator method for profileHash on password
	 *
	 * @param string $newProfileHash
	 * @throws \InvalidArgumentException if the hash is not secure
	 * @throws \RangeException if the hash is not 128 characters
	 * @throws \TypeError if profile hash is not a string
	 **/
	public function setProfileHash(string $newProfileHash): void {
		//enforce that the hash is properly formatted
		$newProfileHash = trim($newProfileHash);
		$newProfileHash = strtolower($newProfileHash);
		if(empty($newProfileHash) === true) {
			throw(new \InvalidArgumentException("Profile Hash for password is empty or insecure"));
		}
		//enforce that the hash is a string representation of a hexadecimal
		if(!ctype_xdigit($newProfileHash)) {
			throw(new \InvalidArgumentException("profile password hash is empty or insecure"));
		}
		//enforce that the hash is exactly 128 characters.
		if(strlen($newProfileHash) !== 128) {
			throw(new \RangeException("profile hash must be 128 characters"));
		}
		//store the hash
		$this->profileHash = $newProfileHash;
	}


	/**
	 * accessor method for profileName
	 *
	 * @return string value of profileName
	 **/
	public function getProfileName(): string {
		return ($this->profileName);
	}
	/**
	 * mutator method for profileName
	 *
	 * @param string $newProfileName new value of profile Name
	 * @throws \InvalidArgumentException if $newProfileName is not a string or insecure
	 * @throws \RangeException if $newProfileName is > 32 characters
	 * @throws \TypeError if $newProfileName is not a string
	 **/
	public function setProfileName(string $newProfileName) : void {
		// verify the profile name is secure
		$newProfileName = trim($newProfileName);
		$newProfileName = filter_var($newProfileName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProfileName) === true) {
			throw(new \InvalidArgumentException("Profile Name is empty or insecure"));
		}
		// verify the profile name will fit in the database
		if(strlen($newProfileName) > 32) {
			throw(new \RangeException("Profile Name is too large"));
		}
		// store the Profile Name
		$this->profileName = $newProfileName;
	}


	/**
	 * accessor method for profileSalt
	 *
	 * @return string value of salt
	 **/
	public function getProfileSalt(): string {
		return $this->profileSalt;
	}

	/**
	 * mutator method for profile salt on password
	 *
	 * @param string $newProfileSalt
	 * @throws \InvalidArgumentException if the salt is not secure
	 * @throws \RangeException if the salt is not 64 characters
	 * @throws \TypeError if the profile salt is not a string
	 */
	public function setProfileSalt(string $newProfileSalt): void {
		//enforce that the salt is properly formatted
		$newProfileSalt = trim($newProfileSalt);
		$newProfileSalt = strtolower($newProfileSalt);
		//enforce that the salt is a string representation of a hexadecimal
		if(!ctype_xdigit($newProfileSalt)) {
			throw(new \InvalidArgumentException("profile password hash is empty or insecure"));
		}
		//enforce that the salt is exactly 64 characters.
		if(strlen($newProfileSalt) !== 64) {
			throw(new \RangeException("profile salt must be 64 characters"));
		}
		//store the hash
		$this->profileSalt = $newProfileSalt;
	}

	/**
	 * inserts a new profile into mySQL
	 * @param \PDO $pdo connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) : void {

		// creates the query template. Ready to be formatted and inserted
		$query = "INSERT INTO profile(profileId, profileActivationToken, profileEmail, profileHash, profileName, profileSalt) VALUES (:profileId, :profileActivationToken, :profileEmail, :profileHash, :profileName, :profileSalt)";

		// stops direct insert for security reasons. Allows for further formatting.
		$statement = $pdo->prepare($query);

		// bind values of variables to respective placeholders in template
		$parameters = ["profileId" => $this->profileId->getBytes(), "profileActivationToken" => $this->profileActivationToken, "profileEmail" => $this->profileEmail, "profileHash" => $this->profileHash, "profileName => $this->profileName", "profileSalt" => $this->profileSalt];
		$statement->execute($parameters);
	}

	/**
	 * Deletes selected profile from mySQL
	 *
	 * @param \PDO $pdo connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) : void {

		// create query template
		$query = "DELETE FROM profile WHERE profileID = :profileId";

		// stops direct deletion
		$statement = $pdo->prepare($query);

		// binds binary value of profileId to placeholder for profileId
		$parameters = ["profileId" => $this->profileId->getBytes()];
		$statement->execute($parameters);
	}


	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		$fields["profileId"] = $this->profileId->toString();
		unset($fields["profileActivationToken"]);
		unset($fields["profileHash"]);
		unset($fields["profileSalt"]);
		return ($fields);
	}
}