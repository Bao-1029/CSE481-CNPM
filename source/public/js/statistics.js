import {
    createElement,
    mandatory,
    summaryArrayObj,
    totalizeObjs,
    getData,
    filterElements
} from './helpers.js';

const props = ['number', 'doubt', 'recovered', 'deaths'];

function initView(data, currentGeo, lastUpdate) {
    const main = document.querySelector('.main'),
        loading = document.querySelector('.main__icon-loading'),
        fragment = new DocumentFragment();
    fragment.appendChild(createMainComponent(data, currentGeo, lastUpdate));
    fragment.appendChild(createIllustration());
    fragment.appendChild(createSearch());
    fragment.appendChild(createTableData(data));

    const table = fragment.querySelector('.main__table-data tbody');
    fragment.getElementById('search').addEventListener('keyup', filterElements.bind(this, table, 'tr'));

    main.removeChild(loading);
    main.appendChild(fragment);
}

/**
 * @param {json} data 
 * @param {string} [currentGeo] current location of user
 * @param {string} lastUpdate datetime
 */
function createMainComponent(data = mandatory(), currentGeo = 'Hà Nội', lastUpdate = mandatory()) {
    const main = createElement('div', {
            class: 'main__data',
            html: `<div class="main__title">
                    <span>Thống kê tình hình dịch bệnh <wbr> Covid-19 tại Việt Nam</span>
                </div>`
        }),
        main_data = createElement('div', {
            class: 'main__data-content'
        }),
        last_update = createElement('p', {
            class: 'main__time-update',
            text: `Cập nhật lần cuối lúc: ${lastUpdate}`
        }),
        config = [
            {
                class: 'main__data-hn',
                child_class: 'main__data-numberhn',
                city: currentGeo,
                data: data[currentGeo]
            },
            {
                class: 'main__data-vn',
                child_class: 'main__data-numbervn',
                city: 'Việt Nam',
                data: totalizeObjs(data, props)
            }
        ];

    config.forEach(cfg => {
        const { class: c, child_class, city, data } = cfg,
            component = createElement('div', {
                class: c,
                html: `<span class="main__name-city">${city}</span>`,
                node: createBoxData(data, child_class)
            });
        main_data.appendChild(component);
    });

    main.appendChild(main_data);
    main.appendChild(last_update);
    return main;
}

function createTableData(data) {
    const div = createElement('div', {
            class: 'main__table-data',
        }),
        table = document.createElement('table'),
        thead = createElement('thead', {
            html: `<tr>
                        <th>Stt</th>
                        <th>Thành phố</th>
                        <th>Số ca nhiễm</th>
                        <th>Số ca tử vong</th>
                        <th>Số ca nghi nhiễm</th>
                        <th>Số ca hồi phục</th>
                    </tr>`
        }),
        tbody = document.createElement('tbody'),
        cities = Object.keys(data);
    for (let i = 1; i < cities.length; i++) {
        const city = cities[i],
            d = data[city],
            { recovered, doubt, number, deaths } = d,
            arr = [i, city, number, deaths, doubt, recovered],
            tr = document.createElement('tr');
        arr.forEach(item => {
            const td = createElement('td', {
                text: item
            });
            tr.appendChild(td);
        })
        tbody.appendChild(tr);
    }
    table.appendChild(thead);
    table.appendChild(tbody);
    div.appendChild(table);
    return div;
}

function createBoxData(data, child_class) {
    const { recovered, doubt, number, deaths } = data;
    return createElement('div', {
        class: child_class,
        nodes: [
            createElement('div', {
                class: 'main__infection-number box',
                html: `<span>${number}</span><p>Ca nhiễm</p>`
            }),
            createElement('div', {
                class: 'main__doubt-number box',
                html: `<span>${doubt}</span><p>Ca nghi nhiễm</p>`
            }),
            createElement('div', {
                class: 'main__die-number box',
                html: `<span>${deaths}</span><p>Ca tử vong</p>`
            }),
            createElement('div', {
                class: 'main__cured-number box',
                html: `<span>${recovered}</span><p>Ca hồi phục</p>`
            })
        ]
    });
}

function createIllustration() {
    return createElement('div', {
        class: 'main__mouse',
        html: `<div class="main__mouse-icon"></div>
                <p class="main__mouse-text">Cuộn xuống để xem dữ liệu các tỉnh thành</p>`,
    });
}

function createSearch() {
    return createElement('div', {
        class: 'main__search',
        html: `<form>
                    <input type="text" name="search" id="search" placeholder="Nhập tên thành phố">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 14.296 14.296"><path id="icons8-search_iOS_Glyph" data-name="icons8-search_iOS Glyph" d="M11.574,5.621a5.953,5.953,0,1,0,3.763,10.558l3.554,3.554a.6.6,0,1,0,.842-.842l-3.554-3.554a5.946,5.946,0,0,0-4.605-9.716Zm0,1.191a4.762,4.762,0,1,1-4.762,4.762A4.753,4.753,0,0,1,11.574,6.812Z" transform="translate(-5.621 -5.621)" fill="rgba(121,117,225,0.7)"></path>
                        </svg>
                    </i>
                </form>`,
    });
}

(function () {
    // fetch('https://maps.vnpost.vn/app/api/democoronas/', {
    // fetch('https://api.covid19api.com/country/vietnam', {
    getData('api/statistics', {
        method: 'GET'
    })
    .then(d => JSON.parse(d))
    .then(d => {
        const data = summaryArrayObj(d, 'address', {
            props: props,
            sum: props
        });
        initView(data, 'Hà Nội', d[d.length - 1]['date']);
        // console.log(data);
    })
    .catch(err =>
        console.log('Request failed', err)
    )
})();