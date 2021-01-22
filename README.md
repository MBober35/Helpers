# Helpers

## Install

    php artisan vendor:publish --provider="MBober35\Helpers\ServiceProvider" --tag=public
    php artisan helpers:init

### Traits

#### CopyStubs
Трейт для пакетов, позволяет копировать файлы `.stub` в приложение. Нужно указать абсолютный путь откуда копировать и путь в приложении куда копировать.

#### ShouldSlug
Трейт генерирует slug для модели. По умолчанию поле `slug` на основе `title`

#### CopyVue
Трейт для пакетов, позволяет подключить `vue` файлы после их публикации.

### Components

#### x-re-captcha
Вывод кнопки для отправки формы с защитой Google ReCaptcha. В `<head>` должен быть `@stack('js-lib')` 

Параметры:
- `callback`: функция, которая будет вызвана после проверки
- `form-id`: id формы, если передан параметр, js функция будет добавлена
- `type`: Тип кнопки
- `class`: Класс кнопки
- `id`: Id кнопки
- `no-script`: Не добавлять скрипт Google Api

### Validation

#### ReCaptcha
Валидация Google ReCaptcha