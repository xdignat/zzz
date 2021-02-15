## group_add
Добавляет новую группу.

### Параметры:
- ```token``` (string, required) - токен сессии
- ```group``` (string) - имя группы
- ```description``` (string) - описание
- ```default``` (boolean) - true, используется по умолчанию для пользователей без группы
- ```permissions``` ([string]) - список разрешений 
```json
{
  "token": "2423fdsf",
  "values": {
      "group": "users",
      "description": "пользователи",
      "permissions": ["get", "list"],
      "default": true, 
      "enable": true
  }
}
```

### Результат:
- ```group_id``` (string) - id 
```json
{
  "success": true,
  "version": 1,
  "time": 1611679631,
  "data": {
      "group_id": "436de39f",
  }
}
```

