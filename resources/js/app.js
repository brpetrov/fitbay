require("./bootstrap");

require("alpinejs");

tinymce.init({
    selector: "textarea",
    plugins: "advlist lists",
    toolbar_mode: "floating",
    resize: false,
    min_height: 500,
    max_height: 1000
});
