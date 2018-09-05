<?php

namespace Phpform;

class Phpform {
	private $provider = "bs3";
	private $form_id = "";
    private $class_form = ' ';
    private $class_horizon_label = 'col-sm-12 col-md-2 control-label text-left';
    private $class_horizon_form_control = 'col-sm-12 col-md-10 ';
    private $class_form_group = 'form-group ';
    private $class_form_control = 'form-control ';
    private $class_button = 'btn ';

    private $is_ajax = FALSE;
    private $ajax_after = FALSE;
    private $ajax_before = FALSE;
    private $is_horizontal = FALSE;

    public function __construct( array $config = array() ) {
        empty($config) OR $this->init($config);

        // $this->CI =& get_instance();
        // $this->CI->load->helper('form');
    }

    public function init( array $config = array() ) {
        foreach ($config as $key => $row) {
            // 같은 키 값이 있으면
            if ( iseet( $this->{$key} ) ) :
                $this->{$key} = $row;
            endif;
        }
        return $this;
    }


    /*----------  열고닫기  ----------*/

    	/**
    	 *
    	 * AJAX 사용 팁
    	 *
    	 * $attr
    	 * 	ajax_after, ajax_before 전달 (성공,실행전 변수)
    	 *  ajaxType 입력 (기본 값 json)
    	 *
    	 */


        public function open( $id, $action="", $attr=array() ) {
        	$this->form_id = $id;

        	// 아작스
        	if( isset($attr['ajax_after']) || isset($attr['ajax_before']) ) {
        		$this->is_ajax = TRUE;

        		$this->ajax_before = $attr['ajax_before'];
        		$this->ajax_after = $attr['ajax_after'];

                unset($attr['ajax_before']);
                unset($attr['ajax_after']);
        	}

            // $attr에 [data-send == not]  일 경우, ajax send 실행안함 (수동으로 실행)

            $attr['class'] .= $this->class_form;
            $attr['method'] = $attr['method'] ? $attr['method'] : 'post';
            if( $action=='' ) $action = $_SERVER['REQUEST_URI'];

            // 가로모드 확인 (생성시 말고도 변경가능토록)
            if( strpos($attr['class'], 'form-horizontal')!==FALSE )
                $this->is_horizontal = TRUE;

            $data = compact('id', 'action', 'attr', 'ci_security');
            $this->out('open', $data);
        }

        public function close() {
            $this->out('close');
        }

    /*----------  출력  ----------*/

	    public function input($label,$type,$id,$value,$attr=array(),$wrapping=TRUE) {
            if( $type=='hidden' )   $wrapping = false;

	        $attr['class'] = $this->class_form_control . $attr['class'];
	        $attr['name'] = isset($attr['name']) ? $attr['name'] : $id;

	        $data = compact('label', 'type', 'id', 'value', 'attr');

	        if( $wrapping ) :
		        $wrapper_header = $this->wrapper_header($data, TRUE);
		        $wrapper_footer = $this->wrapper_footer($data, TRUE);
	    	endif;

	        $data = compact('label', 'type', 'id', 'value', 'attr', 'wrapper_header', 'wrapper_footer');
        	$this->out('input', $data);
	    }

	    public function checkbox($label,$checked,$id,$value,$attr=array(),$wrapping=TRUE) {
	        $attr['class'] = $attr['class'];
	        $attr['name'] = isset($attr['name']) ? $attr['name'] : $id;

	        // for wrapping
	        $attr['without_label'] = isset($attr['without_label']) ? $attr['without_label'] : FALSE;

	        $attr['inline'] = isset($attr['inline']) ? $attr['inline'] : TRUE;

	        $data = compact('label', 'id', 'value', 'attr');

	        if( $wrapping ) :
		        $wrapper_header = $this->wrapper_header($data, TRUE);
		        $wrapper_footer = $this->wrapper_footer($data, TRUE);
	    	endif;

	    	unset($attr['without_label']);
	        $data = compact('label', 'checked', 'id', 'value', 'attr', 'wrapper_header', 'wrapper_footer');
        	$this->out('checkbox', $data);
	    }

	    public function radio($label,$set=array(),$id,$value,$attr=array(),$wrapping=TRUE) {
            if( !is_array($set) || !count($set) ) return false;

	        $attr['class'] = $attr['class'];
	        $attr['name'] = isset($attr['name']) ? $attr['name'] : $id;

	        // for wrapping
	        $attr['without_label'] = isset($attr['without_label']) ? $attr['without_label'] : FALSE;

	        $attr['inline'] = isset($attr['inline']) ? $attr['inline'] : TRUE;

	        $data = compact('label', 'id', 'value', 'attr');

	        if( $wrapping ) :
		        $wrapper_header = $this->wrapper_header($data, TRUE);
		        $wrapper_footer = $this->wrapper_footer($data, TRUE);
	    	endif;

	    	unset($attr['without_label']);
	        $data = compact('label', 'set', 'id', 'value', 'attr', 'wrapper_header', 'wrapper_footer');
        	$this->out('radio', $data);
	    }

	    public function textarea($label,$row,$id,$value,$attr=array(),$wrapping=TRUE) {
	        $attr['class'] = $this->class_form_control . $attr['class'];
	        $attr['name'] = isset($attr['name']) ? $attr['name'] : $id;

	        $data = compact('label', 'row', 'id', 'value', 'attr');

	        if( $wrapping ) :
		        $wrapper_header = $this->wrapper_header($data, TRUE);
		        $wrapper_footer = $this->wrapper_footer($data, TRUE);
	    	endif;

	        $data = compact('label', 'row', 'id', 'value', 'attr', 'wrapper_header', 'wrapper_footer');
        	$this->out('textarea', $data);
	    }

	    public function button($label, $type='', $attr=array()) {
	    	$type = ( $type != '' ) ? $type : 'button';
	    	$attr['class'] = $this->class_button . $attr['class'];

	    	$data = compact('label', 'type', 'attr');
	    	$this->out('button', $data);
	    }

    /*----------  래핑  ----------*/
    	public function out($file, $data = array()) {
            ob_start();
            extract((array)$data);
            include __DIR__."/{$this->provider}/{$file}.php";
            echo ob_get_clean();
    	}

        public function wrapper_header( $data, $return = false ) {
            ob_start();
            extract((array)$data);
            include __DIR__."/{$this->provider}/wrapper_header.php";
            if( $return )
            	return ob_get_clean();
            else
            	echo ob_get_clean();
        }

        public function wrapper_footer( $data, $return = false ) {
            ob_start();
            extract((array)$data);
            include __DIR__."/{$this->provider}/wrapper_footer.php";
            if( $return )
            	return ob_get_clean();
            else
            	echo ob_get_clean();
        }

        public function special_attr( &$attr ) {
            $attr_list = array();
            $attr_list['required'] = ' required ';
            $attr_list['disabled'] = ' disabled ';
            $attr_list['readonly'] = ' readonly="readonly" ';

            $result = '';

            foreach ($attr_list as $key => $row) {
            	if( array_key_exists($key, $attr) )	$result .= $attr_list[$key];
            	unset( $attr[$key] );
            }

            echo $result;
        }
}

?>
