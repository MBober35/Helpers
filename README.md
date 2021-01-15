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