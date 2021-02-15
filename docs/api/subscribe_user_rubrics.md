## subscribe_user_rubrics
Получить список подписок для пользователя

### Параметры:
- ```token``` (string, required) - токен сессии
- ```user_id```, ```user```, ```email``` (string) - идентификатор пользователя. По умолчанию пользователь текущей сессии. 
```json
{
  "token": "2423fdsf",
  "rubric": "news"
}
```

### Результат:
- ```user_id``` - id пользователя, 
- ```user``` (string) - логин пользователя 
- ```email``` (string) - email пользователя 
- ```subscribe``` (string) - id подписки 
```json
{
  "success": true,
  "version": 1,
  "time": 1611679631,
  "data": [
    {
      "user_id": "09173de1", 
      "user": "ivanov", 
      "email": "ivanov@user.com", 
      "subscribe": "436de39f",
    }
    {
      "user_id": "73de1345", 
      "user": "petrov", 
      "email": "petrov@user.com", 
      "subscribe": "39f435ed",
    }
  ]
}
```
