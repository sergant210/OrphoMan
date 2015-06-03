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
If the user is authenticated in the 'mgr' context (logged in backend), he can see highlighted mistakes.

### System setting
- orphoman.auto_delete - Automatic removal of the mistakes that not found on the specified page.
- orphoman.email_body - Html template of the email notify message. Optional.
- orphoman.email_subject - Email subject about a mistake. Optional.
- orphoman.highlight - Enable of mistakes highlighting.
- orphoman.mail_to - Admin email.
- orphoman.tpl - Template to highlight mistakes.

In the backend you can manage found mistakes  
![List of mistakes](https://file.modx.pro/files/2/2/1/221e45255328f3eb91d177ef0c264ec2.png)

[ru]
***
Компонент для борьбы с орфографическими ошибками и опечатками на сайте.

### Как использовать
Вставляем сниппет в шаблон или только в определенные страницы, т.е. туда, где выхотите, чтобы пользователи могли уведомлять об ошибках. На странице с подключенным OrphoMan выделяем слово с ошибкой и нажимаем Ctrl+Enter. Администратору, указанному в настройках, отправится уведомление об ошибке, а сама ошибка сохранится в таблице. Не забудьте указать email администратора в системных настройках после установки пакета.
Список ошибок можно посмотреть в админке. Если администратор авторизован в back-end, то ошибки на сайте будут подсвечиваться (Эта опция отключается).

### Системные настройки
- orphoman.auto_delete - Автоматическое удаление исправленных (не найденных в контенте) слов.
- orphoman.email_body - Текст письма об ошибке. Не обязательно.
- orphoman.email_subject - Заголовок письма об ошибке. Не обязательно.
- orphoman.highlight - Включает выделение слов с ошибками в контенте.
- orphoman.mail_to - Email администратора, которому будет отправлено уведомление об ошибке..
- orphoman.tpl - Шаблон для выделения слов.

Список всех ошибок можно посмотреть в админке. Посмотреть и, если нужно, удалить.
Подробную информацию можно получить [тут](https://modstore.pro/packages/content/orphoman). 

Feel free to suggest ideas/improvements/bugs on GitHub:
http://github.com/sergant210/OrphoMan/issues
