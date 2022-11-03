let sendMail = () => {
    const form = document.querySelector("form");

    let send = async (url, data) => {
        let response = await fetch(url, {
            method: "POST",
            body: data,
        });

        return await response.json();
    }

    form.addEventListener("submit", (e) => {
        e.preventDefault();
        let formData = new FormData(form);

        send("./assets/phpmailer-files/sendmail.php", formData)
            .then(data => {
                console.log(data);
                console.log("Данные отправлены")
            })
            .catch(e => {
                console.log("Ошибка")
            })
            .finally(() => {
                form.reset();
            })
    })
}

sendMail();