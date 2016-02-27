--------------------
OrphoMan - misspelling management
--------------------

![orphoMan](https://file.modx.pro/files/4/5/6/456757754d258eedb62fb2ee94a91e3f.png)

[en]
***
OrphoManager for MODx Revolution. Clear your content from mistakes.

### How to use
Put the snippet OrphoMan into the template or resources, where you want users can notify administrator about mistakes. To do this, you need to select the incorrect word(s) and press Ctrl+Enter.
Do not forget to set the system option "mail_to" if you want to notify the administrator.  
If the user is authenticated in the 'mgr' context (logged in ih the backend), he can see highlighted mistakes.

### System setting
- orphoman.auto_delete - Automatic removal of the mistakes that not found on the specified page.
- orphoman.email_body - Html template of the email notify message. Optional.
- orphoman.email_subject - Email subject about a mistake. Optional.
- orphoman.highlight - Enable of mistakes highlighting.
- orphoman.mail_to - Admin email.
- orphoman.tpl - Template to highlight mistakes.  By default, &lt;span class="error-text" title="{comment}"&gt;{text}&lt;/span&gt;'.
- orphoman.frontend_css - Path to the origin css file.
- orphoman.frontend_js - Path to the origin js file. 

### Properties of the snippet **Orphoman** 
* **min** - minimum number of allowed characters. By default, 5.
* **max** - maximum number of allowed characters. By default, 100.
* **tpl** - chunk of dialog template.
* **tplButton** - chunk of the information button template. If empty the button wll not be shown.
* **loadjGrowl** - Load jGrowl for notification.

In the backend you can manage found mistakes  
![List of mistakes](https://file.modx.pro/files/2/2/1/221e45255328f3eb91d177ef0c264ec2.png)

[ru]
***
Компонент для борьбы с орфографическими ошибками и опечатками на сайте.

### Как использовать
Вставляем сниппет в шаблон или только в определенные страницы, т.е. туда, где выхотите, чтобы пользователи могли уведомлять об ошибках. На странице с подключенным OrphoMan выделяем слово с ошибкой и нажимаем Ctrl+Enter. Администратору, указанному в настройках, отправится уведомление об ошибке, а сама ошибка сохранится в таблице. Не забудьте указать email администратора в системных настройках после установки пакета.
Список ошибок можно посмотреть в админке. Если администратор авторизован в админке, то ошибки на сайте будут подсвечиваться (Эта опция отключается).

### Использование на мобильных устройствах

На мобильных устройствах логика работы следующая - сначала нужно выделить слово, а затем тапнуть на веделение. Появится кнопочка с предложением отправить сообщение.
[![](https://file.modx.pro/files/b/2/1/b21ae634c94ffe1528c4a7b2ff58e2fas.jpg)](https://file.modx.pro/files/b/2/1/b21ae634c94ffe1528c4a7b2ff58e2fa.jpg)   
Дальше как описано выше - диалог->отправить->сообщение о результате.
Также реализована адаптация для мобильных - диалог сообщения об ошибке в зависимости от разрешения и ориентации телефона меняет размер и положение на странице. 
 
### Системные настройки
- orphoman.auto_delete - Автоматическое удаление исправленных (не найденных в контенте) слов.
- orphoman.email_body - Текст письма об ошибке. Не обязательно.
- orphoman.email_subject - Заголовок письма об ошибке. Не обязательно.
- orphoman.highlight - Включает выделение слов с ошибками в контенте.
- orphoman.mail_to - Email администратора, которому будет отправлено уведомление об ошибке..
- orphoman.tpl - Шаблон для выделения слов. По-умолчанию, &lt;span class="error-text" title="{comment}"&gt;{text}&lt;/span&gt;'.
- orphoman.frontend_css - Путь к файлу стилей. Чтобы отключить загрузку, нужно указать пустое значение.
- orphoman.frontend_js - Путь к файлу скриптов. Чтобы отключить загрузку, нужно указать пустое значение. 

### Параметры сниппета **Orphoman** 
* **min** - минимально допустимое количество символов. По умолчанию, 5.
* **max** - максимально допустимое количество символов. По умолчанию, 100.
* **tpl** - шаблон диалога.
* **tplButton** - шаблон кнопки "Нашли ошибку", которая отображается внизу страницы. Если ну указан, то кнопка не покажется.
* **loadjGrowl** - управляет загрузкой библиотеки jGrowl. Если она уже загружается на сайте, то тут можно её отключить.

Список всех ошибок можно посмотреть в менеджере в меню **Приложения**. Для того, чтобы перейти на страницу ресурса, в котором найдена ошибка, нужно в таблице кликнуть на ошибку.  
Подробную информацию можно получить [тут](https://modstore.pro/packages/content/orphoman). 

Feel free to suggest ideas/improvements/bugs on GitHub:
http://github.com/sergant210/OrphoMan/issues
