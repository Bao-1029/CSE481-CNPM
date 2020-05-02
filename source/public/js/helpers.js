// https://github.com/fiduswriter/Simple-DataTables/blob/master/src/helpers.js
/**
 * Create DOM element node
 * @param {String} nodeName
 * @param {Object} attrs - attributes
 *   @param {...} attrs.htmlAttributes
 *   @param {Object=} attrs.node - a node  - append a child node
 *   @param {Object[]=} attrs.nodes - an array of nodes - append child nodes
 *   @param {String=} attrs.html - node as string - append a child node
 *   @param {String[]=} attrs.html - nodes as an array of strings - append child nodes
 *   @param {String=} attrs.text - text of element
 *   @param {{ name: value }} [attrs.props] - properties of a element
 *   @param {Boolean=} [attrs.eventsInline = false] - inline attribute - default false
 *   @param {{ name: listener }} [attrs.events] - list events of element 
 *   - if you want to pass a written func, you shoud use `bind` or else it will fire immediately
 * @example <caption>events property</caption>
 * // {
 * //   click: function() {},
 * //   change: <function name>.bind(this, args)
 * // }
 * @example <caption>node properties</caption>
 * // {
 * //   checked: true,  - a boolean attribute
 * //   oldValue: value - a custom property
 * // }
 * @return {Object} element node
 */
export const createElement = (nodeName, attrs) => {
    attrs = { eventsInline: false, ...attrs };    
    const elem = document.createElement(nodeName);
    if (attrs && typeof attrs == "object")
        for (const attr in attrs) {
            switch (attr) {
                case 'node':
                    elem.appendChild(attrs[attr]);
                    break;
                case 'nodes':
                    attrs[attr].forEach(function (i) {
                        elem.appendChild(i);
                    });
                    break;
                case 'html':
                        elem.insertAdjacentHTML('beforeend', attrs[attr]);
                    break;
                case 'htmls':
                    attrs[attr].forEach(function (i) {
                        elem.insertAdjacentHTML('beforeend', i);
                    });
                    break;
                case 'text':
                    elem.textContent = attrs[attr];
                    break;
                case 'props':
                    for (const p in attrs[attr])
                        elem[p] = attrs[attr][p];
                    break;
                case 'events':
                    const events = attrs[attr];
                    if (!attrs.eventsInline)
                        for (const e in events)
                            elem.addEventListener(e, events[e]);
                    else
                        for (const e in events)
                            elem.addEventListener(`on${e}`, events[e]);
                    break;
                case 'eventsInline':
                    break;
                default:
                    elem.setAttribute(attr, attrs[attr]);
                    break;
            }
        }
    return elem;
};

/**
 * 
 * @param {String} nodeName 
 * @param {Object=} attrs 
 * @param {Object[]} arrayData 
 * @param {function} handlerEachData 
 */
export const createGroupItem = function (nodeName, attrs, arrayData, handlerEachData) {
    return createElement(nodeName, {
        class: 'main__related-news',
        ...attrs,
        nodes: arrayData.map(item => handlerEachData(item))
    });
};

/**
 * Return lastest id in the array of string
 * @param {String[]} arr - array of string
 * @param {String} searchString
 * @param {String} specificId - example: #
 * @return {Number} lastest id in the string
 * - return 0 if not found
 */
export const getLastestId = (arr, searchString, specificId) => {
    const s = arr.filter(x => x.includes(searchString)).sort();
    return s.length == 0 ? +subStr(s[s.length - 1], specificId, false) : 0;
}

export const mandatory = () => { throw new Error('Misssing parameter'); };

/**
 * Summary data of an array of object
 * @param {object[]} json - array of object
 * @param {string} key - group by key
 * @param {object} config
 *   @param {string[]} config.props - array of property's value need to group
 *   @param {string[]} [config.sum] - array of property's value need to sum
 * @return {object} data
 * @example
 * summaryDataObj(json, 'name', {
     props: ['value', 'num'],
     sum: ['value', 'num']
 * })
 * // json = [
 * //   {
 * //       name: 'n1',
 * //       value: 'abc',
 * //       nun: 2,
 * //       other: 'smth'
 * //   },
 * //   {
 * //       name: 'n1',
 * //       value: 'def',
 * //       nun: 2,
 * //       other: 'smth'
 * //   }
 * // ]
 * return: {
    *"n1": {
        value: ['abc', 'def'],
        num: 4
            }
    }
 */
export const summaryDataObj = function (json = mandatory(), key = mandatory(), config = mandatory()) {
    const result = {};
    json.forEach(item => {
        const k = item[key];
        !result[k] && (result[k] = {});
        config['props'].forEach(prop => {
            !result[k][prop] && (result[k][prop] = []);
            result[k][prop].push(item[prop]);
        });
    });

    if (config.sum)
        for (const key in result) {
            config['sum'].forEach(item => {
                result[key][item] = result[key][item].reduce((total, crr) => total + crr, 0);
            });
        }
    return result
};