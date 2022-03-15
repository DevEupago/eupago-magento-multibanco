/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
/*browser:true*/
/*global define*/
define(
    [
        'Magento_Checkout/js/view/payment/default',
    ],
    function (Component) {
        'use strict';

        return Component.extend({
            defaults: {
                template: 'Eupago_Multibanco/payment/form',
            },

            initObservable: function () {

                this._super();
                return this;
            },

            getCode: function () {
                return 'eupago_multibanco';
            },

            getData: function () {
                return {
                    'method': this.item.method
                };
            }
        });
    }
);