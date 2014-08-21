/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

window.onload = function(){
    steal(base_url+"bower_components/jquery/dist/jquery.min.js",loadJqueryPlugins);
    google.load("maps","3.8", {"other_params":"sensor=true",callback:loadGoogleMapPlugin});
}

function loadJqueryPlugins(){
    steal(base_url+"bower_components/jquery-ui/jquery-ui.min.js",
          script_base_url+"libraries/jquery/plugins/jquery.form.js",
          base_url+"bower_components/bootstrap/dist/js/bootstrap.min.js",
          base_url+"bower_components/jquery.validation/dist/jquery.validate.js",jqueryPluginsLoaded);
}

function loadGoogleMapPlugin(){
    steal(base_url+"bower_components/gmaps/gmaps.js",googleMapPluginsLoaded);
}

function jqueryPluginsLoaded(){
    
    $("form").each(function(){
        $(this).validate(validateOptions);
    });
    if(window.jInit){
        jInit();
    }
}

function googleMapPluginsLoaded(){
    if(window.gInit){
        gInit();
    }
}

/****** Custom validation error ********/
function myErrorPlacement(error, element) {
            offset = element.position();
            error.insertAfter(element);
            error.addClass('message');  // add a class to the wrapper
            error.css('position', 'absolute');
            error.css('left',offset.left + element.outerWidth());
            error.css('width','100%');
            error.css('top', offset.top + 60);
        }
var validateOptions = {
        /*errorElement: "span",
        wrapper: "span",
        errorPlacement:myErrorPlacement*/
        
    };        
/******* XXX ********/    