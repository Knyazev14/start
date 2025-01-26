class ModalHandler {
  constructor() {
    this.triggers = document.querySelectorAll("[data-btn-id]"); // Ищем все кнопки с атрибутом data-btn-id
    this.modals = new Map(); // Храним связь модальных окон и их идентификаторов

    if (this.triggers.length > 0) {
      this.init();
      console.log('work')
    }
  }

  init() {
    this.triggers.forEach((trigger) => {
      const modalId = trigger.dataset.btnId; // Получаем ID модального окна из data-btn-id
      const modal = document.querySelector(`.modal[data-modal-id="${modalId}"]`); // Ищем соответствующее модальное окно

      if (modal) {
        this.modals.set(modalId, modal); // Сохраняем модалку в карту
        this.addTriggerListener(trigger, modal); // Привязываем событие открытия
        this.addModalListeners(modal); // Привязываем события закрытия
      }
    });
  }

  // Добавляем обработчик открытия на триггер
  addTriggerListener(trigger, modal) {
    trigger.addEventListener("click", () => this.openModal(modal));
  }

  // Добавляем обработчики событий для закрытия модального окна
  addModalListeners(modal) {
    modal.addEventListener("click", (event) => {
      const isBackground = event.target === modal;
      const closeButton = event.target.closest("[data-btn-close]");
      if (isBackground || closeButton) {
        this.closeModal(modal);
      }
    });
  }

  // Метод для открытия модального окна
  openModal(modal) {
    modal.setAttribute("data-modal-close", "false");
    document.body.style.overflow = "hidden";
  }

  // Метод для закрытия модального окна
  closeModal(modal) {
    modal.removeAttribute("data-modal-close");
    document.body.style.overflow = "";
  }
}

export default ModalHandler;
