<?php

Class MovieDto{

	private $cod;
	private $title;
	private $type;
	private $star;
	private $link;
	private $image;
	private $src;
	private $view;

	public function __construct(){
		$this->title = '';
		$this->type  = '';
		$this->star  = '';
		$this->link  = '';
		$this->src   = '';
		$this->view  = 0;
	}

	/*public function __construct($cod, $title, $type, $star, $link, $image, $src){
		this.$cod = $cod;
		this.$title = $title;
		this.$type = $type;
		this.$star = $star;
		this.$link = $link;
		this.$image = $image;
		this.$src = $src;
	}*/

	public function getCod(){
		return $this->cod;
	}

	public function getTitle(){
		return $this->title;
	}

	public function getType(){
		return $this->type;
	}

	public function getStar(){
		return $this->star;
	}

	public function getLink(){
		return $this->link;
	}

	public function getImage(){
		return $this->image;
	}

	public function getSrc(){
		return $this->src;
	}

	public function getView(){
		return $this->view;
	}

	public function setCod($cod){
		 $this->cod = $cod;
	}

	public function setTitle($title){
		 $this->title = $title;
	}

	public function setType($type){
		 $this->type = $type;
	}

	public function setStar($star){
		 $this->star = $star;
	}

	public function setLink($link){
		 $this->link = $link;
	}

	public function setImage($image){
		 $this->image = $image;
	}

	public function setSrc($src){
		 $this->src = $src;
	}

	public function setView($view){
		 $this->view = $view;
	}

}
