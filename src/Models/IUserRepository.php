<?php

namespace B4nan\Models;

use B4nan\Entities\BaseEntity;

/**
 * Interface IUserRepository
 * @author Martin Adámek <martinadamek59@gmail.com>
 */
interface IUserRepository
{

	/**
	 * @param array|int $where
	 * @return BaseEntity
	 */
	public function get($where);

	/**
	 * @param BaseEntity $entity
	 * @param bool $flush
	 * @return int
	 */
	public function persist($entity, $flush = TRUE);

}
