<?php
function alacarte_html_animation($args = []){
	$args = wp_parse_args($args, [
		'anim'     => 'wave1',
		'echo'     => false,
		'shape'    => 'circle',
		'infinite' => true
	]);
	$wave_wrap_class = ['red-wave-wrap', 'red-'.$args['anim']];
	$wave_class = [$args['shape'], 'red-wave', $args['anim']];
	if($args['infinite'] === true) $wave_class[] = 'infinite';

	switch ($args['anim']) {
		case 'wave4':
			$html = '<div class="'.implode(' ', $wave_wrap_class).'">
				<div class="delay1 '.implode(' ', $wave_class).'"></div>
				<div class="delay2 '.implode(' ', $wave_class).'"></div>
				<div class="delay3 '.implode(' ', $wave_class).'"></div>
				<div class="delay4 '.implode(' ', $wave_class).'"></div>
			</div>';
			break;
		case 'wave3':
			$html = '<div class="'.implode(' ', $wave_wrap_class).'">
				<div class="delay1 '.implode(' ', $wave_class).'"></div>
				<div class="delay2 '.implode(' ', $wave_class).'"></div>
				
			</div>';
			break;
		case 'wave2':
			$html = '<div class="'.implode(' ', $wave_wrap_class).'">
				<div class="delay1 '.implode(' ', $wave_class).'"></div>
				<div class="delay2 '.implode(' ', $wave_class).'"></div>
				<div class="delay3 '.implode(' ', $wave_class).'"></div>
				<div class="delay4 '.implode(' ', $wave_class).'"></div>
			</div>';
			break;
		case 'wave1':
			$html = '<div class="'.implode(' ', $wave_wrap_class).'">
				<div class="delay1 '.implode(' ', $wave_class).'"></div>
				<div class="delay2 '.implode(' ', $wave_class).'"></div>
				<div class="delay3 '.implode(' ', $wave_class).'"></div>
				<div class="delay4 '.implode(' ', $wave_class).'"></div>
			</div>';
			break;
		default : 
			$html = '';
			break;
	}
	if($args['echo'])
		echo alacarte_html($html);
	else 
		return $html;
}