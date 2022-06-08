
define([
  'jquery',
  'underscore',
  'backbone',
  'select2',
  'moment',
  '../models/mentorAccess',
  'text!../templates/mentor_temp.html',
  
], function($,_, Backbone,select2,moment,mentorAccessModel,accessControl){

var mentorAccessView = Backbone.View.extend({
    model:mentorAccessModel,
    initialize: function(options){
      var selfobj = this;
      $('.modelbox').hide();
      $(".profile-loader").show();
      var mname = Backbone.history.getFragment();
      permission = ROLE[mname];
      //var roleList = new userRoleCollection();
      $(".profile-loader").hide();
      selfobj.render();
    },
    events:
    {
      "click .loadview":"loadSubView",
      "change .switchChange":"updateOtherDetails",
      "click #saveAccessDetails": "saveAccessDetails",
      "change #roleID": "loadModuleList",
      //"change .dropval":"updateOtherDetails",
    },
    updateOtherDetails: function(e){
      var collid = $(e.currentTarget).attr("data-modelID");
      var initID = $(e.currentTarget).attr("data-inID");
      var ischeck = $(e.currentTarget).is(":checked");
      if(ischeck){
        var newsetval = [];
        newsetval[""+initID] = "yes";
      }else{
        var newsetval = [];
        newsetval[""+initID] = "no";
      }


      var mm = this.collection.get(collid);
      mm.set(newsetval);
      this.collection.set(mm,{remove: false});
     
    },
    saveAccessDetails: function(e){
      selfobj = this;
      var roleID = $("#roleID").val();
      if (roleID == "") {
        alert("Select Role");
        return false;
      }
      $(e.currentTarget).attr("disabled", "disabled");
        method = "update";
        this.collection.sync(method,this.collection,{headers:{
          'Content-Type':'application/x-www-form-urlencoded','SadminID':$.cookie('authid'),'token':$.cookie('_bb_key'),'Accept':'application/json'
        },error: selfobj.onErrorHandler}).done(function(res){

          if(res.statusCode == 994){app_router.navigate("logout",{trigger:true});}
          if(res.flag == "F"){
            alert(res.msg);
            $(e.currentTarget).html("<span>Error</span>");
          }else{
            $(e.currentTarget).html("<span>Saved</span>");
            //scanDetails.filterSearch();
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
    loadSubView:function(e){
        var selfobj = this;
        var show = $(e.currentTarget).attr("data-show");
        switch(show)
        {
          case "singleemployeeData":{
            var employeeID = $(e.currentTarget).attr("data-employeeID");
            var employeesingleview = new employeeSingleView({employeeID:employeeID,searchemployee:this});
            break;
          }
        }
    },
    loadModuleList:function(e){ 
      var selfobj = this;
      var roleID = $(e.currentTarget).val();
       if (roleID == "") {
        $("#moduleTable").remove();
        return false;
       }
      this.collection.roleID= roleID;
      this.collection.fetch({headers: {
        'contentType':'application/x-www-form-urlencoded','SadminID':$.cookie('authid'),'token':$.cookie('_bb_key'),'Accept':'application/json'
      },error: selfobj.onErrorHandler}).done(function(res){
        if(res.statusCode == 994){app_router.navigate("logout",{trigger:true});}
        $(".popupLoader").hide();
        selfobj.render();
      });
 
    },
    render: function(){
        var template = _.template(accessControl);
        this.$el.html(template({projectList:this.collection}));
        $(".main_container").append(this.$el);
        $('#companyID').select2({width:'100%'});
        return this;
    }
});

  return mentorAccessView;
  
});
