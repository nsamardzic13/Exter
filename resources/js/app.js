/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

AOS.init();

$(document).on('click', '#hideDays', function () {
    document.getElementById('days').style.display = 'none';
    document.getElementById('date').style.display = 'initial';
});

$(document).on('click', '#hideDate', function () {
    document.getElementById('date').style.display = 'none';
    document.getElementById('days').style.display = 'initial';
});


//code for navbar scroll
// grabbing the class names from the data attributes
const navBar = $('.navbar');
data = navBar.data();

// booleans used to tame the scroll event listening a little..
let scrolling = false,
    scrolledPast = false;

// transition Into smaller nav
function switchInto() {
    // update `scrolledPast` bool
    scrolledPast = true;
    // add/remove CSS classes
    navBar.removeClass(data.startcolor);
    navBar.removeClass(data.startsize);
    navBar.addClass(data.intocolor);
    navBar.addClass(data.intosize);
    console.log('into transition triggered!')
}

// transition back into bigge nav
function switchStart() {
    // update `scrolledPast` bool
    scrolledPast = false;
    // add/remove CSS classes
    navBar.addClass(data.startcolor);
    navBar.addClass(data.startsize);
    navBar.removeClass(data.intocolor);
    navBar.removeClass(data.intosize);
    console.log('start transition triggered!')
}

// set `scrolling` to true when user scrolls
$(window).scroll(() => scrolling = true);

setInterval(() => {
    // when `scrolling` becomes true...
    if(scrolling) {
        // set it back to false
        scrolling = false;
        // check scroll position
        if ($(window).scrollTop() > 100) {
            // user has scrolled > 100px from top since last check
            if ( !scrolledPast ) {
                switchInto();
            }
        } else {
            // user has scrolled back <= 100px from top since last check
            if ( scrolledPast ) {
                switchStart();
            }
        }
    }
    // take a breath.. hold event listener from firing for 100ms
}, 100);

//AUTOCOMPLETE for adding users in groups
$(document).ready(function(){
    $('#user_name').keyup(function () {
        var query = $(this).val();
       if(query != ''){
           var _token = $('input[name="_token"]').val();

           $.ajax({
               url: '/autocomplete',
               method: "POST",
               data:{query:query, _token:_token},
               success:function(data){
                   $('#userList').fadeIn();
                   $('#userList').html(data);
                   //console.log('aaa');
               }
           })
       }
    });
    $(document).on('click', 'a', function () {
        $('#user_name').val($(this).text());
        $('#userList').fadeOut();
    });
});




