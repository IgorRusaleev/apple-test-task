##APPLE TEST CASE

Для для определения сгнивших яблок, применить автоматисекий запуск скрипта гниения яблок.
В планировщик cron необходимо добавить задачу запуска консолькной команды приложения:
`php yii apple/rotten`

Ex: `*/5 * * * * php /path/to/project/yii apple/rotten`
(каждые 5 минут запуск скрипта гниения яблок)

При достижении яблоком размера 0%, яблоко удаляется со страницы,
так как в запрос на отображение попадают только яблоки размером больше 0%.
Поэтому функция "удалить" не реализована в связи с отсутствием необходимости.
В задании отсутствовало требование удалить яблоко из базы данных, при достижении размера 0%. 