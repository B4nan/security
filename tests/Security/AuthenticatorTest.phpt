<?php

namespace B4nan\Tests\Security;

use B4nan\Tests\PresenterTestCase;
use Nette\Security\AuthenticationException;
use Nette\Security\IAuthenticator;
use Nette\Security\IIdentity;
use Tester\Assert;

$container = require __DIR__ . '/../bootstrap.container.php';

/**
 * authenticator test
 *
 * @testCase
 * @author Martin Adámek <martinadamek59@gmail.com>
 */
class AuthenticatorTest extends PresenterTestCase
{

	private $authenticator;

	public function setUp()
	{
		$this->authenticator = $this->container->getByType(IAuthenticator::class);
	}

	public function testUserNotExists()
	{
		Assert::exception(function() {
			$this->authenticator->authenticate(['admin', 'test']);
		}, AuthenticationException::class, "User 'admin' does not exist.");
	}

	public function testWrongPassword()
	{
		Assert::exception(function() {
			$this->authenticator->authenticate(['admin@B4nan.com', 'test']);
		}, AuthenticationException::class, 'Invalid password.');
	}

	public function testSuccess()
	{
		$i = $this->authenticator->authenticate(['admin@B4nan.com', 'admin']);
		Assert::type(IIdentity::class, $i);
	}

}

// run test
run(new AuthenticatorTest($container));
