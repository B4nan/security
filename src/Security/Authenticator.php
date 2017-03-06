<?php

namespace B4nan\Security;

use B4nan\Models\IUserRepository;
use Nette\Security\AuthenticationException;
use Nette\Security\IAuthenticator;
use Nette\Security\Passwords;

/**
 * @author Martin Adámek <martinadamek59@gmail.com>
 */
class Authenticator implements IAuthenticator
{

	/** @var IUserRepository */
	protected $users;

	/**
	 * Constructor
	 *
	 * @param IUserRepository $repository
	 */
	public function __construct(IUserRepository $repository)
	{
		$this->users = $repository;
	}

	/**
	 * Authenticate
	 *
	 * @param array $credentials
	 * @param bool $persist
	 * @return \Nette\Security\Identity
	 * @throws AuthenticationException
	 */
	public function authenticate(array $credentials, $persist = TRUE)
	{
		list($email, $password) = $credentials;

		$user = $this->users->find(['email' => $email]);
		if (!$user) {
			throw new AuthenticationException("User '$email' does not exist.", self::IDENTITY_NOT_FOUND);
		}

		if (!Passwords::verify($password, $user->password)) {
			throw new AuthenticationException('Invalid password.', self::INVALID_CREDENTIAL);
		}

		if (!$user->active) {
			throw new AuthenticationException('User is not active.', self::INVALID_CREDENTIAL);
		}

		$user->lastLogin = new \DateTime;
		if ($persist) {
			$this->users->persist($user);
		}

		return $user;
	}

}
