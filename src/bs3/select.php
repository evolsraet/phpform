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
		<option value="<?=$set_key?>"
		    <? if( $set_key == $value ) : ?>
		    selected
		    <? endif; ?>
			>
			<?=$set_row?>
		</option>
	<? endforeach; ?>
</select>

<?=$wrapper_footer?>