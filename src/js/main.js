import 'lazysizes';
import $ from 'cash-dom';
// import smoothscroll from 'smoothscroll-polyfill';

import 'widok';
import createSlider from "widok-slider";

import './nav';

// smoothscroll.polyfill();

$('.image-group-wrap').each((index, DOMElement) => {
  const wrap = $(DOMElement);
  const slides = wrap.find('.image-column');
  if (slides.length <= 2) return;

  const slideNumberElement = wrap.find('.image-group-current');
  const id = `image-group-${index}`;
  wrap.attr({ id });
  createSlider({
    wrap: wrap.find('.image-group'),
    slideSelector: '.image-column',
    useKeys: true,
    mouseDrag: true,
    touchDrag: true,
    loop: true,
    arrowPrev: `#${id} .image-group-prev`,
    arrowNext: `#${id} .image-group-next`,
    onActivate: slide => {
      slideNumberElement.text(slide.realId + 1);
    },
  });
});

document.querySelectorAll('.sbi_photo').forEach(DOMElement => {
  const img = DOMElement.querySelector('img');
  img.dataset.src = DOMElement.dataset.fullRes;
  img.classList.add('lazyload');
});
