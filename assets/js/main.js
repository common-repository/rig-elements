
  
  // Dark Mode
  
  var rigDarkMode;
        if (localStorage.getItem('rig-dark-mode')) {  
        rigDarkMode = localStorage.getItem('rig-dark-mode');  
        } else {
        rigDarkMode = 'light';  
        }
    
        localStorage.setItem('rig-dark-mode', rigDarkMode);
    
        if (localStorage.getItem('rig-dark-mode') == 'dark') {
            jQuery('body').addClass('rig-dark-mode');  
            jQuery('.rig-dark-mode-button').hide();
            jQuery('.rig-light-mode-button').show();
          }
    
    
        jQuery('.rig-dark-mode-button').on('click', function() {  
            jQuery('.rig-dark-mode-button').hide();
            jQuery('.rig-light-mode-button').show();
            jQuery('body').addClass('rig-dark-mode');
            jQuery('.elementor-section').css('background-color: #000000');
            // jQuery('.elementor-section').css('color: #ffffff');
            localStorage.setItem('rig-dark-mode', 'dark');
    });
    
        jQuery('.rig-light-mode-button').on('click', function() {  
            jQuery('.rig-light-mode-button').hide();
            jQuery('.rig-dark-mode-button').show();
            jQuery('body').removeClass('rig-dark-mode');
            localStorage.setItem('rig-dark-mode', 'light');
        });

// jQuery(function() {
//     jQuery('body').addClass('js');
  
//     var $hamburger = jQuery('.hamburger'),
//         $nav = jQuery('#site-nav'),
//         $masthead = jQuery('#masthead');
  
//     $hamburger.click(function() {
//         console.log('Alhamdulillah');
//       jQuery(this).toggleClass('is-active');
//       $nav.toggleClass('is-active');
//       $masthead.toggleClass('is-active');
//       return false; 
//     })
// });


	 
	
// jQuery(function () {
//     jQuery('.toggle-menu').click(function(){
// 		jQuery('.exo-menu').toggleClass('display');
//     });
//    });   

function rig_dark_mode() {

    var element = document.body;
    element.setAttribute('style', 'background-color: black; color: white;');
    var dark_mode = element.classList.toggle("dark-mode");
    window.localStorage.setItem('mode', dark_mode);
 }

 function check_dark_mode() {
    window.localStorage.getItem('mode');
}

// jQuery(function() {
//     });

// jQuery('.caret').hover(function(){
//     jQuery(".sub-menu").css("display","block");
// });


// jQuery(".dropdown").hover(function(){
//     jQuery('.rig-nav-dropdown').css("display", "block");
//     }, function(){
//     jQuery('.rig-nav-dropdown').css("display", "none");
//   });

// jQuery(".rig-mobile-menu-button").click(function(){
//     jQuery('.rig-nav-menu').css("display", "block");
//     }, function(){
//     jQuery('.rig-nav-menu').css("display", "none");
//   });

// var screenWidth = jQuery( window ).width();
// if (screenWidth < 600) {
//       jQuery('.rig-nav-menu').css("display", "none");
//       jQuery(".rig-mobile-menu-button").click(function(){
//     jQuery('.rig-nav-menu').css("display", "block");
//       });
//   //    
//       console.log("CSS Class Initiated");
// }
// console.log(screenWidth);

// jQuery(".rig-mobile-menu-button").click(function(){
//   console.log('Alhamdulillah. Button Clicked');
//   jQuery('.rig-nav-menu').css("display", "block");
//     });    

jQuery(".rig-mobile-menu-button").click(function(){
    console.log('Alhamdulillah. Button Clicked');
  jQuery(".rig-nav-menu").toggle();
      });
//   jQuery('.dropdown').bind("mouseenter focus mouseleave", 
//         function(event) { console.log(event.type); }); 

// jQuery( function() {
//   jQuery( ".rig-nav-menu" ).menu();
// } )
// window.onload = rig_dark_mode;