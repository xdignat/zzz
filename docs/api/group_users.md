## group_get
Получить список пользователей в группе.

### Параметры:
- ```token``` (string, required) - токен сессии
- ```group_id```, ```group``` - (string) любой из идентификаторов группы
```json
{
  "token": "2423fdsf",
  "group": "users"
}
```

### Результат:
- ```user_id``` (string)
- ```login``` (string)
- ```email``` (string)
- ```name``` (string)
```json
{
  "success": true,
  "version": 1,
  "time": 1611679631,
  "data": [
    {
      "user_id": "09173de1", 
      "login": "ivanov", 
      "email": "user@mail.com", 
      "name": "Иванов", 
      "enable": true
    }
  ]
}
```
