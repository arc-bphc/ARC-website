$('body').imagesLoaded().always( function( instance ) {
	$('.back-load').imagesLoaded( { background: true }, function() {
		console.log("hello!!");
	  $('body').addClass('loaded');
	});
 });

document.getElementById("loginUser").addEventListener('click', function() {
	overlay.className = 'show';
    popup.className = 'show';
});

document.getElementById("popupclose").addEventListener('click', function() {
	overlay.className = '';
    popup.className = '';
});

document.getElementById("overlay").addEventListener('click', function() {
	overlay.className = '';
    popup.className = '';
});
