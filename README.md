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
composer require predis/predis
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



#### Получить все записи

###### Используемый метод - GET

###### URI - http://gexabyte/api/ad

###### Поля:



| Имя поля | Статус        | Тип переменной | Значение                                             |
| :------- | ------------- | -------------- | ---------------------------------------------------- |
| page     | Необязательно | строка         | Номер страницы                                       |
| price    | Необязательно | строка         | sort - прямая сортировка; desc - обратная сортировка |
| date     | Необязательно | строка         | sort - прямая сортировка; desc - обратная сортировка |



#### Получить одну запись

###### Используемый метод - GET

###### URI - http://gexabyte/api/ad/{id}

###### Ключи - 

​		id - id записи

