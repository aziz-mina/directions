/*-------------------------------------------------------------*/
/*                           Directions                        */
/*                       Author Mina isaac                     */
/*                          mina-isaac.com                     */
/*-------------------------------------------------------------*/

//------------------- Select2 Init------------------------------//

$(document).ready(function () {
  $('.select2').select2();
});

//------------------- Modal Sahre-------------------------------//

document.addEventListener('DOMContentLoaded', function (e) {
  let field = document.querySelector('.field');
  let input = document.querySelector('#copy_input');
  let copyBtn = document.querySelector('.field button');

  try {
    copyBtn.onclick = () => {
      input.select();
      if (document.execCommand("copy")) {
        field.classList.add('active');
        copyBtn.innerText = 'Copied';
        setTimeout(() => {
          field.classList.remove('active');
          copyBtn.innerText = 'Copy';
        }, 3500)

        navigator.clipboard.writeText(input.value);
      }
    }
  }
  catch (err) {
    // Do Nothing
  }

})

//------------------------- Bacic Loader -------------------------//

load_time = setTimeout(function () {
  $("#page-loader").hide();
  $("#app").show();
}, 1000);

//------------------- Stories Slider-----------------------------//

$('.story').owlCarousel({
  center: false,
  items: 3,
  loop: true,
  margin: 5,
  stagePadding: 15,
});
$('.owl-carousel').owlCarousel({
  loop: true,
  margin: 10,
  nav: false,
  navText: [
    "<i class='fa fa-caret-left'></i>",
    "<i class='fa fa-caret-right'></i>"
  ],
  autoplay: true,
  autoplayHoverPause: true,
  responsive: {
    0: {
      items: 1
    },
    600: {
      items: 3
    },
    1000: {
      items: 5
    }
  }
})

//------------------- Search feild-----------------------------//

var btn = $('#go-top');

$(window).scroll(function () {
  if ($(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function (e) {
  e.preventDefault();
  $('html, body').animate({ scrollTop: 0 }, '300');
});

//--------------------- tabs-----------------------------//

function activeTab(element) {
  let siblings = element.parentNode.querySelectorAll("button");
  for (let item of siblings) {
    item.children[0].innerHTML = "Inactive";
    item.children[1].classList.add("hidden");
    item.classList.add("text-gray-600");
    item.classList.remove("text-indigo-700");
  }
  element.children[0].innerHTML = "Active";
  element.children[1].classList.remove("hidden");
  element.classList.remove("text-gray-600");
  element.classList.add("text-indigo-700");
}

//--------------------- Modal-----------------------------//

