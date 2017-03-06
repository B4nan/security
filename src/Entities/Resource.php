<?php

namespace B4nan\Entities;

use Doctrine\ORM\Mapping as ORM;
use Kdyby\Doctrine\Entities\Attributes\Identifier;
use Kdyby\Doctrine\Entities\MagicAccessors;

/**
 * @ORM\Entity
 */
class Resource implements IEntity
{

	use Identifier, MagicAccessors;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=100, nullable=false)
	 */
	protected $name;

}
