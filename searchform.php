<?php
/**
 * Search Form
 * 
 * @package AlaCarte
 * @subpackage AlaCarte
 * @since 1.0.0
 * @author EF5 Team
 *
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
    <div class="searchform-wrap">
        <input type="text" placeholder="<?php esc_attr_e('Keyword search…', 'alacarte'); ?>" name="s" class="search-field" />
        <button type="submit"></button>
    </div>
</form>