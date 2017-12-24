<?php declare(strict_types = 1);

namespace Mhujer\PHPStanConsistence\Rules;

class ConsistenceFunctionWrappersAreUsedRuleTest extends \PHPStan\Testing\RuleTestCase
{

	protected function getRule(): \PHPStan\Rules\Rule
	{
		return new ConsistenceFunctionWrappersAreUsedRule();
	}

	public function testConsistenceFunctionWrappersAreUsed(): void
	{
		$this->analyse([__DIR__ . '/data/consistence-function-wrappers-are-used.php'], [
			[
				'Consistence ArrayType::containsValue($haystack, $needle) should be used instead of plain in_array',
				10,
			],
			[
				'Consistence ArrayType::mapValuesByCallback($haystack, $callback) should be used instead of plain array_map',
				12,
			],
			[
				'Consistence ArrayType::containsKey($haystack, $key) should be used instead of plain array_key_exists',
				16,
			],
			[
				'Consistence ArrayType::findKey($haystack, $needle) or getKey($haystack, $needle) should be used instead of plain array_search',
				20,
			],
			[
				'Consistence ArrayType::filterValuesByCallback($haystack, $callback) should be used instead of plain array_filter',
				22,
			],
			[
				'Consistence ArrayType::uniqueValues($haystack) should be used instead of plain array_unique (which does loose comparison)',
				26,
			],
		]);
	}

}
