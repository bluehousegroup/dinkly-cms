/******************************************************************************** HELPER FUNCTIONS */

//Borrowed from http://stackoverflow.com/a/1909508/53079
/*
  Example:
    $('input').keyup(function() {
      delay(function(){
        alert('Time elapsed!');
      }, 1000 );
  });
*/
var delay = (function(){
  var timer = 0;
  return function(callback, ms){
    clearTimeout (timer);
    timer = setTimeout(callback, ms);
  };
})();

function doCallback(context, callback, target) {
  if(callback) {
    if(context) {
      return context[callback](target);
    }
    else {
      return window[callback](target);
    }
  }
  return false;
}

//Generate clean message output
function generateMessage(message) {
  var parts = message.split('&&&');
  var output = "";

  if(parts.length > 0) {
    output = "<ul>";
  for(i = 0; i < parts.length; i++) {
    output += "<li>" + parts[i] + "</li>";
  }
  output += "</ul>";
  }
  else { output = parts[0]; }

  return output;
}

function displayConfirmation(message, target_id, callback) {
  $('#modal-confirm').find('.confirm-message').html(message);
  $('#modal-confirm').modal('show');
  $('#modal-confirm').find('.callback').val(callback);
  $('#modal-confirm').find('.target-id').val(target_id);
}

function displayBadMessages() {
  $message = $('#hidden-bad-message').val();
  $('.bad-message').html(generateMessage($message));
  $('.alert-error').show();
  setTimeout(function() {
    $('.alert-error').slideUp();
  }, 3000);
}

function displayGoodMessages() {
  $message = $('#hidden-good-message').val();
  $('.good-message').html(generateMessage($message));
  $('.alert-success').show();
  setTimeout(function() {
    $('.alert-success').slideUp();
  }, 3000);
}

function displaySavingIndicator(saving_message) {
  $('.loading').html(saving_message);
  $('.loading').fadeIn();
}

function hideSavingIndicator() {
  $('.loading').fadeOut(function() {
    $(this).html('');
  });
}

//Let's us externally control the datatable count
function redrawWithNewCount(t, row_count) {
  //Lifted more or less right out of the DataTables source
  var oSettings = t.fnSettings();

  oSettings._iDisplayLength = parseInt(row_count, 10);
  t._fnCalculateEnd( oSettings );
  
  /* If we have space to show extra rows (backing up from the end point - then do so */
  if(oSettings.fnDisplayEnd() == oSettings.fnRecordsDisplay())
  {
    oSettings._iDisplayStart = oSettings.fnDisplayEnd() - oSettings._iDisplayLength;
    if(oSettings._iDisplayStart < 0) {
      oSettings._iDisplayStart = 0;
    }
  }
  
  if(oSettings._iDisplayLength == -1) {
    oSettings._iDisplayStart = 0;
  }
  
  t.fnDraw(oSettings);

  return t;
}

/*
* - Collapsing Panels
* Usage: wrapper with class 'collapse-wrap', can set it closed by default with additional class 'closed'.  An inner a.collapse-trigger and inner .collapse-body containing the markup you wish to toggle.

div.collapse-wrap.closed
  a.collapse-trigger
    i.icon
  div.collapse-body

just call init on doc.ready

*/

window.collapsingInterface = {};
collapsingInterface.init = function(){
  collapsingInterface.setIcons();
  collapsingInterface.bindHandlers();
  $('.collapse-wrap.closed .collapse-body').hide();
}

collapsingInterface.closeBody = function($this){
  $this.addClass('closed').find('.collapse-body').slideUp(collapsingInterface.setIcons());
}

collapsingInterface.openBody = function($this){
  $this.removeClass('closed').find('.collapse-body').slideDown(collapsingInterface.setIcons());
}

collapsingInterface.setIcons = function(){
  $('.collapse-wrap').each(function(){
    if($(this).hasClass('closed')){
      $(this).find('.collapse-trigger i.icon').removeClass('icon-minus icon-plus').addClass('icon-plus');
    }else{
      $(this).find('.collapse-trigger i.icon').removeClass('icon-minus icon-plus').addClass('icon-minus');
    }
  });
}

collapsingInterface.toggleState = function($this){
  if($this.hasClass('closed')){
    collapsingInterface.openBody($this);
  }else{
    collapsingInterface.closeBody($this);
  }
}

collapsingInterface.bindHandlers = function(){
  $('.collapse-trigger').on('click', function(){
    collapsingInterface.toggleState($(this).parent());
  });
}



/***************************************************************************************** EVENTS */

$(function(){

  //Messaging - handle 'yes' click
  $('.confirm-yes').click(function() {
    var target_id = $(this).parents('.modal').find('.target-id').val();
    $target = $('#'+target_id);
    doCallback(null, $(this).parents('.modal').find('.callback').val(), $target);
    $(this).parents('.modal').modal('hide');
    return false;
  });

  /*********************************************************************************** DATATABLES */

  //Externally control filter search on datatable
  $(".datatables-filter-input").keyup(function() { dt.fnFilter(this.value); }); //id -> column in array to search

  //Externally control list count on datatable
  $('.dropdown-menu li').click(function() {
    $(this).parent('ul').children('li').removeClass('active');
    $(this).addClass('active');
    redrawWithNewCount(dt, this.id);
  });

  //Prevent form submit on filter input
  $('.datatables-filter-input').keypress(function(e){
    if(e.which == 13) e.preventDefault();
  });

  //Clear filter input
  $('.clear-filter').click(function() {
    $('.datatables-filter-input').val('');
    dt.fnFilter('');
  });

  //Wake up datatables
  var dt = $('table.dataTables').dataTable({
    'sDom' : '<r>t<p>',
    'bJQueryUI' : false,
    'sPaginationType' : 'full_numbers'
  });

  /*********************************************************************************** INITIALIZATION */

  //MESSAGING - We're using a template for this, and for this to display right we need to slap it near the top of the body
  $confirm = $('#modal-confirm-template').clone(true);
  $confirm.attr('id', 'modal-confirm');
  $('body').append($confirm);

  //MESSAGING - Display bad message on page load
  if($('#hidden-bad-message').val()) {
  	displayBadMessages();
  }

  //MESSAGING - Display good message on page load
  if($('#hidden-good-message').val()) {
    displayGoodMessages();
  }

});