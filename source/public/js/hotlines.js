import {
    createElement,
    mandatory,
    sendData,
    getData,
    getClosest,
    childrenMatches
} from './helpers.js';

const btn_add = document.querySelector(),
    table = document.querySelector('table tbody');
btn_add.onclick = () => alert('Dữ liệu đang được tải, xin chờ chút!');

function getHotlines() {
    getData('api/hotline/all', {
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
 * @param {boolean} [FormData = false] default `false`
 */
function sendHotline(action = mandatory(), method = mandatory(), formData = mandatory(), isReturn = false) {
    isReturn
    ? sendData(`api/hotline/${action}`, {
            method: method,
            body: formData
        })
    : getData(`api/hotline/${action}`, {
        method: method,
        body: formData
    })
}

function addHotline() {
    const new_row = createTableRow(undefined, '', ''),
        btn_edit = new_row.querySelector(''),
        fragment = new DocumentFragment();
    fragment.appendChild(new_row);
    table.insertAdjacentElement('afterbegin', fragment);
    btn_edit.click();
}

function saveEdit(event) {
    const {
        parent,
        td_name,
        td_phone,
        in_name,
        in_phone
    } = event,
        action = parent.querySelector('[role="data action"]'),
        id_row = parent.id_row,
        val_name = in_name.value,
        val_phone = in_phone.value;
    let data = new FormData();
    data.set('name', val_name);
    data.set('phone_number', val_phone);

    if (typeof parent.id_row) {
        parent.id_row = sendHotline('add', 'POST', data, true);
    }
    else {
        data.set('id', id_row);
        sendHotline('edit', 'PUT', data);
    }

    td_name.textContent = val_name;
    td_phone.textContent = val_phone;
    action.forEach(a => a.remove());
    parent.classList.remove('');
}

function cancelEdit(event) {
    const parent = event.parent;
    if (typeof parent.id_row) {
        parent.remove();
        return;
    }
    
    const td_name = event.td_name,
        td_phone = event.td_phone,
        btns = parent.querySelector('[role="data action"]');
    td_name.querySelector('input').remove();
    td_phone.querySelector('input').remove();
    btns.forEach(btn => btn.remove());
    parent.classList.remove('');
}

function editHotline(event) {
    const tr = getClosest(event.target, 'tr'),
        // tds = childrenMatches(tr, 'td'),
        // elems = tds.map(td => td.matches('[data-type]')),
        // action = tds.map(td => td.matches('[role]')),
        action = childrenMatches(tr, '[role="actions"]')[0],
        { td_name, td_phone } = event,
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
            value: phone_number
        })
        btn_save = createElement('button', {
            class: 'main__edit',
            text: 'Lưu',
            role: 'data action',
            parent: tr,
            td_name: td_name,
            td_phone: td_phone,
            in_name: in_name,
            in_phone: in_phone,
            events: {
                click: saveEdit.bind(this, event)
            }
        }),
        btn_cancel = createElement('button', {
            class: 'main__delete',
            text: 'Hủy',
            role: 'data action',
            parent: tr,
            td_name: td_name,
            td_phone: td_phone,
            events: {
                click: cancelEdit.bind(this, event)
            }
        });

    tr.classList.add('');

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
    if (typeof id_row) {
        parent.remove();
        return;
    }
    
    const { td_name } = event,
        hostpital = td_name.textContent.trim();

    let data = new FormData();
    data.set('id', id_row);

    if (confirm(`Xóa dữ liệu về bệnh viện ${hostpital}`))
        sendHotline('remove', 'DELETE', data);;
}

function createTableRow(data) {
    const { id,  name, phone_number } = data,
        elem_name = createElement('td', {
            'data-type': 'name',
            text: name
        }),
        elem_phone = createElement('td', {
            'data-type': 'phone',
            text: phone_number
        }),
        btn_edit = createElement('button', {
            class: '',
            td_name: elem_name,
            td_phone: elem_phone,
            events: {
                click: editHotline.bind(this, event)
            }
        }),
        btn_delete = createElement('button', {
            class: '',
            td_name: elem_name,
            events: {
                click: deleteHotline.bind(this, event)
            }
        }),
        elem_action = createElement('td', {
            role: 'actions',
            nodes: [btn_edit, btn_delete]
        }),
        tr = createElement('tr', {
            id_row: id,
            nodes: [elem_name, elem_phone, elem_action]
        });
    return tr;
}

async function initView() {
    const data = await getHotlines(),
        table = document.querySelector('.main__table tbody'),
        fragment = new DocumentFragment();
    data.forEach(d => {
        const row = createTableRow(d);
        fragment.appendChild(row)
    });
    table.appendChild(fragment);
    btn_add.onclick = addHotline;
}

initView();