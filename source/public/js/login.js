document.getElementById('btn-login').addEventListener('click', function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    const username = window.btoa(formData.get('username')),
        password = formData.get('password');
    if (password.length < 8) {
        alert('Mật khẩu dài ít nhất 8 kí tự');
        return;
    }
    formData.set('username', username);
    formData.set('password', window.btoa(password));
    login(formData);
});

function login(formData) {
    return fetch('api/user', {
        method: 'POST',
        body: formData
    }).then(response => {
        if (response.status == 500)
            alert(`Check your internet connection\nerror code: ${response.status}`);
        else if (response.status != 200)
            alert(response.error);
    });
}