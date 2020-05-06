import { createElement, createGroupItem, mandatory, utf8Decode } from './helpers.js';

const loading = document.querySelector('.main__icon-loading');
let load_num = 0, 
    isFirstLoad = true;

async function initView() {
    const data = await getNews('all');
    let headlines = data.headlines;
    const featuredNews = headlines.shift(),
        relatedNews = headlines,
        otherNews = data.news,
        main = document.querySelector('.main'),
        fragment = new DocumentFragment();
    fragment.appendChild(createHotlines(featuredNews, relatedNews));
    fragment.appendChild(createOtherNews(otherNews));

    const frag_recent = fragment.querySelector('.main__recent-news'),
        btn_more = createElement('button', {
            class: 'main__more',
            html: '<span>Xem thêm</span>',
            events: {
                click: loadOtherNews.bind(this, frag_recent),
        }
    });
    fragment.appendChild(btn_more);
    loading.style.display = 'none';
    main.insertBefore(fragment, loading);
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
            html: `<a href="${link}">${utf8Decode(title)}</a>`
        }),
        span = createElement('span', {
            class: 'main__source',
            text: utf8Decode(source)
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
                    html: `<a href="${href}">${utf8Decode(title)}</a>`
                }),
                span = createElement('span', {
                    class: 'main__source',
                    text: utf8Decode(source)
                }),
                div = createElement('div', {
                    class: 'main__related-content',
                    nodes: [p, span]
                });
            return div;
        });
}

function createOtherNews(data = mandatory()) {
    if (isFirstLoad) {
        isFirstLoad = false;
        return createGroupItem('div', {
            class: 'main__recent-news'
        }, data, createOtherNewsItem);
    } else {
        const fragment = new DocumentFragment();
        data.forEach(d => {
            const row = createOtherNewsItem(d);
            fragment.appendChild(row)
        });
        return fragment;
    }
}

function createOtherNewsItem(item) {
    const { title, source, link, imgUri } = item,
        img = createElement('div', {
            class: 'main__recent-img',
            html: `<a href="${link}"><img src="${imgUri}" alt=""></a>`
        }),
        p = createElement('p', {
            html: `<a href="${link}">${utf8Decode(title)}</a>`
        }),
        span = createElement('span', {
            class: 'main__source',
            text: utf8Decode(source)
        }),
        text = createElement('span', {
            class: 'main__recent-text',
            nodes: [p, span]
        }),
        div = createElement('div', {
            class: 'main__recent-content',
            nodes: [img, text]
        });
    return div;
}

function loadOtherNews(node) {
    // console.log("loadOtherNews -> this 1: ", this); undefined
    const this_btn = event.target;
    loading.style.display = 'block';
    this_btn.style.display = 'none';
    getNews(load_num).then(d => {
        if (d.length == 0) {
            this_btn.remove();
            loading.style.display = 'none';
            return;
        }

        node.appendChild(createOtherNews(d))
        // console.log("loadOtherNews -> this 2: ", this); undefined
        loading.style.display = 'none';
        this_btn.style.display = 'block';
    });
    load_num++;
}

/**
 * @returns json data
 */
function getNews(param) {
    return fetch(`/api/news/${param}`, {
        method: 'GET'
    })
    .then(response => {
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

initView();