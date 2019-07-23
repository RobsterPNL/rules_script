<?php

declare(strict_types = 1);

function checkRule(string $rule): bool 
{
    $items = [2, 177];

    return eval(preg_replace_callback("/\d+/", function($matches) use ($items) {
        return var_export(in_array($matches[0], $items), true);
    }, sprintf('%s %s%s', 'return', $rule, ';')));
}

final class RuleCheckerTest extends PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider typeErrorProvider
     */
    public function testWhenArgumentTypeIsInvalidThenThrowTypeError($rule): void
    {
        $this->expectException(\TypeError::class);

        checkRule($rule);
    }

    /**
     * @dataProvider trueRulesProvider
     */
    public function testWhenItemsPassRuleThenReturnTrue($rule): void
    {
        $this->assertTrue(checkRule($rule));
    }

    /**
     * @dataProvider falseRulesProvider
     */
    public function testWhenItemsNotPassRuleThenReturnFalse($rule): void
    {
        $this->assertFalse(checkRule($rule));
    }

    /**
     * @dataProvider appJobsRulesProvider
     */
    public function testCheckItemsForTestAppJobsRules(string $rule, bool $result): void
    {
        if ($result) {
            $this->assertTrue(checkRule($rule));
        } else {
            $this->assertFalse(checkRule($rule));
        }
    }

    /**
     * @return array
     */
    public function typeErrorProvider(): array
    {
        return [
            'Integer argument 1' => [1],
            'Integer argument 33' => [33],
            'Integer argument 666' => [666],
            'Object argument' => [new \stdClass()],
            'Array argument' => [[]],
            'Boolean argument' => [true],
        ];
    }

    /**
     * @return array
     */
    public function trueRulesProvider(): array
    {
        return [
            ['(2 OR 6)'],
            ['(2 AND 177)'],
            ['(1 OR 177)'],
            ['(2 OR 177)'],
            ['(2) OR (177 AND 55)'],
            ['(2) OR 177 OR (44 AND 66)'],
            ['(177 OR 2) OR (56 AND 12)'],
            ['(77) OR 33 OR ((12 AND 99) OR 2)'],
        ];
    }

    /**
     * @return array
     */
    public function falseRulesProvider(): array
    {
        return [
            ['(2 AND 55)'],
            ['(1 OR 177 AND 55)'],
            ['(2 AND 66 AND 999 AND 34)'],
            ['((2 AND 177) OR (33)) AND 1'],
            ['(2 OR 5) AND (177 OR 3) AND (1 OR 4 OR (45))'],
        ];
    }

    /**
     * @return array
     */
    public function appJobsRulesProvider(): array
    {
        return [
            '((13  OR 3  OR 2 )) should return TRUE' => ['((13  OR 3  OR 2 ))', true],
            '((54  OR 77 ) AND 17  AND 59  AND 36 ) OR ((2  AND 36 )) should return FALSE' => ['((54  OR 77 ) AND 17  AND 59  AND 36 ) OR ((2  AND 36 ))', false],
            '((2  OR 3  OR 13 ) AND 30 ) should return FALSE' => ['((2  OR 3  OR 13 ) AND 30 )', false],
            '((2 )) OR ((13  OR 4 ) AND (17 )) should return TRUE' => ['((2 )) OR ((13  OR 4 ) AND (17 ))', true],
            '((2 )) OR ((13  OR 3 ) AND 17 ) should return TRUE' => ['((2 )) OR ((13  OR 3 ) AND 17 )', true],
            '((2  AND 30 ) OR (3  AND 30 )) should return FALSE' => ['((2  AND 30 ) OR (3  AND 30 ))', false],
        ];
    }
}