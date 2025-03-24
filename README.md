## vkr-smart-sdk

SDK,помогающее внедрить функционал VKR-SMART-API в другие продукты

# 📗 Описание

- [Установка](#Установка)
- [Инициализация клиента Api](#Инициализация-клиента-API)
- [Загрузка документа](#Загрузка-документа)
- [Получение отчёта](#Получение-отчёта)
- [Получение мета-данных](#get)
- [Пример возвращаемого отчёта](#Пример-возвращаемого-отчёта)

## Установка

Простой и наиболее предпочтительный способ установки SDK - composer. Для этого изначально нужно подключить репозиторий 

```bash
"repositories": [{
        "type": "vcs",
        "url": "https://git.iprmedia.ru/gitlab/vkr-smart/sdk.git"
    }]
```

После этого можно подключать sdk к проекту

```bash
"require": {
  "vkrsmart/sdk" : "dev-master"
}
```

Другой способ - скачать архив с исходным кодм master.zip или воспользоваться git clone и вручную добавить в проект.

```bash
 git clone git@git.iprmedia.ru:vkr-smart/sdk.git
```

## Инициализация клиента API

Для инициализации клиента необходимы следующие параметры:

| Параметр  |                  Описание                  | 
|:----------|:------------------------------------------:|
| $clientId | Идентификатор организации-клиента VK-SMART |
| $token    |       Сгенерированный секретный ключ       |

Пример:

```php
$clientId = 12345;
$token = 'some-key';

$client = new Client($clientId, $token);
```
## Загрузка документа

```php
//Получение файла из запроса
$file = $request->file('file');
//Инициализация сессии,с помоощью клиента API
$document = new Document($client);
//Загрузка документа на сервер API
$document->uploadDocument($file);
//Получение ID загруженного документа
$documentId = $document->getId();
```

## Получение отчёта

```php
//Инициализация сессии,с помоощью клиента API
$report = new Report($client);
//Иниициализация отчёта
$report->get($documentId);
//Получение отчёта
$reportContent = $report->getReport();
```

## get

```php
//Получение сообщения в ответе API
$report->getMessage(); 
$document->getMessage();
```

## Пример возвращаемого отчёта

-sourceDocuments - массив найденных в загруженной работе заимствований  
--borrowings - все заимствования из документа  
--link - ссылка на найденный документ  
--percent - процент заимстования в работе из документа  
--title - название документа  

-uniquePercent - общий процент униальности работы


```json
{
  "sourceDocuments": [
    {
      "borrowings": [
        "подрядчиком) обязуется выполнить........",
        "обязуется принять результат работы и оплатить.......",
        "etc"
      ],
      "link": "https://ru.wikipedia.org/wiki/Договор_подряда",
      "percent": 2.02215768527482,
      "title": "Договор_подряда"
    },
    {
    "borrowings": [
      "заимстоваванный фрагмент 1",
      "заимстоваванный фрагмент 2",
      "заимстоваванный фрагмент 2"
    ],
    "link": "https://borrowing/url",
    "percent": 5,
    "title": "Borrowing document"
    }
  ],
  "uniquePercent": 92.97784231472518
}
```








