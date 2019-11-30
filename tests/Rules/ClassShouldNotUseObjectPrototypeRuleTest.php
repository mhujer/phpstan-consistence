<?php declare(strict_types = 1);

namespace Mhujer\PHPStanConsistence\Rules;

/**
 * @extends \PHPStan\Testing\RuleTestCase<\Mhujer\PHPStanConsistence\Rules\ClassShouldNotUseObjectPrototypeRule>
 */
class ClassShouldNotUseObjectPrototypeRuleTest extends \PHPStan\Testing\RuleTestCase
{

	protected function getRule(): \PHPStan\Rules\Rule
	{
		return new ClassShouldNotUseObjectPrototypeRule($this->createBroker());
	}

	public function testClassUsesObjectPrototype(): void
	{
		$this->analyse([__DIR__ . '/data/class-should-not-use-object-prototype.php'], [
			[
				'Class FooClassUsesObjectMixinTrait should not use \Consistence\Type\ObjectMixinTrait, you can rely on PHPStan to catch this type of errors.',
				14,
			],
			[
				'Class "ClassThatExtendsObjectPrototype" should not extend \Consistence\ObjectPrototype, you can rely on PHPStan to catch this type of errors.',
				25,
			],
			[
				'Class "FooWithAnonymousClass" should not extend \Consistence\ObjectPrototype, you can rely on PHPStan to catch this type of errors.',
				31,
			],
		]);
	}

}
