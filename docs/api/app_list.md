## app_list
Возвращает список приложений.

### Параметры:
- ```token``` (string, required) - токен сессии
```json
{
  "token": "2423fdsf"
}
```

### Результат:
- ```app``` (string) - имя приложения
- ```description``` (string) - описание
- ```default``` (boolean) - true, использовать по умолчанию
- ```permissions``` ([string]) - список разрешений 
 
```json
{
  "success": true,
  "version": 1,
  "time": 1611679631,
  "data": [
    {
      "app_id": "09173de1", 
      "app": "browser",
      "description": "браузеры",
      "permissions": ["test"], 
      "default": true, 
      "enable": true
    }
    {
      "app_id": "09173de1", 
      "app": "myapp",
      "description": "Моё приложение",
      "permissions": ["test"],
      "enable": true
    }
  ]
}
```
