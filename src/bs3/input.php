<?=$wrapper_header?>

<input type="<?=$type?>"
    id="<?=$attr['id']? $attr['id'] : $id?>"
    value="<?=$value?>"
    placeholder="<?=$attr['placeholder']?>"
    <?=$this->special_attr($attr)?>
    <? foreach ($attr as $key => $row) : ?>
        <?=$key?>="<?=$row?>"
    <? endforeach; ?>
	>

<!-- help -->
<? if( $attr['help'] ) : ?>
	<p class="help-block">
		<?=$attr['help']?>
	</p>
<? endif; ?>
<!-- End Of help -->

<?=$wrapper_footer?>