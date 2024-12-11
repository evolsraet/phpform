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

			// jquery form plugin 사용
			$(form).ajaxSubmit({
	            beforeSubmit: function (data,form,option) {
	            	beforeSubmit_result = true;
	            	
	            	// 빈 멀티셀렉트 빈값 넣어주기 (isset 으로 검출)
	            	$(form).find('select').each(function(index, el) {
			            if ( !$(el).val() && $(el).attr('name') ) {
			                data.push({
			                    name: $(el).attr('name'),
			                    value: null
			                });
			            }
			        });

	            	if( typeof phpform_beforeSubmit == 'function' ) {
	            		console.log('beforeSubmit is run. phpform / close');
						beforeSubmit_result = phpform_beforeSubmit(data,form,option);
	            	}

	            	if( !beforeSubmit_result )
	            		return false;

					// alert('beforeSubmit');

	            	// console.log('data',data);
	            	// console.log('form',form);
	            	// console.log('option',option);

	            	// // $(form + " checkbox").not(':checked')
	            	// data.push(
		            // 	{
		            // 		name: 'customer_test',
		            // 		value: 'gahaaha',
		            // 		type: 'aaa',
		            // 		required: false,
		            // 	}
	            	// );
					// // {name: 'customer_option[]', value: 'Y', type: 'checkbox', required: false}
					// $(btn).button('reset');
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
					<? if( 0 && ENVIRONMENT == 'development' ) : ?>
						$(form).html(response.responseText + "개발모드 전용");
					<? endif; ?>
					console.log( response.responseText );
					
					$(btn).button('reset');
	            }
			});
	}
</script>
<!-- End Of <?=$this->form_id?> AJAX -->
<? endif; ?>
