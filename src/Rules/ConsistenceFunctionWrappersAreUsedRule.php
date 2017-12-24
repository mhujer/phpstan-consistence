<?php declare(strict_types = 1);

namespace Mhujer\PHPStanConsistence\Rules;

use PhpParser\Node;
use PhpParser\Node\Expr\FuncCall;
use PHPStan\Analyser\Scope;

class ConsistenceFunctionWrappersAreUsedRule implements \PHPStan\Rules\Rule
{

	public function getNodeType(): string
	{
		return FuncCall::class;
	}

	/**
	 * @param \PhpParser\Node\Expr\FuncCall $node
	 * @param \PHPStan\Analyser\Scope $scope
	 * @return string[]
	 */
	public function processNode(Node $node, Scope $scope): array
	{
		if (!($node->name instanceof \PhpParser\Node\Name)) {
			return [];
		}

		$functionName = $node->name->toString();

		if ($functionName === 'in_array') {
			return [
				'Consistence ArrayType::containsValue($haystack, $needle) should be used instead of plain in_array',
			];
		}

		if ($functionName === 'array_map') {
			return [
				'Consistence ArrayType::mapValuesByCallback($haystack, $callback) should be used instead of plain array_map',
			];
		}

		if ($functionName === 'array_key_exists') {
			return [
				'Consistence ArrayType::containsKey($haystack, $key) should be used instead of plain array_key_exists',
			];
		}

		if ($functionName === 'array_search') {
			return [
				'Consistence ArrayType::findKey($haystack, $needle) or getKey($haystack, $needle) should be used instead of plain array_search',
			];
		}

		if ($functionName === 'array_filter') {
			return [
				'Consistence ArrayType::filterValuesByCallback($haystack, $callback) should be used instead of plain array_filter',
			];
		}

		if ($functionName === 'array_unique') {
			return [
				'Consistence ArrayType::uniqueValues($haystack) should be used instead of plain array_unique (which does loose comparison)',
			];
		}

		return [];
	}

}
