$(document).ready(function () {

    $('.clear-cookie').on('click', function () {
        $('.results tr:not(:first-child)').remove();
        $.post('clearCookie.php');
    });

    $('.inp-cbx-x').on('click', function () {
        $('.x-select .warning').removeClass('icon-visible');
    });

    $('.inp-cbx-r').on('click', function () {
        $('.r-select .warning').removeClass('icon-visible');
    });

    $('#Y-select').on('focus', function () {
        $('.y-select .warning').removeClass('icon-visible');
    });

    $('form').submit(function (e) {
        e.preventDefault();
        const x = $('.inp-cbx-x:checked').val();
        const r = $('.inp-cbx-r:checked').val();

        let validX = false;
        let validY = false;
        let validR = false;
        let ySelect = $('#Y-select').val().trim();
        if (ySelect.match(/^-?[0-9]*[.,]?[0-9]+$/) && ySelect && ySelect !== '-') {
            var y = parseFloat(ySelect);
            if (y > -5 && y < 5) {
                validY = true;
            }
        }
        if ($('.inp-cbx-x:checked').length === 1) {
            validX = true;
        }
        if ($('.inp-cbx-r:checked').length === 1) {
            validR = true;
        }

        if (!validX) {
            $('.x-select .warning').addClass('icon-visible')
        }
        if (!validY) {
            $('.y-select .warning').addClass('icon-visible')
        }
        if (!validR) {
            $('.r-select .warning').addClass('icon-visible')
        }
        if (validX && validY && validR) {
            $.ajax({
                type: 'GET',
                url: 'form.php',
                data: {'x': x, 'y': y, 'r': r},
                success: function(data) {
                    $('.results > tbody').append(data);
                    // let response = JSON.parse(data);
                    // let tdEntry = response['isEntry'] === 'true' ? '<td class="green-color">Входит</td>' : '<td class="red-color">Не входит</td>';
                    // $('.results > tbody').append(`
                    //     <tr>
                    //         <td>${x}</td>
                    //         <td>${y}</td>
                    //         <td>${r}</td>
                    //         ${tdEntry}
                    //         <td>${response['currentTime']}</td>
                    //         <td>${response['scriptTime']}</td>
                    //     </tr>
                    // `);
                },
                error: function (jqXHR) {
                    console.log(jqXHR);
                    $('.alert').text("Ошибка " + jqXHR.status + ": " + jqXHR.statusText).slideDown().delay(2000).slideUp();
                }
            });
        }
    });
});