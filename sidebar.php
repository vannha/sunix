<?php
/**
 * Display Sidebar area
 *
 * @package sunix
 * @subpackage sunix
 * @since 1.0.0
 * @author EF5 Team
 *
*/
$sidebar  = sunix_get_sidebar(false);
dynamic_sidebar($sidebar);

