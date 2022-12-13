validate_form();
function validate_form() {
    const $inputs = document.querySelectorAll('.validate-target');
    const $form = document.querySelector('.validate-form');

    if(!$form) {
        return;
    }

    for(const $input of $inputs) {

        $input.addEventListener('input', function(event) {
            const $target = event.currentTarget;
            const $feedback = $target.nextElementSibling;

            activateSubmitBtn($form);

            if(!$feedback.classList.contains('invalid-feedback')) {
                return;
            }

            if($target.checkValidity()) {

                $target.classList.add('is-valid');
                $target.classList.remove('is-invalid');

                $feedback.textContent = '';
            }else {
                $target.classList.add('is-invalid');
                $target.classList.remove('is-valid');

                if($target.validity.valueMissing) {
                    $feedback.textContent = '値を入力してください。';
                }else if($target.validity.tooShort) {
                    $feedback.textContent = $target.minLength + '文字以上で入力してください。現在は' + $target.value.length + '文字です。';
                }else if($target.validity.tooLong) {
                    $feedback.textContent = $target.maxLength + '文字以内で入力してください。現在は' + $target.value.length + '文字です。';
                }else if($target.validity.patternMismatch) {
                    $feedback.textContent = '半角英数字で入力してください。';
                }
            }
        });
    }
    activateSubmitBtn($form);
}

function activateSubmitBtn($form) {
    const $submitBtn = $form.querySelector('[type="submit"]');

    if($form.checkValidity()) {
        $submitBtn.removeAttribute('disabled');
    }else {
        $submitBtn.setAttribute('disabled',true);
    }
}