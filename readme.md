Redactor Boilerplate
====================

Redactor is commercial copyrighted software, please refer [https://imperavi.com/redactor/](https://imperavi.com/redactor/) to get your copy.

### Usage

Attach to a textarea

```html
<textarea name="content" class="redactor" data-upload="http://path/to/upload" data-media="http://path/to/media.json"> </textarea>
```

Setup script

```js
$(function() {
    $('.redactor').each(function() {
        let upload_url = $(this).data('upload');
        let media_url = $(this).data('media');

        $(this).redactor({
            minHeight: 150,
            buttons: ['format', 'bold', 'italic', 'underline', 'deleted', 'lists', 'image', 'file', 'horizontalrule', 'link'],
            plugins: ['alignment', 'table', 'video', 'imagemanager', 'source'],
            imageUpload: upload_url,
            imageManagerJson: media_url,
        });
    });
});
```