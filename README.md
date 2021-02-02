# Helpers

Для управления сайтом можно скачать и добавить тему [AdminKit](https://github.com/adminkit/adminkit), под нее созданы шаблоны для меню

## Install

    php artisan vendor:publish --provider="MBober35\Helpers\ServiceProvider" --tag=public
    php artisan helpers:init

## Menu

Расширить конфиг `menu-structure`, по умолчанию в нем есть две переменные `app` и `admin`

## Variables

- `RE_CAPTCHA_SITE_KEY`
- `RE_CAPTCHA_SECRET_KEY`

## Traits

### CopyStubs
Трейт для пакетов, позволяет копировать файлы `.stub` в приложение. Нужно указать абсолютный путь откуда копировать и путь в приложении куда копировать.

### ShouldSlug
Трейт генерирует slug для модели. По умолчанию поле `slug` на основе `title`

### CopyVue
Трейт для пакетов, позволяет подключить `vue` файлы после их публикации.

## Components

### x-re-captcha-check
Вывод Google ReCaptcha Checkbox. В `<head>` должен быть `@stack('js-lib')`

Параметры:
- `class`: Класс кнопки
- `id`: Id кнопки
- `no-script`: Не добавлять скрипт Google Api

### x-re-captcha
Вывод кнопки для отправки формы с защитой Google ReCaptcha. В `<head>` должен быть `@stack('js-lib')` 

Параметры:
- `callback`: функция, которая будет вызвана после проверки
- `form-id`: id формы, если передан параметр, js функция будет добавлена
- `type`: Тип кнопки
- `class`: Класс кнопки
- `id`: Id кнопки
- `no-script`: Не добавлять скрипт Google Api

### x-table-priority
Вывод списка элементов для смены приоритета вывода

Параметры:
- `table`: таблица в которой необходимо изменить приоритет
- `field`(priority): поле которое отвечает за приоритет
- `elements`: массив элементов

Элемент:
- `name`: Заголовок
- `id`: Id
- `url`(не обязательно): если указан, заголовок будет ссылкой

Пример:
    
    <x-table-priority table="users" :elements="$users"></x-table-priority>

## Validation

### ReCaptcha
Валидация Google ReCaptcha