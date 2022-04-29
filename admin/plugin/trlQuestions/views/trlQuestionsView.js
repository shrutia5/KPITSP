
define([
  'jquery',
  'underscore',
  'backbone',
  'datepicker',
  '../views/trlQuestionsSingleView',
  '../collections/trlQuestionsCollection',
  '../../trlLevelMaster/collections/trlLevelMasterCollection',
  '../models/trlQuestionsFilterOptionModel',
  '../models/trlQuestionsSingleModel',
  'text!../templates/trlQuestionsRow.html',
  'text!../templates/trlQuestionsTemp.html',
  'text!../templates/trlQuestionsFilterOptionTemp.html',
], function($,_, Backbone,datepicker,trlQuestionsSingleView,trlQuestionsCollection,trlLevelMasterCollection,trlQuestionsFilterOptionModel,trlQuestionsSingleModel,trlQuestionsRowTemp,trlQuestionsTemp,trlQuestionsFilterTemp){

var trlQuestionsView = Backbone.View.extend({
    
    initialize: function(options){
        var selfobj = this;
        $(".profile-loader").show();
        var mname = Backbone.history.getFragment();
        permission = ROLE[mname];
        readyState = true;
        // this.render();
        filterOption = new trlQuestionsFilterOptionModel();
        this.trlLevelList = new trlLevelMasterCollection();
        this.questionList = new trlQuestionsCollection();
        this.model = new trlQuestionsSingleModel();
        this.trlLevelList.fetch({headers: {
          'contentType':'application/x-www-form-urlencoded','SadminID':$.cookie('authid'),'token':$.cookie('_bb_key'),'Accept':'application/json'
        },error: selfobj.onErrorHandler,type:'post'}).done(function(res){
          if(res.statusCode == 994){app_router.navigate("logout",{trigger:true});}
          $(".profile-loader").hide();
          selfobj.render();
        });
        this.render();
        // searchtrlQuestions.fetch({headers: {
        //   'contentType':'application/x-www-form-urlencoded','SadminID':$.cookie('authid'),'token':$.cookie('_bb_key'),'Accept':'application/json'
        // },error: selfobj.onErrorHandler,type:'post',data:filterOption.attributes}).done(function(res){
          
        //   if(res.statusCode == 994){app_router.navigate("logout",{trigger:true});}
        //   $(".profile-loader").hide();
        // setPagging(res.paginginfo,res.loadstate,res.msg);   
        // });

        // this.collection = searchtrlQuestions;
        // this.collection.on('add',this.addOne,this);
        // this.collection.on('reset',this.addAll,this);
    },
    events:
    {
      "blur #textval":"setFreeText",
      "change .range":"setRange",
      "change #textSearch":"settextSearch",
      "click .multiOptionSel":"multioption",
      "click #filterSearch": "filterSearch",
      "click #filterOption": "filterRender",
      "click .resetval":"resetSearch",
      "click .loadview":"loadSubView",
      "blur .txtchange":"updateOtherDetails",
      "change .dropval":"updateOtherDetails",
      "click .changeStatus": "changeStatusListElement",
      "click .showpage": "loadData",
      "change .cnganstype": "chnageAnswerType",
      "click .addoption": "addoption",
      "click .optionEditDelete": "optionEditDelete",
      "click .saveQuestion": "saveQuestion",
      "change .getqList": "getqList",
      "click .editQuestion": "editQuestion",
      "click .deleteQuestion": "deleteQuestion",
      
    },
    getqList:function(e)
    {
      var selfobj = this;
      var valuetxt = $(e.currentTarget).val();
      // alert(valuetxt);
      this.questionList.fetch({headers: {
          'contentType':'application/x-www-form-urlencoded','SadminID':$.cookie('authid'),'token':$.cookie('_bb_key'),'Accept':'application/json'
        },error: selfobj.onErrorHandler,type:'post',data:{trlID:valuetxt}}).done(function(res){
          if(res.statusCode == 994){app_router.navigate("logout",{trigger:true});}
          selfobj.render();
        }); 
    },
    editQuestion:function(e){
      
      var selfobj = this;
      var valuetxt = $(e.currentTarget).attr("data-trlquestionid");
      this.model.set({trlQuestionID:valuetxt});
      this.model.fetch({headers: {
        'contentType':'application/x-www-form-urlencoded','SadminID':$.cookie('authid'),'token':$.cookie('_bb_key'),'Accept':'application/json'
      },error: selfobj.onErrorHandler}).done(function(res){
        if(res.statusCode == 994){app_router.navigate("logout",{trigger:true});}
        //$(".popupLoader").hide();
        console.log("updated Data");
        console.log(selfobj.model);
        console.log(selfobj.model.attributes);

        selfobj.render();
        
      });
      //console.log(this.model);
    },
    deleteQuestion:function(e){
      var selfobj = this;
      var del = $(e.currentTarget).attr("data-trlQuestionID");
      $.ajax({
        url:APIPATH+'deleteTRLQuestion',
        method:'POST',
        data:{del:del},
        datatype:'JSON',
         beforeSend: function(request) {
          $(e.currentTarget).html("<span>Updating..</span>");
          request.setRequestHeader("token",$.cookie('_bb_key'));
          request.setRequestHeader("SadminID",$.cookie('authid'));
          request.setRequestHeader("contentType",'application/x-www-form-urlencoded');
          request.setRequestHeader("Accept",'application/json');
        },
        success:function(res){
          if(res.flag == "F")
            alert(res.msg);

          if(res.statusCode == 994){app_router.navigate("logout",{trigger:true});}
          if(res.flag == "S"){
            var valuetxt = $("#trlLevelID").val();
            selfobj.questionList.fetch({headers: {
              'contentType':'application/x-www-form-urlencoded','SadminID':$.cookie('authid'),'token':$.cookie('_bb_key'),'Accept':'application/json'
            },error: selfobj.onErrorHandler,type:'post',data:{trlID:valuetxt}}).done(function(res){
              if(res.statusCode == 994){app_router.navigate("logout",{trigger:true});}
              selfobj.render();
            }); 
          }
          setTimeout(function(){
              //$(e.currentTarget).html(status);
          }, 3000);
          
        }
      });

    },
    saveQuestion:function(e)
    {
      var count=1;
      var  optionArr=[];
      var optionName=$("#ansType").val();
      if($('.getrows').length!=0&&optionName=="option")
      {
        $(".getrows").each(function() {
          optionArr.push({
             optionName:$("#optionName_"+count).val(),
             optGuide:$("#optionGuide_"+count).val(),
             weightage:$("#optionWeightage_"+count).val(),
             sequence:$("#optionSequence_"+count).val(),
             isCorrect:$("#optionIsCorrect_"+count).val(),
          })
          count++;
        })
        this.model.set({qoptions:optionArr})
      }
      var questionID= $(e.currentTarget).attr("data-questionID");
      
      if(questionID == "" || questionID == null){
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
          
        }
        
        setTimeout(function(){
          $(e.currentTarget).html("<span>Save</span>");
          $(e.currentTarget).removeAttr("disabled");
          }, 3000);
        
      });
    },
    optionEditDelete:function(e)
    {
      var action = $(e.currentTarget).attr("data-action");
      var optionID = $(e.currentTarget).attr("data-optionID");
     
      if(action=="delete")
      {
        $('#'+optionID).remove();
      }
      if(action=="edit")
      {
        var btnid = $(e.currentTarget).attr("id");
        var editSave = $(e.currentTarget).attr("data-editSave");
        var lastidArr = btnid.split("_");
        var lnum=lastidArr[1];
        if(editSave=="editOption")
        {
          $('#option_'+lnum+' .showEdit').show();
          $('#option_'+lnum+' .optionP').hide();
          $('#'+btnid).html("Save");
          $("#"+btnid).attr("data-editsave", 'saveOption');
        }
        
        if(editSave=="saveOption")
        {
          var optionName = $("#optionName_"+lnum).val();
          var optGuide = $("#optionGuide_"+lnum).val();
          var weightage = $("#optionWeightage_"+lnum).val();
          var sequence = $("#optionSequence_"+lnum).val();
          var isCorrect = $("#optionIsCorrect_"+lnum).val();

          $("#optionNameP_"+lnum).html(optionName);
          $("#optionGuideP_"+lnum).html(optGuide);
          $("#optionWeightageP_"+lnum).html(weightage);
          $("#optionSequenceP_"+lnum).html(sequence);
          $("#optionIsCorrectP_"+lnum).html(isCorrect);
          $('#option_'+lnum+' .showEdit').hide();
          $('#option_'+lnum+' .optionP').show();
          $('#'+btnid).html("Edit");
          $("#"+btnid).attr("data-editsave", 'editOption');
        }
      }

    },
    addoption:function(e){
      var optionName = $("#optionName").val();
      var optGuide = $("#optGuide").val();
      var weightage = $("#weightage").val();
      var sequence = $("#sequence").val();
      var isCorrect = $("#isCorrect").val();
      // if(optionName==""){ alert("Option Name Required."); return;}
      // if(weightage==""){ alert("Option weightage Required."); return;}
      // if(sequence==""){ alert("Option sequence Required."); return;}
      // if(isCorrect==""){ alert("Please Select is Correct."); return;}
      var lastid = $(".optionrow:last").attr("id");
      var lastoptid=0;
      // alert(lastid)
      if(lastid=="mainRow")
      {
        lastoptid=1;
      }else
      {
        var lastidArr = lastid.split("_");
        // console.log(lastidArr);
        var lnum=lastidArr[1];
        lastoptid=++lnum;
        // alert("last number"+lastoptid);
      }
      // alert(lastoptid);
      var addoptionhtml="";
      var isCorrectSelectHtml="";
      var selYes=selNo="false"
      if(isCorrect=="Yes")
      {
        selYes="true";
      }else
      {
        selNo="true";
      }
      isCorrectSelectHtml+="<select style='display:none;' id='optionIsCorrect_"+lastoptid+"' class='form-control showEdit'><option selected='"+selYes+"' value='Yes'>Yes</option ><option selected='"+selNo+"' value='No'>No</option></select>";
      addoptionhtml+="<div class='row getrows optionrow' id='option_"+lastoptid+"'><div class='col-md-4'><input type='text' style='display:none;' class='form-control showEdit' id='optionName_"+lastoptid+"' value='"+optionName+"'><p class='optionP' id='optionNameP_"+lastoptid+"'>"+optionName+"</p></div><div class='col-md-3'><input type='text' style='display:none;' class='form-control showEdit' id='optionGuide_"+lastoptid+"' value='"+optGuide+"'><p class='optionP' id='optionGuideP_"+lastoptid+"'> "+optGuide+"</p></div><div class='col-md-1'><input type='text' style='display:none;' class='form-control showEdit' id='optionWeightage_"+lastoptid+"' value='"+weightage+"'><p class='optionP' id='optionWeightageP_"+lastoptid+"'>"+weightage+"</p></div><div class='col-md-1'><input type='text' style='display:none;' class='form-control showEdit' id='optionSequence_"+lastoptid+"' value='"+sequence+"'><p class='optionP' id='optionSequenceP_"+lastoptid+"'>"+sequence+"</p></div><div class='col-md-1'>"+isCorrectSelectHtml+"<p class='optionP' id='optionIsCorrectP_"+lastoptid+"'>"+isCorrect+"</p></div><div class='col-md-2'><button data-action='edit' data-editSave='editOption' id='optionBtnEdit_"+lastoptid+"' data-optionID='option_"+lastoptid+"' class='btn btn-primary btn-xs optionEditDelete'>Edit</button><button data-optionID='option_"+lastoptid+"' data-action='delete' class='optionEditDelete btn btn-primary btn-xs'>Delete</button></div></div>";
      $(".optionRow").append(addoptionhtml);
      // alert(addoptionhtml)
    },
    chnageAnswerType:function(e){
      var ansType = $(e.currentTarget).val();  
      // alert(ansType);
        if(ansType=="option")
        {
          $('.optClass').show();
          $('.ansGuideclass').show();
          $('.optOtherClass').hide();
        }
        if(ansType=="file")
        {
          $('.optClass').hide();
          $('.optOtherClass').show();
          $('.ansGuideclass').show(); 
        }
        if(ansType=="text")
        {
          $('.optClass').hide();
          $('.optOtherClass').hide();
          $('.ansGuideclass').show(); 
        }
        if(ansType=="")
        {
          $('.optClass').hide();
          $('.ansGuideclass').hide(); 
          $('.optOtherClass').hide();
        }
    },  
    updateOtherDetails: function(e){

      var valuetxt = $(e.currentTarget).val();
      var toID = $(e.currentTarget).attr("id");
      var newdetails=[];
      newdetails[""+toID]= valuetxt;
      this.model.set(newdetails);
      console.log(this.model);
    },
    onErrorHandler: function(collection, response, options){
        alert("Something was wrong ! Try to refresh the page or contact administer. :(");
        $(".profile-loader").hide();
    },
    render: function(){
        // console.log(this.trlLevelList.models)
        var template = _.template(trlQuestionsTemp);
        this.$el.html(template({model:this.model,trlLevelList:this.trlLevelList.models,trlQuestionList:this.questionList.models}));
        $(".main_container").append(this.$el);
        return this;
    }
});

  return trlQuestionsView;
  
});
