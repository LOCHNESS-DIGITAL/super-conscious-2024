$(function(){

  
  $(document).on('click tap', '.splide__slide', function(){
    open($(this));
  })

  $('.modal__close').on('click', function(){
    close();
  })

  $(document).keyup(function(e) {
    if (e.key === "Escape") { // escape key maps to keycode `27`
      close();
    } else if (e.keyCode == '39') {
      next();
    } else if (e.keyCode == '37') {
      prev();
    }
  });


  var hammertime = new Hammer(document.getElementById('modal'));

  hammertime.on('swipeleft', function() {
    next();
  })

  hammertime.on('swiperight', function() {
    prev();
  })

  $('.modal__nav__item--next').on('click', function(){
    next();
  })

  $('.modal__nav__item--prev').on('click', function(){
    prev();
  })

  $(document).on('swiperight',$('.modal--active'),  function() {
    next();
  });

  $('.modal--active').not('.modal__nav, .modal__image').click(function(){
    close();
  })

function next() {
  var activeItem = $('.modal__image--active');
  muteAllVideos();
  $('.modal__image').removeClass('modal__image--active');
  if($(activeItem).is(':last-child')) {
    $('.modal__image').first().addClass('modal__image--active')
  } else {
    $(activeItem).next().addClass('modal__image--active')
  }
  if($('.modal .modal__image--active video').length){
    $('.modal .modal__image--active video')[0].muted = !$('.modal .modal__image--active video')[0].muted;
  }
}

function prev() {
  var activeItem = $('.modal__image--active');
  muteAllVideos();
  $('.modal__image').removeClass('modal__image--active');
  if($(activeItem).is(':first-child')) {
    $('.modal__image').last().addClass('modal__image--active')
  } else {
    $(activeItem).prev().addClass('modal__image--active')
  }
  $('.modal .modal__image--active video')[0].muted = !$('.modal .modal__image--active video')[0].muted;
}

function open(image) {
  var imageUrl = image.find('img').attr('data-src');
  var slideID = $(image).attr('id').slice(-2);
  var activeSlideNumber = Math. round(slideID*100)/100;
  $('.site-container').attr('data-scroll-pos', $(document).scrollTop());
  
  $('.site-container').addClass('modal-active');  
  image.closest('.splide__list').children().clone().appendTo('.modal__images');
  $('.modal__images > *').removeAttr('class');
  $('.modal__images > *').attr('class', 'modal__image');
  $('.modal__images')
  $('.splide__slide').removeClass('work__item__image--in-view')
  $('.modal__image').eq(activeSlideNumber - 1).addClass('modal__image--active');
  image.addClass('work__item__image--in-view');
  $('.modal').addClass('modal--active');

  if($('.modal .modal__image--active video').length){
    $('.modal .modal__image--active video')[0].muted = !$('.modal .modal__image--active video')[0].muted;
  }
}

function close() {
  var scrollToPosition = $('.site-container').attr('data-scroll-pos');
  muteAllVideos();
  $('.site-container').removeClass('modal-active');
  
  $(document).scrollTop(scrollToPosition);
  $('.modal').removeClass('modal--active');
  $('.modal__images').html('');
}

function muteAllVideos() {
  const videos = document.querySelectorAll('video');
  const volumeUp = document.querySelectorAll('.work__item__video__volume-up');
  const volumeDown = document.querySelectorAll('.work__item__video__volume-down');

  videos.forEach(video => {
      video.muted = true;
  });

  volumeDown.forEach(item => {
    item.classList.remove('active');
  })

  volumeUp.forEach(item => {
    item.classList.add('active');
  })
}

});


