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

// TO TOGGLE ALL POPOVERS
$(function () {
  $('[data-toggle="popover"]').popover();
});