
define([
  'jquery',
  'underscore',
  'backbone',
  'datepicker',
  '../views/emailMasterSingleView',
  '../collections/emailMasterCollection',
  '../models/emailMasterFilterOptionModel',
  'text!../templates/emailMasterRow.html',
  'text!../templates/emailMasterTemp.html',
  'text!../templates/emailMasterFilterOptionTemp.html',
], function($,_, Backbone,datepicker,emailMasterSingleView,emailMasterCollection,emailMasterFilterOptionModel,emailMasterRowTemp,emailMasterTemp,emailMasterFilterTemp){

var emailMasterView = Backbone.View.extend({
    
    initialize: function(options){
        var selfobj = this;
        $(".profile-loader").show();
        var mname = Backbone.history.getFragment();
        permission = ROLE[mname];
        readyState = true;
        this.render();
        filterOption = new emailMasterFilterOptionModel();
        searchemailMaster = new emailMasterCollection();
        searchemailMaster.fetch({headers: {
          'contentType':'application/x-www-form-urlencoded','SadminID':$.cookie('authid'),'token':$.cookie('_bb_key'),'Accept':'application/json'
        },error: selfobj.onErrorHandler,type:'post',data:filterOption.attributes}).done(function(res){
          
          if(res.statusCode == 994){app_router.navigate("logout",{trigger:true});}
          $(".profile-loader").hide();
        setPagging(res.paginginfo,res.loadstate,res.msg);   
        });

      this.collection = searchemailMaster;
      this.collection.on('add',this.addOne,this);
      this.collection.on('reset',this.addAll,this);
      $(".right_col").on("scroll",function(){
            selfobj.loadData();
        });
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
      "change .txtchange":"updateOtherDetails",
      "click .changeStatus": "changeStatusListElement",
      "click .showpage": "loadData",
    },
    updateOtherDetails: function(e){

      var valuetxt = $(e.currentTarget).val();
      var toID = $(e.currentTarget).attr("id");
      var newdetails=[];
      newdetails[""+toID]= valuetxt;
      filterOption.set(newdetails);
    },
    settextSearch: function(e){
      var usernametxt = $(e.currentTarget).val();
      filterOption.set({textSearch: usernametxt});
    },
    changeStatusListElement:function(e){
      var selfobj = this;
      var removeIds = [];
      var status = $(e.currentTarget).attr("data-action");
      var action = "changeStatus";
      $('#emailList input:checkbox').each(function(){
          if($(this).is(":checked"))
          {
            removeIds.push($(this).attr("data-tempID"));
          }
      });
      var idsToRemove = removeIds.toString();
      if(idsToRemove == ''){
        alert("Please select at least one record.");
        return false;
      }
        $.ajax({
            url:APIPATH+'emailMaster/status',
            method:'POST',
            data:{list:idsToRemove,action:action,status:status},
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
                 selfobj.collection.fetch({headers: {
                  'contentType':'application/x-www-form-urlencoded','SadminID':$.cookie('authid'),'token':$.cookie('_bb_key'),'Accept':'application/json'
                    },error: selfobj.onErrorHandler}).done(function(res){
                      if(res.statusCode == 994){app_router.navigate("logout",{trigger:true});}
                      $(".profile-loader").hide();
                      selfobj.filterSearch();
                  });
              }
              setTimeout(function(){
                  $(e.currentTarget).html(status);
              }, 3000);
              
            }
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
          case "singleemailMasterData":{
            var tempID = $(e.currentTarget).attr("data-tempID");
            var emailMasterSingleview = new emailMasterSingleView({tempID:tempID,searchemailMaster:this});
            break;
          }
        }
    },
    resetSearch: function()
    {
      
        filterOption.set({curpage:0,tempID:null,textval: null,textSearch:'tempID',status:'active,inactive',orderBy:'tempID',order:'ASC'});
        $(".multiOptionSel").removeClass("active");
        $("#textval").val("");
        $('#textSearch option[value=status]').attr('selected','selected');
        this.filterSearch();
    },
    loaduser:function(){
      var memberDetails  = new singlememberDataModel();
    },
    addOne: function(objectModel){
        var template = _.template(emailMasterRowTemp);
        $("#emailList").append(template({emailMasterDetails:objectModel}));
    },
    addAll: function(){
        $("#emailList").empty();
        this.collection.forEach(this.addOne,this);
    },
    filterRender:function(){
      $(".modal-dialog").removeClass("modal-lg");
      $(".modal-title").html("Filter Data");
      $(".modelbox").hide();
      if($('#filterData').length){
        $('#filterData').css("display","block");
      }else{
        var template = _.template(emailMasterFilterTemp);
        $("#modalBody").append(template());
        $("#installDateFrom").datepicker({
          todayBtn:  1,
          autoclose: true,
          format:"yyyy/mm/dd",
        }).on('changeDate', function (selected) {
          var minDate = new Date(selected.date.valueOf());
          $('#installDateTo').datepicker('setStartDate', minDate);
        });
      
        $("#installDateTo").datepicker({format:"yyyy/mm/dd",autoclose: true})
          .on('changeDate', function (selected) {
              var minDate = new Date(selected.date.valueOf());
              $('#installDateFrom').datepicker('setEndDate', minDate);
        });
      }
    },
    multioption: function(e){
      var selfobj = this;
        var issinglecheck = $(e.currentTarget).attr("data-single");
        if(issinglecheck == undefined){var issingle ="N"}else{var issingle ="Y"}
        if(issingle=="Y")
        {
          var newsetval = [];
          var classname = $(e.currentTarget).attr("class").split(" ");
          newsetval[""+classname[0]] = $(e.currentTarget).attr("data-value");
          filterOption.set(newsetval);
          
        }
        if(issingle=="N")
        {
          setTimeout(function(){
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
            filterOption.set(objectDetails);
            }, 500);
        }
    },
    filterSearch: function(){
        $('#myModal').modal('hide');
        searchemailMaster.reset();
        var selfobj = this;
        readyState = true;
        filterOption.set({curpage: 0,status:'active,inactive'});
        var $element = $('#loadMember');
        console.log("here");
        console.log(filterOption);
        $(".profile-loader").show();
       
        $element.attr("data-index",1);
        $element.attr("data-currPage",0);
       
        searchemailMaster.fetch({ headers:{
            'contentType':'application/x-www-form-urlencoded','SadminID':$.cookie('authid'),'token':$.cookie('_bb_key'),'Accept':'application/json'
            } ,add: true, remove: false, merge: false,error: selfobj.onErrorHandler ,type:'post', data:filterOption.attributes}).done(function(res){
                if(res.statusCode == 994){app_router.navigate("logout",{trigger:true});}
                $(".profile-loader").hide();
                
        setPagging(res.paginginfo,res.loadstate,res.msg);  
        $element.attr("data-currPage",index);
        $element.attr("data-index",res.paginginfo.nextpage);

                $(".page-info").html(recset);
                if(res.loadtraineeSkill === false){
                    $(".profile-loader-msg").html(res.msg);
                    $(".profile-loader-msg").show();
                }else{
                    $(".profile-loader-msg").hide();
                }
            });
    },
   
        loadData: function(e){
        var selfobj = this;
        var $element = $('#loadMember');
        var cid = $(e.currentTarget).attr("data-dt-idx");
        var isdiabled = $(e.currentTarget).hasClass("disabled");
        if(isdiabled){
          //
        }else{

        $element.attr("data-index",cid);
        searchemailMaster.reset();
        var index = $element.attr("data-index");
        var currPage = $element.attr("data-currPage");
        
        filterOption.set({curpage: index});
        var requestData = filterOption.attributes;
        
          $(".profile-loader").show();
          searchemailMaster.fetch({ headers: {
              'contentType':'application/x-www-form-urlencoded','SadminID':$.cookie('authid'),'token':$.cookie('_bb_key'),'Accept':'application/json'
            },add: true, remove: false, merge: false,type:'post',error: selfobj.onErrorHandler,data:requestData}).done(function(res){
              
              $(".profile-loader").hide();
              if(res.statusCode == 994){app_router.navigate("logout",{trigger:true});}
              
              setPagging(res.paginginfo,res.loadstate,res.msg);  
              $element.attr("data-currPage",index);
              $element.attr("data-index",res.paginginfo.nextpage);
          });
      }
    },
    render: function(){
        var template = _.template(emailMasterTemp);
        this.$el.html(template());
        $(".main_container").append(this.$el);
        return this;
    }
});

  return emailMasterView;
  
});
