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
	public function setUserId($newUserId): Uuid {
		$this->userId = $newUserId;
	}

	/**
	 * accessor method for user Email
	 *
	 * @return Email of the user
	 */
	public function getUserEmail(): string {
		return($this->userEmail);
	}
}