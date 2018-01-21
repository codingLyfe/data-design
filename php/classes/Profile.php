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
		}
}