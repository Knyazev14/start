<?php

class FormHandler
{
    private $required_fields;
    private $email_to;
    private $email_title;
    private $nonce_action;
    private $email_from;
    private $field_limits;

    public function __construct($required_fields = [], $email_to = '', $email_title = '', $nonce_action = '', $email_from = '', $field_limits = [])
    {
        $this->required_fields = $required_fields;
        $this->email_to = $email_to;
        $this->email_title = $email_title;
        $this->nonce_action = $nonce_action;
        $this->email_from = $email_from;
        $this->field_limits = $field_limits;

        add_action('wp_ajax_nopriv_' . $nonce_action, [$this, 'formHandler']);
        add_action('wp_ajax_' . $nonce_action, [$this, 'formHandler']);
    }

    public function formHandler()
    {
        $this->checkSecurity();
        $this->checkBots();

        $validators = [
            [$this, 'checkRequired'],
            [$this, 'checkLength'],
            [$this, 'checkPhone'],
            [$this, 'checkEmail'],
        ];

        $errors = $this->validateFields($_POST, $validators);

        if (!empty($errors)) {
            wp_send_json_error(["message" => "Ошибки валидации", "errors" => $errors]);
        }

        // Удаляем ненужные поля перед отправкой
        $filtered_data = $this->filterFields($_POST);

        // Отправка письма
        $this->sendEmail($filtered_data);

        wp_send_json_success(["message" => "Форма успешно отправлена!"]);
    }

    //Проверка безопасности----------------------------------------------------------------------
    private function checkSecurity()
    {
        check_ajax_referer($this->nonce_action, '_wpnonce');
    }

    //Проверка на ботов---------------------------------------------------------------------------
    private function checkBots()
    {
        if (!empty($_POST['email_requiere']) || !isset($_POST['email_requiere'])) {
            wp_send_json_error(["message" => "Suspicious activity detected.", "errors" => "Обнаружены боты."]);
            die();
        }
    }

    //Валидация полей---------------------------------------------------------------------------
    private function validateFields($data, $validators)
    {
        $errors = [];
        foreach ($validators as $validator) {
            $result = call_user_func($validator, $data);
            if (!empty($result)) {
                $errors = array_merge($errors, $result);
            }
        }
        return $errors;
    }

    //Проверка обязательных полей----------------------------------------------------------------
    private function checkRequired($data)
    {
        $errors = [];
        foreach ($this->required_fields as $field) {
            if (empty($data[$field])) {
                $errors[$field] = "Поле $field обязательно для заполнения.";
            }
        }
        return $errors;
    }

    //Проверка количества символов------------------------------------------------------------------
    private function checkLength($data)
    {
        $errors = [];
        foreach ($this->field_limits as $field => $limits) {
            if (!empty($data[$field])) {
                $length = mb_strlen($data[$field]);
                if (isset($limits['min']) && $length < $limits['min']) {
                    $errors[$field] = "Поле $field слишком короткое. Минимум {$limits['min']} символов.";
                }
                if (isset($limits['max']) && $length > $limits['max']) {
                    $errors[$field] = "Поле $field слишком длинное. Максимум {$limits['max']} символов.";
                }
            }
        }
        return $errors;
    }

    //Проверка телефона---------------------------------------------------------------------------
    private function checkPhone($data)
    {
        $errors = [];
        if (!empty($data['phone']) && !preg_match('/^[+]?\(?\d{1,4}[\s\)\(-]*\d{1,4}[\s\)\(-]*\d{1,4}[\s\)\(-]*\d{1,4}[\s\)\(-]*$/', $data['phone'])) {
            $errors['phone'] = "Неверный номер телефона.";
        }
        return $errors;
    }

    //Проверка email-------------------------------------------------------------------------
    private function checkEmail($data)
    {
        $errors = [];
        if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Неверный email адрес.";
        }
        return $errors;
    }

    // Удаление ненужных полей---------------------------------------------------------------------
    private function filterFields($data)
    {
        $ignored_fields = ['_wpnonce', 'email_requiere', 'action'];
        return array_diff_key($data, array_flip($ignored_fields));
    }

    // Отправка письма-------------------------------------------------------------------------------
    private function sendEmail($data)
    {
        $message = '';
        foreach ($data as $key => $value) {
            if (!empty($value)) { // Проверка на непустое значение
                $message .= ucfirst($key) . ": " . htmlspecialchars($value, ENT_QUOTES, 'UTF-8') . "\n";
            }
        }

        // Проверяем, есть ли данные для отправки
        if (!empty($message)) {
            wp_mail($this->email_to, $this->email_title, $message, ['From: ' . $this->email_from]);
        } else {
            wp_send_json_error(["message" => "Нет данных для отправки.", "error" => "Нет данных для отправки."]);
        }
    }


}

new FormHandler(
    ['name', 'phone', 'email'], // Обязательные поля
    'boxinglon@gmail.com', // Получатель
    'New Application!', // Тема письма
    'default-handler', // Nonce action
    'GBRL <info@yourdomain.com>', // Отправитель
    [
        'name' => ['min' => 2, 'max' => 40],
        'phone' => ['min' => 8, 'max' => 19],
        'email' => ['min' => 7, 'max' => 50],
        'telegram' => ['max' => 50],
    ]
);
