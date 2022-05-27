"use strict";

document.addEventListener('DOMContentLoaded', function () {
  $('.bottom-nav__item span').on('click', function () {
    $(this).parent().next().addClass('active');
    $('.header__bottom').addClass('scroll-off');
  });
  $('.back').on('click', function () {
    $(this).parents('.submenu').removeClass('active');
    $('.header__bottom').removeClass('scroll-off');
  });


  $('.item-entrance').on('click', function (e) {
    e.preventDefault();
    $(this).addClass('active')
    $(this).siblings().removeClass('active')
    $('.entrance-form--entrance').addClass('entrance-form--active');
    $('.entrance-form--registration').removeClass('entrance-form--active');
  });

  $('.item-registration').on('click', function (e) {
    e.preventDefault();
    $(this).addClass('active')
    $(this).siblings().removeClass('active')
    $('.entrance-form--entrance').removeClass('entrance-form--active');
    $('.entrance-form--registration').addClass('entrance-form--active');
  });

  lightGallery(document.getElementById('lightgallery'), {
    plugins: [lgZoom, lgThumbnail],
    speed: 500
  });
  var castomSelect = document.querySelectorAll('.castom-select');
  castomSelect.forEach(function (item) {
    var choices = new Choices(item);
  });

  function selectFanc() {
    var select = document.querySelectorAll('select');
    var selectParent = document.querySelectorAll('.select-block-wrap');

    if (select) {
      select.forEach(function (item) {
        item.addEventListener('blur', function () {
          item.parentElement.classList.remove('active');
        });
      });
      select.forEach(function (item) {
        item.addEventListener('change', function () {
          item.classList.add('active');
        });
      });
      select.forEach(function (item) {
        item.addEventListener('click', function () {
          if (item.parentElement.classList.contains('active')) {
            item.parentElement.classList.remove('active');
          } else {
            item.parentElement.classList.add('active');
          }
        });
      });
      window.addEventListener('scroll', function () {
        selectParent.forEach(function (item) {
          item.classList.remove('active');
        });
      });
    }
  }

  selectFanc();
});
"use strict";

function blogFilter() {
  var filterBox = document.querySelectorAll('.articles__item');
  var filterTop = document.querySelector('.blog-filter-top');
  var filterBtn = document.querySelectorAll('.blog-filter-top__btn');

  if (filterTop) {
    filterTop.addEventListener('click', function (event) {
      var filterClass = event.target.getAttribute("data-filter");
      filterBtn.forEach(function (item) {
        item.classList.remove('active');
      });
      event.target.classList.add('active');
      filterBox.forEach(function (elem) {
        elem.classList.remove('hide');

        if (!elem.classList.contains(filterClass) && filterClass !== 'all') {
          elem.classList.add('hide');
        }
      });
    });
  }
}

blogFilter();
"use strict";

function DynamicAdapt(type) {
  this.type = type;
}

DynamicAdapt.prototype.init = function () {
  var _this2 = this;

  var _this = this; // массив объектов


  this.оbjects = [];
  this.daClassname = "_dynamic_adapt_"; // массив DOM-элементов

  this.nodes = document.querySelectorAll("[data-da]"); // наполнение оbjects объктами

  for (var i = 0; i < this.nodes.length; i++) {
    var node = this.nodes[i];
    var data = node.dataset.da.trim();
    var dataArray = data.split(",");
    var оbject = {};
    оbject.element = node;
    оbject.parent = node.parentNode;
    оbject.destination = document.querySelector(dataArray[0].trim());
    оbject.breakpoint = dataArray[1] ? dataArray[1].trim() : "767";
    оbject.place = dataArray[2] ? dataArray[2].trim() : "last";
    оbject.index = this.indexInParent(оbject.parent, оbject.element);
    this.оbjects.push(оbject);
  }

  this.arraySort(this.оbjects); // массив уникальных медиа-запросов

  this.mediaQueries = Array.prototype.map.call(this.оbjects, function (item) {
    return '(' + this.type + "-width: " + item.breakpoint + "px)," + item.breakpoint;
  }, this);
  this.mediaQueries = Array.prototype.filter.call(this.mediaQueries, function (item, index, self) {
    return Array.prototype.indexOf.call(self, item) === index;
  }); // навешивание слушателя на медиа-запрос
  // и вызов обработчика при первом запуске

  var _loop = function _loop(_i) {
    var media = _this2.mediaQueries[_i];
    var mediaSplit = String.prototype.split.call(media, ',');
    var matchMedia = window.matchMedia(mediaSplit[0]);
    var mediaBreakpoint = mediaSplit[1]; // массив объектов с подходящим брейкпоинтом

    var оbjectsFilter = Array.prototype.filter.call(_this2.оbjects, function (item) {
      return item.breakpoint === mediaBreakpoint;
    });
    matchMedia.addListener(function () {
      _this.mediaHandler(matchMedia, оbjectsFilter);
    });

    _this2.mediaHandler(matchMedia, оbjectsFilter);
  };

  for (var _i = 0; _i < this.mediaQueries.length; _i++) {
    _loop(_i);
  }
};

DynamicAdapt.prototype.mediaHandler = function (matchMedia, оbjects) {
  if (matchMedia.matches) {
    for (var i = 0; i < оbjects.length; i++) {
      var оbject = оbjects[i];
      оbject.index = this.indexInParent(оbject.parent, оbject.element);
      this.moveTo(оbject.place, оbject.element, оbject.destination);
    }
  } else {
    for (var _i2 = 0; _i2 < оbjects.length; _i2++) {
      var _оbject = оbjects[_i2];

      if (_оbject.element.classList.contains(this.daClassname)) {
        this.moveBack(_оbject.parent, _оbject.element, _оbject.index);
      }
    }
  }
}; // Функция перемещения


DynamicAdapt.prototype.moveTo = function (place, element, destination) {
  element.classList.add(this.daClassname);

  if (place === 'last' || place >= destination.children.length) {
    destination.insertAdjacentElement('beforeend', element);
    return;
  }

  if (place === 'first') {
    destination.insertAdjacentElement('afterbegin', element);
    return;
  }

  destination.children[place].insertAdjacentElement('beforebegin', element);
}; // Функция возврата


DynamicAdapt.prototype.moveBack = function (parent, element, index) {
  element.classList.remove(this.daClassname);

  if (parent.children[index] !== undefined) {
    parent.children[index].insertAdjacentElement('beforebegin', element);
  } else {
    parent.insertAdjacentElement('beforeend', element);
  }
}; // Функция получения индекса внутри родителя


DynamicAdapt.prototype.indexInParent = function (parent, element) {
  var array = Array.prototype.slice.call(parent.children);
  return Array.prototype.indexOf.call(array, element);
}; // Функция сортировки массива по breakpoint и place 
// по возрастанию для this.type = min
// по убыванию для this.type = max


DynamicAdapt.prototype.arraySort = function (arr) {
  if (this.type === "min") {
    Array.prototype.sort.call(arr, function (a, b) {
      if (a.breakpoint === b.breakpoint) {
        if (a.place === b.place) {
          return 0;
        }

        if (a.place === "first" || b.place === "last") {
          return -1;
        }

        if (a.place === "last" || b.place === "first") {
          return 1;
        }

        return a.place - b.place;
      }

      return a.breakpoint - b.breakpoint;
    });
  } else {
    Array.prototype.sort.call(arr, function (a, b) {
      if (a.breakpoint === b.breakpoint) {
        if (a.place === b.place) {
          return 0;
        }

        if (a.place === "first" || b.place === "last") {
          return 1;
        }

        if (a.place === "last" || b.place === "first") {
          return -1;
        }

        return b.place - a.place;
      }

      return b.breakpoint - a.breakpoint;
    });
    return;
  }
};

var da = new DynamicAdapt("max");
da.init();
"use strict";

function initAccordion() {
  var questions = document.querySelectorAll(".faq__question");

  if (questions.length != 0) {
    questions.forEach(function (item) {
      item.addEventListener("click", function () {
        if (this.classList.contains("active")) {
          this.classList.remove("active");
          this.nextElementSibling.style.maxHeight = "";
        } else {
          this.classList.add("active");
          this.nextElementSibling.style.maxHeight = this.nextElementSibling.scrollHeight + "px";
        }
      });
    });
  }
}

initAccordion();
"use strict";

function menu() {
  var burger = document.querySelector('.burger');
  var nav = document.querySelector('.header__bottom');
  var overley = document.querySelector('.overley');
  var scrollHide = calcScroll();

  function closeMenu() {
    overley.classList.remove('active');
    nav.classList.remove('active');
    burger.classList.remove('active');
    document.body.style.overflow = "";
    document.body.style.marginRight = '';
  }

  if (burger) {
    burger.addEventListener('click', function () {
      this.classList.toggle('active');
      nav.classList.toggle('active');
      overley.classList.toggle('active');

      if (!nav.classList.contains('active')) {
        document.body.style.overflow = "";
        document.body.style.marginRight = '';
      } else {
        document.body.style.overflow = "hidden";
        document.body.style.marginRight = "".concat(scrollHide, "px");
      }
    });
  }

  if (overley) {
    overley.addEventListener('click', function () {
      closeMenu();
    });
  }

  function calcScroll() {
    var div = document.createElement('div');
    div.style.width = '50px';
    div.style.height = '50px';
    div.style.overflowY = 'scroll';
    div.style.visibility = 'hidden';
    document.body.appendChild(div);
    var scrollWidth = div.offsetWidth - div.clientWidth;
    div.remove();
    return scrollWidth;
  }
}

menu();

function hideHighlightBar() {
  var highlightBar = document.querySelector('.highlight-bar');
  var highlightBarBtn = document.querySelector('.highlight-bar__btn');

  if (highlightBar) {
    var value = JSON.parse(localStorage.getItem("hideHighlightBar"));

    if (value != "yes") {
      highlightBarBtn.addEventListener('click', function () {
        highlightBar.classList.add("hide");
        localStorage.setItem("hideHighlightBar", JSON.stringify("yes"));
      });
    } else {
      highlightBar.classList.add("disabled");
    }
  }
}

hideHighlightBar();
"use strict";

var popup = document.querySelector(".popup");
var popupOverley = document.querySelector(".popup__overley");
var popupBtn = document.querySelector(".popup__btn");
var page = document.querySelector('.page');
var scrollPosition;

function mobileHeight() {
  var vh = window.innerHeight * 0.01;
  document.documentElement.style.setProperty('--vh', "".concat(vh, "px"));
}

var hideScroll = function hideScroll() {
  mobileHeight();
  var scrollWidth = "".concat(getScrollbarWidth(), "px");
  scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
  page.classList.add("scroll-hide");
  page.style.paddingRight = scrollWidth;
  page.scroll(0, scrollPosition);
};

var showScroll = function showScroll() {
  page.style.paddingRight = '';
  page.style.overflow = '';
  page.classList.remove("scroll-hide");
  window.scroll(0, scrollPosition);
}; // Get scrollbar width


var getScrollbarWidth = function getScrollbarWidth() {
  var outer = document.createElement('div');
  outer.style.position = 'absolute';
  outer.style.top = '-9999px';
  outer.style.width = '50px';
  outer.style.height = '50px';
  outer.style.overflow = 'scroll';
  outer.style.visibility = 'hidden';
  document.body.appendChild(outer);
  var getScrollbarWidth = outer.offsetWidth - outer.clientWidth;
  document.body.removeChild(outer);
  return getScrollbarWidth;
};

function showPopup() {
  if (popup) {
    popup.classList.add('active');
    hideScroll();
  }
} // showPopup();


function hidePopup() {
  if (popup) {
    popupOverley.addEventListener("click", function () {
      popup.classList.remove('active');
      showScroll();
    });
    popupBtn.addEventListener("click", function () {
      popup.classList.remove('active');
      showScroll();
    });
  }
}

hidePopup();
"use strict";

var introSwiper = new Swiper(".intro", {
  loop: true,
  speed: 2000,
  autoplay: {
    delay: 10000
  },
  // allowTouchMove: false,
  navigation: {
    nextEl: ".intro-button-next",
    prevEl: ".intro-button-prev"
  }
});
var categoryIntroSlider = new Swiper(".category-intro__slider", {
  loop: true,
  speed: 2000,
  autoplay: {
    delay: 10000
  },
  // allowTouchMove: false,
  navigation: {
    nextEl: ".category-intro__next",
    prevEl: ".category-intro__prev"
  }
});
var swiper2 = new Swiper(".highlights__inner", {
  speed: 1700,
  freeMode: true,
  pagination: {
    el: ".highlights__progressbar",
    type: "progressbar"
  },
  breakpoints: {
    // when window width is >= 320px
    320: {
      spaceBetween: 10,
      slidesPerView: 1.2
    },
    500: {
      spaceBetween: 15,
      slidesPerView: 1.8
    },
    769: {
      slidesPerView: 2.3,
      spaceBetween: 15
    },
    1025: {
      slidesPerView: 3,
      spaceBetween: 30
    }
  }
});
var categoryNav = new Swiper('.category-nav__slider', {
  freeMode: true,
  pagination: {
    el: ".category-nav__progressbar",
    type: "progressbar"
  },
  breakpoints: {
    // when window width is >= 320px
    320: {
      spaceBetween: 15,
      slidesPerView: 1.2,
      speed: 700
    },
    500: {
      spaceBetween: 15,
      slidesPerView: 1.8
    },
    768: {
      slidesPerView: 2.3,
      spaceBetween: 30
    },
    1024: {
      slidesPerView: 3.4,
      spaceBetween: 30,
      speed: 1700
    },
    1366: {
      slidesPerView: 4.4,
      spaceBetween: 30
    }
  }
});
var swiper3 = new Swiper(".category__slider", {
  slidesPerView: 4.5,
  spaceBetween: 30,
  speed: 1700,
  freeMode: true,
  pagination: {
    el: ".category__progressbar",
    type: "progressbar"
  },
  breakpoints: {
    320: {
      spaceBetween: 10,
      slidesPerView: 1.2
    },
    425: {
      spaceBetween: 15,
      slidesPerView: 1.4
    },
    625: {
      spaceBetween: 15,
      slidesPerView: 2
    },
    768: {
      spaceBetween: 15,
      slidesPerView: 2.2
    },
    1024: {
      spaceBetween: 20,
      slidesPerView: 3.2
    },
    1366: {
      slidesPerView: 4.5,
      spaceBetween: 20
    },
    1440: {
      slidesPerView: 4.5,
      spaceBetween: 30
    }
  }
});
var testimonialsSlider = new Swiper(".testimonials__slider", {
  slidesPerView: 3,
  spaceBetween: 30,
  speed: 700,
  loop: true,
  navigation: {
    nextEl: ".testimonials-button-next",
    prevEl: ".testimonials-button-prev"
  },
  breakpoints: {
    320: {
      spaceBetween: 10,
      slidesPerView: 1.7
    },
    768: {
      spaceBetween: 10,
      slidesPerView: 3.2
    },
    1024: {
      slidesPerView: 3
    }
  }
});
var cardPageSwiper = new Swiper(".card-page-swiper", {
  slidesPerView: 1,
  spaceBetween: 0,
  loop: true,
  speed: 1000,
  pagination: {
    el: ".swiper-pagination",
    clickable: true
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev"
  }
});
var sliderProdSwiper = new Swiper(".slider-prod-swiper", {
  slidesPerView: 1,
  spaceBetween: 0,
  loop: true,
  speed: 1000,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev"
  }
});
var reviewsSwiper = new Swiper(".reviews-swiper", {
  slidesPerView: 3,
  spaceBetween: 30,
  speed: 1000,
  pagination: {
    el: ".highlights__progressbar",
    type: "progressbar"
  },
  breakpoints: {
    1300: {
      slidesPerView: 3
    },
    1070: {
      slidesPerView: 2.5
    },
    900: {
      slidesPerView: 2.1
    },
    300: {
      slidesPerView: 1.3
    }
  }
});

if (window.innerWidth < 580) {
  var practicFancSwiper = new Swiper(".practic-fanc-swiper", {
    slidesPerView: 1.7,
    spaceBetween: 15,
    pagination: {
      el: ".highlights__progressbar",
      type: "progressbar"
    }
  });
  var miniCardSwiper = new Swiper(".mini-card-swiper", {
    slidesPerView: 1.4,
    spaceBetween: 30,
    pagination: {
      el: ".highlights__progressbar",
      type: "progressbar"
    }
  });
  var bestsellerList = new Swiper(".bestseller__list", {
    slidesPerView: 1.25,
    spaceBetween: 30,
    freeMode: true,
    observer: true,
    observeParents: true,
    pagination: {
      el: ".bestseller__progressbar",
      type: "progressbar"
    },
    breakpoints: {
      520: {
        slidesPerView: 1.9,
        spaceBetween: 30
      },
      465: {
        slidesPerView: 1.6,
        spaceBetween: 30
      },
      425: {
        slidesPerView: 1.4,
        spaceBetween: 30
      },
      300: {
        slidesPerView: 1.25,
        spaceBetween: 30
      }
    }
  });
}
"use strict";

function toggleVideo() {
  var video = document.querySelector(".video-block__player");
  var button = document.querySelector(".video-block__control");

  if (video != null) {
    button.addEventListener("click", function () {
      if (this.classList.contains("play")) {
        this.classList.remove("play");
        video.pause();
      } else {
        video.play();
        this.classList.add("play");
      }
    });
    video.addEventListener("click", function () {
      if (button.classList.contains("play")) {
        button.classList.remove("play");
        video.pause();
      } else {
        button.classList.add("play");
        video.play();
      }
    });
  }
}

toggleVideo();
"use strict";
//# sourceMappingURL=main.js.map
