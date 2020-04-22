import { createElement, mandatory } from './helpers.js';

function initView(data) {
    const main = document.querySelector(''),
        btn_more = createElement('button', {
            events: {
                'click': createOtherNews(getNews())
            }
        });
        fragment = new DocumentFragment();
    fragment.appendChild(createHotlines(data));
    fragment.appendChild(createOtherNews(data));
    main.appendChild(fragment);
}

function createHotlines(data) {
    const main = createElement('div', {
            class: 'main__news',
            html: '<h2 class="main__title">Bài viết hàng đầu</h2>'
        }),
        featured_news = createFeaturedNews(data);
}

function createFeaturedNews(data) {
    const { title, source, link: href, imgUri } = data,
        img = createElement('a', {
            href: href,
            html: `<img src="${imgUri}" alt="">`
        }),
        p = createElement('p', {
            html: `title`
        }),
        source = createElement('span', {
            class: 'main__source',
            text: source
        }),
        news = createElement('div', {
            class: 'main__featured-news',
            nodes: [img, p, source]
        });
    return news;
}

function createOtherNews(data) {
    
}

/**
 * @returns json data
 */
function getNews(param) {
    fetch(`/api/news/${param}`, {
        method: 'GET'
    })
    .then(response => {
        if (response.status !== 200) {
            console.log(`Check your internet connection\nerror code: ${response.status}`);
            return;
        }
        return response.json();
    })
    .catch(err =>
        console.log('Request failed', err)
    );
}

initView(getNews('all'));