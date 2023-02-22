$(document).ready(function(){

  $('#F1').hide();
  $('#F10').hide();
  $('#sousmenu').hide();
  $('#gesttable').hide();
  $('.olcards').hide();
  $('#gestmenu').hide();
  $('#gestwaiter').hide();
  $('#compteClient').hide();
  $('#gestorders').hide();
    $('#BT0').click(function(){
        $('#BT0').addClass('active');
       $('#BT1').removeClass('active');
       $('#BT2').removeClass('active');
       $('#BT3').removeClass('active');
       $('#BT4').removeClass('active');
       $('#BT5').removeClass('active');
       $('#BT6').removeClass('active');
       $('#sousmenu').slideUp();
       $('.card').show();
       $('#F1').hide();
       $('#gesttable').hide();
       $('.olcards').hide();
       $('#gestmenu').hide();
       $('#gestwaiter').hide();
       $('#compteClient').hide();
       $('#gestorders').hide();
       $('#statistiqued').show();
       $('#F10').hide();

    });
    $('#histo').hide();
    $('.olcardsfilt').hide();
    $('.gererrepas').hide();
    $('#BT1').click(function(){
        $('#BT1').addClass('active');
       $('#BT0').removeClass('active');
       $('#BT2').removeClass('active');
       $('#BT3').removeClass('active');
       $('#BT4').removeClass('active');
       $('#BT5').removeClass('active');
       $('#BT6').removeClass('active');
       $('#sousmenu').slideUp();
       $('.card').hide();
       $('#F1').show();
       $('#gesttable').hide();
       $('.olcards').show();
       $('#gestmenu').hide();
       $('#gestwaiter').hide();
       $('#compteClient').hide();
       $('#customersToaday').hide();
        $('#F4').hide();
        $('#ordersTo').hide();
        $('#gestorders').hide();
        $('#F10').hide();
        $('#statistiqued').hide();
    });
    $('#BT2').click(function(){
        $('#BT2').addClass('active');
       $('#BT1').removeClass('active');
       $('#BT0').removeClass('active');
       $('#BT3').removeClass('active');
       $('#BT4').removeClass('active');
       $('#BT5').removeClass('active');
       $('#BT6').removeClass('active');
       $('#sousmenu').slideUp();
       $('#gestorders').show();
       $('.card').hide();
       $('#gesttable').hide();
       $('#F1').hide();
       $('#gesttable').hide();
       $('.olcards').hide();
       $('#gestmenu').hide();
       $('#gestwaiter').hide();
       $('#compteClient').hide();
       $('#customersToaday').hide();
        $('#F4').hide();
        $('#ordersTo').hide();
        $('#statistiqued').hide();
        $('#F10').hide();
    });
    $('.contcol').hide();
    $('.controlercal').hide();
    $('#BT3').click(function(){
        $('#BT3').addClass('active');
       $('#BT1').removeClass('active');
       $('#BT0').removeClass('active');
       $('#BT2').removeClass('active');
       $('#BT4').removeClass('active');
       $('#BT5').removeClass('active');
       $('#BT6').removeClass('active');
       $('#sousmenu').slideUp();
       $('.card').hide();
       $('#gesttable').hide();
       $('#F1').hide();
       $('#gesttable').hide();
       $('.olcards').hide();
       $('#gestmenu').hide();
       $('#gestwaiter').hide();
       $('#compteClient').show();
       $('#customersToaday').hide();
        $('#F4').hide();
        $('#ordersTo').hide();
        $('#gestorders').hide();
        $('#F10').hide();
        $('#statistiqued').hide();
    });
    $('#BT4').click(function(){
        $('#BT4').addClass('active');
       $('#BT1').removeClass('active');
       $('#BT0').removeClass('active');
       $('#BT3').removeClass('active');
       $('#BT2').removeClass('active');
       $('#BT5').removeClass('active');
       $('#BT6').removeClass('active');
       $('#sousmenu').slideToggle();
       $('#btn1').removeClass('activetwo');
       $('#btn2').removeClass('activetwo');
       $('#btn3').removeClass('activetwo');
       $('#customersToaday').hide();
        $('#F4').hide();
        $('#ordersTo').hide();
        $('#gestorders').hide();
        $('#statistiqued').hide();
        $('#F10').hide();
    });
    $('#BT5').click(function(){
        $('#BT5').addClass('active');
       $('#BT1').removeClass('active');
       $('#BT0').removeClass('active');
       $('#BT3').removeClass('active');
       $('#BT4').removeClass('active');
       $('#BT2').removeClass('active');
       $('#BT6').removeClass('active');
       $('.olcards').hide();
       $('.gererrepas').hide();
       $('.olcardsfilt').hide();
       $('#histo').hide();
       $('.controlercal').hide();
       $('.olcards').hide();
       $('#gestmenu').hide();
       $('#compteClient').hide();
       $('#statistiqued').hide();
       $('#F10').hide();
    });
    $('#BT6').click(function(){
        $('#BT6').addClass('active');
       $('#BT1').removeClass('active');
       $('#BT0').removeClass('active');
       $('#BT3').removeClass('active');
       $('#BT4').removeClass('active');
       $('#BT5').removeClass('active');
       $('#BT2').removeClass('active');
       
    });
    $('#F3').hide();
    $('#BT5').click(function(){
        $('#F3').show();
    });
    $('#BT0').click(function(){
        $('#F3').hide();
    });
    $('#BT1').click(function(){
        $('#F3').hide();
    });
    $('#BT6').click(function(){
        $('#F3').hide();
    });

    $('#btn1').click(function(){
      $('#btn1').addClass('activetwo');
      $('#btn2').removeClass('activetwo');
      $('#btn3').removeClass('activetwo');
      $('#btn4').removeClass('activetwo');
      $('.card').hide();
      $('#F1').hide();
      $('#gesttable').show();
      $('.olcards').hide();
      $('#gestmenu').hide();
      $('#gestwaiter').hide();
      $('#compteClient').hide();
      $('#F10').hide();
     });

     $('#btn2').click(function(){
      $('#btn2').addClass('activetwo');
      $('#btn1').removeClass('activetwo');
      $('#btn3').removeClass('activetwo');
      $('#btn4').removeClass('activetwo');
      $('#gesttable').hide();
      $('.card').hide();
      $('#F1').hide();
      $('.olcards').hide();
      $('#gestmenu').show();
      $('#gestwaiter').hide();
      $('#compteClient').hide();
      $('#F10').hide();
     });

     $('#btn3').click(function(){
      $('#btn3').addClass('activetwo');
      $('#btn1').removeClass('activetwo');
      $('#btn2').removeClass('activetwo');
      $('#btn4').removeClass('activetwo');
      $('#gesttable').hide();
      $('.card').hide();
      $('#F1').hide();
      $('.olcards').hide();
      $('#gestmenu').hide();
      $('#gestwaiter').show();
      $('#compteClient').hide();
      $('#F10').hide();
     });
     $('#btn4').click(function(){
      $('#btn4').addClass('activetwo');
      $('#btn3').removeClass('activetwo');
      $('#btn1').removeClass('activetwo');
      $('#btn2').removeClass('activetwo');
      $('#gesttable').hide();
      $('.card').hide();
      $('#F1').hide();
      $('.olcards').hide();
      $('#gestmenu').hide();
      $('#gestwaiter').hide();
      $('#compteClient').hide();
      $('#F10').show();
     });
    


    /*$('.new_Btn').click(function() {
        $('#html_btn').click();
    });*/

    /*button image */

  
});


/* Get DOM Elements
const modal = document.querySelector('#my-modal');
const modalBtn = document.querySelector('#mdf');
const modalBtn2 = document.querySelector('#mdf2');
const modalBtn3 = document.querySelector('#mdf3');
const closeBtn = document.querySelector('.close');

// Events
modalBtn.addEventListener('click', openModal);
modalBtn2.addEventListener('click', openModal);
modalBtn3.addEventListener('click', openModal);
closeBtn.addEventListener('click', closeModal);
window.addEventListener('click', outsideClick);

// Open
function openModal() {
  modal.style.display = 'block';
}

// Close
function closeModal() {
  modal.style.display = 'none';
}

// Close If Outside Click
function outsideClick(e) {
  if (e.target == modal) {
    modal.style.display = 'none';
  }
}*/

/*
const modalre = document.querySelector('#my-modal-repas');
const modalBtnr = document.querySelector('#dy1');
const modalBtnrr = document.querySelector('#dy2');
const modalBtnrrr = document.querySelector('#dy3');
const closeBtnr = document.querySelector('.close2');


// Events
modalBtnr.addEventListener('click', openModal2);
modalBtnrr.addEventListener('click', openModal2);
modalBtnrrr.addEventListener('click', openModal2);
closeBtnr.addEventListener('click', closeModal2);
window.addEventListener('click', outsideClick2);

// Open
function openModal2() {
    modalre.style.display = 'block';
  }
  
  // Close
  function closeModal2() {
    modalre.style.display = 'none';
  }
  
  // Close If Outside Click
  function outsideClick2(e) {
    if (e.target == modalre) {
        modalre.style.display = 'none';
    }
  }*/