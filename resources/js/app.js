require('bootstrap');
require('./bootstrap');

require('./coverImage');
require('./galleryImage');

tinymce.init({
    selector: 'textarea.tinymce',
});