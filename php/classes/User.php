<?php

/**
 * An individual user on the site
 *
 * @author Calder Benjamin <calderbenjamin@gmail.com>
 */
class User {

	/**
	 *ID for this user, the primary key
	 *
	 * @var Uuid userId
	 */

	private $userId;
	/**
	 * The email associated with this user
	 *
	 * @var string userEmail
	 */

	private $userEmail;
	/**
	 * The hash of this user's password
	 *
	 * @var string userHash
	 */

	private $userHash;
	/**
	 * The salt for this user's password
	 *
	 * @var string userSalt
	 */

	private $userSalt;
	/**
	 *The user's display name
	 *
	 * @var string userName
	 */
	private $userName;

	/**
	 * Constructor for this user
	 *
	 * @param Uuid $newUserId the ID for the user
	 * @param string $newUserEmail the email associated with the user
	 * @param string $newUserHash the hash of this user's password
	 * @param string $newUserSalt the salt for this user's password
	 * @param string $newUserName the user's display name
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 */
	public function _construct($newUserId, $newUserEmail, $newUserHash, $newUserSalt, $newUserName) {
		try {
			$this->setUserId($newUserId);
			$this->setUserEmail($newUserEmail);
			$this->setUserHash($newUserHash);
			$this->setUserSalt($newUserSalt);
			$this->setUserName($newUserName);
		}
		catch(\InvalidArgumentException|\RangeException|\Exception|\TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for user ID
	 *
	 * @return Uuid value of user ID
	 */
	public function getUserId(): Uuid {
		return($this->userId);
	}

	/**
	 * mutator method for user ID
	 *
	 * @param Uuid $newUserId new value of user's ID
	 */
	public function setUserId($newUserId): void {
		$this->userId = $newUserId;
	}

	/**
	 * accessor method for user Email
	 *
	 * @return string Email of the user
	 */
	public function getUserEmail(): string {
		return($this->userEmail);
	}

	/**
	 * mutator method for user Email
	 *
	 * @param string $newUserEmail User's new email
	 * @throws \InvalidArgumentException if $newUserEmail is not a string or insecure
	 * @throws \TypeError if $newUserEmail is not a string
	 */
	public function setUserEmail($newUserEmail): void {
		$newUserEmail = trim($newUserEmail);
		$newUserEmail = filter_var($newUserEmail, FILTER_VALIDATE_EMAIL);
		if(empty($newUserEmail) === true) {
			throw(new \InvalidArgumentException("Email is not valid or is insecure"));
		}

		$this->userEmail = $newUserEmail;
	}

	/**
	 * accessor method for userHash
	 *
	 * @return string Hash of the user
	 */
	public function getUserHash(): string {
		return($this->userHash);
	}

	/**
	 * mutator method for userHash
	 *
	 * @param string $newUserHash User's new Hash
	 */
	public function setUserHash($newUserHash): void {
		$this->userHash = $newUserHash;
	}

	/**
	 * accessor method for userSalt
	 *
	 * @return string Salt of the user
	 */
	public function getUserSalt() : string {
		return($this->userSalt);
	}

	/**
	 * mutator method for usersalt
	 *
	 * @param string $newUserSalt User's new salt
	 */
	public function setUserSalt($newUserSalt): void {
		$this->userSalt = $newUserSalt;
	}

	/**
	 * accessor method for userName
	 *
	 * @return string User's display name
	 */
	public function getUserName() : string {
		return($this->userName);
	}

	/**
	 * mutator method for userName
	 *
	 * @param string $newUserName The user's new display name
	 * @throws \InvalidArgumentException if $newUserName is not a string or insecure
	 * @throws \RangeException if $newUserName is > 32 characters
	 * @throws \TypeError if $newUserName is not a string
	 */
	public function setUserName($newUserName) : void {
		$newUserName = trim($newUserName);
		$newUserName = filter_var($newUserName, FILTER_SANITIZE_STRING);
		if(empty($newTweetContent) === true) {
			throw(new \InvalidArgumentException("username is empty or insecure"));
		}
		if(strlen($newUserName) > 32) {
			throw(new \RangeException("username too large"));
		}

		$this->userName = $newUserName;
	}
}