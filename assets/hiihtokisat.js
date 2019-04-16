/**
 * Author: Kim Lehtinen <kim.lehtinen@student.uwasa.fi>
 */


$(document).ready(function() {
    initTulosseurantaKisaSarjaRefresh();
    initTulosseurantaKisaRefresh();
    initRegister();
    initLogin();
});

/**
 * Päivitä yksittäisen sarjan tulosseuranta joka 10s.
 */
function initTulosseurantaKisaSarjaRefresh() {
    if ($('#tulosseuranta_kisa_sarja_starts').length) {
        setTimeout(function() {
          console.log('reloading page: tulosseuranta kisa sarja...');
          location.reload();
        }, 10000);
    }
}

/**
 * Päivitä kisan kaikki sarjojen tulosseuranta joka 10s.
 */
function initTulosseurantaKisaRefresh() {
    if ($('#tulosseuranta_kisa_starts').length) {
        setTimeout(function() {
          console.log('reloading page: tulosseuranta kisa...');
          location.reload();
        }, 10000);
    }
}

/**
 * Rekisteröi käyttäjä ajax request
 */
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

/**
 * Kirjaudu sisään ajax request
 */
function initLogin() {
    $('#login-form').submit(function(e) {
        e.preventDefault();
        $('#login-form-spinner').show();
        var formData = getFormDataObject('login-form');
        $.ajax({
            type: 'POST',
            data: {
                email: formData['email'],
                salasana: formData['salasana']
            },
            url: 'scripts/login.php',
            success: function(data){
                if (data === 'true') {
                    $('#login-form-spinner').hide();
                    window.location.href = '/sovellus';
                } else {
                    $('#login-form-spinner').hide();
                    $('#alert-login-failed > strong').html('Sisäänkirjautuminen epäonnistui. Tarkista sähköpostiosoite tai salasana.');
                    $('#alert-login-failed').show();
                }
            },
            error: function (request, status, error) {
                $('#login-form-spinner').hide();
                $('#alert-register-failed > strong').html('Sisäänkirjautuminen epäonnistui. Tarkista sähköpostiosoite tai salasana.');
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
