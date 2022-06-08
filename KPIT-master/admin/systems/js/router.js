define([
    'jquery',
    'underscore',
    'backbone',
    'bootstrap',
    'jqueryCookie',
    'custom',
    'plugin/login/views/loginView',
    'plugin/dashboard/views/dashboardView',
    'plugin/admin/views/adminView',
    'plugin/userRole/views/userRoleView',
    'plugin/registerUser/views/registerUserView',
    'plugin/menu/views/menuView',
    'plugin/infoSettings/views/infoSettingsView',
    'plugin/admin/views/accessDetailsView',
    'plugin/userProfile/views/userProfileView',
    'plugin/login/views/otpView',
    'plugin/emailMaster/views/emailMasterView',
    'plugin/categoryMaster/views/categoryMasterView',
    'plugin/stateMaster/views/stateMasterView',
    'plugin/cityMaster/views/cityMasterView',
    'plugin/collegeMaster/views/collegeMasterView',
    'plugin/blogs/views/blogsView',
    'plugin/blogs/views/blogsSingleView',
    'plugin/faqMaster/views/faqMasterView',
    'plugin/contactUs/views/contactUsView',
    'plugin/readFiles/views/readFilesView',
    'plugin/ourclients/views/ourclientsMasterView',
    'plugin/trlLevelMaster/views/trlLevelMasterView',
    'plugin/trlQuestions/views/trlQuestionsView',
    'plugin/mentorAccess/views/mentorAccessView',
    'plugin/helpfulResources/views/helpfulResourcesView',
  
    'text!../templates/Master_temp_1.html',
    'text!../templates/Master_temp_2.html',
    'text!../templates/sideBar_temp.html',
    'text!../templates/topNav_temp.html',
  ],function($,_,Backbone,bootstrap,jqueryCookie,custom,loginView,dashboardView,adminView,userRoleView,registerUserView,menuView,infoSettingsView,accessDetailsView,userProfileView,otpView,emailMasterView,categoryMasterView,stateMasterView,cityMasterView,collegeMasterView,blogsView,blogsSingleView,faqMasterView,contactUsView,readFilesView,ourclientsMasterView,trlLevelMasterView,trlQuestionsView,mentorAccessView,helpfulResourcesView,Master_temp_1,Master_temp_2,sidebar,topNav) {
  
    
    var AppRouter = Backbone.Router.extend({
      routes: {
        'logout': 'logoutlink',
        'login': 'loginlink',
        'dashboard': 'dashboardview',
        'usersList': 'adminView',
        'roleList': 'userRoleView',
        'registerUser':'registerUserView',
        'infoDetails': 'infoSettingsView',
        'access-control': 'accessDetailsView',
        'userProfile': 'userProfileView',
        'emailsmsmaster': 'emailMasterView',
        'menuList': 'menuView',
        'categoryMaster': 'categoryMasterView',
        'stateMaster': 'stateMasterView',
        'cityMaster': 'cityMasterView',
        'collegeMaster': 'collegeMasterView',
        'blogs': 'blogsView',
        'addnewblog':"addblog",
        'addnewblog/:blogID':"addblog",
        'faqMaster':"faqMasterView",
        'contactUs':"contactUsView",
        'readFiles':"readFilesView",
        'ourclients':"ourclientsMasterView",
        'trlLevel':"trlLevelMasterView",
        'trlQuestions':"trlQuestionsView",
        'mentorAccess':"mentorAccessView",
        'helpfulresources':"helpfulResourcesView",


        '*actions': 'defaultAction'
      }
    });
    
      var initialize = function(){
      var bbauth = $.cookie('bbauth');
      ADMINNAME = $.cookie('name');
      ISMENUSET = false;
      ROLE = '';
      function preTemp() {
        if(typeof($.cookie('authid')) == "undefined"){
            app_router.navigate("login",{trigger:true});
            return false;
        }else
        {
  
          if(!ISMENUSET){
            if(typeof(localStorage.roleDetails) == "undefined" || localStorage.roleDetails =="[]"){
              app_router.navigate("logout",{trigger:true});
            }
            ROLE = JSON.parse(localStorage.roleDetails);
            var res = $.ajax({
                url:APIPATH+'getMenuList',
                method:'GET',
                async: false,
                datatype:'JSON',
                 beforeSend: function(request) {
                  request.setRequestHeader("token",$.cookie('_bb_key'));
                  request.setRequestHeader("SadminID",$.cookie('authid'));
                  request.setRequestHeader("contentType",'application/x-www-form-urlencoded');
                  request.setRequestHeader("Accept",'application/json');
                },
                success:function(res){
                  if(res.flag == "F"){
                    alert(res.msg);
                    return false;
                  }
                  if(res.statusCode == 994){app_router.navigate("logout",{trigger:true});}
                  if(res.flag == "S"){
                    ISMENUSET =res.data;
                    var template = _.template(Master_temp_1);
                    $("#master__load").addClass("nav-md");
                    $("#master__load").empty().append(template());
                    var sidebarTemplate = _.template(sidebar);
                    var topNavTemplate = _.template(topNav);
                    $(".main_container").append(sidebarTemplate({menuDetails:ISMENUSET}));
                    $(".main_container").append(topNavTemplate());
                    setsidbar();
                  }
                }
              });
            if(res.promise()){
              return true;
            }
            }else{
              var template = _.template(Master_temp_1);
              $("#master__load").addClass("nav-md");
              $("#master__load").empty().append(template());
              var sidebarTemplate = _.template(sidebar);
              var topNavTemplate = _.template(topNav);
              $(".main_container").append(sidebarTemplate({menuDetails:ISMENUSET}));
              $(".main_container").append(topNavTemplate({menuDetails:ISMENUSET}));
              setsidbar();
               return true;
            }
        }
       
      }
      app_router = new AppRouter;
      app_router.on('route:defaultAction', function (actions) {
        if(typeof($.cookie('authid')) == "undefined"){
           app_router.navigate("login",{trigger:true});
        }else
        {
          app_router.navigate("dashboard",{trigger:true});
        }
      });
  
      app_router.on('route:dashboardview', function(){
        var validate = preTemp();
        if(validate){
           var dashboardview = new dashboardView();
          setsidbar();
        }
      });
      app_router.on('route:accessDetailsView', function(){
       var validate = preTemp();
       if(validate){
          var accesscontrol = new accessDetailsView();
       }
      });
    
      app_router.on('route:adminView', function(){    
            var validate = preTemp();
       if(validate){
          var adminview = new adminView({});
         setsidbar();
       }
      });
      app_router.on('route:userRoleView', function(){
        var validate = preTemp();
        if(validate){
           var userRoleview = new userRoleView();
          setsidbar();
        }
      });
      
      app_router.on('route:registerUserView', function(){
        var validate = preTemp();
        if(validate){
           var registerView = new registerUserView();
          setsidbar();
        }
      });
      
      app_router.on('route:menuView', function(){
        var validate = preTemp();
        if(validate){
           var menuview = new menuView();
          setsidbar();
        }
      });
  
    
      app_router.on('route:infoSettingsView', function (actions) {
         var validate = preTemp();
       if(validate){
          var infoview = new infoSettingsView();
         setsidbar();
       }
       
      });
      app_router.on('route:userProfileView', function (actions) {
        
         var validate = preTemp();
       if(validate){
          var userProfile = new userProfileView();
         setsidbar();
       }
       
      });
      app_router.on('route:emailMasterView', function (actions) {
         var validate = preTemp();
       if(validate){
          var emailMaster = new emailMasterView();
         setsidbar();
       }
      });
      app_router.on('route:categoryMasterView', function (actions) {
         var validate = preTemp();
       if(validate){
          var emailMaster = new categoryMasterView();
         setsidbar();
       }
      });
      app_router.on('route:stateMasterView', function (actions) {
        var validate = preTemp();
      if(validate){
         var emailMaster = new stateMasterView();
        setsidbar();
      }
     });
     app_router.on('route:cityMasterView', function (actions) {
      var validate = preTemp();
      if(validate){
       var cityMaster = new cityMasterView();
      setsidbar();
      }
    });
    app_router.on('route:collegeMasterView', function (actions) {
      var validate = preTemp();
      if(validate){
      var collegeMaster = new collegeMasterView();
      setsidbar();
      }
    });
      app_router.on('route:faqMasterView', function (actions) {
         var validate = preTemp();
       if(validate){
          var emailMaster = new faqMasterView();
         setsidbar();
       }
      });
      app_router.on('route:blogsView', function (actions) {
         var validate = preTemp();
       if(validate){
          var emailMaster = new blogsView();
         setsidbar();
       }
      });
     app_router.on('route:addblog', function(action){
      console.log(action);
         var validate = preTemp();
         if(validate){
            var addblog = new blogsSingleView({action:action});
           //setsidbar();
         }
        });

        app_router.on('route:contactUsView', function (actions) {
          var validate = preTemp();
        if(validate){
           var contactUs = new contactUsView();
          setsidbar();
        }
       });

        
        app_router.on('route:readFilesView', function (actions) {
          var validate = preTemp();
        if(validate){
           var contactUs = new readFilesView();
          setsidbar();
        }
       });

        
        app_router.on('route:ourclientsMasterView', function (actions) {
          var validate = preTemp();
        if(validate){
           var ourclientsMaster = new ourclientsMasterView();
          setsidbar();
        }
       });

        app_router.on('route:trlLevelMasterView', function (actions) {
          var validate = preTemp();
        if(validate){
           var trlLevelMaster = new trlLevelMasterView();
          setsidbar();
        }
       });

        app_router.on('route:trlQuestionsView', function (actions) {
          var validate = preTemp();
        if(validate){
           var trlQuestions = new trlQuestionsView();
          setsidbar();
        }
       });        
        app_router.on('route:loginlink', function (actions) {
        var loc = window.location.pathname;
        var template = _.template(Master_temp_2);
        $("#master__load").addClass("login");
        $("#master__load").empty().append(template());
        var login_View = new loginView();
      });

    app_router.on('route:mentorAccessView', function (actions) {
        var validate = preTemp();
      if(validate){
         var mentoraccessview = new mentorAccessView();
        setsidbar();
      }
    });
    app_router.on('route:helpfulResourcesView', function (actions) {
      var validate = preTemp();
    if(validate){
       var helpfulresourcesView = new helpfulResourcesView();
      setsidbar();
    }
  });
     
      app_router.on('route:logoutlink',function(){
          $.ajax({
            url:APIPATH+'logout',
            method:'POST',
            data:{adminID:$.cookie("authid"),key:$.cookie("_bb_key")},
            datatype:'JSON',
             beforeSend: function(request) {
              request.setRequestHeader("token",$.cookie('_bb_key'));
              request.setRequestHeader("SmemberID",$.cookie('authid'));
              request.setRequestHeader("contentType",'application/x-www-form-urlencoded');
              request.setRequestHeader("Accept",'application/json');
            },
            success:function(res){
             $.removeCookie('_bb_key', { path: COKI });
             $.removeCookie('fname', { path: COKI });
             $.removeCookie('lname', { path: COKI });
             $.removeCookie('authid', { path: COKI });
             $.removeCookie('avtar', { path: COKI });
             $.removeCookie('bbauth', { path: COKI });
             $.removeCookie('name', { path: COKI });
             $.removeCookie('uname', { path: COKI });
             $.removeCookie('roleOfUser', { path: COKI });
             delete $.cookie('authid');
             delete $.cookie('_bb_key');
             delete ADMINNAME;
             localStorage.removeItem("roleDetails");
             app_router.navigate("login",{trigger:true});
            }
          });
      });
      Backbone.history.start();
    };
    return { 
      initialize: initialize
    };
  });