<form id="<?=$id?>" name="<?=$id?>"
	action="<?=$action?>"
	<? if( $attr['multipart'] ) : ?>
	enctype="multipart/form-data"
	<? endif; ?>
	<? foreach( (array)$attr as $key => $row ) : ?>
	<?=$key?>="<?=$row?>"
	<? endforeach; ?>
	>

	<?
		// 코드이그나이터 CSRF코드
		if( CI_VERSION > 3 && $attr['method']!='get') :
            $CI =& get_instance();
            if( $CI->config->item('csrf_protection') ) :
        	?>
			<input type="hidden" name="<?=$CI->security->get_csrf_token_name()?>" value="<?=$CI->security->get_csrf_hash()?>">
			<?
            endif;
		endif;
    ?>
