
  $(function () {

    // MENU: cerrar navbar al hacer clic en un enlace,
    // pero NO si es el toggle del dropdown ni un item que abre modal
    $('.navbar-collapse a').on('click', function () {
      var $this = $(this);
      if ($this.hasClass('dropdown-toggle')) return;
      if ($this.attr('data-toggle') === 'modal') return;
      $(".navbar-collapse").collapse('hide');
    });

    // AOS ANIMATION
    AOS.init({
      disable: 'mobile',
      duration: 800,
      anchorPlacement: 'center-bottom'
    });

    // SMOOTHSCROLL: solo los enlaces con clase .smoothScroll que apunten a secciones reales
    $('.smoothScroll').on('click', function (event) {
      var href = $(this).attr('href');
      if (!href || href.charAt(0) !== '#') return;
      var $target = $(href);
      if (!$target.length) return;
      event.preventDefault();
      $('html, body').stop().animate({
        scrollTop: $target.offset().top - 49
      }, 1000);
    });

  });
