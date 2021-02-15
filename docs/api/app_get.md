## app_get
Возвращает даные приложения.

### Параметры:
- ```token``` (string, required) - токен сессии
- ```app_id```, ```app``` - (string) любой из идентификаторов приложения
```json
{
  "token": "2423fdsf",
  "app": "myapp"
}
```

### Результат:
- ```app``` (string) - имя группы
- ```description``` (string) - описание
- ```default``` (boolean) - true, использовать по умолчанию
- ```permissions``` ([string]) - список разрешений 
 
```json
{
  "success": true,
  "version": 1,
  "time": 1611679631,
  "data": {
      "app_id": "09173de1", 
      "app": "browser",
      "description": "браузеры",
      "permissions": ["test"], 
      "default": true, 
      "enable": true
  }
}
```
