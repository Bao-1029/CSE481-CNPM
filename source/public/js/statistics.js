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
const summaryDataObj = function (json, key, config) {
    const result = {};
    json.forEach(item => {
        const k = item[key];
        !result[k] && (result[k] = {});
        config['props'].forEach(prop => {
            !result[k][prop] && (result[k][prop] = []);
            result[k][prop].push(item[prop]);
        });
    });

    if(config.sum)
        for (const key in result) {
            config['sum'].forEach(item => {
                result[key][item] = result[key][item].reduce((total, crr) => total + crr, 0);
            });
        }
    return result
};


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
            if (response.status !== '200')
            {
                console.log(`Check your internet connection\nerror code: ${response.status}`);
                return;
            }
            
            response.json().then(data => {
                console.log(data);
                return data;
            })
        })
        .then(response => console.log(summaryDataObj(response, 'address', {
            props: props,
            sum: props
        })))
        .catch(err => 
            console.log('Request failed', err)
        )
})();