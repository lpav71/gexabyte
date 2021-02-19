<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


# API приложение. Используется REDIS и имеет тесты



## Настройка и запуск

В файле .env

```
DB_CONNECTION=pgsql
DB_PORT=5432
CACHE_DRIVER=redis
```

Прописать настройки вашего сервера БД.

Используемая СУБД - PostgreSQL.

Выполнить в консоли:

```
composer install
php artisan migrate
```

## Краткая документация



#### Добавить запись

###### Используемый метод - POST

###### URI - http://gexabyte/api/ad

###### Поля:



| Имя поля    | Статус      | Тип переменной | Значение             |
| :---------- | ----------- | -------------- | -------------------- |
| text        | Обязательно | строка         | Заголовок объявления |
| price       | Обязательно | строка         | Цена                 |
| description | Обязательно | строка         | Текст объявления     |
| images      | Обязательно | JSON           | Изображения          |

Пример ответа:

```json
{
  "result": "success",
  "id": 216
}
```



#### Получить все записи

###### Используемый метод - GET

###### URI - http://gexabyte/api/ad

###### Поля:



| Имя поля | Статус        | Тип переменной | Значение                                                     |
| :------- | ------------- | -------------- | ------------------------------------------------------------ |
| page     | Необязательно | строка         | Номер страницы                                               |
| price    | Необязательно | строка         | Сортировка по цене<br /> sort - прямая сортировка; <br />desc - обратная сортировка |
| date     | Необязательно | строка         | Сортировка по дате<br />sort - прямая сортировка; <br />desc - обратная сортировка |

Пример ответа

```json
{
    "current_page": 1,
    "data": [
        {
            "id": 185,
            "text": "Текст объявления 3",
            "price": "5245",
            "links": "image1"
        },
        {
            "id": 183,
            "text": "Текст объявления 3",
            "price": "5245",
            "links": "image1"
        }
    ],
    "first_page_url": "?page=1",
    "from": 1,
    "last_page": 6,
    "last_page_url": "?page=6",
    "links": [
        {
            "url": null,
            "label": "&laquo; Previous",
            "active": false
        },
        {
            "url": "?page=1",
            "label": 1,
            "active": true
        }
    ],
    "next_page_url": "?page=2",
    "path": "",
    "per_page": 10,
    "prev_page_url": null,
    "to": 10,
    "total": 53
}
```



#### Получить одну запись

###### Используемый метод - GET

###### URI - http://gexabyte/api/ad/{id}

###### Ключи - 

​		id - id записи

​		Например: http://gexabyte/api/ad/122 - показать запись имеющую id = 122

###### Поля:

| Имя поля | Статус        | Тип переменной | Значение                                                     |
| :------- | ------------- | -------------- | ------------------------------------------------------------ |
| fields   | Необязательно | строка         | images - показать ссылки на все изображения;<br />description - показать текст объявления.<br />Значения указываются через запятую. |

Пример ответа:

```json
{
  "text": "Текст объявления 7",
  "price": "686.33",
  "image": "image1",
  "images": "[\"image1\",\"image2\",\"image3\"]",
  "description": "Описание 7"
}
```

