<?php
/**
 * Display Sidebar area
 *
 * @package AlaCarte
 * @subpackage AlaCarte
 * @since 1.0.0
 * @author EF5 Team
 *
*/
$sidebar  = alacarte_get_sidebar(false);
dynamic_sidebar($sidebar);

