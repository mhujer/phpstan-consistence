<?php declare(strict_types = 1);

namespace ClassUsesObjectPrototype;

use Consistence\ObjectPrototype;
use Consistence\Type\ObjectMixinTrait;

class ClassThatDoesNotExtendAnything
{

}

// class that extends something else and uses ObjectMixinTrait
class FooClassUsesObjectMixinTrait extends ClassThatDoesNotExtendAnything
{
	use ObjectMixinTrait;
}

// class that extends something else, but does not use ObjectMixinTrait
class FooClassThatDoesNotUseAnyTrait extends ClassThatDoesNotExtendAnything
{

}

class ClassThatExtendsObjectPrototype extends ObjectPrototype
{

}

// class with anonymous class is not analyzed
class FooWithAnonymousClass extends ObjectPrototype
{

	public function getInst()
	{
		return new class
		{
		};
	}
}

// enum
class MyValues extends \Consistence\Enum\Enum
{
}

// multi enum
class MultiValues extends \Consistence\Enum\MultiEnum
{
}

class MyException extends \Consistence\PhpException
{
}
