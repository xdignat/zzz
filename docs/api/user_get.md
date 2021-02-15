## user_get
Возвращает даные пользователя.

### Параметры:
- ```token``` (string, required) - токен сессии
- ```id```, ```user```, ```email``` (string) - идентификатор пользователя. По умолчанию пользователь текущей сессии. 
```json
{
  "token": "2423fdsf",
  "login": "ivanov"
}
```

### Результат:
```json
{
  "success": true,
  "version": 1,
  "time": 1611679631,
  "data": {
      "user_id": "09173de1", 
      "user": "ivanov", 
      "email": "user@mail.com", 
      "name": "Иванов", 
      "group": "users", 
      "enable": true
  }
}
```
