define([
  'jquery',
  'underscore',
  'backbone',
  'validate',
  'inputmask',
  'datepicker',
  '../models/emailMasterSingleModel',
  'text!../templates/emailMasterSingleTemp.html',
], function($,_, Backbone,validate,inputmask,datepicker,emailMasterSingleModel,emailMasterTemp){

var emailMasterView = Backbone.View.extend({
    model:emailMasterSingleModel,
    initialize: function(options){
        var selfobj = this;
        $(".modelbox").hide();
        scanDetails = options.searchemailMaster;
        $('#userRoleData').remove();
        $(".popupLoader").show();
      
        this.model = new emailMasterSingleModel();
        if(options.tempID != ""){
          this.model.set({tempID:options.tempID});
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
      "click #saveuserRoleDetails":"saveuserRoleDetails",
      "click .item-container li":"setValues",
      "blur .txtchange":"updateOtherDetails",
      "change .multiSel":"setValues",
      "change .bDate":"updateOtherDetails",
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

      console.log(this.model)
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
    saveuserRoleDetails: function(e){
      e.preventDefault();
      var termstxt = CKEDITOR.instances.emailContent.getData();
      this.model.set({'emailContent':termstxt})
      var tempID = this.model.get("tempID");
    if(permission.edit != "yes"){
        alert("You dont have permission to edit");
        return false;
      }
        

      if(tempID == "" || tempID == null){
        var methodt = "PUT";
      }else{
        var methodt = "POST";
      }
      if($("#userRoleDetails").valid()){
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
            console.log(scanDetails.filterOption)
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
        $("#userRoleDetails").validate({
        rules: {
          roleName:{
             required: true,
          }
        },
        messages: {
          roleName: "Please enter User Role Name"
        }
      });
    },
    render: function(){
        var source = emailMasterTemp;
        var template = _.template(source);
        this.$el.html(template(this.model.attributes));
        $("#modalBody").append(this.$el);
        
        var profile = this.model.get("userName");
        $(".modal-title").html("Email Master");
        $('#userRoleData').show();
        this.initializeValidate();
        this.setValues();
        CKEDITOR.replace('emailContent',{
          language: 'en',
        });
        return this;
    },onDelete: function(){
        this.remove();
    }
});

  return emailMasterView;
    
});
