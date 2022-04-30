define([
  'jquery',
  'underscore',
  'backbone',
  'validate',
  '../models/adminSingleModel',
  'text!../templates/addAdmin_temp.html',
  '../../userRole/collections/userRoleCollection',
], function($,_,Backbone,validate,adminModel,addAdminTemp,userRoleCollection){

var addAdminView = Backbone.View.extend({
    initialize: function(options){
        var selfobj = this;
        $(".modelbox").hide();
        scanDetails = options.searchadmin;
        $('#adminData').remove();
        $(".popupLoader").show();
        this.model = new adminModel();
        this.userRoleList = new userRoleCollection();

        this.userRoleList.fetch({headers: {
            'contentType':'application/x-www-form-urlencoded','SadminID':$.cookie('authid'),'token':$.cookie('_bb_key'),'Accept':'application/json'
          },error: selfobj.onErrorHandler,data:{getAll:'Y'}}).done(function(res){
            if(res.statusCode == 994){app_router.navigate("logout",{trigger:true});}
            $(".popupLoader").hide();
            selfobj.render();
          });
        if(typeof(options.adminID) != 'undefined' && options.adminID !=''){
          this.model.set({adminID:options.adminID});
          this.model.fetch({headers: {
            'contentType':'application/x-www-form-urlencoded','SadminID':$.cookie('authid'),'token':$.cookie('_bb_key'),'Accept':'application/json'
          },error: selfobj.onErrorHandler}).done(function(res){
            if(res.statusCode == 994){app_router.navigate("logout",{trigger:true});}
            $(".popupLoader").hide();
            selfobj.render();
            selfobj.setValues();
          });
        }else
        {
           selfobj.render();
           $(".popupLoader").hide();
        }
    },
    events:
    {
      "click #saveEduDetails":"saveEduDetails",
      "click .item-container li":"setValues",
      "blur .txtchange":"updateOtherDetails",
      "change .dropval":"updateOtherDetails",
    },
    onErrorHandler: function(collection, response, options){
        alert("Something was wrong ! Try to refresh the page or contact administer. :(");
        $(".profile-loader").hide();
    },
    updateOtherDetails: function(e){

      var valuetxt = $(e.currentTarget).val();
      var toID = $(e.currentTarget).attr("id");
      var newdetails=[];
      newdetails[""+toID]= valuetxt;
      this.model.set(newdetails);
    },
    setValues:function(e){
        setvalues = ["status"];
        var selfobj = this;
        $.each(setvalues,function(key,value){
          var modval = selfobj.model.get(value);
          if(modval != null){
            var modeVal = modval.split(",");
          }else{ var modeVal = {};}

          $(".item-container li."+value).each(function(){
            var currentval = $(this).attr("data-value");
            var selecterobj = $(this);
            $.each(modeVal,function(key,dbvalue){
              if(dbvalue.trim().toLowerCase() == currentval.toLowerCase()){
                $(selecterobj).addClass("active");
              }
            });
          });
          
        });
        setTimeout(function(){
        if(e != undefined && e.type == "click")
        {
          var newsetval = [];
          var objectDetails = [];
          var classname = $(e.currentTarget).attr("class").split(" ");
          $(".item-container li."+classname[0]).each(function(){
            var isclass = $(this).hasClass("active");
            if(isclass){
              var vv = $(this).attr("data-value");
              newsetval.push(vv);
            }
         
          });

          if (0 < newsetval.length) {
            var newsetvalue = newsetval.toString();
          }
          else{var newsetvalue = "";}

          objectDetails[""+classname[0]] = newsetvalue;
          $("#valset__"+classname[0]).html(newsetvalue);
          selfobj.model.set(objectDetails);
        }
      }, 500);
    },
    saveEduDetails: function(e){
      e.preventDefault();
      var aid = this.model.get("adminID");
    
      if(permission.edit != "yes"){
        alert("You dont have permission to edit");
        return false;
      }
      if(aid == "" || aid == null){
        var methodt = "PUT";
      }else{
        var methodt = "POST";
      }
      if($("#adminDetails").valid()){
        var selfobj = this;
        $(e.currentTarget).html("<span>Saving..</span>");
        $(e.currentTarget).attr("disabled", "disabled");
        this.model.save({},{headers:{
          'Content-Type':'application/x-www-form-urlencoded','SadminID':$.cookie('authid'),'token':$.cookie('_bb_key'),'Accept':'application/json'
        },error: selfobj.onErrorHandler,type:methodt}).done(function(res){
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
      }
    },
    initializeValidate:function(){
      var selfobj = this;
        $("#adminDetails").validate({
        rules: {
          name:{
             required: true,
          },
          userName:{
             required: true,
          },
          email:{
             required: true,
             email: true,
          },
          password:{
             required: true,
          },
           roleID:{
             required: true,
          }
        },
        messages: {
          name: "Please enter Name",
          userName: "Please enter Username",
          email: "Please enter Valid Email-ID ",
          password: "Please enter Password",
          roleID: "Please select User Role"
        }
      });
    },
    render: function(){
        var source = addAdminTemp;
        var template = _.template(source);
        this.$el.html(template({"model":this.model.attributes,"userRoleList":this.userRoleList.models}));
        $("#modalBody").append(this.$el);
        $(".modal-title").html("Admin Details");

        $('#adminData').show();
        $('#roleID').select2({width:'100%'});
        this.initializeValidate();
        this.setValues();

        return this;
    },onDelete: function(){
        this.remove();
    }
});

  return addAdminView;
  
});
