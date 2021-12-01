$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
    var inputs = document.querySelectorAll('input[list]');
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].addEventListener('change', function() {
            var optionFound = false,
                datalist = this.list;
            for (var j = 0; j < datalist.options.length; j++) {
                if (this.value == datalist.options[j].value) {
                    optionFound = true;
                    break;
                }
            }
            if (optionFound) {
                this.setCustomValidity('');
            } else {
                this.setCustomValidity('Пожалуйста, выберите один из вариантов.');
            }
        });
    }
    $('.btn_change .btn').on(
        'click',
        function() {
            $('#form_dep, #form_clock').toggle()
        }
    );
});