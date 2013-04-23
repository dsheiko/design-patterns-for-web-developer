// NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
// IT'S ALL JUST JUNK FOR OUR DOCS!
// ++++++++++++++++++++++++++++++++++++++++++

!function ( $ ) {

    // Disable certain links in docs
    $('section [href^=#]').click(function (e) {
      e.preventDefault()
    });

    setTimeout(function () {
      $('.bs-docs-top').affix();
    }, 100);



}( window.jQuery )
