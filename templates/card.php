<?php

$link = get_field('link');

?>

<article class="card card--full card--default-bg">
  <div class="card__content">
    <!-- CONTENT -->
    <div class="card__text">

      <!-- TITLE -->
      <h3 class="govuk-heading-m">
        <a class="card__link" href="<?php echo esc_url($link['url']) ?>" rel="bookmark"><?php echo wp_kses_post($link['title']) ?></a>
      </h3>

      <?php if (get_field('card_style') === 'full' && get_field('description')) : ?>
      <!-- DESCRIPTION -->
      <p class="card__description">
        <?php echo wp_kses_post(get_field('description')) ?>
      </p>
      <?php endif; ?>
    </div>
    <!-- /.card__text -->
    
  </div>
  <!-- /.card__content -->
</article>
