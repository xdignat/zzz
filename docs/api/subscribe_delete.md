## subscribe_delete
Отписаться. Удаляет подписку.

### Параметры:
- ```token``` (string, required) - токен сессии
- ```subscribe_id``` (string) - id подписки 
- ```rubric_id```, ```rubric``` идентификатор рубрики
- ```user_id```, ```user```, ```email``` - (string) любой из идентификаторов пользователя
```json
{
  "token": "2423fdsf",
  "subscribe": "436de39f",
}
```
или
```json
{
  "token": "2423fdsf",
  "rubric": "news",
}
```
