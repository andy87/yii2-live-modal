
Модальные окна.

Настройки.

Добавить в `Yii::$app->params` ключи
 - `liveModalCommonContainerId` - id контейнера для модальных окон.
 - `liveModalCommonContainerTemplate` - шаблон контейнера для модальных окон.
 - `liveModalCommonJsLibrary` - имя переменной для хранения данных модальных окон в JS окружении.


   
1. Использование.

Доступно два типа модальных окон:
  - Отдельное модальное окно.
  - Коллекция модальных окон.


Одно модальное окно.

Регистрация в контроллере.


Добавление кнопки, посылающей запрос и открывающей модальное окно.
```php
// добавление модального окна "зарегистрированного" в контроллере
echo $modalCreate->displayButton('Добавить');

// добавление кнопки "зарегистрированной" в шаблоне(view)
echo LiveModalView::constructButton( Blog::CAN_ADD, 'Добавить', '/api/request/path' );
```

Добавление контейнера в который "вставляется" контент полученный из запроса.
```php
// добавление персонального контейнера для модального окна "зарегистрированного" в контроллере.
// Если у модального окна персональный контейнер.
echo $modalCreate->displayContainer();

// добавление общего контейнера в который по умолчанию вставляется контент
echo LiveModalView::constructContainer();
```




Настройка коллекции.



Настраивается в контроллере.
```php
$liveModalCollection = new LiveModalCollection([
    Part::MODAL_COLLECTION_1 => new LiveModalGroup([
        'modalCreate_1' => LiveModal::class,
        'modalCreate_2' => LiveModal::class,
    ]),
    Part::MODAL_COLLECTION_2 => new LiveModalGroup([
        'modalView_1' => LiveModal::class,
        'modalView_2' => LiveModal::class,
    ], containerId: 'personalContainerGroup2',),
],'/api/common/endpoint', 'containerIdCollection', '@frontend/views/modal/liveModalViewContainer.php' );
```

Отображение кнопок.
```php
echo $liveModalCollection->displayButton('modalCreate_1');
echo $liveModalCollection->displayButton('modalCreate_2', 'personal btn text modalCreate_2', 'personalContainerCreate_2');
echo $liveModalCollection->displayButton('modalView_1');
echo $liveModalCollection->displayButton('modalView_2', 'personal btn text modalView_2', 'personalContainerView_2' );
```

Добавление контейнеров.
```php
echo $liveModalCollection->displayContainer(Blog::LIVE_MODAL_COLLECTION_1 );
echo $liveModalCollection->displayContainer(Blog::LIVE_MODAL_COLLECTION_2 ); 
```


В контроллере