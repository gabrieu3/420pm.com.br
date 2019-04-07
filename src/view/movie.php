<?php

Class MovieDto{
	
	private $cod;
	private $title;
	private $type;
	private $star;
	
	public function __construct($cod, $title, $type, $star){
		this.$cod = $cod;
		this.$title = $title;
		this.$type = $type;
		this.$star = $star;		
	}
	
	public function getCod(){
		return $cod;
	}
	
	public function getTitle(){
		return $title;
	}
	
	public function getType(){
		return $type;
	}
	
	public function getStar(){
		return $star;
	}
	
	public function setCod($cod){
		 this.$cod = $cod;
	}
	
	public function setTitle($title){
		 this.$title = $title;
	}
	
	public function setType($type){
		 this.$type = $type;
	}
	
	public function setStar($star){
		 this.$star = $star;
	}

}