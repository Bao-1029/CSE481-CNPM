const form = document.getElementById('login-form');
document.getElementById('btn-login').addEventListener('click', function (e) {
    e.preventDefault();
    const formData = new FormData(form);
    const username = window.btoa(formData.get('username')),
        password = formData.get('password');
    if (password.length < 8) {
        alert('Mật khẩu dài ít nhất 8 kí tự');
        return;
    }
    formData.append('username', username);
    formData.append('password', window.btoa(password));
    login(formData);
});

function login(formData) {
    return fetch('user/login', {
        method: 'POST',
        body: formData
    }).then(response => {
        if (response.status == 500)
            alert(`Check your internet connection\nerror code: ${response.status}`);
        else if (response.error)
            alert(response.error);
        if (response.status == 302)
            window.location.replace('dashboard');
    }).catch(err =>
        console.log('Request failed', err)
    );
}