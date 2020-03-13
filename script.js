var ww = document.body.clientWidth;
      if (ww<768){
      var swiper = new Swiper('.swiper-container', {
        pagination: {
          el: '.swiper-pagination',
        },
        autoplay: {
          duration:1000,
        }
      });}
