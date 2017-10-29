$(document).ready(function () {
    function checkResult (id) {
        var isCorrect = false;
        var buttonElement = $('#check'+id);
        var boxElement = $('#resultBox'+id);
        var actualResult = $('#resultFormula'+id).val();

        boxElement.parent().removeClass('has-success, has-error');

        if ($(boxElement).val() === actualResult)
        {
            isCorrect = true;
            boxElement.parent().addClass('has-success');
        }
        else
        {
            boxElement.parent().addClass('has-error');
        }

        return isCorrect;
    };

    if ($('#check1').click(function () {
        var isCorrect = checkResult(1);
        $('#check1').data('isCorrect', isCorrect);
    }));

    if ($('#check2').click(function() {
        var isCorrect = checkResult(2);
        $('#check2').data('isCorrect', isCorrect);
    }));
});