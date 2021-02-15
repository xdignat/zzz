## subscribe_add
Подписаться. Добавляет новую подписку.

### Параметры:
- ```token``` (string, required) - токен сессии
- ```user_id```, ```user```, ```email``` (string) - идентификатор пользователя. По умолчанию пользователь текущей сессии. 
- ```rubric_id```, ```rubric``` (string) - идентификатор рубрики
- ```user_name``` (string) - имя пользователя
```json
{
  "token": "2423fdsf",
  "values": {
      "rubric": "news", 
      "user": "ivanov",
      "user_name": "Иван Иваныч"
  }
}
```

### Результат:
- ```subscribe``` (string) - id подписки 
```json
{
  "success": true,
  "version": 1,
  "time": 1611679631,
  "data": {
      "subscribe": "436de39f",
  }
}
```


