<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Проект по REST API

**Тестовое задание (Junior PHP Developer)**

**Задача:** Разработка простого API для управления задачами

**Требуется реализовать REST API для управления списком задач (To-Do List) на PHP с
использованием Laravel.**


**Требования к реализации:**
1.  Создать Laravel-проект (если нет опыта с Laravel, можно на чистом PHP).


2. Реализовать API с CRUD-операциями для задач:

    - [x] Создание задачи: **POST /tasks** (поля: **title, description, status**).
    - [x] Просмотр списка задач: **GET /tasks** (возвращает все задачи).
    - [x] Просмотр одной задачи: **GET /tasks/{id}**.
    - [x] Обновление задачи: **PUT /tasks/{id}**.
    - [x] Удаление задачи: **DELETE /tasks/{id}**.


3. Валидация данных (например, **title** не должен быть пустым).


4. Использовать SQLite или MySQL в качестве базы данных.


5. Код должен быть загружен в GitHub/GitLab/Bitbucket.


### Я немного усложнил задачу:

- Задачи (tasks) имеют связь "многие ко многим" с таблицей исполнителей (users)
- При миграции, есть возможность заполнить базу данных тестовыми данными (15 задач, 10 пользователей), об этом ниже, в разделе "установка"
- При получении списка всех задач и просмотра одной конкретной задачи, дополнительно будут отображаться исполнители задачи (только если это не новая задача)
- У задачи есть пять статусов, они прописаны в enum TaskStatus:
- [ ] New - Новая задача. У неё не может быть исполнителей, она только создана
- [ ] Accepted - Задаче назначен исполнитель. Один или несколько исполнителей решили взяться за проект (ну или им на собрании сообщили, что на них возложена данная миссия)
- [ ] In progress - Задача в процессе разработки. Рисуется дизайн, пишется код, работа кипит
- [ ] Testing - Проект почти готов, тестирование, фикс багов
- [ ] Done - Релиз проекта, готов к продакшину.

В результате, статус задачи может иметь только эти пять состояний, а иначе выдаст ошибку валидации.


### Установка

- Склонировать репозиторий из гитхаба 
```bash

git clone git@github.com:kamil19862307/To-Do-List-Api-Laravel.git
```

- Перейти в репозирорий с проектом
```bash

cd To-Do-List-Api-Laravel
```

- Команды для докера настроены для работы из корневой дирректории, в дирректорию src (там находится laravel) переключаться не надо


- Поднять контейнеры докера (в репозитории уже есть docker-compose.yml с nginx, MySQL и composer)
```bash

docker compose up -d
```

- Установить PHP-зависимости (Composer) 
```bash

docker compose exec app composer install
```

- Скопировать файл окружения
```bash

cp .env.example .env
```

- Сгенерировать ключ laravel
```bash

docker compose exec app php artisan key:generate
```

- Выполнить миграцию и заполнить базу данных тестовыми данными (добавит 10 пользователей и 15 задач, а так же создаст связующую pivot таблицу между исполнителями и задачами)
```bash

docker compose exec app php migrate --seed
```

- Если всё прошло успешно, то проект будет по адресу (порт 8080) http://localhost:8080/api/tasks

### Какие могут возникнуть проблемы при устаовке:

- Если комп достаточно старый, то может не "подняться" контейнер с базой данных, проверить можно командой:
```bash

docker ps
```

В таком случае можно понизить версию дазы данных на более старую. В корневой дирректории находим
docker-compose.yml и меняем строку **image: mysql:8.0** на **image: mysql:5.7**

### Как обращаться к сервисам в докере

Обращаться к сервисам из корневой дирректории (у меня это To-Do List) через:

docker compose exec app

Например установить зависимости:

docker compose exec app composer install

Или сгенерировать ключ ларавель:

docker compose exec app php artisan key:generate

Или хотим создать контроллер:

docker compose exec app php artisan make:controller CustomerController

Или поработать с композером:

docker compose exec app composer require laravel/sanctum
