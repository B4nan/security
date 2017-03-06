<?php

namespace B4nan\Tests\Security;

use B4nan\Entities\Resource;
use B4nan\Entities\Role;
use B4nan\Models\IAccessControlRepository;
use Nette\InvalidStateException;
use Nette\Security\IAuthorizator;

/**
 * @author Martin Adámek <martinadamek59@gmail.com>
 */
class AccessControl implements IAccessControlRepository
{

	/** @var IAuthorizator */
	private $authorizator;

	/** @var array */
	private $resources;

	/**
	 * @param IAuthorizator $authorizator
	 */
	public function setAuthorizator(IAuthorizator $authorizator)
	{
		$this->authorizator = $authorizator;
	}

	/**
	 * get resources
	 *
	 * @return array
	 */
	public function getResources()
	{
		return [];
	}

	/**
	 * get resource by name
	 *
	 * @param string $name
	 * @return Resource
	 */
	public function getResource($name)
	{
		return new Resource(['name' => $name]);
	}

	/**
	 * @param bool $pairs
	 * @return array
	 */
	public function getRoles($pairs = FALSE)
	{
		return [ new Role(['name' => 'admin']) ];
	}

	/**
	 * @return array
	 */
	public function getRules()
	{
		return [];
	}

	/**
	 * @param string $name
	 * @return bool
	 * @throws InvalidStateException
	 */
	public function addResource($name)
	{
		if (isset($this->resources[$name])) {
			return FALSE;
		}

		$resource = new Resource;
		$resource->name = $name;
		$this->resources[$name] = $resource;

		if (! $this->authorizator) {
			throw new InvalidStateException('Authorizator not set! Cannot remove cache after resource adding.');
		}

		$this->authorizator->cleanCache();

		return TRUE;
	}

}
