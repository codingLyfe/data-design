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

		private $profileId;

		private $profileName;

		private $profileActivationToken;

		private $profileEmail;

		private $profileHash;

		private $profileSalt;

}