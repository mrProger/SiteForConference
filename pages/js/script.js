function auth() {
    let login = document.getElementById('login').value;
    let password = document.getElementById('password').value;
    if (login.trim().length === 0 || password.trim().length === 0) {
        alert('Все поля должны быть заполнены');
        return;
    }
    fetch("/api/v1/auth", {
        method: "POST",
        body: JSON.stringify({
            "login": login,
            "password": password
        })
    }).then((response) => {
        return response.text().then(function (data) {
            alert(data);
        });
    });
}

function registration() {
    let login = document.getElementById('login').value;
    let password = document.getElementById('password').value;
    let passwordSubmit = document.getElementById('passwordSubmit').value;
    if (login.trim().length === 0 || password.trim().length === 0 || passwordSubmit.trim().length === 0) {
        alert('Все поля должны быть заполнены');
        return;
    }
    if (password !== passwordSubmit) {
        alert('Пароль и повтор пароля должны совпадать');
        return;
    }
    fetch("/api/v1/registration", {
        method: "POST",
        body: JSON.stringify({
            "login": login,
            "password": password
        })
    }).then((response) => {
        return response.text().then(function (data) {
            alert(data);
        });
    });
}

function generateError() {
    fetch("/api/v1/generate-error", {
        method: "POST"
    });
}