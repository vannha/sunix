<?php
/**
 * Header Contact Button
 * @since 1.0.0 
*/
if(!function_exists('alacarte_header_contact_plain_text')){
	function alacarte_header_contact_plain_text($args = []){
		$args = wp_parse_args($args, [
			'before'      => '',
			'after'       => '',
			'layout'	  => '1',	
			'class'       => 'justify-content-end gutters-80',
			'item_class'  => 'col-auto',
			'inner_class' => 'row gutters-20 align-items-center',
			'page_only'	  => false
		]);
		$header_contact_plain = alacarte_get_opts('header_contact_plain', '0');
		if($header_contact_plain !== '1') return;

		wp_enqueue_style( 'font-linear' );

		$header_contact_plain_icon1 = alacarte_get_opts('header_contact_plain_icon1', '',$args['page_only']);
		$header_contact_plain_icon2 = alacarte_get_opts('header_contact_plain_icon2', '',$args['page_only']);
		$header_contact_plain_icon3 = alacarte_get_opts('header_contact_plain_icon3', '',$args['page_only']);

		$header_contact_plain_text1 = alacarte_get_opts('header_contact_plain_text1', '',$args['page_only']);
		$header_contact_plain_text2 = alacarte_get_opts('header_contact_plain_text2', '',$args['page_only']);
		$header_contact_plain_text3 = alacarte_get_opts('header_contact_plain_text3', '',$args['page_only']);

		$header_contact_plain_subtext1 = alacarte_get_opts('header_contact_plain_subtext1', '',$args['page_only']);
		$header_contact_plain_subtext2 = alacarte_get_opts('header_contact_plain_subtext2', '',$args['page_only']);
		$header_contact_plain_subtext3 = alacarte_get_opts('header_contact_plain_subtext3', '',$args['page_only']);

		printf('%1$s<div class="red-qc red-qc-%2$s row %3$s">', $args['before'], $args['layout'], $args['class']);
		for ($i=1; $i < 4 ; $i++) {
			if(!empty(${'header_contact_plain_icon'.$i}) || !empty(${'header_contact_plain_text'.$i}) || !empty(${'header_contact_plain_subtext'.$i})) :
				switch ($args['layout']) {
					case '4':
					?>
					<div class="qc-item <?php echo esc_attr($args['item_class']);?>">
						<div class="<?php echo esc_attr($args['inner_class']);?>">
							<?php if(!empty(${'header_contact_plain_icon'.$i})) : ?>
								<div class="col-auto">
									<span class="qc-icon accent-color <?php echo esc_attr(${'header_contact_plain_icon'.$i});?>"></span>
								</div>
							<?php endif; ?>
							<div class="col">
								<span class="qc-heading"><?php echo esc_html(${'header_contact_plain_text'.$i});?></span>
								<span class="qc-text"><?php echo esc_html(${'header_contact_plain_subtext'.$i});?></span>
							</div>
						</div>
					</div>
				<?php
					break;
					default:
				?>
					<div class="qc-item <?php echo esc_attr($args['item_class']);?>">
						<div class="<?php echo esc_attr($args['inner_class']);?>">
							<?php if(!empty(${'header_contact_plain_icon'.$i})) : ?>
								<div class="col-auto">
									<span class="qc-icon accent-color <?php echo esc_attr(${'header_contact_plain_icon'.$i});?>"></span>
								</div>
							<?php endif; ?>
							<div class="col">
								<div class="red-heading qc-heading font-style-500"><span class="qc-heading"><?php echo esc_html(${'header_contact_plain_text'.$i});?></span></div>
								<div class="qc-text"><?php echo esc_html(${'header_contact_plain_subtext'.$i});?></div>
							</div>
						</div>
					</div>
			<?php
					break;
				}
			endif;
		}
		printf('</div>%s', $args['after']);
	}
}

function alacarte_header_contact_plain_icon($args = []){
	$args = wp_parse_args($args, [
		'before' => '',
		'after'  => '',
		'icon'	 => 'fal fa-phone fa-rotate-90'
	]);
	$show_contact = alacarte_get_opts('header_contact_plain', '0');
	if($show_contact !== '1') return;

	printf('%s', $args['before']);
?>
	<a href="#red-header-contact-plain" class="header-icon red-header-popup d-xl-none sonarWarning bg-accent text-white"><span class="<?php echo esc_attr($args['icon']);?>"></span></a>
<?php
	printf('%s', $args['after']);
}

function alacarte_header_contact_plain_popup_html(){
	$show_contact = alacarte_get_opts('header_contact_plain', '0');
	if($show_contact !== '1') return;
?>
	<div id="red-header-contact-plain" class="mfp-hide container"><div class="row justify-content-center"><div class="col-auto">
		<?php alacarte_header_contact_plain_text([
			'layout'      => '1', 
			'class'       => 'gutters-80', 
			'inner_class' => 'row gutters-20 align-items-center',
			'page_only'	  => true
		]); ?>
	</div></div></div>
<?php
}
add_action('wp_footer','alacarte_header_contact_plain_popup_html');