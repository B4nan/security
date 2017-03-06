<?php

namespace B4nan\Models;

use Nette\InvalidStateException;
use Nette\Security\IAuthorizator;

/**
 * @package B4nan\Models
 * @author Martin Adámek <martinadamek59@gmail.com>
 */
interface IAccessControlRepository
{

	/**
	 * @param IAuthorizator $authorizator
	 */
	public function setAuthorizator(IAuthorizator $authorizator);

	/**
	 * @return array
	 */
	public function getResources();

	/**
	 * @param string $name
	 * @return Resource
	 */
	public function getResource($name);

	/**
	 * @param bool $pairs
	 * @return array
	 */
	public function getRoles($pairs = FALSE);

	/**
	 * @return array
	 */
	public function getRules();

	/**
	 * @param string $name
	 * @return bool
	 * @throws InvalidStateException
	 */
	public function addResource($name);

}
