$(document).ready(function () {
    function showResult (id)
    {
        var actualResult = $('#resultFormula'+id).val();
        var boxElement = $('#resultBox'+id);
        var buttonElement = $('#check'+id);
        var showResultElement = $('#showResult'+id);

        boxElement.val(actualResult);
        boxElement.prop('disabled', true);
        buttonElement.prop('disabled', true);
        showResultElement.prop('disabled', true);
    }

    if ($('#showResult1').click(function() {
        showResult(1);
        $('#showResult1').data('hasGivenUp', true);
    }));

    if ($('#showResult2').click(function() {
        showResult(2);
        $('#showResult2').data('hasGivenUp', true);
    }));
});