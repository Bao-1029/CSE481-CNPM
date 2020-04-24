import { createElement, createGroupItem, mandatory } from './helpers.js';

function initView(data) {
    const main = document.querySelector('');
        fragment = new DocumentFragment();
    fragment.appendChild(createHotlines(data));
    fragment.appendChild(createOtherNews(data));

    const btn_more = createElement('button', {
        events: {
            'click': loadOtherNews(fragment.querySelector('.main__recent-news'), getNews())
        }
    })
    fragment.appendChild(btn_more);
    main.appendChild(fragment);
}

function createHotlines(featuredData = mandatory(), relatedData = mandatory()) {
    const featured_news = createFeaturedNews(featuredData),
        related_news = createRelatedNews(relatedData),
        main = createElement('div', {
            class: 'main__news',
            html: '<h2 class="main__title">Bài viết hàng đầu</h2>',
            nodes: [featured_news, related_news]
        });
    return main;
}

function createFeaturedNews(data = mandatory()) {
    const { title, source, link, imgUri } = data,
        img = createElement('a', {
            href: link,
            html: `<img src="${imgUri}" alt="">`
        }),
        p = createElement('p', {
            html: title
        }),
        span = createElement('span', {
            class: 'main__source',
            text: source
        }),
        news = createElement('div', {
            class: 'main__featured-news',
            nodes: [img, p, span]
        });
    return news;
}

function createRelatedNews(data = mandatory()) {
    return createGroupItem('div', {
        class: 'main__related-news'
        }, data, function(item) {
            const { title, source, link: href } = item,
                p = createElement('p', {
                    html: `<a href="${href}">${title}</a>`
                }),
                span = createElement('span', {
                    class: 'main__source',
                    text: source
                }),
                div = createElement('div', {
                    class: 'main__related-content',
                    nodes: [p, span]
                });
            return div;
        });
}

function createOtherNews(data = mandatory()) {
    return createGroupItem('div', {
        class: 'main__recent-news'
    }, data, createOtherNewsItem);
}

function createOtherNewsItem(item) {
    const { title, source, link, imgUri } = item,
    img = createElement('div', {
            class: 'main__recent-img',
            html: `<a href="${link}"><img src="${imgUri}" alt=""></a>`
        }),
        p = createElement('p', {
            html: `<a href="${href}">${title}</a>`
        }),
        span = createElement('span', {
            class: 'main__source',
            text: source
        }),
        text = createElement('span', {
            class: 'main__recent-text',
            nodes: [p, span]
        }),
        div = createElement('div', {
            class: 'main__recent-text',
            nodes: [img, text]
        });
    return div;
}

function loadOtherNews(node, data) {
    
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