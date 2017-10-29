require('./extensions/timer.jquery.min');

$(document).ready(function () {
    var alert1 = $('#alert1');
    var alert2 = $('#alert2');

    var alert1Shown = false;
    var alert2Shown = false;

    var team1Surrender = false;
    var team2Surrender = false;

    var time1 = -1;
    var time2 = -1;

    var didTeam1Finish = false;
    var didTeam2Finish = false;

    var attemptsTeam1 = 0;
    var attemptsTeam2 = 0;

    var team1Tried = ['start'];
    var team2Tried = ['start'];

    function clearAlert(id)
    {
        // Init
        var alert = $('#alert' + id);

        // Clear out the title and the body
        $('#alert' + id + '_title').html('');
        $('#alert' + id + '_body').html('');

        // Remove all previous alert types
        alert.removeClass('alert-info');
        alert.removeClass('alert-success');
        alert.removeClass('alert-warning');
        alert.removeClass('alert-danger');
    }

    function showAlert(id, title, body, type)
    {
        // Init all of our stuff
        var alert = $('#alert'+ id);
        var titleElement = $('#alert'+ id + '_title');
        var bodyElement = $('#alert' + id + '_body');

        // Clear the current alert
        clearAlert(id);

        // Set the data of our alert
        alert.addClass('alert-' + type);
        titleElement.html(title);
        bodyElement.html(body);

        // Show our alert
        alert.removeClass('notVisible');
    }

    function disableInputs(id)
    {
        $('#check' + id).prop('disabled', true);
        $('#showResult'+ id).prop('disabled', true);
        $('#resultBox' + id).prop('disabled', true);
    }

    function showModal(title, body, button)
    {
        $('#exampleModalLabel').html(title);
        $('#modal-body-text').html(body);
        $('#modal-button').html(button);
        $('#myModal').modal();
    }

    function doStopModal(timerRanOut)
    {
        // Stop the timer and remove the click event from the wells and from the timer
        $('#timer').trigger('click');
        $('#timer').off('click');
        $('.well').off('click');

        // Get our victor
        var victoryTeam = 0;
        var surrenderingTeam = 0;
        var timeRanOutForTeam = 0;
        var team1Result = $('#resultBox1').val();
        var team2Result = $('#resultBox2').val();
        if (team1Result > team2Result) victoryTeam = 1;
        if (team2Result > team1Result) victoryTeam = 2;
        if (team1Surrender && !timerRanOut) {victoryTeam = 2; surrenderingTeam = 1;}
        if (team2Surrender && !timerRanOut) {victoryTeam = 1; surrenderingTeam = 2;}
        if (team1Surrender && team2Surrender) {victoryTeam = 0; surrenderingTeam = [1, 2];}
        if (time1 === -1 && !team2Surrender) {victoryTeam = 2; timeRanOutForTeam = 1;}
        if (time2 === -1 && !team1Surrender) {victoryTeam = 1; timeRanOutForTeam = 2;}
        if (time1 === -1 && time2 === -1) {victoryTeam = 0; timeRanOutForTeam = [1, 2];}

        // Do a timeout to get some time to realize what has happened
        setTimeout(function() 
        {
            // If both teams completed their tasks and in time
            if (!team1Surrender && !team2Surrender && !timerRanOut)
            {
                showModal('Spēle beigusies', ('Uzvar ' + victoryTeam + '. komanda!'), 'Saglabāt rezultātus');
            }

            // If one of the teams surrendered but time didn't run out
            if ((team1Surrender && !timerRanOut) || (team2Surrender && !timerRanOut))
            {
                // If both teams surrender
                if (team1Surrender && team2Surrender)
                {
                    showModal('Spēle beigusies', 'Neuzvar neviena komanda, jo abas padevās!', 'Saglabāt rezultātus');
                }
                // One of the teams surrender
                else
                {
                    showModal('Spēle beigusies', ('Uzvar ' + victoryTeam + '. komanda, jo ' + surrenderingTeam + '. komanda padevās!'), 'Saglabāt rezultātus');
                }
            }

            // If the timer ran out
            if (timerRanOut)
            {
                // If only one of the teams ran out of time and none surrendered
                if ((didTeam1Finish && !didTeam2Finish && !team1Surrender && !team2Surrender) || (!didTeam1Finish && didTeam2Finish && !team1Surrender && !team2Surrender))
                {
                    showModal('Spēle beigusies', ('Uzvar ' + victoryTeam + '. komanda, jo laiks beidzās ' + timeRanOutForTeam + '. komandai!'), 'Saglabāt rezultātus');
                }

                // If at least one of the teams surrendered
                if (team1Surrender || team2Surrender)
                {
                    // If one of the teams surrendered and the other one ran out of time
                    if ((team1Surrender && !team2Surrender) || (!team1Surrender && team2Surrender))
                    {
                        showModal('Spēle beigusies', 'Neuzvar neviena komanda, jo viena padevās un otra neatrisināja uzdevumu!', 'Saglabāt rezultātus');                    
                        victoryTeam = 0;
                        if (team1Surrender && !team2Surrender) {timeRanOutForTeam = 2; surrenderingTeam = 1;}
                        if (!team1Surrender && team2Surrender) {timeRanOutForTeam = 1; surrenderingTeam = 2;}
                    }
                }

                // If both teams ran out of time and didn't surrender
                if (!didTeam1Finish && !team1Surrender && !didTeam2Finish && !team2Surrender)
                {
                    victoryTeam = 0;
                    timeRanOutForTeam = [1, 2];
                    showModal('Spēle beigusies', 'Neuzvar neviena komanda, jo laiks abām komandām beidzās!', 'Saglabāt rezultātus');                    
                }
            }

            // Log the data when modal is closed
            $('#myModal').on('hide.bs.modal', function () {
                var formula1 = $('#formula1').html();
                var formula2 = $('#formula2').html();
                var result1 = $('#resultFormula1').val();
                var result2 = $('#resultFormula2').val();
                var actualResult1 = $('#resultBox1').val();
                var actualResult2 = $('#resultBox2').val();
                if (team1Surrender) actualResult1 = null;
                if (team2Surrender) actualResult2 = null;

                $.ajax({
                    url: '/',
                    type: 'POST',
                    dataType: 'json',
                    cache: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        class: selectedClass,
                        victoryTeam: victoryTeam,
                        team1Surrender: team1Surrender,
                        team2Surrender: team2Surrender,
                        surrenderingTeam: surrenderingTeam,
                        timeTeam1: time1,
                        timeTeam2: time2,
                        didTimeRunOut: timerRanOut,
                        didTeam1Finish: didTeam1Finish,
                        didTeam2Finish: didTeam2Finish,
                        formula1: formula1,
                        formula2: formula2,
                        result1: result1,
                        result2: result2,
                        enteredResult1: actualResult1,
                        enteredResult2: actualResult2,
                        attempts1: attemptsTeam1,
                        attempts2: attemptsTeam2,
                        timeRanOutForTeam: timeRanOutForTeam,
                        team1Tried: team1Tried,
                        team2Tried: team2Tried
                    },
                    success: function(result) {
                        window.location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Failed to post');
                        console.log(JSON.stringify(jqXHR));
                        console.log("Ajax error: " + textStatus + ' : ' + errorThrown);
                    }
                });
            });
        }, 1000);
    }

    function timeRanOut()
    {
        disableInputs(1);
        disableInputs(2);
        if (time1 != -1 && !team1Surrender)
        {
            didTeam1Finish = true;
        }

        if (time2 != -1 && !team2Surrender)
        {
            didTeam2Finish = true;
        }

        doStopModal(true);
    }

    // Do our checks if any of the conditions are true then display alert
    $('.well').click(function (object) {
        var element = $(object.target);
        
        switch (element.attr('id')) 
        {
            case 'check1':
                if (element.data('isCorrect') === true)
                {
                    time1 = $('#timer').html();
                    disableInputs(1);
                    showAlert(1, 'Pareizi!', 'Komanda 1 ir izpildijuši pareizi! Laiks - ' + time1, 'success');
                    alert1Shown = true;
                    didTeam1Finish = true;
                }

                if (element.data('isCorrect') === false)
                {
                    showAlert(1, 'Nepareizi!', 'Komanda 1 ir nepareizi atrisinājuši! Mēģiniet vēlreiz!', 'danger')
                    attemptsTeam1++;
                    team1Tried.push($('#resultBox1').val());
                }
                break;
            
            case 'showResult1':
                if (element.data('hasGivenUp') === true)
                {
                    time1 = $('#timer').html();
                    disableInputs(1);
                    showAlert(1, 'Nopietni?', '1. komanda ir padevušies! Laiks - ' + time1, 'danger');
                    alert1Shown = true;
                    team1Surrender = true;
                }
                break;

            case 'check2':
                if (element.data('isCorrect') === true)
                {
                    time2 = $('#timer').html();
                    disableInputs(2);
                    showAlert(2, 'Pareizi!', 'Komanda 2 ir izpildijuši pareizi! Laiks - ' + time2, 'success');
                    alert2Shown = true;
                    didTeam2Finish = true;
                }
                
                if (element.data('isCorrect') === false)
                {
                    attemptsTeam2++;
                    team2Tried.push($('#resultBox2').val());
                    showAlert(2, 'Nepareizi!', 'Komanda 2 ir nepareizi atrisinājuši! Mēģiniet vēlreiz!', 'danger')
                }
                break;
            
            case 'showResult2':
                if (element.data('hasGivenUp') === true)
                {
                    time2 = $('#timer').html();
                    disableInputs(2);
                    showAlert(2, 'Nopietni?', '2. komanda ir padevušies! Laiks - ' + time2, 'danger');
                    alert2Shown = true;
                    team2Surrender = true;
                }
                break;
        
            default:
                break;
        }

        // Stop the timer and display our finish modal
        if (alert1Shown && alert2Shown)
        {
            doStopModal(false);
        }
    });

    $('#secretItem').click(function (e) { 
        e.preventDefault();
        $('#secretItem').off('click');
        hasClickedOnSecret = true;
        timeRanOut();
    });
});