## user_list
Возвращает список пользователей.

### Параметры:
- ```token``` (string, required) - токен сессии
```json
{
  "token": "2423fdsf"
}
```

### Результат:
```json
{
  "success": true,
  "version": 1,
  "time": 1611679631,
  "data": [
    {
      "user_id": "09173de1", 
      "user": "ivanov", 
      "email": "user@mail.com", 
      "name": "Иванов", 
      "group": "users", 
      "enable": true
    }
  ]
}
```
