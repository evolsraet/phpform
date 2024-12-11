<?=$wrapper_header?>

<?
	$inline = $attr['inline'] ? "radio-inline" : "";
	unset($attr['inline']);

	// 여러개일때도 special_attr 가 유지되도록
	$original_attr = $attr;
?>

<div class="radio">
	<? foreach( $set as $set_key => $set_row ) : ?>
	<? $attr = $original_attr; ?>
	<label class="<?=$inline?>">
		<input type="radio"
			id="<?="{$id}_{$set_key}"?>"
		    value="<?=$set_key?>"
		    placeholder="<?=$attr['placeholder']?>"
		    <? if( $value != '' && $set_key == $value ) : ?>
		    checked
		    <? endif; ?>
		    <?= ($attr['readonly']) ? 'onclick="return false;"' : "" ?>
		    <?=$this->special_attr($attr)?>
		    <? foreach ($attr as $key => $row) : ?>
		        <?=$key?>="<?=$row?>"
		    <? endforeach; ?>
			>

		<?=$set_row?>
	</label>
	<? endforeach; ?>
</div>

<!-- help -->
<? if( $attr['help'] ) : ?>
	<p class="help-block">
		<?=$attr['help']?>
	</p>
<? endif; ?>
<!-- End Of help -->

<?=$wrapper_footer?>