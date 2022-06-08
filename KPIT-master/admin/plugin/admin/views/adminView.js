define([
  'jquery',
  'underscore',
  'backbone',
  '../views/addAdminView',
  '../views/accessCompanyDetails',
  '../collections/adminCollection',
  '../models/adminFilterOptionModel',
  'text!../templates/adminRow.html',
  'text!../templates/admin_temp.html',
  'text!../templates/adminFilterOption_temp.html',

], function($,_, Backbone,addAdminView,accessCompanyDetails,adminCollection,adminFilterOptionModel,adminRow,adminTemp,adminFilterOptionTemp){

var adminView = Backbone.View.extend({
    
    initialize: function(options){
        var selfobj = this;
        this.render();
        $(".profile-loader").show();
        var mname = Backbone.history.getFragment();
        permission = ROLE[mname];
        readyStatePhoto = true;
        filterOption = new adminFilterOptionModel();
        if(typeof(options.status) != "undefined"){
          filterOption.set({status:options.status});
        }
        searchcontact = new adminCollection();
        searchcontact.fetch({headers: {
          'contentType':'application/x-www-form-urlencoded','SadminID':$.cookie('authid'),'token':$.cookie('_bb_key'),'Accept':'application/json'
        },error: selfobj.onErrorHandler,type:'post',data:filterOption.attributes}).done(function(res){
          
          if(res.statusCode == 994){app_router.navigate("logout",{trigger:true});}
          $(".profile-loader").hide();
          setPagging(res.paginginfo,res.loadstate,res.msg);  
    });

      this.collection = searchcontact;
      this.collection.on('add',this.addOne,this);
      this.collection.on('reset',this.addAll,this);
      /*$(".table-responsive").on("scroll",function(){
          console.log("wait..");
          selfobj.loadData();
      });*/
    },
    events:
    {
      "blur #textval":"setFreeText",
      "change #textSearch":"settextSearch",
      "click .multiOptionSel":"multioption",
      "click #filterSearch": "filterSearch",
      "click #filterOption": "filterRender",
      "click .resetval":"resetSearch",
      "click .loadview":"loadSubView",
      "click .changeStatus": "changeStatusListElement",
      "click .showpage": "loadData",
    },
    loadSubView:function(e){
        var selfobj = this;
        var show = $(e.currentTarget).attr("data-show");

        switch(show)
        {
          case "singleadminData":{
            var adminID = $(e.currentTarget).attr("data-adminID");
            var addadminview = new addAdminView({adminID:adminID,searchadmin:this});
            break;
          }
          case "accessCompany":{
            var adminID = $(e.currentTarget).attr("data-adminID");
            var accessCompany = new accessCompanyDetails({adminID:adminID,searchadmin:this});
            break;
          }
          
          
        }
    },
    resetSearch: function()
    {
        filterOption.set({curpage:0,textval: null,textSearch:null,status:null,orderBy:'createdDate',order:'DESC'});
        $(".multiOptionSel").removeClass("active");
        $("#textval").val("");
        $('#textSearch option[value=screenName]').attr('selected','selected');
        this.filterSearch();
    },
    settextSearch: function(e){
      var usernametxt = $(e.currentTarget).val();
      filterOption.set({textSearch: usernametxt});
    },
    setFreeText: function(e){
      var usernametxt = $(e.currentTarget).val();
      filterOption.set({textval: usernametxt});
    },
    changeStatusListElement:function(e){
      var selfobj = this;
      var removeIds = [];
      var status = $(e.currentTarget).attr("data-action");
      if(status =="delete"){
        var r = confirm("Are you sure to delete admin user?");
        if (r == false){
          return false;
        }
        var action = "delete";
      }else{
        var action = "changeStatus";
      }
      $('#adminlistcheck input:checkbox').each(function(){
          if($(this).is(":checked"))
          {
            removeIds.push($(this).attr("data-adminID"));
          }
      });
      var idsToRemove = removeIds.toString();
      if(idsToRemove == ''){
        alert("Please select at least one User.");
        return false;
      }
        $.ajax({
            url:APIPATH+'admins/status',
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
    filterRender:function(){
      $(".modal-dialog").removeClass("modal-lg");
      $(".modal-title").html("Filter Data");
      $(".modelbox").hide();
      if($('#filterData').length){
        $('#filterData').css("display","block");
      }else{
        var template = _.template(adminFilterOptionTemp);
        $("#modalBody").append(template());
      
      }
    },
    onErrorHandler: function(collection, response, options){
        alert("Something was wrong ! Try to refresh the page or contact administer. :(");
        $(".profile-loader").hide();
    },
    addOne: function(objectModel){
        var template = _.template(adminRow);
        $("#couponList").append(template({adminDetails:objectModel}));
    },
    addAll: function(){
        $("#couponList").empty();
        this.collection.forEach(this.addOne,this);
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
        this.collection.reset();
        var selfobj = this;
        readyStatePhoto = true;
        filterOption.set({curpage: 0});
        var $element = $('#loadMember');
        
        $(".profile-loader").show();
       
        $element.attr("data-index",1);
        $element.attr("data-currPage",0);
       
        
        this.collection.fetch({ headers:{
            'contentType':'application/x-www-form-urlencoded','SadminID':$.cookie('authid'),'token':$.cookie('_bb_key'),'Accept':'application/json'
            } ,add: true, remove: false, merge: false,error: selfobj.onErrorHandler ,type:'post', data:filterOption.attributes}).done(function(res){
                if(res.statusCode == 994){app_router.navigate("logout",{trigger:true});}
                $(".profile-loader").hide();
                setPagging(res.paginginfo,res.loadstate,res.msg);  
                $element.attr("data-currPage",index);
                $element.attr("data-index",res.paginginfo.nextpage);
                $(".page-info").html(recset);
                if(res.loadstate === false){
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
        searchcontact.reset();
        var index = $element.attr("data-index");
        var currPage = $element.attr("data-currPage");
        
        filterOption.set({curpage: index});
        var requestData = filterOption.attributes;
        
          $(".profile-loader").show();
          searchcontact.fetch({ headers: {
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
        var template = _.template(adminTemp);
        this.$el.html(template());
        $(".main_container").append(this.$el);
        return this;
    }
});

  return adminView;
  
});
