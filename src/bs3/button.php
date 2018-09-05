<button type="<?=$type?>"
	<? foreach( (array)$attr as $key => $row ) : ?>
	<?=$key?>="<?=$row?>"
	<? endforeach; ?>
	>
	<?=$label?>
</button>