$('body').imagesLoaded().always( function( instance ) {
	console.log("hi!");
	$('body').imagesLoaded({ background: '.back-load' }, function() {
		console.log("bye");
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
