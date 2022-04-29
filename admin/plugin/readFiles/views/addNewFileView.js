define([
  'jquery',
  'underscore',
  'backbone',
  'RealTimeUpload',
  '../models/addFilesModel',
  'text!../templates/addNewFileTemp.html',
], function($,_, Backbone,RealTimeUpload,addFilesModel,addNewFileTemp){

var addNewFileView = Backbone.View.extend({
    initialize: function(options){
      var selfobj = this;
      this.model=new addFilesModel()
      $(".modelbox").hide();
      $('.modal-dialog').removeClass("modal-lg");
      scanDetails = options.searchVideos;
      var pathToSave=options.folderPath;
      this.model.set({folderPath:pathToSave})
      $('#addNewFileInFolder').html("");
      $('#addNewFileInFolder').remove();
      this.render();
      
  
    },
    events:
    {
      "click #saveuserRoleDetails":"saveuserRoleDetails",
      "change .fileAdded": "updateImage",
      "click #saveuserRoleDetails":"saveuserRoleDetails",
       
    },

    updateImage: function(e){
      var newdetails=[];
      $(e.currentTarget.files).each(function(index,data){
         var reader = new FileReader();
          reader.readAsDataURL(data);
          reader.onload = function (e) {

           newdetails.push(reader.result)

         };

      })
      this.model.set({fileList:newdetails})
      
    },
    
    saveuserRoleDetails: function(e){
      e.preventDefault();
        var selfobj = this;
        $(e.currentTarget).html("<span>Saving..</span>");
        $(e.currentTarget).attr("disabled", "disabled");
        this.model.save({},{headers:{
          'Content-Type':'application/x-www-form-urlencoded','SadminID':$.cookie('authid'),'token':$.cookie('_bb_key'),'Accept':'application/json'
        },error: selfobj.onErrorHandler,type:"POST"}).done(function(res){
          if(res.statusCode == 994){app_router.navigate("logout",{trigger:true});}
          if(res.flag == "F"){
            alert(res.msg);
            $(e.currentTarget).html("<span>Error</span>");
          }else{
            $(e.currentTarget).html("<span>Saved</span>");
            scanDetails.filterSearch();
          }
          
          setTimeout(function(){
            $(e.currentTarget).html("<span>Save</span>");
            $(e.currentTarget).removeAttr("disabled");
            }, 3000);
          
        });
    },
    onErrorHandler: function(collection, response, options){
        alert("Something was wrong ! Try to refresh the page or contact administer. :(");
        $(".profile-loader").hide();
    },

    render: function(){
        var source = addNewFileTemp;
        var template = _.template(source);
        this.$el.html(template());
        $("#modalBody").append(this.$el);
        $(".modal-title").html("File");
        // this.setValues();
        return this;
    },onDelete: function(){
        this.remove();
    }
});

  return addNewFileView;
  
});
