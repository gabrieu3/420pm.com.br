<?php

require('../dao/'.'MovieDao.php');

Class MovieController{

	private $movieList;
	private $movie;
	private $dao;
	private $dto;


	public function __construct(){
		$this->dao = new MovieDao();
	}

	private function round_up($number, $precision = 0)
	{
	    $fig = (int) str_pad('1', $precision, '0');
	    return (ceil($number * $fig) / $fig);
	}

	public function getMovies($pagination, $search){
		return $this->dao->getMovies($pagination, $search);
	}

	public function getQtMovies($search){
		$qtMoviesResult = $this->dao->getQtMovies($search);
		while ($qt = $qtMoviesResult->fetch_array()){
			return $qt[0];
		}
		return 0;
	}


	public function getQtPages($search){
		return $this->round_up($this->getQtMovies($search) / 12,0);
	}


	public function insertMovie($movie){
		$this->dao->insertMovie($movie);
	}

	public function getImage($cod){
		return $this->dao->getImage($cod);
	}

	public function insertView($cod){
    $this->dao->insertView($cod);
	}

	public function getView($cod){
		return $this->dao->getView($cod);
  }

 public function getPositionTitle($string){
	 $pos = 0;
	 $posAr = [];
	 $posAr[0] = (strpos(strtoupper($string),'TORRENT') != null) ? strpos(strtoupper($string),'TORRENT') : 1000 ;
	 $posAr[0] = (strpos(strtoupper($string),'TEMPORADA') != null) ? strpos(strtoupper($string),'TEMPORADA') : 1000 ;
	 $posAr[1] = (strpos($string,'(') != null) ? strpos($string,'(') : 1000 ;
	 $posAr[2] = (strpos($string,'/') != null) ? strpos($string,'/') : 1000 ;
	 $posAr[3] = (strpos($string,'-') != null) ? strpos($string,'-') : 1000 ;
	 $posAr[4] = (strpos($string,'–') != null) ? strpos($string,'–') : 1000 ;
	 $posAr[5] = (strpos($string,'ª') != null) ? strpos($string,'ª')-2 : 1000 ;
	 $posAr[6] = 30;

	 return min($posAr);

 }

  public function getSearchYoutube($cod, $string){

    return 'http://www.youtube.com/results?search_query=Trailer+'. trim(substr($string,0, $this->getPositionTitle($string)));

	}

	public function getSearchImdb($cod, $string){
		
		return 'https://m.imdb.com/find?q='. trim(substr($string,0, $this->getPositionTitle($string))).'&s=all';

	}
}
