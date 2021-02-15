## session_info
Продлить сессию.

### Параметры:
- ```token``` (string, required) - токен сессии
```json
{
  "token": "2423fdsf"
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
