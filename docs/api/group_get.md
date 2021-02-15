## group_get
Возвращает даные группы.

### Параметры:
- ```token``` (string, required) - токен сессии
- ```group_id```, ```group``` - (string) любой из идентификаторов группы
```json
{
  "token": "2423fdsf",
  "group": "users"
}
```

### Результат:
- ```group``` (string) - имя группы
- ```description``` (string) - описание
- ```default``` (boolean) - true, используется по умолчанию для пользователей без группы
- ```permissions``` ([string]) - список разрешений 
 
```json
{
  "success": true,
  "version": 1,
  "time": 1611679631,
  "data": {
      "group_id": "09173de1", 
      "group": "users",
      "description": "пользователи",
      "permissions": ["get", "list"],
      "default": true, 
      "enable": true
  }
}
```
