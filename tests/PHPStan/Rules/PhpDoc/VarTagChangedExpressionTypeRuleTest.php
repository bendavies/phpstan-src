<?php declare(strict_types = 1);

namespace PHPStan\Rules\PhpDoc;

use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

/**
 * @extends RuleTestCase<VarTagChangedExpressionTypeRule>
 */
class VarTagChangedExpressionTypeRuleTest extends RuleTestCase
{

	protected function getRule(): Rule
	{
		return new VarTagChangedExpressionTypeRule(new VarTagTypeRuleHelper(true));
	}

	public function testRule(): void
	{
		$this->analyse([__DIR__ . '/data/var-tag-changed-expr-type.php'], [
			[
				'PHPDoc tag @var with type string is not subtype of native type int.',
				17,
			],
			[
				'PHPDoc tag @var with type string is not subtype of type int.',
				37,
			],
			[
				'PHPDoc tag @var with type string is not subtype of native type int.',
				54,
			],
			[
				'PHPDoc tag @var with type string is not subtype of native type int.',
				73,
			],
		]);
	}

	public function testAssignOfDifferentVariable(): void
	{
		$this->analyse([__DIR__ . '/data/wrong-var-native-type.php'], [
			[
				'PHPDoc tag @var with type string is not subtype of type int.',
				95,
			],
		]);
	}

}
