## app_add
Добавляет новое приложение.

### Параметры:
- ```token``` (string, required) - токен сессии
- ```app``` (string) - имя приложения
- ```description``` (string) - описание
- ```default``` (boolean) - true, использовать по умолчанию
- ```permissions``` ([string]) - список разрешений 
```json
{
  "token": "2423fdsf",
  "values": {
      "app": "myapp",
      "description": "Моё приложение",
      "permissions": ["test"], 
      "default": false, 
      "enable": true
  }
}
```

### Результат:
- ```app_id``` (string) - id 
```json
{
  "success": true,
  "version": 1,
  "time": 1611679631,
  "data": {
      "app_id": "436de39f",
  }
}
```
