<?=$wrapper_header?>

<textarea id="<?=$id?>"
	rows="<?=$row?>"
    placeholder="<?=$attr['placeholder']?>"
    <? foreach ($attr as $key => $row) : ?>
        <?=$key?>="<?=$row?>"
    <? endforeach; ?>
    <?=$this->special_attr($attr)?>
	><?=$value?></textarea>

<?=$wrapper_footer?>