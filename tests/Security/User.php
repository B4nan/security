<?php

namespace B4nan\Tests\Security;

use B4nan\Entities\BaseEntity;
use B4nan\Models\IUserRepository;
use Nette\Security\IIdentity;
use Nette\Security\Passwords;

/**
 * Class User
 * @author Martin Adámek <martinadamek59@gmail.com>
 */
class User implements IIdentity
{

	public $email, $password, $active;

	/**
	 * User constructor.
	 */
	public function __construct()
	{
		$this->email = 'admin@B4nan.com';
		$this->password = Passwords::hash('admin');
		$this->active = TRUE;
	}

	/**
	 * Returns the ID of user.
	 * @return mixed
	 */
	function getId()
	{
		return 1;
	}

	/**
	 * Returns a list of roles that the user is a member of.
	 * @return array
	 */
	function getRoles()
	{
		return ['admin'];
	}

}
