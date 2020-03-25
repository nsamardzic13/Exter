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


function setAtt(n){
    $input = $("#time" + String(n) + " > p.title");
    $input.html("Event time - " + String(n));

    $input = $("#time" + String(n) + " > div.form-group > label:first");
    $input.attr("for", "time-start[" + String(n)+"]");
    $input = $("#time" + String(n)+" > div.form-group > input:first");
    $input.attr("name", "time-start[" + String(n)+"]");

    $input = $("#time" + String(n)+" > div.form-group > input:first");
    $input.attr("for", "time-end[" + String(n)+"]");
    $input = $("#time" + String(n)+" > div.form-group > input:last");
    $input.attr("name", "time-end[" + String(n)+"]");

    $input = $("#time" + String(n)+" > div.btn-group-toggle  label.btn input:checkbox");
    $input.attr("name", "day" + String(n)+"[]");
};
var n = 0;
$(document).on('click', '#addtime', function () {
    n++;
    if (n == 1) {
        setAtt(n);
        n++;
    }
    if (n < 10) {
        $clone = $("#time1").clone()
        $("#time").append($clone);
        $clone.attr("id", "time" + String(n));
        setAtt(n);
    }
});
$(document).on('click', '#removetime', function () {
    if(n > 1){
        $id = "#time"+n;
        $($id).remove();
        n--;
    }
});

$(document).on('click', '#hideDays', function () {
    document.getElementById('days').style.display = 'none';
    document.getElementById('date').style.display = 'initial';
});

$(document).on('click', '#hideDate', function () {
    document.getElementById('date').style.display = 'none';
    document.getElementById('days').style.display = 'initial';
    setAtt(1);
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
    //console.log('into transition triggered!')
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
    //console.log('start transition triggered!')
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
    $('#user_name').focusout(function (){
        $('#userList').fadeOut();
    });
});

//redirect to specific tab and change url dependent on tab click
$(document).ready(() => {
    let url = location.href.replace(/\/$/, "");
    //console.log(location.href);
    if (location.hash) {
        const hash = url.split("#");
        $('#tabMenu a[href="#'+hash[1]+'"]').tab("show");
        url = location.href.replace(/\/#/, "#");
        history.replaceState(null, null, url);
        setTimeout(() => {
            $(window).scrollTop(0);
        }, 150);
    }

    $('a[data-toggle="tab"]').on("click", function() {
        let newUrl;
        const hash = $(this).attr("href");
        if(hash == "#profile") {
            newUrl = url.split("#")[0];
        } else {
            newUrl = url.split("#")[0] + hash;
        }
        newUrl += "/";
        history.replaceState(null, null, newUrl);
    });
});

//scrip for adding user to group
var groupId;
var regUser;
$(document).ready(function(){
    $('button[name="btnZaModal"]').click(function(){
        groupId = $(this).attr('id');
        regUser = $('#userId').attr('name');
    });

    $('#addFriend').click(function(){
        var userName = $('#user_name').val();
        var _token = $('input[name="_token"]').val();

        console.log(userName);

        $.ajax({
            type: 'POST',
            url: '/users/addPersonToGroup',
            data: {
                    _token : _token,
                    groupId : groupId,
                    userName : userName
            },
            success:function (data) {
                $('#addUserToGroup').modal('toggle');
                location.reload();
                //window.location.href = '/user/'+regUser+'#groups';
            },

            error: function(data){
                var error = data.responseJSON.errors.userName[0];
                $('#errorForAddingUser').text(error)
            }

        });
    });
});

//alert fade up after being shown
$(document).ready(function() {
    $('.alert').fadeTo(2000, 500).slideUp(500, function() {
        $('.alert').slideUp(600);
    });
});




