<?=$wrapper_header?>

<textarea id="<?=$id?>"
	rows="<?=$row?>"
    placeholder="<?=$attr['placeholder']?>"
    <? foreach ($attr as $key => $row) : ?>
        <?=$key?>="<?=$row?>"
    <? endforeach; ?>
    <?=$this->special_attr($attr)?>
	><?=$value?></textarea>

<!-- help -->
<? if( $attr['help'] ) : ?>
	<p class="help-block">
		<?=$attr['help']?>
	</p>
<? endif; ?>
<!-- End Of help -->

<?=$wrapper_footer?>