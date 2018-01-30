define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Frontend, Table, Form) {

    var Controller = {
        index: function () {},

        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});