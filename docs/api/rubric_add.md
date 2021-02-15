## rubric_add
Добавляет новую рубрику.

### Параметры:
- ```token``` (string, required) - токен сессии
- ```rubric``` (string) - имя рубрики
- ```description``` (string) - описание
```json
{
  "token": "2423fdsf",
  "values": {
      "rubric": "news", 
      "description": "новости",
      "enable": true
  }
}
```

### Результат:
- ```rubric_id``` (string) - id 
```json
{
  "success": true,
  "version": 1,
  "time": 1611679631,
  "data": {
      "rubric_id": "436de39f",
  }
}
```
