function updateLoginForm() {
    document.getElementById('updateMail').classList.add('invisibleForm');
    document.getElementById('updatePassword').classList.add('invisibleForm');
    document.getElementById('updateLogin').classList.remove('invisibleForm');
};
document.getElementById('updateLoginButton').addEventListener('click', updateLoginForm);

function updateMailForm() {
    document.getElementById('updateLogin').classList.add('invisibleForm');
    document.getElementById('updatePassword').classList.add('invisibleForm');
    document.getElementById('updateMail').classList.remove('invisibleForm');
};
document.getElementById('updateMailButton').addEventListener('click', updateMailForm);

function updatePasswordForm() {
    document.getElementById('updateLogin').classList.add('invisibleForm');
    document.getElementById('updateMail').classList.add('invisibleForm');
    document.getElementById('updatePassword').classList.remove('invisibleForm');
};
document.getElementById('updatePasswordButton').addEventListener('click', updatePasswordForm);