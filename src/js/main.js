import 'lazysizes';
import $ from 'cash-dom';
import smoothscroll from 'smoothscroll-polyfill';

import 'widok';
import createSlider from "widok-slider";

import './nav';

smoothscroll.polyfill();

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

const deliCategories = document.querySelector('.deli-categories');
if (deliCategories) {
  let dragging = false;
  let moved = false;
  let startX = 0;
  let startScroll = 0;

  deliCategories.addEventListener('pointerdown', e => {
    if (e.pointerType !== 'mouse') return;
    dragging = true;
    moved = false;
    startX = e.clientX;
    startScroll = deliCategories.scrollLeft;
  });

  // starting a drag on a chip would otherwise begin a native link drag
  deliCategories.addEventListener('dragstart', e => e.preventDefault());

  window.addEventListener('pointermove', e => {
    if (!dragging) return;
    const dx = e.clientX - startX;
    if (Math.abs(dx) > 5) moved = true;
    if (!moved) return;
    deliCategories.classList.add('is-dragging');
    deliCategories.scrollLeft = startScroll - dx;
    e.preventDefault();
  });

  const endDrag = () => {
    dragging = false;
    deliCategories.classList.remove('is-dragging');
  };
  window.addEventListener('pointerup', endDrag);
  window.addEventListener('pointercancel', endDrag);

  // swallow the click that ends a drag so it doesn't jump to a category
  deliCategories.addEventListener(
    'click',
    e => {
      if (!moved) return;
      e.preventDefault();
      e.stopPropagation();
    },
    true
  );
}

$('.deli-category-btn').on('click', function (e) {
  e.preventDefault();
  const target = document.querySelector($(this).attr('href'));
  if (!target) return;
  const navHeight =
    document.querySelector('.deli-categories-wrap')?.offsetHeight ?? 0;
  const top = target.getBoundingClientRect().top + window.scrollY - navHeight;
  window.scrollTo({ top, behavior: 'smooth' });
});

document.querySelectorAll('.sbi_photo').forEach(DOMElement => {
  const img = DOMElement.querySelector('img');
  img.dataset.src = DOMElement.dataset.fullRes;
  img.classList.add('lazyload');
});
