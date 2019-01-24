<div class="<?=$this->class_form_group?>">

	<? if( $this->is_horizontal || $attr['without_label']!=true ) :
		// 가로모드 || 라벨있을 경우만
	?>

		<label  for="<?=$id?$id:""?>"
	            class="control-label <?=$this->is_horizontal ? $this->class_horizon_label : ""?>"
			>
			<? if( $attr['required'] && !$this->view_mode ) : ?>
				<span class="text-danger">* </span>
			<? endif; ?>
			<? if( $attr['without_label']!=true ) : ?>
				<?=$label?>
				<? unset($attr['without_label']); ?>
			<? endif; ?>
		</label>

	<? endif; ?>

	<? if( $this->is_horizontal ) : ?>
    	<div class="<?=$this->class_horizon_form_control?> <?=$this->view_mode ? "view_mode" : ""?>" >
    <? endif; ?>