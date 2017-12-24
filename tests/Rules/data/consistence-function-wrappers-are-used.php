<?php declare(strict_types = 1);

namespace ConsistenceFunctionWrappersAreUsed;

class ClassWithMethods
{

	public function foo(): void
	{
		$res = in_array('a', ['a', 'b']);

		array_map(function ($el) {
			return $el + 1;
		}, [1, 2, 3]);

		if (array_key_exists(1, ['a', 'b', 'c'])) {
			echo 'a';
		}

		array_search('a', ['a', 'b', 'c']);

		array_filter(['a', 'b', 'c'], function ($el) {
			return true;
		});

		array_unique([1, '1', true]);

		// verify that anonymous function call is properly handled
		$anonymous = function () {
			return 'a';
		};
		$anonymous();

		// this function does not have a wrapper in Consistence
		substr('hello world', 0, 3);
	}

}
