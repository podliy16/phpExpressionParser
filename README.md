# phpExpressionParser

Алгоритм:

Сначала разбиваем выражение на токены.
Обрабатываем эти токены с помощью алгоритма ShuntingYard. Который переводит infix-нотацию в postfix.
Сохраняем результат постфикс-нотации.
При вызове `calculate` обходим массив и подставляем значения в переменные.