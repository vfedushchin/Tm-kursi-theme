jQuery(document).ready(function($){


  // $('.main-navigation ul').superfish();
  

  // var menu_ul = '.main-navigation .menu';

  var menu_ul_first = $('.main-navigation').find('ul').first();
  var menu_ul = $('.main-navigation').find('ul');


  menu_ul.children('.menu-item-has-children').children('a').append('<span class="mytheme_menu_switch">+</span>');


  // Touch friendly expanded nav
  // $(menu_ul + ' li span').click(function(event){

    $('.menu-item-has-children').children('a').hover(function() {
      /* code for mouseover */
    }, function() {
     /* code for mouseout */
    });


  function close_all_submenu(e) {
    // get the child of the clicked menu switch
    var child_menu = $(e).parent().parent().children('ul');

    // get the parent link of the clicked menu switch
    var parent_link = $(e).parent();

    // if it's open, close it

      // remove any "active" class from parent item
      $(parent_link).removeClass('active');
      // hide child menu
      $(child_menu).removeClass('childopen');
      // set this open menu switch to +
      $(e).html('+');
  }


  $('.mytheme_menu_switch').click(function(event){

    // close all submenus except pressed
    var body = $('body');
    var breakpoint = 750;
    if(body.width() >= breakpoint) {
      // close_all_submenu($('.mytheme_menu_switch').not(this));
    }
    

    event.preventDefault();

    // get the child of the clicked menu switch
    var child_menu = $(this).parent().parent().children('ul');

    // get the parent link of the clicked menu switch
    var parent_link = $(this).parent();

    // check if it's currently open or closed
    if ( child_menu.hasClass('childopen') ) {
      // if it's open, close it

      // remove any "active" class from parent item
      $(parent_link).removeClass('active');
      // hide child menu
      $(child_menu).removeClass('childopen');
      // set this open menu switch to +
      $(this).html('+');

    } else {
      // if it's closed, open it

      // hide any open child menus
      // $(menu_ul + ' ul').removeClass('childopen');
      menu_ul.children('ul').removeClass('childopen');
      // set any open menu switch symbols back to +
      // $(menu_ul + ' li span').html('+');
      menu_ul.children('li').children('span').html('+');

      // show correct child menu
      $(child_menu).addClass('childopen');
      // set this open menu switch to -
      $(this).html('-');

      return false;

    }

  });

  $('.navicon').click(function(){
    if ( menu_ul_first.css('display') == 'none' ) {

      menu_ul_first.addClass('show');
      menu_ul_first.removeClass('closed').addClass('open');
      menu_ul_first.children('.fa').removeClass('fa-navicon').addClass('fa-close');

    } else {

      menu_ul_first.removeClass('show');
      menu_ul_first.removeClass('open').addClass('closed');
      menu_ul_first.children('.fa').removeClass('fa-close').addClass('fa-navicon');

    }

  });

});