if (document.body.classList.contains('single')) {

  window.addEventListener('scroll', workSingleStickiness);
  window.addEventListener('load', function(){
    const workInfo = document.querySelector('.work-single__column--info');
    const workInfoOffset = workInfo.offsetTop - 100;
    workSingleStickiness();
  });

  window.addEventListener('resize', function(){
    const workInfo = document.querySelector('.work-single__column--info');
    const workInfoOffset = workInfo.offsetTop - 100;
    workSingleStickiness();
  });


  const workInfo = document.querySelector('.work-single__column--info');
  const workInfoOffset = workInfo.offsetTop - 100;

  function workSingleStickiness() {
    const workInner = document.querySelector('.work-single__inner');
    const footer = document.querySelector('footer.footer');
    const workNav = document.querySelector('.work-single__nav');    
    const footerOffset = footer.offsetTop - window.innerHeight;
    let scrollPos = window.scrollY;
    
    // Work info column sticky
    if (scrollPos > workInfoOffset) {
      workInner.classList.add('work-single__inner--sticky');
    } else {
      workInner.classList.remove('work-single__inner--sticky');
    }

    // Work nav not sticky
    if(scrollPos > footerOffset) {
      workNav.classList.add('work-single__nav--not-sticky');
    } else {
      workNav.classList.remove('work-single__nav--not-sticky');
    }
  }


  const sections = document.querySelectorAll(".work-single__block");
  const navLi = document.querySelectorAll('.work__item__terms a');
  window.onscroll = () => {
    var current = "";

    sections.forEach((section) => {
      const sectionTop = section.offsetTop;
      if (scrollY >= sectionTop + 200) {
        current = section.getAttribute("id");
      }
    });

    navLi.forEach((a) => {
      a.classList.remove("active");
      if (a.classList.contains(current)) {
        a.classList.add("active");
      }
    });
  };
}

