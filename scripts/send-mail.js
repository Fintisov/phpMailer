const form = document.querySelector("#form");
form.addEventListener("submit", formSend);

async function formSend(e) {
    e.preventDefault();

    let error = formValidate(form);

    let formData = new FormData(form);

    if (error === 0) {
        document.querySelector("body").classList.add("_sending");

        let response = await fetch("sendmail.php", {
            method: "POST",
            body: formData
        });

        if (response.ok) {
            let result = await response.json();
            alert(result.message);
            form.reset();
            document.querySelector("body").classList.remove("_sending");
        } else {
            document.querySelector("body").classList.remove("_sending");
        }
    }
}

function formValidate(form) {
    let error = 0;
    let formReq = document.querySelectorAll("._req")

    formReq.forEach((input) => {
        formRemoveError(input);

        if (input.classList.contains("_email")) {
            if (emailTest(input)) {
                formAddError(input);
                error++;
            }
        } else {
            if (input.value === "") {
                formAddError(input);
                error++;
            }
        }
    })

    return error;
}

function formAddError(input) {
    input.classList.add("_error");
}

function formRemoveError(input) {
    input.classList.remove("_error");
}

function emailTest(input) {
    return !/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,8})+$/.test(input.value);
}

