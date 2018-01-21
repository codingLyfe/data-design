<?php

namespace Edu\Cnm\DataDesign;


//getting undefined namespace error
//use Ramsey\Uuid\Uuid;

/**
 * Cross section of a "Medium" profile
 *
 * This Profile can be considered an example of what might be stored in a User's Profile on Medium.
 *
 * @author Tristan Bennett tbennett19@cnm.edu
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

}