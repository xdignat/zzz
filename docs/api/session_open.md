## session_open
Открыть сессию.

### Параметры:
- ```user```, ```email``` (string, required) - любой из идентификаторов пользователя
- ```password``` (string, required) - пароль
- ```app``` (string) - имя приложения
```json
{
  "user": "ivanov",
  "password": "123456",
  "app": "myapp",
}
```

### Результат:
- ```token``` - (string) id токена
- ```expires``` - (timestamp) время истечения срока

```json
{
  "success": true,
  "version": 1,
  "time": 1611679631,
  "data": {
    "token": "847d23ea34b3",
    "expires": 16116800561  
  }
}
```
