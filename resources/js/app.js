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


$(document).ready(function (){
    var n =  document.getElementById('number-times').value;
    console.log(n);
    //otvori n timova pri loadanju
    if(n > 1){
        for (var i = 1; i <= n; i++){
            document.getElementById('time'+String(i)).style.display = 'initial';
        }
    }
    $(document).on('click', '#addtime', function () {
        if (n < 10) {
            n++;
            document.getElementById('time'+String(n)).style.display = 'initial';
            document.getElementById('number-times').value = n;

        }
    });
    $(document).on('click', '#removetime', function () {
        if (n > 1) {
            document.getElementById('time' + String(n)).style.display = 'none';
            n--;
            document.getElementById('number-times').value = n;

        }
    });
});

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
    $('.alert:not(.login-alert)').fadeTo(2000, 500).slideUp(500, function() {
        $('.alert').slideUp(600);
    });
});

var message_id;
var like_dislike;
var group_id;
var type;
var no;
$(document).on("click", ".a_dislike", function(e){
    var posts = $('.endless-pagination').html();
    no = $(this).attr("id");
    var group_id = $('#group_id'+no).val();
    message_id = $('#message_id'+no).val();
    like_dislike = 'dislike';
    type = $('#type'+no).val();
    e.preventDefault();
    var _token = $('input[name="_token"]').val();
    $.ajax({
        type: 'POST',
        url: '/groups/' + group_id,
        data: {
            _token: _token,
            message_id: message_id,
            like_dislike: like_dislike,
            group_id: group_id,
            type: type
        },
        success: function (data) {
            //$("#likes_messages"+no).load("/groups/" +group_id + " #likes_messages"+no);
            // $('#likes_messages'+no).fadeOut(800, function () {
            //     $('#likes_messages'+no).fadeIn().delay(2000);
            // })
            $("#likes_messages" + no + " .a_dislike").addClass("likescroll")
            $("#likes_messages" + no + " .likescroll-dislikes").html(parseInt($("#likes_messages" + no + " .likescroll-dislikes").html())+1)

            if ($("#likes_messages" + no + " .a_like").hasClass("likescroll")) {
                let newhtml = parseInt($("#likes_messages" + no + " .likescroll-likes").html())-1

                $("#likes_messages" + no + " .likescroll-likes").html(newhtml)
                $("#likes_messages" + no + " .a_like").removeClass("likescroll")
            }
        }
    });
});

$(document).on("click", ".a_like", function(e){
    var no = $(this).attr("id");
    group_id = $('#group_id'+no).val();
    message_id = $('#message_id'+no).val();
    like_dislike = 'like';
    type = $('#type'+no).val();
    e.preventDefault();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        type: 'POST',
        url: '/groups/' + group_id,
        data: {
            _token: _token,
            message_id: message_id,
            like_dislike: like_dislike,
            group_id: group_id,
            type: type
        },
        success: function (data) {
            //location.reload(null, false);
            //<div id="likes_messages{{ $message->id }}
            $("#likes_messages" + no + " .a_like").addClass("likescroll")
            $("#likes_messages" + no + " .likescroll-likes").html(parseInt($("#likes_messages" + no + " .likescroll-likes").html())+1)

            if ($("#likes_messages" + no + " .a_dislike").hasClass("likescroll")) {
                let newhtml = parseInt($("#likes_messages" + no + " .likescroll-dislikes").html())-1

                $("#likes_messages" + no + " .likescroll-dislikes").html(newhtml)
                $("#likes_messages" + no + " .a_dislike").removeClass("likescroll")
            }
        }
    });
});

$(document).ready(function() {
    $(window).scroll(fetchPosts);

    function fetchPosts() {

        var page = $('.endless-pagination').data('next-page');
        if(page !== null) {

            clearTimeout( $.data( this, "scrollCheck" ) );

            $.data( this, "scrollCheck", setTimeout(function() {
                var scroll_position_for_posts_load = $(window).height() + $(window).scrollTop() + 3000;

                if(scroll_position_for_posts_load >= $(document).height()) {
                    $.get(page, function(data){
                        // $('.posts').html(data.messages);
                        $('.posts').append(data.messages);
                        $('.endless-pagination').data('next-page', data.next_page);
                    });
                }
            }, 350))
        }
    }
});
