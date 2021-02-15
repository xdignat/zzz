## rubric_list
Возвращает список рубрик.

### Параметры:
- ```token``` (string, required) - токен сессии
```json
{
  "token": "2423fdsf"
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
  "data": [
    {
      "rubric_id": "09173de1", 
      "rubric": "news", 
      "description": "новости",
      "enable": true
    }
  ]
}
```
