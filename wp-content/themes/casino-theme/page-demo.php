<?php
/**
 * Template Name: Demo Casino Listing
 */
get_header();
?>
<section class="container hero">
    <h1>Демо: Рейтинг казино</h1>
    <p>Пример визуального шаблона со статичными данными для согласования дизайна.</p>
</section>

<section class="container">
    <div class="filters-toolbar">
        <div class="filters-meta">Найдено казино: 124</div>
        <div class="filters-actions">
            <button class="button button--primary mobile-filters-toggle" type="button" data-filters-toggle>Фильтры</button>
            <button class="button button--ghost" type="button">Сбросить фильтры</button>
        </div>
    </div>
    <div class="filters">
        <span class="filter-chip filter-chip--active">Mobile-friendly casinos</span>
        <span class="filter-chip">Крипто казино</span>
        <span class="filter-chip">High-rollers</span>
        <span class="filter-chip filter-chip--active">Бездепозитное казино</span>
        <span class="filter-chip">Для новичков</span>
        <span class="filter-chip">С минимальным депозитом</span>
        <span class="filter-chip">Быстрые выплаты</span>
    </div>
</section>

<section class="container layout">
    <div>
        <div class="casino-grid">
            <?php
            $demo_cards = [
                [
                    'name' => 'Ninja Casino',
                    'rating' => '4.7',
                    'min_deposit' => '€10',
                    'currency' => 'EUR',
                    'badges' => ['Бонус за регистрацию', 'Бездепозитный бонус'],
                    'promocode' => 'BONUS50',
                ],
                [
                    'name' => 'Winz',
                    'rating' => '4.5',
                    'min_deposit' => '€5',
                    'currency' => 'EUR',
                    'badges' => ['Бездепозитный бонус'],
                    'promocode' => 'SPINS25',
                ],
                [
                    'name' => 'Happy Spins',
                    'rating' => '4.3',
                    'min_deposit' => '€20',
                    'currency' => 'EUR',
                    'badges' => ['Бонус за регистрацию'],
                    'promocode' => 'HAPPY20',
                ],
                [
                    'name' => 'Respin',
                    'rating' => '4.1',
                    'min_deposit' => '€10',
                    'currency' => 'USD',
                    'badges' => ['Бонус за регистрацию'],
                    'promocode' => 'RESPIN10',
                ],
                [
                    'name' => 'Coolbet',
                    'rating' => '4.2',
                    'min_deposit' => '€15',
                    'currency' => 'EUR',
                    'badges' => ['Бездепозитный бонус'],
                    'promocode' => 'COOL15',
                ],
                [
                    'name' => 'BetSafe',
                    'rating' => '4.0',
                    'min_deposit' => '€5',
                    'currency' => 'EUR',
                    'badges' => [],
                    'promocode' => 'BET5',
                ],
            ];
            foreach ($demo_cards as $card) :
                ?>
                <article class="casino-card">
                    <div class="casino-card__header">
                        <div class="casino-card__logo">
                            <?php echo esc_html(mb_substr($card['name'], 0, 1)); ?>
                        </div>
                        <div>
                            <h3><?php echo esc_html($card['name']); ?></h3>
                            <div class="casino-card__rating">Рейтинг: <?php echo esc_html($card['rating']); ?>/5</div>
                        </div>
                    </div>

                    <div class="casino-card__badges">
                        <?php if (!empty($card['badges'])) : ?>
                            <?php foreach ($card['badges'] as $badge) : ?>
                                <span class="badge"><?php echo esc_html($badge); ?></span>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <span class="badge">Без активных бонусов</span>
                        <?php endif; ?>
                    </div>

                    <div class="casino-card__details">
                        <div>Мин. депозит: <?php echo esc_html($card['min_deposit']); ?></div>
                        <div>Валюта: <?php echo esc_html($card['currency']); ?></div>
                    </div>
                    <div class="casino-card__promo">
                        <span>Промокод: <?php echo esc_html($card['promocode']); ?></span>
                        <button type="button" data-copy="<?php echo esc_attr($card['promocode']); ?>">Копировать</button>
                    </div>
                    <div class="casino-card__note">Короткая заметка о казино из админки: надежность, бонус и лимиты.</div>

                    <div class="casino-card__actions">
                        <button class="button button--primary" type="button">Получить бонус</button>
                        <button class="button button--ghost" type="button">Читать обзор</button>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
        <div class="pagination-demo">
            <span class="is-active">1</span>
            <span>2</span>
            <span>3</span>
            <span>4</span>
        </div>
        <div class="pagination-hint">Пагинация / ленивая загрузка</div>
    </div>

    <aside class="sidebar">
        <div class="sidebar__header">
            <h3>Характеристики</h3>
            <button class="sidebar__close" type="button" aria-label="Закрыть фильтры" data-filters-close-btn>×</button>
        </div>
        <div class="filter-group">
            <label>Рейтинг (от)</label>
            <input type="range" min="0" max="5" step="0.1" value="4.0" />
            <div class="range-value">Текущее: 4.0</div>
        </div>
        <div class="filter-group">
            <label>Минимум депозит (до)</label>
            <input type="range" min="0" max="100" step="5" value="20" />
            <div class="range-value">Текущее: 20</div>
        </div>
        <div class="filter-group">
            <strong>Валюта</strong>
            <select multiple>
                <option selected>EUR</option>
                <option selected>USD</option>
                <option>RUB</option>
                <option>GBP</option>
                <option>SEK</option>
            </select>
            <div class="select-hint">Используйте Ctrl/⌘ для мультивыбора</div>
        </div>
        <div class="filter-group">
            <label>
                <input type="checkbox" checked />
                Приложение
            </label>
        </div>
        <div class="filter-group">
            <strong>Лицензия</strong>
            <label><input type="checkbox" checked /> MGA</label>
            <label><input type="checkbox" /> UKGC</label>
        </div>
        <div class="filter-group">
            <strong>Платежный метод</strong>
            <select multiple>
                <option selected>Visa</option>
                <option selected>Mastercard</option>
                <option>Skrill</option>
                <option>Neteller</option>
                <option>Crypto</option>
                <option>Apple Pay</option>
                <option>Google Pay</option>
                <option>Bank Transfer</option>
            </select>
            <div class="select-hint">Используйте Ctrl/⌘ для мультивыбора</div>
        </div>
        <div class="filter-group">
            <strong>Игровой провайдер</strong>
            <select multiple>
                <option selected>Pragmatic Play</option>
                <option>NetEnt</option>
                <option selected>Play'n GO</option>
                <option>Microgaming</option>
                <option>Evolution</option>
                <option>Yggdrasil</option>
                <option>Quickspin</option>
                <option>BGaming</option>
            </select>
            <div class="select-hint">Используйте Ctrl/⌘ для мультивыбора</div>
        </div>
        <div class="filter-group">
            <strong>Страна</strong>
            <select multiple>
                <option selected>Estonia</option>
                <option>Latvia</option>
                <option>Lithuania</option>
                <option>Finland</option>
                <option>Sweden</option>
                <option>Germany</option>
            </select>
            <div class="select-hint">Используйте Ctrl/⌘ для мультивыбора</div>
        </div>
        <button class="button button--primary" type="button">Применить</button>
    </aside>
</section>
<div class="filters-backdrop" data-filters-close></div>
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
  const closeButton = document.querySelector('[data-filters-close-btn]');
  const body = document.body;

  if (toggle && backdrop) {
    toggle.addEventListener('click', () => {
      body.classList.add('filters-open');
    });
    backdrop.addEventListener('click', () => {
      body.classList.remove('filters-open');
    });
  }

  if (closeButton) {
    closeButton.addEventListener('click', () => {
      body.classList.remove('filters-open');
    });
  }
</script>
<?php get_footer(); ?>
