# Rule checker

PHPUnit command `./vendor/bin/phpunit --bootstrap vendor/autoload.php --testdox tests`

```
PHPUnit 8.2.5 by Sebastian Bergmann and contributors.

RuleChecker
 ✔ When argument type is invalid then throw type error with data set "Integer argument 1"
 ✔ When argument type is invalid then throw type error with data set "Integer argument 33"
 ✔ When argument type is invalid then throw type error with data set "Integer argument 666"
 ✔ When argument type is invalid then throw type error with data set "Object argument"
 ✔ When argument type is invalid then throw type error with data set "Array argument"
 ✔ When argument type is invalid then throw type error with data set "Boolean argument"
 ✔ When items pass rule then return true with data set #0
 ✔ When items pass rule then return true with data set #1
 ✔ When items pass rule then return true with data set #2
 ✔ When items pass rule then return true with data set #3
 ✔ When items pass rule then return true with data set #4
 ✔ When items pass rule then return true with data set #5
 ✔ When items pass rule then return true with data set #6
 ✔ When items pass rule then return true with data set #7
 ✔ When items not pass rule then return false with data set #0
 ✔ When items not pass rule then return false with data set #1
 ✔ When items not pass rule then return false with data set #2
 ✔ When items not pass rule then return false with data set #3
 ✔ When items not pass rule then return false with data set #4
 ✔ Check items for test app jobs rules with data set "((13  OR 3  OR 2 )) should return TRUE"
 ✔ Check items for test app jobs rules with data set "((54  OR 77 ) AND 17  AND 59  AND 36 ) OR ((2  AND 36 )) should return FALSE"
 ✔ Check items for test app jobs rules with data set "((2  OR 3  OR 13 ) AND 30 ) should return FALSE"
 ✔ Check items for test app jobs rules with data set "((2 )) OR ((13  OR 4 ) AND (17 )) should return TRUE"
 ✔ Check items for test app jobs rules with data set "((2 )) OR ((13  OR 3 ) AND 17 ) should return TRUE"
 ✔ Check items for test app jobs rules with data set "((2  AND 30 ) OR (3  AND 30 )) should return FALSE"

Time: 30 ms, Memory: 4.00 MB

OK (25 tests, 25 assertions)
```