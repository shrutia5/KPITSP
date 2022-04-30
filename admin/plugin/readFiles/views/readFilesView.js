
define([
  'jquery',
  'underscore',
  'backbone',
  'datepicker',
  'jqueryUI',
  '../collections/readFilesCollection',
  '../views/addNewFileView',
  '../views/addNewFileView2',
  '../views/addNewDIR',
  '../models/readFilesFilterOptionModel',
  'text!../templates/readFilesTemp.html',
], function($,_, Backbone,datepicker,jqueryUI,readFilesCollection,addNewFileView,addNewFileView2,addNewDIR,readFilesFilterOptionModel,readFilesTemp){

var readFilesView = Backbone.View.extend({
    
    initialize: function(options){
        var selfobj = this;
        $(".profile-loader").show();

        var mname = Backbone.history.getFragment();
        permission = ROLE[mname];
        readyState = true;
        filterOption = new readFilesFilterOptionModel();
        this.searchreadFiles = new readFilesCollection();
        
        this.searchreadFiles.fetch({headers: {
          'contentType':'application/x-www-form-urlencoded','SadminID':$.cookie('authid'),'token':$.cookie('_bb_key'),'Accept':'application/json'
        },error: selfobj.onErrorHandler,type:'post'}).done(function(res){
          
          if(res.statusCode == 994){app_router.navigate("logout",{trigger:true});}
          // console.log(res.paths)
          selfobj.currentPath=res.paths.folderCurrentPath;
          selfobj.realpath=res.paths.realpath;
          selfobj.folderName=res.paths.folderName;
          
           selfobj.render(); 
          $(".profile-loader").hide();
        });
    },
   events:
    {
      "click .loadview":"loadSubView",
      "click .readNewFolder":"readNewFolder",
      "click .fileImage":"copyfileImagePath",
      "click .backOneFolder":"backOneFolder",
    },
    onErrorHandler: function(collection, response, options){
        alert("Something was wrong ! Try to refresh the page or contact administer. :(");
        $(".profile-loader").hide();
    },
    loadSubView:function(e){
        var selfobj = this;
        var show = $(e.currentTarget).attr("data-show");
        switch(show)
        {
          case "addNewFile":{
            var folderPath = this.realpath;
            var addNewFileview = new addNewFileView({folderPath:folderPath,searchVideos:this});
            break;
          }
          case "addNewFile2":{
            var folderPath = this.realpath;
            var addNewFileview2 = new addNewFileView2({folderPath:folderPath,searchVideos:this});
            break;
          }
          case "addDIR":{
            var folderPath = this.realpath;
            var addNewDir = new addNewDIR({folderPath:folderPath,searchVideos:this});
            break;
          }
        }
    },
    backOneFolder:function(e)
    {
      var selfobj = this;
       var nestedFolderPath = this.realpath;
       var folderName = this.folderName;
       var folderCurrentPath = this.currentPath;

       // console.log(nestedFolderPath)
       // console.log(folderName)
       // console.log(folderCurrentPath)

        var reminingFolderToBack=folderCurrentPath;
        nestedFolderPath=nestedFolderPath.split("/")
        folderCurrentPath=folderCurrentPath.split("/")

        var newfolderaName=nestedFolderPath.splice((nestedFolderPath.length)-2,1);
        folderCurrentPath.splice((folderCurrentPath.length)-2,1);
        folderName=newfolderaName.toString()+"/";
        var nestedFolderPath= nestedFolderPath.join("/");
        var folderCurrentPath= folderCurrentPath.join("/");

         if(reminingFolderToBack!="")
         {
          this.searchreadFiles.fetch({headers: {
              'contentType':'application/x-www-form-urlencoded','SadminID':$.cookie('authid'),'token':$.cookie('_bb_key'),'Accept':'application/json'
            },error: selfobj.onErrorHandler,type:'post',data:{folderCurrentPath:folderCurrentPath,nestedFolderPath:nestedFolderPath,folderName:folderName}}).done(function(res){
              
              if(res.statusCode == 994){app_router.navigate("logout",{trigger:true});}
              selfobj.currentPath=res.paths.folderCurrentPath;
              selfobj.realpath=res.paths.realpath;
              selfobj.folderName=res.paths.folderName;
               selfobj.render(); 
              $(".profile-loader").hide();
            });
          }
    },
    copyfileImagePath:function(e)
    {
       var imagePath = $(e.currentTarget).attr("src");
       var $inp=$("<input/>");
       
       $("body").append($inp);
       $inp.val(imagePath).select();
       
       document.execCommand("copy");
       $inp.remove();
       $(".alterMesage").fadeIn(800,function(){
        $(".alterMesage").fadeOut(800);
       })

    },
    readNewFolder:function(e)
    {
      var selfobj = this;
       var nestedFolderPath = $(e.currentTarget).attr("data-folderPath");
       var folderName = $(e.currentTarget).attr("data-folderName");
       var folderCurrentPath = $(e.currentTarget).attr("data-folderCurrentPath");
            folderCurrentPath=folderCurrentPath+folderName
       
       this.searchreadFiles.fetch({headers: {
          'contentType':'application/x-www-form-urlencoded','SadminID':$.cookie('authid'),'token':$.cookie('_bb_key'),'Accept':'application/json'
        },error: selfobj.onErrorHandler,type:'post',data:{folderCurrentPath:folderCurrentPath,nestedFolderPath:nestedFolderPath,folderName:folderName}}).done(function(res){
          
          if(res.statusCode == 994){app_router.navigate("logout",{trigger:true});}
            selfobj.currentPath=res.paths.folderCurrentPath;
            selfobj.realpath=res.paths.realpath;
            selfobj.folderName=res.paths.folderName;
            selfobj.render(); 
          $(".profile-loader").hide();
        });

    },

    filterSearch: function(){
        // $('#myModal').modal('hide');
        this.searchreadFiles.reset();
        var selfobj = this;
        
        var nestedFolderPath = this.realpath;
       var folderName = this.folderName;
       var folderCurrentPath = this.currentPath;
        this.searchreadFiles.fetch({ headers:{
            'contentType':'application/x-www-form-urlencoded','SadminID':$.cookie('authid'),'token':$.cookie('_bb_key'),'Accept':'application/json'
            } ,add: true, remove: false, merge: false,error: selfobj.onErrorHandler ,type:'post',data:{folderCurrentPath:folderCurrentPath,nestedFolderPath:nestedFolderPath,folderName:folderName}}).done(function(res){
                if(res.statusCode == 994){app_router.navigate("logout",{trigger:true});}
                $(".profile-loader").hide();
                selfobj.currentPath=res.paths.folderCurrentPath;
                selfobj.realpath=res.paths.realpath;
                selfobj.folderName=res.paths.folderName;
                selfobj.render();
               
            });
    },
    
    render: function(){
        var selfobj= this;
        var template = _.template(readFilesTemp);
        this.$el.html(template({searchreadFiles:this.searchreadFiles.models}));
        $(".main_container").append(this.$el);
      $(".alterMesage").hide();
        return this;
    }
});

  return readFilesView;
  
});
