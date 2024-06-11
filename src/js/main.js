import 'lazysizes';
import $ from 'cash-dom';
// import smoothscroll from 'smoothscroll-polyfill';

import 'widok';

// smoothscroll.polyfill();

function openNav() {
  if (isNavOpen) return;
  $('#burger, nav').addClass('opened');
  isNavOpen = true;
}

function closeNav() {
  if (!isNavOpen) return;
  $('#burger, nav').removeClass('opened');
  isNavOpen = false;
}

let isNavOpen = false;

$('#burger').on('click', event => {
  if (isNavOpen) closeNav();
  else openNav();
});

$('#burger, nav').on('click', event => {
  event.isFromNav = true;
});

$(document).on('click', event => {
  if (isNavOpen && event.isFromNav !== true) closeNav();
});
