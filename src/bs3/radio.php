<?=$wrapper_header?>

<?
	$inline = $attr['inline'] ? "radio-inline" : "";
	unset($attr['inline']);
?>

<div class="radio">
	<? foreach( $set as $set_key => $set_row ) : ?>
	<label class="<?=$inline?>">
		<input type="radio"
			id="<?="{$id}_{$set_key}"?>"
		    value="<?=$set_key?>"
		    placeholder="<?=$attr['placeholder']?>"
		    <? if( $value != '' && $set_key == $value ) : ?>
		    checked
		    <? endif; ?>
		    <?=$this->special_attr($attr)?>
		    <? foreach ($attr as $key => $row) : ?>
		        <?=$key?>="<?=$row?>"
		    <? endforeach; ?>
			>

		<?=$set_row?>
	</label>
	<? endforeach; ?>
</div>

<?=$wrapper_footer?>