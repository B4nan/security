<?php

namespace B4nan\Tests\Security;

use B4nan\Entities\BaseEntity;
use B4nan\Models\IUserRepository;
use Doctrine\ORM\EntityNotFoundException;

/**
 * Class Users
 * @author Martin Adámek <martinadamek59@gmail.com>
 */
class Users implements IUserRepository
{

	/** @var array */
	private $data = [];

	/**
	 * Users constructor.
	 */
	public function __construct()
	{
		$user = new User;
		$this->data = [$user->email => $user];
	}

	/**
	 * @param array|int $where
	 * @return BaseEntity
	 */
	public function find($where)
	{
		if (! isset($this->data[$where['email']])) {
			return NULL;
		}
		return $this->data[$where['email']];
	}

	/**
	 * @param array|int $where
	 * @return BaseEntity
	 * @throws EntityNotFoundException
	 */
	public function get($where)
	{
		if (! isset($this->data[$where['email']])) {
			throw new EntityNotFoundException;
		}
		return $this->data[$where['email']];
	}

	/**
	 * @param BaseEntity $entity
	 * @param bool $flush
	 * @return int
	 */
	public function persist($entity, $flush = TRUE)
	{
		if ($flush) {
			$this->data[$entity->email] = $entity;
		}
	}

}
