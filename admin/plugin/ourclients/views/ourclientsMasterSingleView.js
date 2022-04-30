define([
  'jquery',
  'underscore',
  'backbone',
  'validate',
  'inputmask',
  'datepicker',
  '../models/ourclientsMasterSingleModel',
  '../../categoryMaster/collections/categoryMasterCollection',
  'text!../templates/ourclientsMasterSingleTemp.html',
], function($,_, Backbone,validate,inputmask,datepicker,ourclientsMasterSingleModel,categoryMasterCollection,ourclientsMasterSingleTemp){

var ourclientsMasterView = Backbone.View.extend({
    model:ourclientsMasterSingleModel,
    initialize: function(options){
        var selfobj = this;
        $(".modelbox").hide();
        scanDetails = options.searchclientsMaster;
        $('#pageMaster').remove();
        $(".popupLoader").show();
      
        this.model = new ourclientsMasterSingleModel();
        
        var categoryList = new categoryMasterCollection();
        categoryList.fetch({headers: {
          'contentType':'application/x-www-form-urlencoded','SadminID':$.cookie('authid'),'token':$.cookie('_bb_key'),'Accept':'application/json'
        },error: selfobj.onErrorHandler,type:'post',data:filterOption.attributes}).done(function(res){
          selfobj.model.set("categoryList",res.data);
          selfobj.render();
        });

        if(options.clientsID != ""){
          this.model.set({clientsID:options.clientsID});
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
           this.render();
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
      "change .fileAdded": "updateImage",
    },
    updateImage: function(e){
      var ob = this;
      var toID = $(e.currentTarget).attr("id");
      var newdetails=[];
      var reader = new FileReader();
      reader.onload = function (e) {
          document.getElementById("output").src = e.target.result;
          newdetails[""+toID]= reader.result;
          ob.model.set(newdetails);
      };
      // read the image file as a data URL.
      reader.readAsDataURL(e.currentTarget.files[0]);
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
    saveuserRoleDetails: function(e){
      e.preventDefault();
      var clientsID = this.model.get("clientsID");
    if(permission.edit != "yes"){
        alert("You dont have permission to edit");
        return false;
      }
      if(clientsID == "" || clientsID == null){
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
            $("#clientImageUP").val("");
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
        $("#userRoleDetails").validate({
        rules: {
          clientsname:{
             required: true,
          }
        },
        messages: {
          roleName: "Please enter client Name"
        }
      });
    },
    render: function(){
      console.log(this.model);
        var source = ourclientsMasterSingleTemp;
        var template = _.template(source);
        this.$el.html(template(this.model.attributes));
        $("#modalBody").append(this.$el);
        
        $(".modal-title").html("Client Details");
        $('#pageMaster').show();
        this.initializeValidate();
        this.setValues();
       
        return this;
    },onDelete: function(){
        this.remove();
    }
});

  return ourclientsMasterView;
    
});
