<?php

namespace Edu\Cnm\DataDesign;

//TODO: getting undefined namespace error
//use Ramsey\Uuid\Uuid;

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


class Profile {
	/**
	 * Id for this Profile; this is a primary key
	 * @var Uuid $profileId
	 */
		private $profileId;

	/**
	 * Name associate with the Profile
	 * @var string $profileName
	 */
		private $profileName;

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
	 * Salt for Profile password
	 * @var string $profileSalt
	 */
		private $profileSalt;


	/**
	 * accessor for ProfileId
	 * @return Uuid for ProfileId
	 */
		public function getProfileId() : Uuid {
			return ($this->profileId);
		}

	/**
	 * mutator for ProfileId
	 * @param Uluid/string $newProfileId is a new value for ProfileId
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

		//TODO: accessor and mutator for profileActivationToken

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
		$newProfileEmail = filter_var($newProfileEmail, FILTER_VALIDATE_EMAIL);
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


















}