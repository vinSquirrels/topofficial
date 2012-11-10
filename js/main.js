$(document).ready(function(){
  setToolbarTitle();
  $('.official-review').on('click', showReviewForm);

  function setToolbarTitle() {
    $('.progress').each(function(){
      var totalBarWidth = $(this).css('width');
      var totalBarValue = $(this).children().css('width');
      var totalBarPercent = parseInt(parseInt(totalBarValue) * 100 / parseInt(totalBarWidth)) + '%';
      $(this).attr('title', totalBarPercent).tooltip();
    });
  }

  function showReviewForm(el) {
      el.preventDefault();
      $('.official-review-form').slideDown('slow');
  }
  
});