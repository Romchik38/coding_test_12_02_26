'use strict';

import { default as Form } from '/media/js/modules/components/form.js';

var f = Form.fromClass('api-shipping-calculate');


document.addEventListener('DOMContentLoaded', ()=>{
    try {
        console.log('the form is ready');
        
    } catch (e) {
        console.error('Form api-shipping-calculate does not work correctly');
        console.error(e);
    }
});
