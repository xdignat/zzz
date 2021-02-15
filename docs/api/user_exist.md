## user_exist
Проверить наличие пользователя.

### Параметры:
- ```token``` - (string, required) токен сессии
- ```user_id```, ```user```, ```email``` - (string) любой из идентификаторов пользователя
```json
{
  "token": "2423fdsf",
  "user": "ivanov"
}
```

### Результат:
```json
{
  "success": true,
  "version": 1,
  "time": 1611679631,
  "data": true
}
```
