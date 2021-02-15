## group_exist
Проверить наличие группы.

### Параметры:
- ```token``` - (string, required) токен сессии
- ```group_id```, ```group``` - (string) любой из идентификаторов группы
```json
{
  "token": "2423fdsf",
  "group": "users"
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
