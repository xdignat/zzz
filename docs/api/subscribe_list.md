## subscribe_list
Возвращает список подписок.

### Параметры:
- ```token``` (string, required) - токен сессии
- ```user_id```, ```user```, ```email``` (string) - идентификатор пользователя. По умолчанию пользователь текущей сессии. 
```json
{
  "token": "2423fdsf",
  "login": "ivanov"
}
```

### Результат:
- ```subscribe``` (string) - id подписки 
- ```rubric``` (string) - имя рубрики 
- ```description``` (string) - описание
```json
{
  "success": true,
  "version": 1,
  "time": 1611679631,
  "data": [
    {
      "subscribe": "436de39f",
      "rubric_id": "8320d263", 
      "rubric": "news", 
      "description": "новости"
    }
  ]
}
```
