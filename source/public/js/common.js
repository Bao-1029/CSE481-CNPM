import {
    createElement,
    createGroupItem,
    getData,
    filterElements
} from './helpers.js';

const content_hotline = document.getElementById("content-hotline"),
    menu = document.getElementById("menu"),
    btn_back_to_top = document.querySelector('.main__back');

document.querySelector('.header__icon-bar').addEventListener('click', function () {
    menu.style.width = "100%";
});

document.getElementById('close-menu').addEventListener('click', function () {
    menu.removeAttribute("style");
});

document.getElementById('close-hotline').addEventListener('click', function () {
    content_hotline.style.right = "-450px";
});

window.addEventListener('scroll', function () {
    const vh = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
    if ((document.documentElement.scrollTop || document.body.scrollTop) > vh)
        btn_back_to_top.classList.add('show');
    else
        btn_back_to_top.classList.remove('show');
});

function scrollToTop() {
    const y = document.documentElement.scrollTop || document.body.scrollTop;
    if (y > 0) {
        window.requestAnimationFrame(scrollToTop);
        window.scrollTo(0, y - y / 8);
    }
}
btn_back_to_top.addEventListener('click', scrollToTop);

let isFetched = false;
document.querySelector('.main__contact-phone').addEventListener('click', function () {
    content_hotline.style.right = "0";

    !isFetched &&
        getHotlines().then(data => {
            return createList(data);
        }).then(elem => {
            const content = document.getElementById('content-hotline'),
                fragment = new DocumentFragment();
            fragment.appendChild(elem);

            
            document.querySelector('.main__icon-loading-hpl').remove();
            content.appendChild(fragment);
            document.getElementById('search-hospital')
                    .addEventListener('keyup', filterElements.bind(this, content, 'li'));
            isFetched = true;
        })
});

function getHotlines() {
    return getData('hotline/all', {
        method: 'GET'
    }).catch(err =>
        console.log('Request failed', err)
    );
}

function createList(data) {
    const ul = createGroupItem('ul', {
            class: 'main__hospital-menu',
            html: '<li><span>Tên bệnh viện</span><span>Số điện thoại</span></li>',
        }, data, createListItem),
        div = createElement('div', {
            class: 'main__hotline-list',
            node: ul
        });
    return ul;
}

function createListItem(data) {
    const { name, phone_number } = data,
        li = createElement('li', {
            htmls: [
                `<span>${name}</span>`,
                `<span>${phone_number}</span>`,
            ]
        });
    return li;
}