tinymce.init({
    language : 'de',
    selector: "#editor",
    theme: "modern",
    //force_p_newlines : false,
    extended_valid_elements: 'div[class=section|class=row|class=gallery|class=col|class=four|class=tablet-six|class=mobile-six|class=ratio]|span[style]',
    entity_encoding: 'raw',
    height: 500,
    plugins: [//bbcode
        "advlist autolink link image lists charmap print hr anchor",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "save table contextmenu directionality emoticons template paste"
    ],
    content_css: tinymce_content_css,
    toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | insertfile | link image media | forecolor backcolor emoticons | print",
    style_formats: [
        {title: 'Image Left', selector: 'img', styles: {
            'float' : 'left',
            'margin': '0 10px 0 10px',
            'float' : 'left',
            'width': 'inherit'
        }},
        {title: 'Image Right', selector: 'img', styles: {
            'float' : 'right',
            'margin': '0 10px 0 10px',
            'float' : 'right',
            'width': 'inherit'
        }},
    ]
});