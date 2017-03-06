<?php

namespace B4nan\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Role
 *
 * @ORM\Table(name="role", indexes={@ORM\Index(name="parent", columns={"parent_id"})})
 * @ORM\Entity
 */
class Role implements IEntity
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
	 * @var integer
	 *
	 * @ORM\Column(name="parent_id", type="integer", nullable=true)
	 */
	protected $parent;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="name", type="string", length=100, nullable=false)
	 */
	protected $name;

	/**
	 * @ORM\ManyToMany(targetEntity="User", mappedBy="roles")
	 * @ORM\JoinTable(name="user2role")
	 */
	protected $users;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->users = new \Doctrine\Common\Collections\ArrayCollection;
	}

}
