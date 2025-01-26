<footer class="footer">
    <div class="container">
        <div class="footer__body">
            Footer
        </div>
    </div>
</footer>
</div>
<?php wp_footer(); ?>

<?php
    //Модальные окна
    get_template_part('modules/modals/modal'); ?>

<script>
    window.addEventListener("load", () => {
  let script = document.createElement("script");
  script.src = "<?= THEME_PATH; ?>/assets/js/app.js"; // Путь к файлу
  document.body.appendChild(script);

  script.onload = () => {
    console.log("Скрипт app.min.js успешно загружен!");
    new DynamicLoader({
      onVisible: [".load-on-vissible--js"], // Элементы для наблюдения
      onClick: [".load-on-click--js"], // Элементы для загрузки по клику
    });
  };

  script.onerror = () => {
    console.error("Ошибка загрузки скрипта app.min.js!");
  };
});
</script>
</body>
</html>