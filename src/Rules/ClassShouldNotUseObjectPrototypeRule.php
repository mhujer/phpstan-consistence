<?php declare(strict_types = 1);

namespace Mhujer\PHPStanConsistence\Rules;

use Consistence\Enum\Enum;
use Consistence\ObjectPrototype;
use Consistence\Type\ObjectMixinTrait;
use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use PHPStan\Analyser\Scope;
use PHPStan\Broker\Broker;

/**
 * @implements \PHPStan\Rules\Rule<\PhpParser\Node\Stmt\Class_>
 */
class ClassShouldNotUseObjectPrototypeRule implements \PHPStan\Rules\Rule
{

	private Broker $broker;

	public function __construct(
		Broker $broker
	)
	{
		$this->broker = $broker;
	}

	public function getNodeType(): string
	{
		return Class_::class;
	}

	/**
	 * @param \PhpParser\Node\Stmt\Class_ $node
	 * @param \PHPStan\Analyser\Scope $scope
	 * @return string[]
	 */
	public function processNode(Node $node, Scope $scope): array
	{
		$className = $node->name;
		if ($className === null) {
			return [];
		}

		$fullyQualifiedClassName = $scope->getNamespace() . '\\' . $className;

		// anonymous classes are not analyzed
		if (!$this->broker->hasClass($fullyQualifiedClassName)) {
			return [];
		}

		$classReflection = $this->broker->getClass($fullyQualifiedClassName);

		// enums extend ObjectPrototype, so we won't check them
		if ($classReflection->isSubclassOf(Enum::class)) {
			return [];
		}

		// \Consistence\PhpException uses \Consistence\Type\ObjectMixinTrait, so we won't check them
		if ($classReflection->isSubclassOf(\Consistence\PhpException::class)) {
			return [];
		}

		$parentClass = $classReflection->getParentClass();
		if ($parentClass !== null && $parentClass->getName() === ObjectPrototype::class) {
			return [
				sprintf(
					'Class "%s" should not extend \Consistence\ObjectPrototype, you can rely on PHPStan to catch this type of errors.',
					$className->toString()
				),
			];
		}

		if ($classReflection->hasTraitUse(ObjectMixinTrait::class)) {
			return [
				sprintf(
					'Class %s should not use \Consistence\Type\ObjectMixinTrait, you can rely on PHPStan to catch this type of errors.',
					$className->toString()
				),
			];
		}

		return [];
	}

}
