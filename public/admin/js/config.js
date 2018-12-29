
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
var PLUGINS_URL = '/plugins/';
var CKEDITOR_UPLOADER_URL = "/admin/uploader/ckeditor" + "?_token=" + CSRF_TOKEN;
var WEBUPLOADER_UPLOADER_URL = "/admin/uploader/webuploader" + "?_token=" + CSRF_TOKEN;
var WEBUPLOADER_SWF = PLUGINS_URL + 'webuploader/dist/Uploader.swf';