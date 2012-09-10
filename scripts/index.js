/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

window.onload = function(){
    steal(script_base_url+"libraries/jquery/jquery-1.6.4.min.js",loadJqueryPlugins);
    google.load("maps","3.8", {"other_params":"sensor=true",callback:loadGoogleMapPlugin});
}

function loadJqueryPlugins(){
    steal(script_base_url+"libraries/javascriptmvc/jquerymx-3.2.custom.min_1.js",
          script_base_url+"libraries/jquery/jquery-ui-1.8.11.custom.min.js",
          script_base_url+"libraries/jquery/plugins/jquery.form.js",
          script_base_url+"libraries/jquery/plugins/jquery.validate.js",jqueryPluginsLoaded);
}

function loadGoogleMapPlugin(){
    steal(script_base_url+"libraries/gmap/gmaps.js",googleMapPluginsLoaded);
}

function jqueryPluginsLoaded(){
    if(window.jInit){
        jInit();
    }
}

function googleMapPluginsLoaded(){
    if(window.gInit){
        gInit();
    }
}