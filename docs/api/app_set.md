## app_set
Устанавливает даные приложения.

### Параметры:
- ```token``` (string, required) - токен сессии
- ```app``` (string) - имя приложения
- ```description``` (string) - описание
- ```default``` (boolean) - true, использовать по умолчанию
- ```permissions``` ([string]) - список разрешений 
```json
{
  "token": "2423fdsf",
  "group": "browser",
  "values": {
      "app": "browser",
      "description": "браузеры",
      "permissions": ["test"], 
      "default": true, 
      "enable": true
  }
}
```

