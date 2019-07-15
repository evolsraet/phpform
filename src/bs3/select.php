<?=$wrapper_header?>

<?
	$inline = $attr['inline'] ? "radio-inline" : "";
	unset($attr['inline']);
?>

<select name="<?=$id?>"
	id="<?=$id?>"
    <? foreach ($attr as $key => $row) : ?>
        <?=$key?>="<?=$row?>"
    <? endforeach; ?>
	<?=$this->special_attr($attr)?>
	placeholder="<?=$attr['placeholder']?>"
	>
	<? foreach( $set as $set_key => $set_row ) : ?>
		<? if( is_array($set_row) || is_object($set_row) ) : ?>
			<option value="<?=$set_row->id?>"
			    <? if( $set_row->id == $value ) : ?>
			    selected
			    <? endif; ?>
				>
				<?=$set_row->text?>
			</option>					
		<? else : ?>
			<option value="<?=$set_key?>"
			    <? if( $set_key == $value ) : ?>
			    selected
			    <? endif; ?>
				>
				<?=$set_row?>
			</option>
		<? endif; ?>
	<? endforeach; ?>
</select>

<?=$wrapper_footer?>
