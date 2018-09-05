<?=$wrapper_header?>

<div class="checkbox">
	<label class="<?=$attr['inline']?"checkbox-inline":""?>">
		<input type="checkbox"
		    id="<?=$id?>"
		    value="<?=$value?>"
		    <? if( $checked ) : ?>
		    checked
		    <? endif; ?>
		    value="<?=$value?>"
		    placeholder="<?=$attr['placeholder']?>"
		    <?=$this->special_attr($attr)?>
		    <? foreach ($attr as $key => $row) : ?>
		        <?=$key?>="<?=$row?>"
		    <? endforeach; ?>
			>

		<?=$label?>
	</label>

</div>

<?=$wrapper_footer?>
