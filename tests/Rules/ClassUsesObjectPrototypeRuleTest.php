<?php declare(strict_types = 1);

namespace Mhujer\PHPStanConsistence\Rules;

class ClassUsesObjectPrototypeRuleTest extends \PHPStan\Testing\RuleTestCase
{

	protected function getRule(): \PHPStan\Rules\Rule
	{
		return new ClassUsesObjectPrototypeRule($this->createBroker());
	}

	public function testClassUsesObjectPrototype(): void
	{
		$this->analyse([__DIR__ . '/data/class-uses-object-prototype.php'], [
			[
				'Class "ClassThatDoesNotExtendAnything" should extend \Consistence\ObjectPrototype',
				8,
			],
			[
				'Class FooClassThatDoesNotUseAnyTrait should use \Consistence\Type\ObjectMixinTrait',
				20,
			],
		]);
	}

}
