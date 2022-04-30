define([
  'jquery',
  'underscore',
  'backbone',
  'jqueryUI',
  'validate',
  'inputmask',
  'datepicker',
  'minicolors',
  'Quill',
  'templateEditor',
  '../models/blogsSingleModel',
  '../../categoryMaster/collections/categoryMasterCollection',
  'text!../templates/blogsSingleTemp.html',
], function($,_, Backbone,jqueryUI,validate,inputmask,datepicker,minicolors,Quill,templateEditor,blogsSingleModel,categoryMasterCollection,blogsTemp){

var blogsView = Backbone.View.extend({
    
    initialize: function(options){
      // alert("hello")
        var selfobj = this;
        $(".profile-loader").show();
        var mname = Backbone.history.getFragment();
        // permission = ROLE[mname];
        var blogID=options.action;
        console.log("blog id");
        console.log(blogID);
        readyState = true;
        this.model = new blogsSingleModel();
        this.categoryMaster = new categoryMasterCollection();
         this.categoryMaster.fetch({headers: {
          'contentType':'application/x-www-form-urlencoded','SadminID':$.cookie('authid'),'token':$.cookie('_bb_key'),'Accept':'application/json'
        },error: selfobj.onErrorHandler,data:{status:'active',getAll:'Y'}}).done(function(res){
          if(res.statusCode == 994){app_router.navigate("logout",{trigger:true});}
          $(".popupLoader").hide();
          
          selfobj.render();
        });
        // alert(blogID);
        if(blogID){
          this.model.set({blogID:blogID});
          console.log(this.model);
          this.model.fetch({headers: {'contentType':'application/x-www-form-urlencoded','SadminID':$.cookie('authid'),'token':$.cookie('_bb_key'),'Accept':'application/json'
          },error: selfobj.onErrorHandler}).done(function(res){
            if(res.statusCode == 994){app_router.navigate("logout",{trigger:true});}
            $(".popupLoader").hide();
            var category=selfobj.model.get("category");
            var arrayCategory=category.split(",");
            selfobj.model.set({arrayCategory:arrayCategory});
            // console.log(arrayCategory)
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
      "click #saveuserRoleDetails":"saveuserRoleDetails",
      "click .item-container li":"setValues",
      "blur .txtchange":"updateOtherDetails",
      "change .multiSel":"setValues",
      "change .bDate":"updateOtherDetails",
      "change .dropval":"updateOtherDetails",
      "click .multiselect": "getMulipleSelectedValue",
      "change .fileAdded": "updateImage",
      "keyup .titleChange": "updateURL",
    },
    onErrorHandler: function(collection, response, options){
        alert("Something was wrong ! Try to refresh the page or contact administer. :(");
        $(".profile-loader").hide();
    },
    updateURL: function(e){
      var url = $(e.currentTarget).val().trim().replace(/[^A-Z0-9]+/ig, "_");
      $("#blogLink").val(url);
      this.model.set({"blogLink":url});
    },
    updateOtherDetails: function(e){

      var valuetxt = $(e.currentTarget).val();
      var toID = $(e.currentTarget).attr("id");
      var newdetails=[];
      newdetails[""+toID]= valuetxt;
      this.model.set(newdetails);
    },
    updateImage: function(e){
      var ob = this;
      var toID = $(e.currentTarget).attr("id");
      var newdetails=[];

      // var image = $(e.currentTarget).attr('src');
      // console.log(image);
      // return;
      // var base64ImageContent = image.replace(/^data:image\/(png|jpg);base64,/, "");
      // var blob = this.base64ToBlob(base64ImageContent, 'image/png');                
      // var toID = $(e.currentTarget).attr("id");
      // var newdetails=[];
      // newdetails[""+toID]= blob;
      // this.model.set(newdetails);
      var reader = new FileReader();
      // console.log(reader)
      reader.onload = function (e) {
          // get loaded data and render thumbnail.
          document.getElementById("output").src = e.target.result;
          // $("#output").show();
          // $(".deleteQuestionImage").css("display", "inline-flex");
          newdetails[""+toID]= reader.result;
          ob.model.set(newdetails);
      };

      
      // read the image file as a data URL.
      reader.readAsDataURL(e.currentTarget.files[0]);
      
      // console.log(toID);
      // console.log(reader.result);
      
      // console.log(this.model);
      //var image = $('#output');
      //image.src = URL.createObjectURL(e.currentTarget.files[0]);

    },
    setValues:function(e){
        setvalues = ["category"];
        var selfobj = this;

        $.each(setvalues,function(key,value){
          var modval = selfobj.model.get(value);
         // console.log(modval);
          if(modval != null){
            var modeVal = modval.split(",");
          }else{ var modeVal = {};}

          $(".category").each(function(){
            var currentval = $(this).attr("data-value");
            // console.log(currentval)
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
      // var termstxt = CKEDITOR.instances.description.getData();
      // this.model.set({'description':termstxt})
      var blogID = this.model.get("blogID");
    // if(permission.edit != "yes"){
    //     alert("You dont have permission to edit");
    //     return false;
    //   }
    console.log(this.model)
      if(blogID == "" || blogID == null){
        var methodt = "PUT";
      }else{
        var methodt = "POST";
      }
      // console.log(methodt);
      if($("#blogDetails").valid()){
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
            alert("blog saved");
            $(e.currentTarget).html("<span>Saved</span>");
            selfobj.model.clear();
            app_router.navigate("blogs",{trigger:true});
             //scanDetails.filterSearch();
          }
          
          setTimeout(function(){
            $(e.currentTarget).html("<span>Save</span>");
            $(e.currentTarget).removeAttr("disabled");
            }, 3000);
          
        });
      }
    },
    getHTML:function(){

        $(".emailTemplateDump").html($(".playgrounddiv").html());
        $(".emailTemplateDump").find(".rowHeaders").remove();
        $(".ws-element-wrapper").addClass(".row");
        

    },
    initializeValidate:function(){
      var selfobj = this;
        $("#blogDetails").validate({
        rules: {
          blogTitle:{
             required: true,
          },
          blogLink:{
             required: true,
          },
          metaKeywords:{
             required: true,
          },
          metaDesc:{
             required: true,
          },
          category:{
             required: true,
          },
          blogTemplate:{
             required: true,
          },
        },
        messages: {
          blogTitle: "Please enter blog Title",
          blogLink: "Please enter blog Link",
          metaKeywords: "Please enter Meta Keywords",
          metaDesc: "Please enter Meta Description",
          category: "Please Select Category",
          blogTemplate: "Please Select Template",
        },
      });
    },
    render: function(){
      var selfobj = this;
         var source = blogsTemp;
        var template = _.template(source);
        this.$el.html(template({model:this.model.attributes,category:this.categoryMaster.models}));
        // $(".playgrounddiv").html(this.model.attributes.pageCode);
        $(".main_container").append(this.$el);
        setTimeout(function(){
        var tt = $(".emailTemplate");
          if(tt.hasClass("email_temp_int")){
            console.log("has calls");
          }else{
            tt.addClass("email_temp_int");
            tt.templateDesign({
                playground:$(".playgrounddiv"),
                playgroundElements:$(".playgroundelements"),
                nextbtn:$("#nextbtn"),
                savebtn:$(".getHTML"), 
                temptemplate:$(".emailTemplateDump"),
                version:"block",
                HTMLUpdate : function(data){
                  //alert("sdfsdf");
                  var codeD =[];
                  codeD["pageCode"]= $(".playgrounddiv").html();
                  codeD["pageContent"]= $(".emailTemplateDump").html();
                  codeD["pageCss"]= data.css;
                  // console.log(codeD);
                  selfobj.model.set(codeD);
                  selfobj.saveuserRoleDetails(data.els);
                 },
              });
          }
        },2000);
        this.initializeValidate();
        return this;
          
          
    }
});

  return blogsView;
  
});
