<?php
	
require('../controller/'.'MovieController.php');

$pagination = (isset($_GET['pagination']))   ? $_GET['pagination']   : 0 ;
$search 	  = (isset($_GET['search']))   	   ? $_GET['search']   	   : "";

$controller = new MovieController();
$movieList = $controller->getMovies($pagination, $search);

while ($dados = $movieList->fetch_array()){
	echo '
	<div class="col-md-3">
	    
		
		<!-- 
	    	Product to offer - Begin
	    -->
	  	<div class="pm420-product">

	  		
	  		
	  		<!-- 
	    		Product image - Begin
	    	-->
	    	<div class="pm420-product-img">

			    <a href  					= "'.$dados['link'].'" 
			       title 					= "'.$dados['title'].'" 
			       data-lightbox-gallery  	= "gallery1" 
			       data-lightbox-hidpi		= "img/works/1@2x.jpg">
					
					 <img src="src/view/image.php?cod='.$dados['cod'].'" class="img-responsive" alt="img">
				</a>
			</div>	
	  		<!-- 
	    		Product image - End
	    	-->


          	<!-- 
            	Product navigation - Begin
            -->
            <div class="pm420-product-nav">
				<div class="text-left">
					<div class="btn-group">					
						<button type="button" onclick="likeme('.$dados['cod'].')" class="btn btn-default pm420-product-btn"> 
						<span class="pm420-prd-view-'.$dados['cod'].'">'.$dados['view'].'</span>
						<i class="fas fa-cannabis"></i></i>
						</button>

						<button type="button" onclick="window.location.href = \''.$controller->getSearchYoutube($dados['cod'],$dados['title']).' \' " class="btn btn-default pm420-product-btn">
						<i class="fas fa-shopping-cart"></i>
						</button>

						<button type="button" onclick="window.open(\''.$controller->getSearchImdb($dados['cod'],$dados['title']).'\',\'_blank\');" class="btn btn-default pm420-product-btn">
						<i class="fas fa-share-alt"></i>
						</button>
					</div>
				</div>
			</div>
			<!-- 
            	Product navigation - End
            -->

        </div>
		<!-- 
	    	Product to offer - End
	    -->        
	</div>
	';

	}
?>