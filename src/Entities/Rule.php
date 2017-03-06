<?php

namespace B4nan\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Acl
 *
 * @ORM\Table(name="acl", indexes={@ORM\Index(name="role", columns={"role_id"}), @ORM\Index(name="privilege", columns={"privilege_id"}), @ORM\Index(name="resource", columns={"resource_id"})})
 * @ORM\Entity
 */
class Rule implements IEntity
{
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="id", type="integer", nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	protected $id;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="allowed", type="boolean", nullable=false)
	 */
	protected $allowed;

	/**
	 * @var \B4nan\Entities\Role
	 *
	 * @ORM\ManyToOne(targetEntity="B4nan\Entities\Role")
	 * @ORM\JoinColumns({
	 *   @ORM\JoinColumn(name="role_id", referencedColumnName="id")
	 * })
	 */
	protected $role;

	/**
	 * @var \B4nan\Entities\Privilege
	 *
	 * @ORM\ManyToOne(targetEntity="B4nan\Entities\Privilege")
	 * @ORM\JoinColumns({
	 *   @ORM\JoinColumn(name="privilege_id", referencedColumnName="id")
	 * })
	 */
	protected $privilege;

	/**
	 * @var \B4nan\Entities\Resource
	 *
	 * @ORM\ManyToOne(targetEntity="B4nan\Entities\Resource")
	 * @ORM\JoinColumns({
	 *   @ORM\JoinColumn(name="resource_id", referencedColumnName="id")
	 * })
	 */
	protected $resource;


}
