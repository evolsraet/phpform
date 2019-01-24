</form>

<? if( $this->is_ajax ) : ?>
<!-- <?=$this->form_id?> AJAX by phpForm Library-->
<script>
	$(function(){
		$("#<?=$this->form_id?>").bind("submit", function(event) {
			event.preventDefault();

			if( $(this).attr('data-send')=='not' ) return false;
			<?=$this->form_id?>_submit();
		});
	});

	function <?=$this->form_id?>_submit() {
			// alert('1');

			// 폼 필수 요소 확인
			var form = $("#<?=$this->form_id?>");
			var url = $(form).attr('action');
			var btn = $(form).find("[type='submit']");

			// dateType = $("#<?=$this->form_id?>").attr('method') ? $("#<?=$this->form_id?>").attr('method') : 'json';

			// jquery form plugin 사용
			$(form).ajaxSubmit({
	            beforeSubmit: function (data,form,option) {
					// alert('beforeSubmit');
					$(btn).button('loading');
					<? if( $this->ajax_before ) : ?>
						beforeSubmit = <?=$this->ajax_before?>(btn);
					<? endif; ?>

					if( beforeSubmit == false ) {
						$(btn).button('reset');
						return false;
					}
					// return false;
	                //막기위해서는 return false를 잡아주면됨
	                // return true;
	            },
	            success: function(response,status){
					// alert('success');
					if(response != undefined && typeof response == "object" && response.errors) {
						alert('AJAX 에러 :: 관리자에게 문의하세요.');
						console.log( response );
					} else {
						<? if( $this->ajax_after ) : ?>
							<?=$this->ajax_after?>(response, btn);
						<? endif; ?>
					}

					// $(btn).button('reset');
	            },
	            error: function( response ){
					// alert('error');
					alert('AJAX 통신 중 에러가 발생했습니다.\n새로고침 후 시도해보세요.');
					<? if( ENVIRONMENT == 'development' ) : ?>
						$(form).html(response.responseText + "개발모드 전용");
					<? endif; ?>
					console.log( response.responseText );
	            }
			});
	}
</script>
<!-- End Of <?=$this->form_id?> AJAX -->
<? endif; ?>
