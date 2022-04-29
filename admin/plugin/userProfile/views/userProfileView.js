define([
  'jquery',
  'underscore',
  'backbone',
  'validate',
  'inputmask',
  'datepicker',
  '../models/userProfileModel',
  'text!../templates/userProfileTemp.html',
], function($,_, Backbone,validate,inputmask,datepicker,userProfileModel,userProfileTemp){

var infoSingleView = Backbone.View.extend({
    model:userProfileModel,
    initialize: function(options){
        var selfobj = this;
        $(".modelbox").hide();
        $('#infoDetails').remove();
        $(".popupLoader").show();
        this.model = new userProfileModel();

        this.model.set({adminID:$.cookie('authid')})
        console.log(this.model)
         this.model.fetch({headers: {
            'contentType':'application/x-www-form-urlencoded','SadminID':$.cookie('authid'),'token':$.cookie('_bb_key'),'Accept':'application/json'
          },error: selfobj.onErrorHandler}).done(function(res){
            if(res.statusCode == 994){app_router.navigate("logout",{trigger:true});}
            $(".popupLoader").hide();
            selfobj.render();
           
          });
        
    },
    events:
    {
      "click #saveUserDetails":"saveUserDetails",
      "click .item-container li":"setValues",
      "blur .txtchange":"updateOtherDetails",
      "change .multiSel":"setValues",
      "change .bDate":"updateOtherDetails",
      "change .dropval":"updateOtherDetails",
      "click  .chageIcon":"chageIcon",
    },
    onErrorHandler: function(collection, response, options){
        alert("Something was wrong ! Try to refresh the page or contact administer. :(");
        $(".profile-loader").hide();
    },
    chageIcon:function(e)
    {
      // alert("hii");
      var currentval = $("#password").attr("type");
      if(currentval=="password")
      {
        this.model.set({eyeIcon:"fa fa-eye",inputType:"text"})
      }
      if(currentval=="text")
      {
        this.model.set({eyeIcon:"fa fa-eye-slash",inputType:"password"})
      }
      this.render();

    },
    updateOtherDetails: function(e){

      var valuetxt = $(e.currentTarget).val();
      var toID = $(e.currentTarget).attr("id");
      var newdetails=[];
      newdetails[""+toID]= valuetxt;
      this.model.set(newdetails);
      console.log(this.model);
    },
    setValues:function(e){
        setvalues = ["adminID"];
        var selfobj = this;
        $.each(setvalues,function(key,value){
          var modval = selfobj.model.get(value);
          if(modval != null){
            console.log(setvalues);

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
          console.log(classname[0]);
          console.log(selfobj.model);
        }
      }, 500);
    },
    
    saveUserDetails: function(e){
      e.preventDefault();
      var bid = this.model.get("adminID");
      // console.log(bid)
      if(bid != "0" || bid == ""){
        var methodt = "POST";
      }else{
        var methodt = "PUT";
      }
      
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
            //scanDetails.filterSearch();
          }
          
          setTimeout(function(){
            $(e.currentTarget).html("<span>Save</span>");
             $(e.currentTarget).removeAttr("disabled");
            }, 3000);
          
        });
    
    },
   
    render: function(){
        var source = userProfileTemp;
        var template = _.template(source);
        console.log(this.model.attributes);
        this.$el.html(template(this.model.attributes));
        $(".main_container").append(this.$el);
        this.setValues();
       
        
        return this;
    },
});

  return infoSingleView;
  
});
