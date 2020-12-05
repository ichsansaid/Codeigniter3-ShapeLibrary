<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ShapeException extends Exception{}

class DataShape{
	private $data_per_shape = [];
	private $data = [];
	private $shapes;
	private $CI;
	private $current;

	public function __construct($data_per_shape, $global, $shapes, $current){
		$this->data = $global;
		$this->data_per_shape = $data_per_shape;
		$this->shapes = $shapes;
		$this->CI =& get_instance();
		$this->current = $current;
	}
	
	public function _data($key){
		if(isset($this->data[$key])){
			return $this->data[$key];
		} else {
			$ea = false;
			if(!isset($this->CI->config->config['shape-debug'])){
				$ea = true;
			} else {
				if(!$this->CI->config->config['shape-debug']){
					$ea=true;
				}
			}
			if($ea) throw new ShapeException("<text> Data Global with key <strong>".$key."</strong> not exist You can disable this message with add 'shape-debug' True at config.php</text>");
		}
	}

	public function data($key){
		if(isset($this->data_per_shape[$this->current][$key])){
			return $this->data_per_shape[$this->current][$key];
		} else {
			$ea = false;
			if(!isset($this->CI->config->config['shape-debug'])){
				$ea = true;
			} else {
				if(!$this->CI->config->config['shape-debug']){
					$ea=true;
				}
			}
			if($ea) throw new ShapeException("<text> Data Shape in ".$this->current." with key <strong>".$key."</strong> not exist. You can disable this message with add 'shape-debug' True at config.php</text>");
		}
	}

	public function render($key, $debug=true){
		if($key == $this->current){
			$ea = false;
			if(!isset($this->CI->config->config['shape-debug'])){
				$ea = true;
			} else {
				if(!$this->CI->config->config['shape-debug']){
					$ea=true;
				}
			}
			if($ea) throw new ShapeException("<text> You can't render <strong>".$key."</strong> becase you are currently in this shape. You can disable this message with add 'shape-debug' True at config.php</text>");
			return;
		}
		if(array_key_exists($key, $this->shapes)){
			$test = clone($this);
			$test->current = $key;
			return $this->CI->load->view($this->shapes[$key], ['shape'=>$test], TRUE);
		} else {
			$ea = false;
			if(!isset($this->CI->config->config['shape-debug'])){
				$ea = true;
			} else {
				if(!$this->CI->config->config['shape-debug']){
					$ea=true;
				}
			}
			if($ea) throw new ShapeException("<text> Shape with key <strong>".$key."</strong> not exist. You can disable this message with add 'shape-debug' True at config.php</text>");
		}
	}

}

class Shape{
	private $data_global;
	private $data_shape;
	private $shape;
	private $key_extend;
	private $extend;
	private $CI;

	public function __construct(){
		$this->CI =& get_instance();
	}

	public function extend($key, $extend, $value){
		$this->extend = $extend;
		$this->key_extend = $key;
		$this->addShape($key, $extend, $value);
		return $this;
	}

	public function addShape($key, $url, $data=NULL){
		$this->shape[$key] = $url;
		if($data != NULL){
			$this->setShapeData($key, $data);
		}
		return $this;
	}

	public function setGlobalData($value, $key = NULL){
		if($key == NULL){
			$this->data_global = $value;
		} else {
			$this->data_global[$key] = $value;
		}
		return $this;
	}

	public function setShapeData($shape, $value, $key = NULL){
		if($key == NULL){
			$this->data_shape[$shape] = $value;
		} else {
			$this->data_shape[$shape][$key] = $value;
		}
		return $this;
	}

	public function load($key=NULL, $extend=NULL, $value=NULL, $data = NULL){
		$this->data_global = $data != NULL ? $data : $this->data_global;	
		$dataShape = new DataShape($this->data_shape, $this->data_global, $this->shape, $extend != NULL ? $key : $this->key_extend);
		$this->CI->load->view($extend != NULL ? $extend : $this->extend, ['shape'=>$dataShape]);
	}
}
