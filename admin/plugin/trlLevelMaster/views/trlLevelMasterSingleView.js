define([
  'jquery',
  'underscore',
  'backbone',
  'validate',
  'inputmask',
  'datepicker',
  '../models/trlLevelMasterSingleModel',
  'text!../templates/trlLevelMasterSingleTemp.html',
], function($,_, Backbone,validate,inputmask,datepicker,trlLevelMasterSingleModel,trlLevelMasterTemp){

var trlLevelMasterView = Backbone.View.extend({
    model:trlLevelMasterSingleModel,
    initialize: function(options){
        var selfobj = this;
        $(".modelbox").hide();
        scanDetails = options.searchtrlLevelMaster;
        $('#faqData').remove();
        $(".popupLoader").show();
      
        this.model = new trlLevelMasterSingleModel();
        if(options.id != ""){
          this.model.set({id:options.id});
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
      "click #saveFaqDetails":"saveFaqDetails",
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
    saveFaqDetails: function(e){
      e.preventDefault();
      var id = this.model.get("id");
       var termstxt = CKEDITOR.instances.trl_description.getData();
      this.model.set({'trl_description':termstxt})
    if(permission.edit != "yes"){
        alert("You dont have permission to edit");
        return false;
      }
      if(id == "" || id == null){
        var methodt = "PUT";
      }else{
        var methodt = "POST";
      }
      if($("#FaqDetails").valid()){
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
        $("#FaqDetails").validate({
        rules: {
          faqQuestion:{
             required: true,
          },
          faqAnswer:{
             required: true,
          },
          status:{
             required: true,
          },
        },
        messages: {
          faqQuestion: "Please enter Question",
          faqAnswer: "Please enter Answer",
          status: "Please Select Status",
        }
      });
    },
    render: function(){
        var source = trlLevelMasterTemp;
        var template = _.template(source);
        this.$el.html(template(this.model.attributes));
        $("#modalBody").append(this.$el);
        
        var profile = this.model.get("userName");
        $(".modal-title").html("TRL Master");
        $('#userRoleData').show();
        this.initializeValidate();
        this.setValues();
        CKEDITOR.replace('trl_description',{
          language: 'en',
        }); 
        return this;
    },onDelete: function(){
        this.remove();
    }
});

  return trlLevelMasterView;
    
});
