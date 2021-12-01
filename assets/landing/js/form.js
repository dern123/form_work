$(document).ready(function() {

    if ($('#leadAlreadyCreated').val() == 'true') {
        functionBeforeSend();
        functionSuccess();
    }

    // Form input validation

    jQuery.extend(jQuery.validator.messages, {
        required: "Обязательное поле!"
    });
    $.validator.addMethod("forename", function(value, element) {
        return this.optional(element) || /[A-Za-zА-Яа-яЁё]{2,}/i.test(value);
    }, "Введите имя корректно!");

    $.validator.addMethod("surname", function(value, element) {
        return this.optional(element) || /[A-Za-zА-Яа-яЁё ]{2,}/i.test(value);
    }, "Введите фамилию корректно!");

    $.validator.addMethod("email", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/i.test(value);
    }, "Введите почту корректно!");

    $.validator.addMethod("button", function(value, element) {
        return this.optional(element) || /[^ ]/i.test(value);
    }, "Вы не нажали кнопку!");

    function functionBeforeSend() {
        $(".btn-reg").attr("disabled", true);
        $("form").hide();
        $(".waiting_block").css('display', 'block');
    }

    function functionSuccess(data) {
        $(".waiting_block").css('display', 'none');
        $(".success_block").css('display', 'inline-block');

        if ($('#turnOnFacebookPixel').val() == 'true') {
            fbq('track', 'CompleteRegistration');
            fbq('track', 'ViewContent');
            fbq('track', 'Lead');
        }

        console.log(data);
    }

    $(".btn-reg").click(function() {
        var form = $(this).parents('form:first');


        form.validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
                forename: {
                    required: true,
                    minlength: 2,
                },
                surname: {
                    required: true,
                    minlength: 2,
                },
                phone: {
                    required: true,
                },
                // forename: "required forename",
                surname: "required surname",
                // email: "required email",
                button: "required button",
            },
            // messages: {
            //     email: {
            //         email: "Введите коректный email"
            //     },
            //     name: {
            //         minlength: jQuery.validator.format("Длина имени должна быть не менее {0}-х символов"),
            //     },
            //     surname: {
            //         minlength: jQuery.validator.format("Длина имени должна быть не менее {0}-х символов"),
            //     },
            //     tel: {
            //         minlength: jQuery.validator.format("Длина имени должна быть не менее {0}-х символов"),
            //     }
            // },
            errorPlacement: function(error, element) {
                if (element.attr("name") == "phone") {
                    error.insertBefore(form.find(".error_div"));
                    console.log(element);

                } else {
                    error.insertAfter(element);
                }
            }
        });

        if (form.valid() && form.find('.error-msg').hasClass("hide")) {
            var data = $(this).closest("form").serialize();
            $.ajax({
                url: 'mail.php',
                type: "POST",
                data: data,
                dataType: "html",
                beforeSend: functionBeforeSend,
                success: functionSuccess
            });
        }

    });

    // Phone validation

    let ary = Array.prototype.slice.call(document.querySelectorAll(".phone"));

    ary.forEach(function(el) {
        PhoneDisplay(el);
    })

    function PhoneDisplay(input) {

        var iti = window.intlTelInput(input, {
            initialCountry: "auto",
            geoIpLookup: function(success, failure) {
                $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "us";
                    success(countryCode);
                });
            },
            autoHideDialCode: "false",
            separateDialCode: "true",
            utilsScript: "assets/landing/js/utils.js"
        });

        var errorMap = ["Укажите корректный номер телефона.", "Не корректный код страны", "Слишком короткий номер телефона", "Слишком длинный номер телефона", "Укажите корректный номер телефона."];

        var reset = function(this_valid, this_error) {
            input.classList.remove("error");
            this_error.text('');
            this_error.addClass('hide');
            this_valid.addClass("hide");

            $(".countryISO2").val(iti.getSelectedCountryData().iso2);
            $(".countryDialCode").val("+" + iti.getSelectedCountryData().dialCode);
        };
        $(input).blur(function() {
            var this_valid = $(this).parents().children(".valid-msg");
            var this_error = $(this).parents().children(".error-msg");
            reset(this_valid, this_error);
            if (input.value.trim()) {
                if (iti.isValidNumber()) {
                    this_valid.removeClass("hide");
                } else {
                    input.classList.add("error");
                    var errorCode = iti.getValidationError();
                    this_error.text(errorMap[errorCode]);
                    this_error.removeClass('hide');
                }
            }
        });
        $(input).on("change keyup", function() {
            var this_valid = $(this).parents().children(".valid-msg");
            var this_error = $(this).parents().children(".error-msg");
            reset(this_valid, this_error);
        });
    }



});

$(document).ready(function() {
    var EmailDomainSuggester = {

        domains: ["yahoo.com", "gmail.com", "google.com", "hotmail.com", "me.com", "aol.com", "mac.com", "live.com", "comcast.com", "googlemail.com", "msn.com", "hotmail.co.uk", "yahoo.co.uk", "facebook.com", "verizon.net", "att.net", "gmz.com", "mail.com"],

        bindTo: $('.email'),

        init: function() {
            this.addElements();
            this.bindEvents();
        },

        addElements: function() {
            // Create empty datalist
            this.datalist = $("<datalist />", {
                id: 'email-options'
            }).insertAfter(this.bindTo);
            // Corelate to input
            this.bindTo.attr("list", "email-options");
        },

        bindEvents: function() {
            this.bindTo.on("keyup", this.testValue);
        },

        testValue: function(event) {
            var el = $(this),
                value = el.val();

            // email has @
            // remove != -1 to open earlier
            if (value.indexOf("@") != -1) {
                value = value.split("@")[0];
                EmailDomainSuggester.addDatalist(value);
            } else {
                // empty list
                EmailDomainSuggester.datalist.empty();
            }

        },

        addDatalist: function(value) {
            var i, newOptionsString = "";
            for (i = 0; i < this.domains.length; i++) {
                newOptionsString +=
                    "<option value='" +
                    value +
                    "@" +
                    this.domains[i] +
                    "'>";
            }

            // add new ones
            this.datalist.html(newOptionsString);
        }

    }

    EmailDomainSuggester.init();


    $(".phone").mask("(999) 99-99-999");

})