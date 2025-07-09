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

			// 폼 필수 요소 확인
			var form = $("#<?=$this->form_id?>");
			var url = $(form).attr('action');
			var btn = $(form).find("[type='submit']");

			// dateType = $("#<?=$this->form_id?>").attr('method') ? $("#<?=$this->form_id?>").attr('method') : 'json';

			$(btn).button('loading');
			<? if( $this->ajax_before ) : ?>
				beforeSubmit = <?=$this->ajax_before?>(btn);
			<? endif; ?>

			if( beforeSubmit == false ) {
				$(btn).button('reset');
				return false;
			}

			// // 폼 안에 있는 모든 체크박스를 선택
			// var checkboxes = $('form').find(':checkbox');

			// // 체크되지 않은 체크박스를 필터링
			// var unchecked = checkboxes.filter(function() {
			// 	return !this.checked;
			// });

			// $.each(unchecked, function(index, value) {
			// 	// 요소에 대한 작업 수행
			// });


			// jquery form plugin 사용
			$(form).ajaxSubmit({
	            beforeSubmit: function (data,form,option) {
					// alert('beforeSubmit');

					// return false;
	                //막기위해서는 return false를 잡아주면됨
	                // return true;
	            },
	            success: function(response,status){
					// alert('success');
					if(response != undefined && typeof response == "object" && response.errors) {
						alert('AJAX 에러 :: 관리자에게 문의하세요.');
						// log2server(response, '고객 탁송접수 에러');
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
					<? if( 0 && ENVIRONMENT == 'development' ) : ?>
						$(form).html(response.responseText + "개발모드 전용");
					<? endif; ?>
					// log2server(response, '고객 탁송접수 에러');
					console.log( response.responseText );
					
					$(btn).button('reset');
	            }
			});
	}
</script>
<!-- End Of <?=$this->form_id?> AJAX -->
<? endif; ?>
