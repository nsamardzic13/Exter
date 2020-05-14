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



//show filename in create event
$("#picture").on('change', function() {

    var input = document.getElementById( 'picture' );
    var infoArea = document.getElementById( 'file-upload-filename' );
    // the change event gives us the input it occurred in
    var input = event.srcElement;

    // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
    var fileName = input.files[0].name;

    // use fileName however fits your app best, i.e. add it into a div
    infoArea.textContent = '- ' + fileName;
    infoArea.style.display = 'initial';
    if (fileName.length < 15){
        document.getElementById( 'length_filename' ).style.width = '40%';
    } else if (fileName.length < 30) {
        document.getElementById('length_filename').style.width = '50%';
    } else if (fileName.length < 50) {
        document.getElementById('length_filename').style.width = '80%';
    } else {
        document.getElementById('length_filename').style.width = '100%';
    }
});


////join group to event
$(document).on('click', '[name="changegroup"]', function() {
    $('.groupusers').each(function() {
        this.checked = false;
    });
    $('.groupusers').each(function() {
        this.disabled = false;
    });
    $('#selected_people').html("0");

    $('.tabusers').each(function() {
            $(this).removeClass("active");
        });

    $('#cannot_checkall').css('display', 'none');
    $('#options-select-users').css('display', 'initial');
    $('#join_group').css('display', 'none');
});


$(document).on('click', '.groupusers', function() {
    var active_tab = $("ul.tabs li a.active").attr("id");
    var count = $("input[name='"+active_tab+"users[]']:checked").length;

    $('#selected_people').html(count);

    var people = parseInt( $('#num_people').html() );
    console.log($("input[name='"+active_tab+"users[]']:checked").length);
    if (count > 0) {
        $('#join_group').css('display', 'initial');
    } else {
        $('#join_group').css('display', 'none');
    }
    if (count >= people){
        $('.groupusers').not(':checked').each(function() {
            this.disabled = true;
        });
    } else {
        $('.groupusers').each(function() {
            this.disabled = false;
        });
    }

});


$(document).on('click', '#checkallusers', function() {

    var active_tab = $("ul.tabs li a.active").attr("id");
    var count = $("input[name='"+active_tab+"users[]']").length;

    var people = parseInt( $('#num_people').html());
    if (count > people){
        $('#cannot_checkall').css('display', 'initial');
        $('#join_group').css('display', 'none');
    } else {
        $("input[name='"+active_tab+"users[]']").each(function() {
            this.checked = true;
        });
        $("label[name='"+active_tab+"users']").each(function() {
            $(this).addClass("active");
        });

        $('#selected_people').html(count);
        $('#join_group').css('display', 'initial');
    }
});
$(document).on('click', '#uncheckallusers', function() {

    var active_tab = $("ul.tabs li a.active").attr("id");

        $("input[name='"+active_tab+"users[]']").each(function() {
            this.checked = false;
        });
        $("label[name='"+active_tab+"users']").each(function() {
            $(this).removeClass("active");
        });

        $('#selected_people').html(0);
        $('#join_group').css('display', 'none');
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
        $('#tabMenu,#v-pills-tab a[href="#'+hash[1]+'"]').tab("show");
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

        //console.log(userName);

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

//function for checking notifications independently
$(document).ready(function() {
    $(document).on('click', "button#checkButton", function(){
        var notifyId = $(this).attr('value');
        var _token = $('input[name="_tokenCheck"]').val();

        $.ajax({
            type: 'POST',
            url: '/notifications',
            data: {
                _token : _token,
                notifyId : notifyId
            },
            success:function (data) {
                $("#notifyId").load(window.location.href + "  #notifyId > *");
            }
        });
    });
});

//function for checking notifications ALL
$(document).ready(function() {
    $(document).on('click', "#checkAll", function(){
        var _token = $('input[name="_tokenCheck"]').val();

        $.ajax({
            type: 'POST',
            url: '/notificationsAll',
            data: {
                _token : _token,
            },
            success:function (data) {
                $("#notifyId").load(window.location.href + "  #notifyId > *");
            }
        });
    });
});

//function for following
$(document).ready(function() {
    $(document).on('click', "#follow", function(){
        var followerId = $(this).attr('value');
        var _token = $('input[name="_token"]').val();

        $.ajax({
            type: 'POST',
            url: '/follow',
            data: {
                followerId : followerId,
                _token : _token,
            },
            success:function (data) {
            }
        });
    });
});

//function for unFollowing
$(document).ready(function() {
    $(document).on('click', "#unFollow", function(){
        var followerId = $(this).attr('value');
        var _token = $('input[name="_token"]').val();

        $.ajax({
            type: 'POST',
            url: '/unFollow',
            data: {
                followerId : followerId,
                _token : _token,
            },
            success:function (data) {
            }
        });
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
            $("#likes_messages" + no + " .a_dislike").addClass("dislikescroll");
            let newhtml = (parseInt($("#dislikebutton" + no + " .likescroll-dislikes").html())+1);
            $("#dislikebutton" + no + " .likescroll-dislikes").html(' ' + newhtml);
            if ($("#likes_messages" + no + " .a_like").hasClass("likescroll")) {
                let newhtml = parseInt($("#likebutton" + no + " .likescroll-likes").html())-1;

                $("#likebutton" + no + " .likescroll-likes").html(' ' + newhtml);
                $("#likes_messages" + no + " .a_like").removeClass("likescroll");
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
            $("#likes_messages" + no + " .a_like").addClass("likescroll");
            let newhtml = (parseInt($("#likebutton" + no + " .likescroll-likes").html())+1);
            $("#likebutton" + no + " .likescroll-likes").html(' ' + newhtml);
            if ($("#likes_messages" + no + " .a_dislike").hasClass("dislikescroll")) {
                let newhtml = parseInt($("#dislikebutton" + no + " .likescroll-dislikes").html())-1;

                $("#dislikebutton" + no + " .likescroll-dislikes").html(' ' + newhtml);
                $("#likes_messages" + no + " .a_dislike").removeClass("dislikescroll");
            }
        }
    });
});

$(document).ready(function() {
    $(window).scroll(fetchPosts);

    function fetchPosts() {

        var page = $('.endless-pagination').data('next-page');
        if (page !== null && page != "") {
            clearTimeout($.data(this, "scrollCheck"));

            $.data(this, "scrollCheck", setTimeout(function () {
                var scroll_position_for_posts_load = $(window).height() + $(window).scrollTop() + 3000;

                if (scroll_position_for_posts_load >= $(document).height()) {
                    $.get(page, function (data) {
                        // $('.posts').html(data.messages);
                        $('.posts').append(data.messages);
                        $('.endless-pagination').data('next-page', data.next_page);
                    });
                }
            }, 350))
        }
    }
});

$(document).ready(function() {
    $(".modal-btn").on('click', function() {
        var id = this.id;
        var message_id = $(this).attr('click');
        var _token = $('input[name="_token"]').val();
        var value;
        if ($(this).hasClass('likes')) {
            value = true;
            $("#myModal .modal-title").html('Message liked by:')
        } else {
            value = false;
            $("#myModal .modal-title").html('Message disliked by:')
        }
        $.ajax({
            type: 'POST',
            url: '/messages/showLikes/' + id,
            data: {
                value: value,
                _token: _token,
                id: message_id,
            },
            success: function (data) {
                $("#myModal .modal-body").html('')
                for(var i = 0; data.likes.data.length; i++) {
                    $("#myModal .modal-body").append(
                        `
                        <p>
                            <a href="/user/`+ data.likes.data[i].user_id +`"> `+ data.likes.data[i].name +` </a>
                        </p>
                        `
                    );
                }
            }
        });

    })
});

$(document).ready(function() {
    $(".page-link").on('click', function() {
        console.log('mrs')
    });
});

//google maps autocomplete
$(document).ready(function() {
   var input = document.getElementById('address');
   var input1 = document.getElementById('event_address');
   var autocomplete = new google.maps.places.Autocomplete(input);
   var autocomplete = new google.maps.places.Autocomplete(input1);

});

//js for sidebar
$(document).ready(function () {

        $('#sidebarCollapse').on('click', function () {
            $('#sidebar, #content').toggleClass('active');
            $('.collapse.in').toggleClass('in');
            $('a[aria-expanded=true]').attr('aria-expanded', 'false');
        });
});

$(document).ready(function(){
    $('#rangeIndicator').on('change', function(e){
        var id = e.target.value;
        document.getElementById("rangeValue").innerHTML = id;
        document.getElementById("inputRangeValue").value = id;

    });
    $('#rangeIndicator').change();
});
