## user_exist
Проверить наличие рубрики.

### Параметры:
- ```token``` - (string, required) токен сессии
- ```rubric_id```, ```rubric``` - (string) любой из идентификаторов рубрики
```json
{
  "token": "2423fdsf",
  "rubric": "news"
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
