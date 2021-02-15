## subscribe_get
Возвращает данные подписки.

### Параметры:
- ```token``` (string, required) - токен сессии
- ```subscribe_id``` (string) - id подписки 
- ```rubric_id```, ```rubric``` идентификатор рубрики
- ```user_id```, ```user```, ```email``` - (string) любой из идентификаторов пользователя



```json
{
  "token": "2423fdsf",
  "subscribe_id": "436de39f"
}
```
или
```json
{
  "token": "2423fdsf",
  "rubric": "news",
  "user": "user"
}
```

### Результат:
- ```subscribe_id``` (string) - id подписки 
- ```description``` (string) - описание
- ```user_name``` (string) - имя пользователя
```json
{
  "success": true,
  "version": 1,
  "time": 1611679631,
  "data": {
      "subscribe_id": "436de39f",
      "rubric_id": "5629336a", 
      "rubric": "news", 
      "description": "новости",
      "user_id": "123456",
      "user_name": "Иван Иваныч"
  }
}
```
