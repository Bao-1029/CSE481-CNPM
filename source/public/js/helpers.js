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
 * Create items and append all to elem
 * @param {String} nodeName 
 * @param {Object=} attrs 
 * @param {Object[]} arrayData 
 * @param {function} handlerEachData 
 * @return {Object} element node
 */
export const createGroupItem = function (nodeName, attrs, arrayData, handlerEachData) {
    return createElement(nodeName, {
        ...attrs,
        nodes: arrayData.map(item => handlerEachData(item))
    });
};

/**
 * Get substring
 * @param {String} str - string
 * @param {String} breakChar - break character
 * - if there is no character provided explicitly, the value return is `undefined`
 * @param {Boolean} fromStart - default `true`
 * - `true`: Get substring from start to break character
 * - `false`: Get substring from break character to end
 * @param {Boolean} includeBreakChar - include break character when return - default `false`
 * @return {String} return `undefined` if not found
 * @example
 * subStr('1234abcd', '4') // return "123"
 * subStr('1234abcd', '4', true, true) // "1234"
 * subStr('1234abcd', '4', false, false) // "abcd"
 * subStr('1234abcd', '4', false, true) // "4abcd"
 */
export const subStr = (str, breakChar, fromStart = true, includeBreakChar = false) => {
    const i = str.indexOf(breakChar);
    return i != -1 ? fromStart ? str.substring(0, includeBreakChar ? i + 1 : i) : str.substring(includeBreakChar ? i : i + 1) : undefined;
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

/**
 * Flatten an object with the paths for keys.
 * @param {Object} obj The object need to flatten
 * @param {String=} prefix to create the path
 * @return {Object}
 * @example
 * flattenObject({
        a: {
            b: {
                c: 1
            }
        },
        d: 1
    });
 * Output: { 'a.b.c': 1, d: 1 }
 * @see {@link https://www.30secondsofcode.org/js/s/flatten-object/}
 */
export const flattenObject = function (obj, prefix = '') {
    return Object.keys(obj).reduce((acc, k) => {
        const pre = prefix.length ? prefix + '.' : '';
        if (typeof obj[k] === 'object') Object.assign(acc, flattenObject(obj[k], pre + k));
        else acc[pre + k] = obj[k];
        return acc;
    }, {});
}

/**
 * 
 * @param {Object} obj 
 * @param {Function} fn 
 * @return {Object}
 * @example
 *
 const obj = {
     foo: '1',
     nested: {
         child: {
             withArray: [{
                 grandChild: ['hello']
             }]
         }
     }
 };
 const upperKeysObj = deepMapKeys(obj, key => key.toUpperCase());
 {
   "FOO":"1",
   "NESTED":{
     "CHILD":{
       "WITHARRAY":[
         {
           "GRANDCHILD":[ 'hello' ]
         }
       ]
     }
   }
 }
 * @see {@link https://www.30secondsofcode.org/js/s/deep-map-keys/}
 */
export const deepMapKeys = function (obj, fn) {
    Array.isArray(obj)
    ? obj.map(val => deepMapKeys(val, fn))
    : typeof obj === 'object'
        ? Object.keys(obj).reduce((acc, current) => {
            const key = fn(current);
            const val = obj[current];
            acc[key] =
                val !== null && typeof val === 'object' ? deepMapKeys(val, fn) : val;
            return acc;
        }, {}) 
        : obj;
}

/**
 * Creates an object with keys generated by running the provided function for each key and the same values as the provided object.
 * @param {Object} obj 
 * @param {Function} fn - The callback receives three arguments - the value, the key and the object.
 * - `function(value, key, object) {}`
 * @return {Object}
 * @example
 * mapKeys({ a: 1, b: 2 }, (val, key) => key + val); // { a1: 1, b2: 2 }
 * @see {@link https://www.30secondsofcode.org/js/s/map-keys/}
 */
export const mapKeys = function (obj, fn) {
    Object.keys(obj).reduce((acc, k) => {
        acc[fn(obj[k], k, obj)] = obj[k];
        return acc;
    }, {});
}

/**
 * Returns the first key that satisfies the provided testing function.
 * Otherwise undefined is returned.
 * @param {Object} obj 
 * @param {Function} fn - The callback receives three arguments - the value, the key and the object.
 * - `function(value, key, object) {}`
 * @return {String|Number} a key that match
 * @example
 * findKey({
         barney: {
             age: 36,
             active: true
         },
         fred: {
             age: 40,
             active: false
         }
     },
     o => o['active']
 ); // 'barney'
 * @see {@link https://www.30secondsofcode.org/js/s/find-key/}
 */
export const findKey = (obj, fn) => Object.keys(obj).find(key => fn(obj[key], key, obj));

/**
 * Send data, alert if false
 * @param {RequestInfo} input 
 * @param {RequestInit} init 
 * @return {Promise<Response>}
 */
export const sendData = function (input, init) {
    return fetch(input, init)
        .then(response => {
            if (response.status == 500)
                alert(`Check your internet connection\nerror code: ${response.status}`);
            else if (response.error)
                alert(response.error);
            return response.text();
        })
        .then(text => alert(text))
        .catch(err =>
            console.log('Request failed', err)
        );
}

/**
 * 
 * @param {RequestInfo} input 
 * @param {RequestInit} init 
 * @return {Promise<Response>}
 */
export const getData = function (input, init) {
    return fetch(input, init)
        .then(response => {
            if (response.status == 500)
                alert(`Check your internet connection\nerror code: ${response.status}`);
            else if (response.error)
                alert(response.error);
            return response.json();
        })
        .then(json => {
            return json.data
        })
        .catch(err =>
            console.log('Request failed', err)
        );
}

/**
 * Get the closest parent element with a matching selector
 * @param {Element} elem 
 * @param {String} selector selectorString
 * @return {Element}
 * @see {@link https://gomakethings.com/how-to-get-the-closest-parent-element-with-a-matching-selector-using-vanilla-javascript/}
 */
export const getClosest = function (elem, selector) {
    for (; elem && elem !== document; elem = elem.parentNode) {
        if (elem.matches(selector)) return elem;
    }
    return null;
};

/**
 * Get all direct descendant elements that match a selector
 * * (c) 2018 Chris Ferdinandi, MIT License, https://gomakethings.com
 * @param  {Node}   elem     The element to get direct descendants for
 * @param  {String} selector The selector to match against
 * @return {Array}           The matching direct descendants
 * @see {@link https://gomakethings.com/getting-direct-descendant-elements-by-selector-with-vanilla-js/}
 */
export const childrenMatches = function (elem, selector) {
    return Array.prototype.filter.call(elem.children, function (child) {
        return child.matches(selector);
    });
};

/**
 * Get the child element of the closest parent element with a matching selector
 * @param {Element} elem 
 * @param {String} selector selectorString
 * @return {Element}
 * @see {@link https://gomakethings.com/how-to-get-the-closest-parent-element-with-a-matching-selector-using-vanilla-javascript/}
 */
export const childOfClosest = function (elem, parentSelector, selector) {
    const parent = getClosest(elem, parentSelector);
    return parent.querySelector(selector);
};

/**
 * Get all direct childrent element of the closest parent element with a matching selector
 * @param {Element} elem 
 * @param {String} selector selectorString
 * @return {Element[]}
 * @see {@link https://gomakethings.com/how-to-get-the-closest-parent-element-with-a-matching-selector-using-vanilla-javascript/}
 */
export const childrentOfClosest = function (elem, parentSelector, selector) {
    const parent = getClosest(elem, parentSelector);
    return childrenMatches(parent, selector);
};