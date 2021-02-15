## user_add
Добавляет нового пользователя.

### Параметры:
- ```token``` (string, required) - токен сессии
```json
{
  "token": "2423fdsf",
  "values": {
      "user": "ivanov", 
      "email": "user@mail.com", 
      "name": "Иванов", 
      "group": "users", 
      "enable": true
  }  
}
```

### Результат:
- ```user_id``` (string) - id 
```json
{
  "success": true,
  "version": 1,
  "time": 1611679631,
  "data": {
      "user_id": "436de39f",
  }
}
```
