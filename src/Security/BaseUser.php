<?php

namespace B4nan\Security;

use B4nan\Models\BaseModelLoader;
use Nette\InvalidStateException;
use Nette\Security\IUserStorage;
use Nette\Security\IAuthenticator;
use Nette\Security\IAuthorizator;
use Nette\Security\User;

/**
 * @property-read bool $root isInRole('root')
 * @property-read bool $admin isInRole('administrator')
 */
class BaseUser extends User
{

	/** @var BaseModelLoader */
	protected $models;

	/**
	 * @param IUserStorage $storage
	 * @param BaseModelLoader $models
	 * @param IAuthenticator $authenticator
	 * @param IAuthorizator $authorizator
	 */
	public function __construct(IUserStorage $storage, BaseModelLoader $models, IAuthenticator $authenticator = NULL, IAuthorizator $authorizator = NULL)
	{
		parent::__construct($storage, $authenticator, $authorizator);
		$this->models = $models;
	}

	/**
	 * @return bool
	 */
	public function isAdmin()
	{
		return $this->isInRole('administrator');
	}

	/**
	 * @return bool
	 */
	public function isRoot()
	{
		return $this->isInRole('root');
	}

	/**
	 * is user allowed to work with specified resource / privilege
	 *
	 * @param string $resource
	 * @param string $privilege
	 * @param int $id id of
	 * @return bool
	 */
	public function isAllowed($resource = IAuthorizator::ALL, $privilege = IAuthorizator::ALL, $id = NULL)
	{
		try {
			return $parent = parent::isAllowed($resource, $privilege);
		} catch (InvalidStateException $e) {
			// try adding this resource
			return $this->models->accessControl->addResource($resource);
		}
	}

}
