let emailReg = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()\.,;\s@\"]+\.{0,1})+[^<>()\.,;:\s@\"]{2,})$/;
let loginReg = /^[a-zA-Z0-9_][A-Za-z0-9]+(?:[_-][A-Za-z0-9]+)*$/;
let passReg = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/;

let mailSucc = "Email is correct";
let mailErr = "Email is not correct";

let loginSucc = "Uername is correct";
let loginErr = "Must be longer then 6 and less then 16 char. long, starts with letter or '_' symbol";

let passSucc = "Password is ok";
let passErr = "Must be longer then 8 and less then 32 char. long, contain at least 1 uppercase char., 1 lowercase char., 1 digit";

let passConfSucc = "Passwords are matched";
let passConfErr = "Passwords doesn`t matches";


let inputLogin = document.getElementById("login-input");
let inputMail = document.getElementById("email-input");
let inputPass = document.getElementById("form-password")
let inputPasConf = document.getElementById("form-password-repeat");

let login = $(inputLogin.parentNode).find("span")[0];
let mail = $(inputMail.parentNode).find("span")[0];
let pass = $(inputPass.parentNode).find("span")[0];
let pasConf = $(inputPasConf.parentNode).find("span")[0];

let reqFields = [[login, inputLogin], [mail, inputMail], [pass, inputPass], [pasConf, inputPasConf]];

let isEmailValid = false;
let isLoginValid = false;
let isPassValid = false;
let isPassConfValid = false;

let form = $("#login-form")[0];

window.addEventListener("load", function () {
    for (let el of reqFields) {
        setIfEmpty(el[1], el[0]);
        el[1].addEventListener("change", function () {
            setIfEmpty(el[1], el[0]);
        });
    }
});

inputLogin.addEventListener("input", function () {
    loginValidation(this, login, loginSucc, loginErr, loginReg);
});

inputMail.addEventListener("input", function () {
    emailValidation(this, mail, mailSucc, mailErr, emailReg);
});

inputPass.addEventListener("input", function () {
    passValidation(this, pass, passSucc, passErr, passReg);
    passConfimrValid(inputPasConf, this, pasConf, passConfSucc, passConfErr);
});

inputPasConf.addEventListener("input", function () {
    passConfimrValid(this, inputPass, pasConf, passConfSucc, passConfErr);
});

$(form).find("button")[0].addEventListener("click", function () {
    if (isFormValid()) {
        form.submit();
        return true;
    }
    else {
        reqFields.forEach(arr => {
            arr[0].classList.remove('is-unvissible');
        });
        return false
    };
});

function emailValidation(input, textNode, mSucc, mErr, regexp) {
    if (regexp.test(input.value)) {
        setValue(textNode, mSucc);
        textNode.classList.remove("isntCorrect");
        textNode.classList.add("isCorrect");
        isEmailValid = true;
    } else {
        setValue(textNode, mErr);
        textNode.classList.remove("isCorrect");
        textNode.classList.add("isntCorrect");
        isEmailValid = false;
    }
}

function passValidation(input, textNode, mSucc, mErr, regexp) {
    if (regexp.test(input.value)) {
        setValue(textNode, mSucc);
        textNode.classList.remove("isntCorrect");
        textNode.classList.add("isCorrect");
        isPassValid = true;
    } else {
        setValue(textNode, mErr);
        textNode.classList.remove("isCorrect");
        textNode.classList.add("isntCorrect");
        isPassValid = false;
    }
}

function loginValidation(input, textNode, mSucc, mErr, regexp) {
    if (regexp.test(input.value) && input.value.length >= 6 && input.value.length < 16) {
        setValue(textNode, mSucc);
        textNode.classList.remove("isntCorrect");
        textNode.classList.add("isCorrect");
        isLoginValid = true;
    } else {
        setValue(textNode, mErr);
        textNode.classList.remove("isCorrect");
        textNode.classList.add("isntCorrect");
        isLoginValid = false;
    }
}

function passConfimrValid(input, inputPass, textNode, mSucc, mErr) {
    if (input.value == inputPass.value) {
        setValue(textNode, mSucc);
        textNode.classList.remove("isntCorrect");
        textNode.classList.add("isCorrect");
        isPassConfValid = true;
    } else {
        setValue(textNode, mErr);
        textNode.classList.remove("isCorrect");
        textNode.classList.add("isntCorrect");
        isPassConfValid = false;
    }
}

function isFormValid() {
    return (isEmailValid & isLoginValid & isPassValid & isPassConfValid & true);
}

function setValue(obj, value) {
    obj.innerText = value;
}

function setIfEmpty(field, textNode) {
    if (field.value == "") {
        setValue(textNode, "This field is requared");
        textNode.classList.add("isntCorrect");
        textNode.classList.remove("isCorrect");
    }
}
