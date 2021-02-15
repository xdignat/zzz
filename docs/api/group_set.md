## group_set
Устанавливает даные группы.

### Параметры:
- ```token``` (string, required) - токен сессии
- ```group_id``` (integer) - id группы
- ```group``` (string) - имя группы
- ```description``` (string) - описание
- ```default``` (boolean) - true, используется по умолчанию для пользователей без группы
- ```permissions``` ([string]) - список разрешений 
```json
{
  "token": "2423fdsf",
  "group": "users",
  "values": {
      "group": "users",
      "description": "пользователи",
      "permissions": ["get", "list"],
      "default": true, 
      "enable": true
  }
}
```

