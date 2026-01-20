</main>
<footer class="site-footer">
    <div class="container">
        <p>© <?php echo esc_html(date('Y')); ?> <?php bloginfo('name'); ?>. Все права защищены.</p>
    </div>
</footer>
<script>
  document.querySelectorAll('[data-copy]').forEach((button) => {
    button.addEventListener('click', () => {
      const value = button.getAttribute('data-copy');
      navigator.clipboard.writeText(value).then(() => {
        button.textContent = 'Скопировано';
        setTimeout(() => {
          button.textContent = 'Копировать';
        }, 1500);
      });
    });
  });

  const toggle = document.querySelector('[data-filters-toggle]');
  const backdrop = document.querySelector('[data-filters-close]');
  const body = document.body;

  if (toggle && backdrop) {
    toggle.addEventListener('click', () => {
      body.classList.add('filters-open');
    });
    backdrop.addEventListener('click', () => {
      body.classList.remove('filters-open');
    });
  }
</script>
<?php wp_footer(); ?>
</body>
</html>
