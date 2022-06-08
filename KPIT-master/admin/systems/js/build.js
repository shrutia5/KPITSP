({
    baseUrl: ".",
    mainConfigFile:"main.js",
    name: "main",
    out: "admin.min.js",
    preserveLicenseComments:false,
    //optimize:'none',
    paths: {
        requiredlib:'../libs/require/require',
        jquery: '../libs/jquery/jquery-min',
        underscore: '../libs/underscore/underscore-min',
        backbone: '../libs/backbone/backbone-min',
        bootstrap : '../../assets/bootstrap/dist/js/bootstrap.min',
        jqueryCookie : '../../assets/jquery.cookies/jquerycookie', 
        bootstrapSlider:'../../assets/range_slider/bootstrap-slider',
        magnificPopup:'../../assets/magnific-popup/jquery.magnific-popup-min',
        locationpicker:'../../assets/map/locationpicker',
        fastclick : 'fastclick/lib/fastclick',
        datepicker:'../../assets/datepicker/datepicker',
        hotkeys:'../../assets/bootstrapWysiwyg/jquery.hotkeys',
        wysiwyg:'../../assets/bootstrapWysiwyg/bootstrap-wysiwyg',
        tagmanager:'../../assets/tagmanager/tagmanager.min',
        typeahead:'../../assets/tagmanager/bootstrap3-typeahead.min',
        flot:'../../assets/Flot/jquery.flot',
        curvedLines : '../../assets/flot.curvedlines/curvedLines',
        validate:'../../assets/jquery.validate/jquery.validate.min',
        inputmask:'../../assets/inputMask/jquery.inputmask.bundle',
        icheck:'../../assets/iCheck/icheck.min',
        select2:'../../assets/select2/js/select2.full.min',
        moment:'../../assets/datepicker/moment.min',
        plugin: '../../plugin',
        xlsx:'../../assets/SheetJS/xlsx.full.min',
        xlsprocess:'../../assets/SheetJS/xlsProcess',
        templates: '../templates',
        custom : 'custom',
        },
        include:'requiredlib'
})