/**
 * Author: Kim Lehtinen <kim.lehtinen@student.uwasa.fi>
 */

var filters = {
    filterShowAll: 0,
    filterTechnology: 1,
    filterSport: 2,
    filterTravel: 3
};

$(document).ready(function() {
    initCreatePost();
    initRegister();
    initLogin();
    initFilterByCategory();
});

function initFilterByCategory() {
    $('.post-filter-category a').click(function() {
        $('.post-filter-category a').removeClass('active');

        $(this).addClass('active');
        var classes = $(this).attr("class").split(' ');
        var filter = '';
        
        for (var i=0; i<classes.length; i++) {
            if (filters.hasOwnProperty(classes[i])) {
                filter = classes[i];
                break;
            }
        }

        if (filter.length > 0) {
            filterCategory(filter);
        }
    });
}

function filterCategory(filter) {
    var filterNumber = filters[filter];

    if (filter === 'filterShowAll') {
        $('.post').show();
    } else {
        $('.post').hide();
        $('.post-category-' + filterNumber).show();
    }
}

function initListPosts() {
    //
}

function initCreatePost() {
    $('#create-post-form').submit(function(e) {
        e.preventDefault();
        $('#create-post-form-spinner').show();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            data: formData,
            url: 'Controllers/Post/CreatePost.php',
            processData: false,
            contentType: false,
            success: function(data){
              if (data === 'true') {
                $('#create-post-form-spinner').hide();
                $('#alert-create-post-success > strong').html('Lisätty!');
                $('#alert-create-post-success').show();
                $('#create-post-form')[0].reset();
              } else {
                $('#create-post-form-spinner').hide();
                $('#alert-create-post-failed > strong').html('Lisääminen epäonnistui');
                $('#alert-create-post-failed').show();
              }
            },
            error: function (request, status, error) {
                $('#create-post-form-spinner').hide();
                $('#alert-create-post-failed > strong').html('Lisääminen epäonnistui');
                $('#alert-create-post-failed').show();
                console.log(request.responseText);
            }
        });
    });
}

function initRegister() {
    $('#register-form').submit(function(e) {
        e.preventDefault();
        $('#register-form-spinner').show();
        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            data: formData,
            url: 'scripts/register.php',
            processData: false,
            contentType: false,
            success: function(data){
                if (data === 'true') {
                    $('#register-form-spinner').hide();
                    $('#alert-register-success > strong').html('Kiitos! Voit nyt kirjautua sisään.');
                    $('#alert-register-success').show();
                    $('#register-form')[0].reset();
                } else {
                    $('#register-form-spinner').hide();
                    $('#alert-register-failed > strong').html('Rekisteröityminen epäonnistui');
                    $('#alert-register-failed').show();
                }

                $([document.documentElement, document.body]).animate({
                    scrollTop: $("#register-form-section").offset().top
                }, 500);
            },
            error: function (request, status, error) {
                $('#register-form-spinner').hide();
                $('#alert-register-failed > strong').html('Rekisteröityminen epäonnistui');
                $('#alert-register-failed').show();
                $([document.documentElement, document.body]).animate({
                    scrollTop: $("#register-form-section").offset().top
                }, 500);
                console.log(request.responseText);
            }
        });
    });
}

function initLogin() {
    $('#login-form').submit(function(e) {
        e.preventDefault();
        var formData = getFormDataObject('login-form');
        $.ajax({
            type: 'POST',
            data: {
                username: formData['username'],
                password: formData['password']
            },
            url: 'login.php',
            success: function(data){
                if (data === 'true') {
                    window.location = '/';
                }
                else {
                $('#alert-login-failed > strong').html('Sisäänkirjautuminen epäonnistui. Tarkista käyttäjätunnus tai salasana.');
                $('#alert-login-failed').show();
                }
            },
            error: function (request, status, error) {
                $('#alert-register-failed > strong').html('Sisäänkirjautuminen epäonnistui. Tarkista käyttäjätunnus tai salasana.');
                $('#alert-register-failed').show();
                console.log(request.responseText);
            }
        });
    });
}

function getFormDataObject(formID) {
    var dataArr = $('#' + formID).serializeArray(),
    dataObj = {};
    
    $(dataArr).each(function(i, field){
        dataObj[field.name] = field.value;
    });
    
    return dataObj;
}
