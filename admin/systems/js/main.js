// Author: kiran Malave <kiran.malave@gmail.com>
// Filename: main.js

// All Global Path for images and API call
APPNAME = "KPIT";
COKI = "/";


// APPPATH = "http://localhost/kpit/admin";
// APIPATH = "http://localhost/kpit/admin/crmAPI/";
// FRONTIMAGES = "http:///localhost/kpit/images";
// ResourceImage = "http:///localhost/kpit/uploads/helpfulResources/";

APPPATH = "http://localhost/kpit/admin";
APIPATH = "http://localhost/kpit/admin/crmAPI/";
FRONTIMAGES = "http://localhost/kpit/images";
ResourceImage = "http://localhost/kpit-masteruploads/helpfulResources/";
IMAGES = APPPATH+"/"+"images";

PROFILEPIC = APPPATH+"/"+"images";
require.config({
  shim:{
    'bootstrap': {
        deps: ['jquery']
    },
    'jqueryCookie':{
      deps:['jquery']
    },
    'magnificPopup':{
      deps:['jquery']
    },
    'flot':{
      deps: ['jquery']  
    },
    'datepicker':{
        deps:['jquery']
    },
    'moment':{
        deps:['jquery']
    },
    'datetimepicker':{
        deps:['jquery','moment']
    },
    'wysiwyg':{
        deps:['jquery','hotkeys']
    },
    'curvedLines':{
      deps: ['jquery','flot']  
    },
    'typeahead':{
      deps: ['jquery']  
    },
    'tagmanager':{
      deps: ['jquery']  
    },
    'validate':{
        deps:['jquery']
    },
    'inputmask':{
        deps:['jquery']
    },
    'icheck':{
        deps:['jquery']
    },
    'select2':{
        deps:['jquery']
    },
    'slim':{
        deps:['jquery']
    },
    'multiselect':{
        deps:['jquery']
    },
     'RealTimeUpload':{
        deps:['jquery']
    },
    'jqueryUI':{
        deps:['jquery']
    },
    'minicolors':{
        deps:['jquery']
    },
    'Quill':{
        deps:['jquery']
    },
    'templateEditor':{
        deps:['jquery','Quill','minicolors']
    },
    'custom':{
        deps:['jquery','moment','videoJS']
    }
  }, 
  paths:{
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
    slim:'../../assets/slim/slim.jquery.min',
    multiselect:'../../assets/multiselect/js/multiselect.min',
    RealTimeUpload:'../../assets/realTimeUpload/js/RealTimeUpload',
    custom : 'custom',
    xlsx:'../../assets/SheetJS/xlsx.full.min',
    xlsprocess:'../../assets/SheetJS/xlsProcess',
    videoJS:'../../assets/videojs/video',
    jqueryUI:'../../assets/jquery-ui/jquery-ui.min',
    minicolors:'../../assets/Color-Picker/jquery.minicolors',
    Quill:'../../assets/quill-1.3.6/quill.min',
    templateEditor:'../../assets/templateEditor/dragDrop',
    
  }
});


require([
  // Load our app module and pass it to our definition function
  'app',

], function(App){
  // The "app" dependency is passed in as "App"
  // Again, the other dependencies passed in are not "AMD" therefore don't pass a parameter to this function
  App.initialize();
});