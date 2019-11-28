<?php
/**
 * Search Form
 * 
 * @package sunix
 * @subpackage sunix
 * @since 1.0.0
 * @author EF5 Team
 *
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
    <div class="searchform-wrap">
        <input type="text" placeholder="<?php esc_attr_e('Keyword search…', 'sunix'); ?>" name="s" class="search-field" />
        <button type="submit"></button>
    </div>
</form>