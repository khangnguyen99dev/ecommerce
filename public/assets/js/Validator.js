function Validator(form) {
    let formElement = $(form);

    let formRules = {};

    let validatorRules = {
        required : function(value) {
            return value ? undefined : 'Vui lòng nhập trường này!';
        },
        email : function (value) {
            const Regex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
            return Regex.test(value) ? undefined : 'Trường này phải là email';
        },
        min: function (min) {
            return function (value) {
                return value.length >= min ? undefined : `Vui lòng nhập ít nhất ${min} ký tự!`;
            }
        },
        max: function (max) {
            return function (value) {
                return value.length <= max ? undefined : `Vui lòng nhập tối đa ${max} ký tự!`;
            }
        },
        password_confirm: function (value) {
            let password = $(formElement).find('#password').val();
            return password == value ? undefined : `Mật khẩu nhập lại không đúng`; 
        },
        check_email: function (value) {
            let result = $.ajax({ type: "GET",   
                        url: `/checkmail/${value}`,   
                        async: false
                    }).responseJSON;
            return !result ? undefined : 'Email đã tồn tại';
        },
        check_mail_login: function (value) {
            let result = $.ajax({ type: "GET",   
                        url: `/checkmail/${value}`,   
                        async: false
                    }).responseJSON;
            return result ? undefined : 'Email không đúng';       
        }
    }
    if(formElement) {
        let inputs = formElement.find('[name][rules]');
        for(let input of inputs) {
            formRules[input.name] = $(input).attr('rules');
            let rules = $(input).attr('rules').split('|');
            for(let rule of rules) {
                let ruleInfo;
                let isRuleHasValue = rule.includes(':');
                if(isRuleHasValue) {
                    ruleInfo = rule.split(':');
                    rule = ruleInfo[0];
                }

                let ruleFunc = validatorRules[rule];
                if(isRuleHasValue) {
                    ruleFunc = ruleFunc(ruleInfo[1]);
                }

                if(Array.isArray(formRules[input.name])) {
                    formRules[input.name].push(ruleFunc)
                }else{
                    formRules[input.name] = [ruleFunc];
                }
            }

            $(input).on('blur', handleValidate); 
            
            $(input).on('input', handleClearError)
        }

        function handleValidate (e) {
            let rules = formRules[e.target.name];
            let errorMessage;

            rules.some(function (rule) {
                errorMessage = rule(e.target.value);
                return errorMessage;
            })

            if(errorMessage) {
                let formGroup = $(e.target).parent();
                if(formGroup) {
                    $(formGroup).addClass('invalid');
                    let formMessage = $(formGroup).find('.form-message');
                    if(formMessage) {
                        $(formMessage).html(errorMessage);
                    }
                }
            }

            return !errorMessage;
        }

        function handleClearError (e) {
            let formGroup = $(this).parent();
            if($(formGroup).hasClass('invalid')) {
                $(formGroup).removeClass('invalid');
            }
            let formMessage = $(formGroup).find('.form-message');
            if(formMessage) {
                $(formMessage).html('');
            }
        }
    }

    $(formElement).on('submit', function (e) {
        e.preventDefault();
        let inputs = formElement.find('[name][rules]');
        let isValid = true;
        for(let input of inputs) {
            isValid = (!handleValidate({ target: input})) ? false : true;
        }

        if(isValid) {
            if(this.onSubmit) {
                this.onSubmit();
            }else{
                this.submit();
            }
        }
    })
}