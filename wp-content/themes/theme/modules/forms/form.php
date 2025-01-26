<?php defined('ABSPATH') || exit; ?>
<!-- 
    data-action - определяет обработчик на сервере
    data-form - добавляется для обработки формы через ajax
    data-form-validate - результат валидации полей формы (true/false)
    data-sending - идет ли отправка формы (true/false)
    data-sent - отправлено ли птсьмо (true/false)
    -->
<!-- 
    Поля:
    data-min и data-max - количество символов
    data-requiere - обязательное поле
    data-phone - телефон 
    -->
<form class="form load-on-vissible--js" data-action="default-handler"  data-form data-form-validate data-sending data-sent data-module="./modules/form.js">

    <label class="form__label" data-validate>
        <input class="form__input" name="name" placeholder="Name" aria-label="Nmae" data-min="2" data-max="40"
            data-requiere>
    </label>

    <label class="form__label" data-validate>
        <input class="form__input" name="telegram" placeholder="Telegram" aria-label="Telegram" data-max="40">
    </label>

    <label class="form__label" data-validate>
        <input class="form__input" name="phone" placeholder="Phone" aria-label="Phone" data-phone data-requiere
            data-min="8" data-max="19">
    </label>

    <label class="form__label" data-validate>
        <input class="form__input" name="email" placeholder="Email" aria-label="Email" data-email data-requiere
            data-min="7" data-max="50">
    </label>

    <button type="submit" name="form" value="default form">Отправить</button>

    <!-- Безопасность -->
    <input class="razzylom" name="email_requiere" aria-label="Next" autocomplete="off">
    <input type="hidden" name="_wpnonce" value="<?php echo wp_create_nonce('default-handler'); ?>">
</form>
<div class="form__notice" data-responce>
    Успешно отправлено!
</div>