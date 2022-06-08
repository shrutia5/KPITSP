define([
  'jquery',
  'underscore',
  'backbone',
  'validate',
  'inputmask',
  'datepicker',
  '../models/cityMasterSingleModel',
  '../../stateMaster/collections/stateMasterCollection',
  'text!../templates/cityMasterSingleTemp.html',
], function($,_, Backbone,validate,inputmask,datepicker,cityMasterSingleModel,stateMasterCollection,cityMasterTemp){


  
var cityMasterView = Backbone.View.extend({
    model:cityMasterSingleModel,
    initialize: function(options){
         var selfobj = this;
        $(".modelbox").hide();
         scanDetails = options.searchcityMaster;
         $('#cityData').remove();
        $(".popupLoader").show();
        
        var selfobj = this;
        //$(".profile-loader").show();
        var mname = Backbone.history.getFragment();
        // permission = ROLE[mname];
        var cityID=options.action;
        console.log("city id");
        console.log(cityID);
        readyState = true;
        this.model = new cityMasterSingleModel();
        this.stateMaster = new stateMasterCollection();
         this.stateMaster.fetch({headers: {
          'contentType':'application/x-www-form-urlencoded','SadminID':$.cookie('authid'),'token':$.cookie('_bb_key'),'Accept':'application/json'
        },error: selfobj.onErrorHandler,data:{status:'active',getAll:'Y'}}).done(function(res){
          if(res.statusCode == 994){app_router.navigate("logout",{trigger:true});}
          $(".popupLoader").hide();
          //console.log("welcome");
          //console.log(res);
          selfobj.render();
        });
        if(cityID){
          this.model.set({cityID:cityID});
          console.log(this.model);
          this.model.fetch({headers: {'contentType':'application/x-www-form-urlencoded','SadminID':$.cookie('authid'),'token':$.cookie('_bb_key'),'Accept':'application/json'
          },error: selfobj.onErrorHandler}).done(function(res){
            if(res.statusCode == 994){app_router.navigate("logout",{trigger:true});}
            $(".popupLoader").hide();
            var state=selfobj.model.get("state");
            var arrayState=state.split(",");
            selfobj.model.set({arrayState:arrayState});
            console.log("state list");
             console.log(arrayState);
              selfobj.render();
            selfobj.setValues();
          });
        }else
        {
           selfobj.render();
           $(".popupLoader").hide();
        }
        this.render();
     

      
    },
    events:
    {
      "click #savecityDetails":"savecityDetails",
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
        setvalues = ["status","isParent"];
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
    savecityDetails: function(e){
      e.preventDefault();
      var cityID = this.model.get("cityID");
    if(permission.edit != "yes"){
        alert("You dont have permission to edit");
        return false;
      }
      if(cityID == "" || cityID == null){
        var methodt = "PUT";
      }else{
        var methodt = "POST";
      }
      if($("#cityDetails").valid()){
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
        $("#cityDetails").validate({
        rules: {
          cityName:{
             required: true,
          }
        },
        messages: {
          cityName: "Please enter city name."
        }
      });
    },
    render: function(){
        var source = cityMasterTemp;
        var template = _.template(source);
        console.log(this.model.attributes);
        this.$el.html(template({cityData:this.model.attributes,stateList:this.stateMaster.models}));
        $("#modalBody").append(this.$el);
        
        var profile = this.model.get("userName");
        $(".modal-title").html("city Details");
        $('#cityData').show();
        this.initializeValidate();
        this.setValues();
       
        return this;
    },onDelete: function(){
        this.remove();
    }
});

  return cityMasterView;
    
});
