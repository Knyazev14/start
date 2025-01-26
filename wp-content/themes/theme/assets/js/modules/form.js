class FormHandler {
    constructor(selector = "form[data-form]") {
      this.forms = document.querySelectorAll(selector);
  
      // Привязываем методы к текущему экземпляру
      this.checkRequired = this.checkRequired.bind(this);
      this.checkLength = this.checkLength.bind(this);
      this.checkPhone = this.checkPhone.bind(this);
      this.checkEmail = this.checkEmail.bind(this);
      this.checkValidateStatus = this.checkValidateStatus.bind(this);
  
      this.init();
    }
  
    // Инициализация
    init() {
      this.forms.forEach((form) => {
        form.addEventListener("submit", (event) =>
          this.handleSubmit(event, form)
        );
      });
    }
  
    // Обработчик отправки
    async handleSubmit(event, form) {
      event.preventDefault();
  
      // Проверяем состояние отправки
      if (!this.toggleSending(form, true)) return;
  
      // Валидация
      if (!this.validateForm(form)) {
        this.toggleSending(form, false);
        return;
      }
  
      // Подготовка данных
      const formData = this.prepareData(form);
  
      //Отправка и обработка ответа сервера
      await this.processFormSubmission(formData, form);
    }
  
    // Управление состоянием отправки
    toggleSending(form, isSending) {
      if (isSending && form.getAttribute("data-sending") === "true") return false;
      form.setAttribute("data-sending", isSending.toString());
      return true;
    }
  
    // Валидация формы
    validateForm(form) {
      const inputs = form.querySelectorAll(
        "[data-requiere], [data-min], [data-max], [data-phone], [data-email]"
      );
      const validators = [
        this.checkRequired,
        this.checkLength,
        this.checkPhone,
        this.checkEmail,
      ];
  
      return Array.from(inputs).every((input) =>
        validators.every((validator) => validator(input))
      );
    }
  
    // Подготовка данных
    prepareData(form) {
      const formData = new FormData(form);
      const action = form.getAttribute("data-action");
      formData.append("action", action);
      formData.append("site_url", document.location.href);
      formData.forEach((value, key) => console.log(`${key}: ${value}`));
      return formData;
    }
  
    //Отправка и обработка ответа сервера
    async processFormSubmission(formData, form) {
      try {
        const data = await this.sendToServer(formData);
        this.handleServerResponse(data, form);
      } catch (error) {
        console.error("Ошибка при отправке формы:", error);
      } finally {
        // Завершение отправки
        this.toggleSending(form, false);
      }
    }
  
    // Отправка данных на сервер
    async sendToServer(formData) {
      console.log(ajax_params.ajax_url)
      const response = await fetch(ajax_params.ajax_url, {
        method: "POST",
        body: formData,
        headers: {
          "X-Requested-With": "XMLHttpRequest",
        },
      });
      if (!response.ok) {
        throw new Error(`HTTP ошибка: ${response.status}`);
      }
      return response.json();
    }
  
    // Обработка ответа сервера
    handleServerResponse(data, form) {
      const formWrap = form.closest(".form");
      if (data.success) {
        this.toggleSent(form, true);
        console.log("Форма успешно отправлена!");
      } else {
        this.toggleSent(form, false);
        console.error(
          "Ошибка при отправке формы:",
          data.data.message,
          data.data.errors
        );
      }
    }
  
    // Форма отправлена или нет
    toggleSent(form, isSend) {
      if (isSend && form.getAttribute("data-sent") === "true") return false;
      form.setAttribute("data-sent", isSend.toString());
      return true;
    }
  
    // Проверка обязательных полей
    checkRequired(input) {
      if (input.hasAttribute("data-requiere") && input.value.trim() === "") {
        console.error(
          `Поле ${input.name || input.id} обязательно для заполнения`
        );
        this.checkValidateStatus(input, false);
        return false;
      }
      this.checkValidateStatus(input, true);
      return true;
    }
  
    // Проверка длины значения
    checkLength(input) {
      const min = input.getAttribute("data-min");
      const max = input.getAttribute("data-max");
      const length = input.value.trim().length;
  
      if (min && length < Number(min)) {
        console.error(`Поле ${input.name || input.id} слишком короткое`);
        this.checkValidateStatus(input, false);
        return false;
      }
      if (max && length > Number(max)) {
        console.error(`Поле ${input.name || input.id} слишком длинное`);
        this.checkValidateStatus(input, false);
        return false;
      }
      this.checkValidateStatus(input, true);
      return true;
    }
  
    // Проверка телефона
    checkPhone(input) {
      if (input.hasAttribute("data-phone")) {
        const pattern =
          /^[+]?\(?\d{1,4}[\s\)\(-]*\d{1,4}[\s\)\(-]*\d{1,4}[\s\)\(-]*\d{1,4}[\s\)\(-]*$/;
        if (!pattern.test(input.value.trim())) {
          console.error(
            `Неверный номер телефона в поле ${input.name || input.id}`
          );
          this.checkValidateStatus(input, false);
          return false;
        }
      }
      this.checkValidateStatus(input, true);
      return true;
    }
  
    // Проверка email
    checkEmail(input) {
      if (input.hasAttribute("data-email")) {
        const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!pattern.test(input.value.trim())) {
          console.error(`Неверный email в поле ${input.name || input.id}`);
          this.checkValidateStatus(input, false);
          return false;
        }
      }
      this.checkValidateStatus(input, true);
      return true;
    }
  
    //Изменения статуса валидности поля
    checkValidateStatus(input, isValid) {
      const parentInput = input.closest("[data-validate]");
      if(!parentInput) return;
      parentInput.setAttribute("data-validate", isValid.toString());
    }
  
  }
  
  export default FormHandler;
  