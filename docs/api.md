## Список методов

Обмен данных между клиентом и сервером происходит в формате Json. Клиет передаёт данные теле POST.

Для получения данных от серевера в формате XML надо в заголовке указать: ```Accept: application/xml``` либо в теле Json прописать значение ```"format": "xml"```.

### Базовые
| имя | описание |
|-----|----------|
|[status](api/status.md)|Статус сервера.|

### Сессии
| имя | описание |
|-----|----------|
|[session_open](api/session_open.md)|Открыть сессию|
|[session_close](api/session_close.md)|Закрыть сессию|
|[session_info](api/session_info.md)|Продлить сессию|
 
### Пользователи
| имя | описание |
|-----|----------|
|[user_list](api/user_list.md)|Список пользователей|
|[user_exist](api/user_exist.md)|Проверить наличие поьзователя|
|[user_get](api/user_get.md)|Получить даные пользователя|
|[user_set](api/user_set.md)|Установить данные пользователя|
|[user_add](api/user_add.md)|Добавить пользователя|
|[user_delete](api/user_delete.md)|Удалить пользователя|      

### Группы пользователей
| имя | описание |
|-----|----------|
|[group_list](api/group_list.md)|Получить список групп| 
|[group_exist](api/group_exist.md)|Проверить наличие группы|
|[group_get](api/group_get.md)|Получить данные группы|
|[group_set](api/group_set.md)|Установить даные группы| 
|[group_add](api/group_add.md)|Добавить группу|
|[group_delete](api/group_delete.md)|Удалить группу|
|[group_users](api/group_users.md)|Получить список пользователей в группе|

### Приложения
| имя | описание |
|-----|----------|
|[app_list](api/app_list.md)|Получить список приложений|
|[app_exist](api/app_exist.md)|Проверить наличие приложения|
|[app_get](api/app_get.md)|Получить данные приложения|
|[app_set](api/app_set.md)|Установить данные приложения|
|[app_add](api/app_add.md)|Добавить приложение|
|[app_delete](api/app_delete.md)|Удалить приложение|

### Рубрики
| имя | описание |
|-----|----------|
|[rubric_list](api/rubric_list.md)|Получить список рубрик|
|[rubric_exist](api/rubric_exist.md)|Проверить наличие рубрики|
|[rubric_get](api/rubric_get.md)|Получить данные рубрики|
|[rubric_set](api/rubric_set.md)|Установить данные рубрики|
|[rubric_add](api/rubric_add.md)|Добавить рубрику|
|[rubric_delete](api/rubric_delete.md)|Удалить рубрику|

### Подписка
| имя | описание |
|-----|----------|
|[subscribe_list](api/subscribe_list.md)|Получить список подписок|
|[subscribe_get](api/subscribe_get.md)|Получить данные подписки|
|[subscribe_set](api/subscribe_set.md)|Установить данные подписки|
|[subscribe_add](api/subscribe_add.md)|Подписаться|
|[subscribe_delete](api/subscribe_delete.md)|Отписаться|
|[subscribe_user_rubrics](api/subscribe_user_rubrics.md)|Получить список подписок для пользователя|
|[subscribe_user_clear](api/subscribe_user_clear.md)|Отписать пользователя от всех рубрик|
|[subscribe_rubric_users](api/subscribe_rubric_users.md)|Получить список подписчиков рубрики|
