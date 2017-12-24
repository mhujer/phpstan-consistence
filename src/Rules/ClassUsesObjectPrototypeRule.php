<?php declare(strict_types = 1);

namespace Mhujer\PHPStanConsistence\Rules;

use Consistence\Type\ObjectMixinTrait;
use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use PHPStan\Analyser\Scope;
use PHPStan\Broker\Broker;

class ClassUsesObjectPrototypeRule implements \PHPStan\Rules\Rule
{

	/**
	 * @var \PHPStan\Broker\Broker
	 */
	private $broker;

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
		$fullyQualifiedClassName = $scope->getNamespace() . '\\' . $className;

		// anonymous classes are not analyzed
		if (!$this->broker->hasClass($fullyQualifiedClassName)) {
			return [];
		}

		$classReflection = $this->broker->getClass($fullyQualifiedClassName);

		$parentClass = $classReflection->getParentClass();
		if ($parentClass === false) { // does not extend anything
			return [
				sprintf(
					'Class "%s" should extend \Consistence\ObjectPrototype',
					$className
				),
			];
		}

		if (!$classReflection->hasTraitUse(ObjectMixinTrait::class)) {
			return [
				sprintf(
					'Class %s should use \Consistence\Type\ObjectMixinTrait',
					$className
				),
			];
		}

		return [];
	}

}
