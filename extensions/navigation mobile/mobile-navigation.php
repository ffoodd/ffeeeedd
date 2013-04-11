<!-- À copier dans header.php en lieu et place de la navigation -->
<nav role="navigation" id="navigation">
  <label for="toggle-menu" data-icon="≡" title="<?php echo __('Menu', 'ffeeeedd'); ?>" onclick=""></label>
  <input type="checkbox" id="toggle-menu" title="<?php echo __('Menu', 'ffeeeedd'); ?>">
  <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
</nav>
