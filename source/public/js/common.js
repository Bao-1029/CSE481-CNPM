import { createElement, createGroupItem } from './helpers.js';

const content_hotline = document.getElementById("content-hotline"),
    menu = document.getElementById("menu");

document.querySelector('.header__icon-bar').addEventListener('click', function () {
    menu.style.width = "100%";
});

document.getElementById('close-menu').addEventListener('click', function () {
    menu.removeAttribute("style");
});

document.getElementById('icon-phone').addEventListener('click', function () {
    content_hotline.style.width = "450px";
});

document.getElementById('close-hotline').addEventListener('click', function () {
    content_hotline.style.width = "0px";
});

let fetched = false;
document.querySelector('.main__contact-phone').addEventListener('click', function () {
    fetched ?? getHotlines();
});

function getHotlines() {
    fetch('api/hotline/all', {
        method: 'GET'
    }).then(resresponse => {
        if (response.status !== 200) {
            console.log(`Check your internet connection\nerror code: ${response.status}`);
            return;
        }
        return response.json();
    })
    .then(json => {
        return json.data;
    })
    .catch(err =>
        console.log('Request failed', err)
    );
}

function createTable(data) {
    const rows = createTableRow()
}

function createTableRow(data) {
    return createGroupItem('div', {
        class: 'main__hospital-main',
    }, data, function () {
        const {name, phone_number} = data;
    });
}