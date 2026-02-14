'use strict';

/**
 * The file is a part of the Site2 Project https://github.com/Romchik38/site2
 * Please read the license before use https://github.com/Romchik38/site2/blob/main/LICENSE.md
 */

export default function(parts){
    if(parts.length === 0) {
        throw new Error('parts is empty');
    }
    return '/' + parts.join('/');
};