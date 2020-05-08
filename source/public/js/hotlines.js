import {
    createElement,
    mandatory,
    sendData,
    getData,
    getClosest,
    childrenMatches,
    filterElements
} from './helpers.js';

const btn_add = document.querySelector('.main__add'),
    table = document.querySelector('.main__table tbody'),
    menu = document.getElementById('menu');
btn_add.onclick = () => alert('Dữ liệu đang được tải, xin chờ chút!');

table.insertAdjacentHTML(
    'beforeend', 
    `<div class="main__icon-loading-hpl">
        <div class="main__loading-hpl"></div>
        <span class="main__text-loading-hpl">Đang tải...</span>
    </div>`);
document.getElementById('search').addEventListener('keyup', filterElements.bind(this, table, 'tr'));
document.getElementById('btn-logout').addEventListener('click', logout);
document.getElementById('item-logout').addEventListener('click', logout);
document.querySelector('.header__icon-bar').addEventListener('click', function () {
    menu.style.width = "100%";
});
document.getElementById('close-menu').addEventListener('click', function () {
    menu.removeAttribute("style");
});

function logout () {
    fetch('user/logout', {
            method: 'POST'
        })
        .then(response => {
            if (response.status == 302)
                window.location.replace('login');
        })
        .catch(err =>
            console.log('Request failed', err)
        );
}

function getHotlines() {
    return getData('hotline/all', {
            method: 'GET'
        }).catch(err =>
            console.log('Request failed', err)
        );
}

/**
 * 
 * @param {String} action 
 * @param {String} method 
 * @param {FormData} formData 
 * @param {boolean} [isReturn = false] default `false`
 */
function sendHotline(action = mandatory(), method = mandatory(), formData = mandatory(), isReturn = false) {
    return isReturn
    ? sendData(`hotline/${action}`, {
            method: method,
            body: formData
        })
    : getData(`hotline/${action}`, {
        method: method,
        body: formData
    })
}

function addHotline() {
    const new_row = createTableRow({id: undefined, name: '', phone_number: ''}),
        btn_edit = new_row.querySelector('.main__icon-edit');
    table.insertAdjacentElement('afterbegin', new_row);
    btn_edit.click();
}

function saveEdit(event) {
    const {
        parent,
        td_name,
        td_phone,
        in_name,
        in_phone
    } = event.target,
        action = parent.querySelectorAll('[role="data action"]'),
        id_row = parent.id_row,
        val_name = in_name.value.trim(),
        val_phone = in_phone.value.trim();

    if (val_name.length < 1 || val_phone.length < 1) {
        alert('Thông tin phải được điền đầy đủ!');
        return;
    }
    if (/^\d{4}[-. ]?\d{3}[-. ]?\d{3}$/.test(val_phone) == false) {
        alert('Định dạng số điện thoại bị sai!');
        return;
    }
    
    let data = new FormData();
    data.set('name', val_name);
    data.set('phone_number', val_phone);

    if (parent.id_row == undefined) {
        sendHotline('add', 'POST', data, true).then(response => {
            response.data ? (parent.id_row = response.data) : alert('Có lỗi ở máy chủ');
        });
    }
    else {
        data.set('id', id_row);
        sendHotline('edit', 'POST', data).then(response => {
            if (!response) alert('Có lỗi ở máy chủ');
        });
    }

    td_name.textContent = val_name;
    td_phone.textContent = val_phone;
    action.forEach(a => a.remove());
    parent.classList.remove('edit');
}

function cancelEdit(event) {
    const parent = event.target.parent;
    // console.log("cancelEdit -> parent.id_row", parent.id_row);
    if (parent.id_row == undefined) {
        parent.remove();
        return;
    }
    
    const { td_name, td_phone } = event.target,
        btns = parent.querySelectorAll('[role="data action"]');
    td_name.querySelector('input').remove();
    td_phone.querySelector('input').remove();
    btns.forEach(btn => btn.remove());
    parent.classList.remove('edit');
}

function editHotline(event) {
    // console.log("editHotline -> event", event);
    const tr = getClosest(event.target, 'tr'),
        // tds = childrenMatches(tr, 'td'),
        // elems = tds.map(td => td.matches('[data-type]')),
        // action = tds.map(td => td.matches('[role]')),
        action = childrenMatches(tr, '[role="actions"]')[0],
        { td_name, td_phone } = event.target,
        // td_name = elems[findKey(data, obj => obj.hasOwnProperty('name'))],
        data = {
            /* ...elems.map(function (d) {
                return {
                    // OR: d['attributes']["data-type"].value --> but too long
                    [d.dataset.type]: d.textContent
                }
            }) */
            name: td_name.textContent,
            phone_number: td_phone.textContent
        },
        { name, phone_number } = data,
        // mapKeys(flattenObject(data), (val, key) => subStr(key, '.', false)),
        fragment = new DocumentFragment(),
        in_name = createElement('input', {
            value: name
        }),
        in_phone = createElement('input', {
            type: 'tel',
            pattern: '^\d{4}[-. ]?\d{3}[-. ]?\d{3}$',
            value: phone_number
        }),
        btn_save = createElement('button', {
            class: 'main__edit',
            text: 'Lưu',
            role: 'data action',
            props: {
                parent: tr,
                td_name: td_name,
                td_phone: td_phone,
                in_name: in_name,
                in_phone: in_phone,
            },
            events: {
                click: saveEdit.bind(this)
            }
        }),
        btn_cancel = createElement('button', {
            class: 'main__delete',
            text: 'Hủy',
            role: 'data action',
            props: {
                parent: tr,
                td_name: td_name,
                td_phone: td_phone,
            },
            events: {
                click: cancelEdit.bind(this)
            }
        });

    tr.classList.add('edit');

    fragment.appendChild(in_name);
    td_name.appendChild(fragment);

    fragment.appendChild(in_phone);
    td_phone.appendChild(fragment);

    fragment.appendChild(btn_save);
    fragment.appendChild(btn_cancel);
    action.appendChild(fragment);
}

function deleteHotline(event) {
    const parent = getClosest(event.target, 'tr'),
        id_row = parent.id_row;
    if (id_row == undefined) {
        parent.remove();
        return;
    }
    
    const { td_name } = event.target,
        hostpital = td_name.textContent.trim();

    let data = new FormData();
    data.set('id', id_row);

    let r;
    if (confirm(`Xóa dữ liệu về bệnh viện ${hostpital}`))
        sendHotline('remove', 'POST', data, true)
            .then(response => {
                response.data ? parent.remove() : alert('Có lỗi ở máy chủ');
            });
        
}

function createTableRow(data) {
    const { id, name, phone_number } = data,
        elem_name = createElement('td', {
            'data-type': 'name',
            text: name
        }),
        elem_phone = createElement('td', {
            'data-type': 'phone',
            text: phone_number
        }),
        btn_edit = createElement('button', {
            class: 'main__icon-edit',
            role: 'row action',
            props: {
                td_name: elem_name,
                td_phone: elem_phone,
            },
            events: {
                click: editHotline.bind(this)
            }
        }),
        btn_delete = createElement('button', {
            class: 'main__icon-delete',
            role: 'row action',
            props: {
                td_name: elem_name,
            },
            events: {
                click: deleteHotline.bind(this)
            }
        }),
        elem_action = createElement('td', {
            role: 'actions',
            nodes: [btn_edit, btn_delete]
        }),
        tr = createElement('tr', {
            props: {
                id_row: id,
            },
            nodes: [elem_name, elem_phone, elem_action]
        });
    return tr;
}

async function initView() {
    const data = await getHotlines(),
        fragment = new DocumentFragment();
    data.forEach(d => {
        const row = createTableRow(d);
        fragment.appendChild(row)
    });
    document.querySelector('.main__icon-loading-hpl').remove();
    table.appendChild(fragment);
    btn_add.onclick = addHotline;
}

initView();