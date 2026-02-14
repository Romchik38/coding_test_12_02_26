'use strict';

import { default as Component } from '/media/js/modules/components/component.js';
import { default as Form } from '/media/js/modules/components/form.js';
import { default as RequestData } from '/media/js/modules/utils/make-request/request-data.js';
import { default as makeRequest } from '/media/js/modules/utils/make-request/make-post-request.js';

/**
 * The components:
 * 
 * f            The Form
 * b            calculate button
 * iw           input weight
 * is           select option slug
 * sm           success message div
 * em           error message div
 */

var f = Form.fromClass('api-calculate-form');
var b = Component.fromClass('api-calculate-btn');
var iw = Component.fromClass('api-calculate-weight');
var is = Component.fromClass('api-calculate-slug');
var sm = Component.fromClass('api-calculate-success_message');
var em = Component.fromClass('api-calculate-error_message');

var path = ['api', 'shipping', 'calculate'];

f.onEvent('submit', (e) => {
    e.preventDefault();
    b.disable();
    // do request
    var requestData = new RequestData();
    requestData.addData(iw.getName(), iw.getValue());
    requestData.addData(is.getName(), is.getValue());
    makeRequest(path, requestData, (err, data) => {
        if (err !== null) { 
            // on error      
            console.log({ 'api-calculate': err});
            sm.hide();
            em.text('Error: ' + err.message);
            em.show();
        } else {
            // on success
            console.log({ 'api-calculate': data.price });
            em.hide();
            sm.text('Price: ' + data.price.toString());
            sm.show();
        }
        // finally
        b.enable();
    });
});
