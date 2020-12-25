"use strict";

// MARGIN TOP TO ADJUST ELEMENTS AFTER TOP NAVBAR
$("#navbarTop").next().css("margin-top",
    $("#navbarTop").outerHeight()
);

// MARGIN TOP ADJUSTMENT WHEN WINDOW IS RESIZE
$(window).resize(function() {
  $("#navbarTop").next().css("margin-top",
    $("#navbarTop").outerHeight()
  )
});

// TO TOGGLE ALL THE TOOLTIPS
$('[data-toggle="tooltip"]').tooltip();

$(function () {
  // TO TOGGLE ALL POPOVERS
  $('[data-toggle="popover"]').popover();
});