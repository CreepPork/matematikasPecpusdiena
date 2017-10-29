require('./extensions/timer.jquery.min');

$(document).ready(function () {
    var timer = $('#timer');
    var isRunning = false;
    var timerInitDone = false;
    var hasSetClass = false;

    $('#exampleModalLabel').html('Matemātikas restlings');
    $('#modal-body').html(
        `<div class="form-group">
        <h4>Izvēlaties klasi: </h4>
        <select id="classSelector" class="form-control">
            <option value="5.a">5.a</option>
            <option value="5.b">5.b</option>
            <option value="5.c">5.c</option>
            <option value="5.d">5.d</option>
            <option value="5.e">5.e</option>
        </select>
    </div>`
    );
    $('#modal-button').html('Sākam!');
    $('#myModal').modal();

    $('#myModal').on('hide.bs.modal', function () {
        timer.trigger('click');
        if (!hasSetClass) {selectedClass = $('#classSelector').val(); hasSetClass = true; hasTimeRunOut = false;}
        $('#modal-body').html('<h4 id="modal-body-text"></h4>');
    });

    timer.click(function() {
        if (timerInitDone == false)
        {
            timer.timer({
                duration: '5m',
                format: '%M:%S',
                countdown: true,
                callback: function () {
                    $('#secretItem').trigger('click');
                }
            });
            timerInitDone = true;
        }

        if (isRunning == false)
        {
            timer.timer('resume');
            isRunning = true;
        }
        else
        {
            timer.timer('pause');
            isRunning = false;
        }
    });
});