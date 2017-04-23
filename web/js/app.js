//Namespace
var App = {};

/**
 * Main JS File
 */
(function (App) {

    'use strict';

    var Tasker = {

        init: function () {
            this.preview();
            this.deleteTask();
        },

        cache: {
            preview:         $('#preview'),
            previewModal:    $('#preViewModal'),
            crateTaskForm:   $('#crateTask'),
            inputImg:        $('#inputImg'),
            previewName:     $('#previewName'),
            previewEmail:    $('#previewEmail'),
            previewDes:      $('#previewDes'),
            previewImg:      $('#previewImg'),

            deleteBtn:       $('.delete-btn')
        },

        preview: function () {

            var that = this,
                formData = {},
                reader = new FileReader();

            this.cache.preview.on('click', function (e) {
                e.preventDefault();
                that.cache.previewModal.modal('show');

                $.each(that.cache.crateTaskForm.serializeArray(), function () {
                    formData[this.name] = this.value;
                });

                $(that.cache.previewName).attr('value', formData['name']);
                $(that.cache.previewEmail).attr('value', formData['email']);
                $(that.cache.previewDes).text(formData['description']);


                if(that.cache.inputImg[0].files && that.cache.inputImg[0].files[0]) {
                    reader.onload = function (e) {
                        $(that.cache.previewImg[0]).attr('src', e.target.result);
                    };

                    reader.readAsDataURL(that.cache.inputImg[0].files[0]);
                }


            })
        },

        deleteTask: function () {
            this.cache.deleteBtn.on('click', function (e) {
                e.preventDefault();

                var r = confirm("Точно удалить?");
                if (r == true) {
                  location.href = $(this).attr('href');
                }
            })
        }
    };

    // Init Tasker Module
    Tasker.init();

}(App || (App = {})));
