<?php

namespace B4nan\Security;

use B4nan\Models\IAccessControlRepository;
use Nette\Security\Permission;
use Nette\Caching\Cache;
use Nette\Caching\IStorage;
use Nette\Utils\Callback;

/**
 * @author Martin Adámek <adamek@royaldesign.cz>
 */
final class Authorizator extends Permission
{

	/** @var Cache */
	private $cache;

	/**
	 * init roles, resources and rules from database
	 *
	 * @param IAccessControlRepository $model
	 * @param IStorage $storage
	 */
	public function __construct(IAccessControlRepository $model, IStorage $storage)
	{
		$this->cache = new Cache($storage, 'B4nan.Authorizator');
		$model->setAuthorizator($this);

		// roles
		$roles = $this->cache->load('roles', Callback::closure($model, 'getRoles'));
		foreach ($roles as $role) {
			$parent = $role->parent ? $role->parent->name : NULL;
			$this->addRole($role->name, $parent);
		}

		// resources
		$resources = $this->cache->load('resources', Callback::closure($model, 'getResources'));
		foreach ($resources as $resource) {
			$this->addResource($resource->name);
		}

		// rules
		$rules = $this->cache->load('rules', Callback::closure($model, 'getRules'));
		foreach ($rules as $rule) {
			$resource = $rule->resource ? $rule->resource->name : NULL;
			$privilege = $rule->privilege ? $rule->privilege->name : NULL;
			$this->{$rule->allowed ? 'allow' : 'deny'}($rule->role->name, $resource, $privilege);
		}
	}

	public function cleanCache()
	{
		$this->cache->clean();
	}

}
