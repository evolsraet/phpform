<?=$wrapper_header?>

<?
	$is_multiple = array_key_exists('multiple', $attr);
	$inline = $attr['inline'] ? "radio-inline" : "";
	unset($attr['inline']);
?>

<select
    name="<?=$id?><?=$is_multiple?"[]":""?>"
	id="<?=str_replace("[]","",$id)?>"
    <? foreach ($attr as $key => $row) : ?>
        <?=$key?>="<?=$row?>"
    <? endforeach; ?>
	<?=$this->special_attr($attr)?>
	placeholder="<?=$attr['placeholder']?>"
	>
	<? foreach( (array) $set as $set_key => $set_row ) : ?>
		<? if( is_array($set_row) || is_object($set_row) ) : ?>
			<?
				$set_row = (array) $set_row;
			?>		
			<option value="<?=$set_row['id']=='_default' ? '' : $set_row['id']?>"
			    <? if( $this->check_value($set_row['id'], $value) ) : ?>
			    selected
			    <? endif; ?>
				>
				<?=$set_row['text']?>
			</option>					
		<? else : ?>
			<option value="<?=$set_key=='_default' ? '' : $set_key?>"
			    <? if( $this->check_value($set_key, $value) ) : ?>
			    selected
			    <? endif; ?>
				>
				<?=$set_row?>
			</option>
		<? endif; ?>
	<? endforeach; ?>
</select>

<!-- help -->
<? if( $attr['help'] ) : ?>
	<p class="help-block">
		<?=$attr['help']?>
	</p>
<? endif; ?>
<!-- End Of help -->

<?=$wrapper_footer?>

