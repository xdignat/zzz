## app_exist
Проверить наличие приложения.

### Параметры:
- ```token``` - (string, required) токен сессии
- ``app_id```, ```app``` - (string) любой из идентификаторов приложения
```json
{
  "token": "2423fdsf",
  "app": "browser"
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
