<?php
//Глобальные переменные
require_once(dirname(__FILE__) . '/inc/consts.php');
//Подключение стиоей и скриптов
require_once(dirname(__FILE__) . '/inc/enqueue.php');
//Базовые настройки
require_once(dirname(__FILE__) . '/inc/base.php');
//svg-fix
require_once(dirname(__FILE__) . '/inc/svg-fix.php');
//Строковые переводы
// require_once( dirname(__FILE__) . '/inc/translate.php');



//Обработка форм
require_once(dirname(__FILE__) . '/inc/FormHandler.php');
//Атрибуты изображений
require_once(dirname(__FILE__) . '/inc/get/Image.php');
//Атрибуты
require_once(dirname(__FILE__) . '/inc/get/Get.php');

// if (file_exists(dirname(__FILE__) . '/inc/importExportDatabase.php')) {
//     require_once(dirname(__FILE__) . '/inc/importExportDatabase.php');
// }


//Кастомная нарезка картинок
require_once(dirname(__FILE__) . '/inc/customSrsetCrop.php');
