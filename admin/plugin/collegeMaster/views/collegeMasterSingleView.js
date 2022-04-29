define([
  'jquery',
  'underscore',
  'backbone',
  'validate',
  'inputmask',
  'datepicker',
  '../models/collegeMasterSingleModel',
  '../../stateMaster/collections/stateMasterCollection',
  '../../cityMaster/collections/cityMasterCollection',
  'text!../templates/collegeMasterSingleTemp.html',
], function($,_, Backbone,validate,inputmask,datepicker,collegeMasterSingleModel,stateMasterCollection,cityMasterCollection,collegeMasterTemp){


  
var collegeMasterView = Backbone.View.extend({
    model:collegeMasterSingleModel,
    initialize: function(options){
         var selfobj = this;
        $(".modelbox").hide();
         scanDetails = options.searchcollegeMaster;
         $('#collegeData').remove();
        $(".popupLoader").show();
        
        var selfobj = this;
        //$(".profile-loader").show();
        var mname = Backbone.history.getFragment();
        // permission = ROLE[mname];
        var collegeID=options.action;
        console.log("college id");
        console.log(collegeID);
        readyState = true;
        this.model = new collegeMasterSingleModel();
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
        this.cityMaster = new cityMasterCollection();
        this.cityMaster.fetch({headers: {
          'contentType':'application/x-www-form-urlencoded','SadminID':$.cookie('authid'),'token':$.cookie('_bb_key'),'Accept':'application/json'
        },error: selfobj.onErrorHandler,data:{status:'active',getAll:'Y'}}).done(function(res){
          if(res.statusCode == 994){app_router.navigate("logout",{trigger:true});}
          $(".popupLoader").hide();
          //console.log("welcome");
          //console.log(res);
          selfobj.render();
        });
        if(collegeID){
          this.model.set({collegeID:collegeID});
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
      "click #savecollegeDetails":"savecollegeDetails",
      "click .item-container li":"setValues",
      "blur .txtchange":"updateOtherDetails",
      "change .multiSel":"setValues",
      "change .bDate":"updateOtherDetails",
      "change .dropval":"updateOtherDetails",
      "change .changeCity":"getCityList",
    },
    onErrorHandler: function(collection, response, options){
        alert("Something was wrong ! Try to refresh the page or contact administer. :(");
        $(".profile-loader").hide();
    },
    getCityList: function(e){
      var selfobj = this;
      this.cityMaster.fetch({headers: {
        'contentType':'application/x-www-form-urlencoded','SadminID':$.cookie('authid'),'token':$.cookie('_bb_key'),'Accept':'application/json'
      },error: selfobj.onErrorHandler,data:{stateid:$(e.currentTarget).val(),status:'active',getAll:'Y'}}).done(function(res){
        if(res.statusCode == 994){app_router.navigate("logout",{trigger:true});}
        $(".popupLoader").hide();
        selfobj.render();
      });
      console.log(this.cityMaster);
    },
    updateOtherDetails: function(e){
      //alert("here");
      var valuetxt = $(e.currentTarget).val();
      //alert(valuetxt);
      var toID = $(e.currentTarget).attr("id");
      //alert(toID);
      var newdetails=[];
      newdetails[""+toID] = valuetxt;
      console.log(newdetails);
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
    savecollegeDetails: function(e){
      e.preventDefault();
      var collegeID = this.model.get("collegeID");
    if(permission.edit != "yes"){
        alert("You dont have permission to edit");
        return false;
      }
      if(collegeID == "" || collegeID == null){
        var methodt = "PUT";
      }else{
        var methodt = "POST";
      }
      if($("#collegeDetails").valid()){
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
        $("#collegeDetails").validate({
        rules: {
          collegeName:{
             required: true,
          }
        },
        messages: {
          collegeName: "Please enter college name."
        }
      });
    },
    render: function(){
      //alert("here");
        var source = collegeMasterTemp;
        var template = _.template(source);
        console.log(this.model.attributes);
        this.$el.html(template({collegeData:this.model.attributes,stateList:this.stateMaster.models,cityList:this.cityMaster.models}));
        $("#modalBody").append(this.$el);
        
        var profile = this.model.get("userName");
        $(".modal-title").html("college Details");
        $('#collegeData').show();
        this.initializeValidate();
        this.setValues();
       alert("ssdsd");
        return this;
    },onDelete: function(){
        this.remove();
    }
});

  return collegeMasterView;
    
});
