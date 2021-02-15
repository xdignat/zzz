## user_set
Устанавливливает даные пользователя.

### Параметры:
- ```token``` (string, required) - токен сессии
- ```user_id```, ```user```, ```email``` (string) - идентификатор пользователя. По умолчанию пользователь текущей сессии. 
```json
{
  "token": "2423fdsf",
  "login": "ivanov",
  "values": {
    "user": "ivanov",
    "email": "user@mail.com", 
    "name": "Иванов", 
    "group": "users", 
    "enable": true
  }  
}
```
