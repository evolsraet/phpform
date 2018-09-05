<?=$wrapper_header?>

<input type="<?=$type?>"
    id="<?=$id?>"
    value="<?=$value?>"
    placeholder="<?=$attr['placeholder']?>"
    <?=$this->special_attr($attr)?>
    <? foreach ($attr as $key => $row) : ?>
        <?=$key?>="<?=$row?>"
    <? endforeach; ?>
	>

<?=$wrapper_footer?>