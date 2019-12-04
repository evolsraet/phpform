<?=$wrapper_header?>

<? if( !$attr['inline'] ) : ?>
<div class="checkbox">
<? endif; ?>
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
<? if( !$attr['inline'] ) : ?>
</div>
<? endif; ?>

<!-- help -->
<? if( $attr['help'] ) : ?>
	<p class="help-block">
		<?=$attr['help']?>
	</p>
<? endif; ?>
<!-- End Of help -->

<?=$wrapper_footer?>
