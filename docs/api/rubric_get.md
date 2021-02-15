## rubric_get
Возвращает даные рубрики.

### Параметры:
- ```token``` (string, required) - токен сессии
- ```rubric_id```, ```rubric``` - (string) любой из идентификаторов рубрики
```json
{
  "token": "2423fdsf",
  "rubric": "news"
}
```

### Результат:
- ```rubric``` (string) - имя рубрики
- ```description``` (string) - описание
 
```json
{
  "success": true,
  "version": 1,
  "time": 1611679631,
  "data": {
      "rubric_id": "09173de1", 
      "rubric": "news", 
      "description": "новости",
      "enable": true
  }
}
```
