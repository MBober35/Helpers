# Helpers

Для управления сайтом можно скачать и добавить тему [AdminKit](https://github.com/adminkit/adminkit), под нее созданы шаблоны `adminkit`

В js прописаны ссылки на тему, что бы не использховать ее, нужно почистить созданные js и scss, которые относятся к теме, и webpack

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

## Validation

### ReCaptcha
Валидация Google ReCaptcha