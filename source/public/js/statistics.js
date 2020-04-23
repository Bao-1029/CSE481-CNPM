import { createElement, mandatory, summaryDataObj } from './helpers.js';

function initView(data, currentGeo, lastUpdate) {
    const main = document.querySelector(''),
        fragment = new DocumentFragment();
    fragment.appendChild(createMainComponent(data, currentGeo, lastUpdate));
    fragment.appendChild(createTableData(data));
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
                    <span>Thống kê tình hình dịch bệnh <br> Covid-19 tại Việt Nam</span>
                </div>`
        }),
        main_data = createElement('div', {
            class: 'main__data-content'
        }),
        lastUpdate = createElement('p', {
            class: 'main__time-update',
            text: `Cập nhật lần cuối lúc: ${lastUpdate}`
        }),
        config = [
            {
                class: 'main__data-vn',
                city: 'Việt Nam',
                data: data[city]
            },
            {
                class: 'main__data-hn',
                city: currentGeo,
                data: data[city]
            },
        ];

    config.forEach(cfg => {
        const { c, city , data } = cfg,
            component = createElement('div', {
                class: c,
                html: `<span class="main__name-city">${city}</span>`,
                node: createBoxData(data)
            });
        main_data.appendChild(component);
    });

    main_data.appendChild(lastUpdate);
    main.appendChild(main_data);
    return main;
}

function createTableData(data) {
    const table = createElement('table', {
            class: 'main__table-data',
            html: `<tr>
                        <th>Stt</th>
                        <th>Thành phố</th>
                        <th>Số ca nhiễm</th>
                        <th>Số ca tử vong</th>
                        <th>Số ca nghi nhiễm</th>
                        <th>Số ca hồi phục</th>
                    </tr>`
        }),
        cities = Object.keys(data);
    for (let i = 1; i < cities.length; i++) {
        const city = cities[i],
            d = data[city],
            { recovered, doubt, number, deaths } = d,
            arr = [i, city, number, deaths, doubt, recovered],
            tr = document.createElement('tr');
        arr.forEach(item => {
            const td = createElement('td', {
                text: object[key]
            });
            tr.appendChild(td);
        })
        table.appendChild(tr);
    }
    return table;
}

function createBoxData(data) {
    const { recovered, doubt, number, deaths } = data;
    return createElement('div', {
        class: 'main__data-numberhn',
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

(function () {
    const props = ['number', 'doubt', 'recovered', 'deaths'];

    fetch('https://maps.vnpost.vn/app/api/democoronas/', {
        method: 'GET',
        redirect:'follow',
        headers: {
            'Accept': '*/*',
            'Cache-Control': 'no-cache',
            'Host': 'maps.vnpost.vn',
            'Accept-Encoding': 'gzip, deflate, br',
            'Connection': 'keep-alive'
        }})
        .then(response => {
            if (response.status !== 200)
            {
                console.log(`Check your internet connection\nerror code: ${response.status}`);
                return;
            }
            return response.json();
        })
        .then(d => {
            data = summaryDataObj(d, 'address', {
                props: props,
                sum: props
            });
            initView(data, 'Hà Nội', d[d.length - 1]['date']);
            console.log(data);
        })
        .catch(err => 
            console.log('Request failed', err)
        )
})();