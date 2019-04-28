/**
 * Scriptzin
 */
/**
 * Function to load content with AJAX
 */
var qtdeMax = 0;
qtPages();
var pageNumber		= 1;
var search	= "";

/**
 * Function to paginate
 *
 */
function loadDoc(pagination) {
	  var url = 'src/view/list.php';
	  var param = '?pagination='+pagination+'&search='+search;
		var urlPagination = url + param;

		if (pagination = 0){
			$('.pm420-cards').html("");
			pageNumber		= 1;
		}

		$.ajax({
			url: urlPagination,
			dataType: 'html',
			success: function(html) {
				$('.pm420-cards').append(html);
				$('#loading').hide();
				if (html.length == 0){
					$('#info').show();
				}
			},
			error: function() {
				$('#loading').hide();
				$('#info').show();
		 },
		});

		if (pageNumber == qtdeMax){
			$('#info').show();
		}

		$('#log').append("urlPagination " + urlPagination + "<br>");
    //$('#info').show();
}

/**
 * Function to initialize content,
 * load the first page
 */
function init(){
	loadDoc(0);
}

/**
 * function to find the number of pages:
 * $qtdeMax
 */
function qtPages() {
		$.ajax({
			url: 'src/function/qtMoviesPage.php',
			dataType: 'html',
			method: "GET",
			data: {"search": search},
			success: function(html) {
				qtdeMax =  parseInt(html);
			},
		});
}



function openInNewTab(url) {
  var win = window.open(url, '_blank');
  win.focus();
}


/**
 * function to add a click to the product
 * $qtdeMax
 */
function likeme(cod) {
  console.log(cod);	
  $.ajax({
			url: 'src/view/click.php',
			dataType: 'html',
			method: "POST",
			data: {"cod": cod},
			success: function(html) {
				$('.pm420-prd-view-'+cod).html(html);
			},
		});
}


/**
 * When the DOM is ready do this...
 */
$(document).ready(function() {
	var win = $(window);
	// Each time the user scrolls
	win.scroll(function() {
		var a = $(document).height();
		var b = window.innerHeight;
		var c = win.scrollTop();
		// End of the document reached?
		if ($(document).height() - window.innerHeight <= win.scrollTop() + 300) {

			pageNumber =  pageNumber + 1 ;

			if( pageNumber <= qtdeMax ){
				$('#loading').show();
				loadDoc(pageNumber);
				if (pageNumber == qtdeMax){
					$('#info').show("slow");
				}
				$('#log').append("$(document).height() " + a + "<br>");
				$('#log').append("window.innerHeight " +b + "<br>");
				$('#log').append("win.scrollTop() " + c + "<br>");
				$('#log').append("pageNumber " + pageNumber + "<br>");
				$('#log').append("$(document).height() - window.innerHeight <= win.scrollTop() + 10 -----> " + (a - b) + "<=" + (c + 10 ) + "<br><br><br>");

			}else {
					pageNumber = qtdeMax + 1; //Always last page more one.
			}
		}
	});
});


$(document).ready(function(){
     $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        // scroll body to 0px on click
        $('#back-to-top').click(function () {
            $('#back-to-top').tooltip('hide');
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });

        $('#back-to-top').tooltip('show');

});



$(document).ready(function(){
	$('#search-button').click(function () {
		search = $('#input-search').val();
		search = search.trim();
		$('.pm420-cards').html("");
		pageNumber		= 1;
		qtPages();
		loadDoc(0);
		return false;
	});

	$('#input-search').keypress(function (e) {
	  if (e.which == 13) {
			search = $('#input-search').val();
			search = search.trim();
			$('.pm420-cards').html("");
			pageNumber		= 1;
			qtPages();
			loadDoc(0);
			return false;
	  }
	});

});

/*Event of button about*/
$('.about').on('click', function (){
	var urlpath = 'src/view/about.php';
	$.ajax({
			url: urlpath,
			dataType: 'html',
			success: function(html) {
				$('.container').append(html);
				$('#loading').hide();
			},
			error: function() {
				$('#loading').hide();
		 },
		});
});