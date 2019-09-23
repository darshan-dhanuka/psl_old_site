$(function(){
	//$('.single-item').slick();
	$('.topSlider').owlCarousel({
		 items: 1,
     nav:true,
     loop: true,
      autoplay:false,
      smartSpeed: 800,
	});
	 $('.meetSlider').owlCarousel({
    center: true,
        margin: 10,
        loop: true,
        nav:true,
        mouseDrag: false,
        dots: false,
        smartSpeed: 500,
        responsive: {
          0: {
            items: 1
          },
          641: {
            items: 3
          },
          1000: {
            items: 5
          }
        }
      })
  $('.mobilemenu').click(function(){
    $(this).siblings('ul').toggleClass('active');
  });
$("#uploadBtn").change(function(){
    $('#uploadFile').val($(this).val().replace(/^.*\\/, ""));
  });
  $('.according h4').click(function(){
    if(!$(this).parent('div').parent('div').hasClass('active')){
      $(this).parent('div').parent('div').addClass('active');
      $(this).parent('div').parent('div').siblings('div.active').children('div').children('.accor').slideUp();
      $(this).parent('div').parent('div').siblings('div').removeClass('active');
      $(this).siblings('.accor').slideDown();
    }else{
      $(this).parent('div').parent('div').removeClass('active');
      $(this).parent('div').parent('div').siblings('div').removeClass('active');
      $(this).siblings('.accor').slideUp();
    }
  })
  $('.mentorLnk').click(function (){
  $('html,body').animate({scrollTop: $("#mentor").offset().top}, 'slow');
 });
  $('.open_popup').click(function(){
    var gtImg=$(this).find('img').attr('src');
    var gtName=$(this).data('name');
    var gtteamTitle=$(this).data('teamtitle');
    var gtAge=$(this).data('age');
    var gtregen=$(this).data('region');
    var gtgpi=$(this).data('gpi');
    var gtatm=$(this).data('atm');
    var gtcontent=$(this).data('content');
    var gtsmtxt=$(this).data('smtxt');

    $('.imgSec img').attr("src", gtImg);
    $('.NameTitle').text(gtName);
    $('.team_title').text(gtteamTitle);
    $('.gtAge').text(gtAge);
    $('.gtRegion').text(gtregen);
    $('.gtGpi').text(gtgpi);
    $('.gtAtm').text(gtatm);
    $('.clntCont').text(gtcontent);
    $('.smallTxt').text(gtsmtxt);
    $('.profilePopup').show();
    return false;
  });
  $('.overlay, .closeBtn').click(function(){
    $('.profilePopup').hide();
  });
  $('.dropListOpn').click(function(){
    if(!$(this).hasClass('active')){
      $('.dropListOpn').removeClass('active');
      $(this).addClass('active');
    }else{
      $('.dropListOpn').removeClass('active');
    }
    
    });
// $('.tableBtn .customBtn').click(function(){
//   $('.InnerCant').hide();
//   $('.profilePopup').show();
//   $('.afterPreRegister').show();
// })
if($(window).width()>992){
var highest = null;
var hi = 0;
$(".table thead th span").each(function(){
  var h = $(this).height();
  if(h > hi){
     hi = h;
     highest = $(this);  
  } 
   
});
$(".table thead th span, .table thead th .selectopt").height(highest.height()) ;

var highest2 = null;
var hii = 0;
$(".table thead th span").each(function(){
  var h = $(this).height();
  if(h > hii){
     hii = h;
     highest2 = $(this);  
  } 
   
});
$(".table tbody td span").height(highest2.height()) 
}
})
