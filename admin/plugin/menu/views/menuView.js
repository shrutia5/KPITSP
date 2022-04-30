
define([
  'jquery',
  'underscore',
  'backbone',
  'datepicker',
  '../views/menuSingleView',
  '../collections/menuCollection',
  '../models/menuFilterOptionModel',
  'text!../templates/menuRow.html',
  'text!../templates/menu_temp.html',
  'text!../templates/menuFilterOption_temp.html',
], function($,_, Backbone,datepicker,menuSingleView,menuCollection,menuFilterOptionModel,menuRowTemp,menuTemp,menuFilterTemp){
 
var menuView = Backbone.View.extend({
     
    initialize: function(options){
        
      
        var selfobj = this;
        $(".profile-loader").show();
        var mname = Backbone.history.getFragment();
        permission = ROLE[mname];

        readyState = true;
        this.render();
        filterOption = new menuFilterOptionModel();
        searchmenu = new menuCollection();
        searchmenu.fetch({headers: {
          'contentType':'application/x-www-form-urlencoded','SadminID':$.cookie('authid'),'token':$.cookie('_bb_key'),'Accept':'application/json'
        },error: selfobj.onErrorHandler,type:'post',data:filterOption.attributes}).done(function(res){
          
          if(res.statusCode == 994){app_router.navigate("logout",{trigger:true});}
          $(".profile-loader").hide();
          setPagging(res.paginginfo,res.loadstate,res.msg);
        });

      this.collection = searchmenu;
      this.collection.on('add',this.addOne,this);
      this.collection.on('reset',this.addAll,this);
     /* $(".right_col").on("scroll",function(){
            console.log("wait..");
            selfobj.loadData();
            
        });*/
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
      $('#menuList input:checkbox').each(function(){
          if($(this).is(":checked"))
          {
            removeIds.push($(this).attr("data-menuID"));
          }
      });
      var idsToRemove = removeIds.toString();
      if(idsToRemove == ''){
        alert("Please select at least one record.");
        return false;
      }
        $.ajax({
            url:APIPATH+'menuMaster/status',
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
          case "singlemenuData":{
            var menuID = $(e.currentTarget).attr("data-menuID");
            var menusingleview = new menuSingleView({menuID:menuID,searchmenu:this});
            break;
          }
        }
    },
    resetSearch: function()
    {
      
        filterOption.set({curpage:0,menuID:null,textval: null,textSearch:'menuName',status:'active',orderBy:'menuName',order:'ASC'});
        $(".multiOptionSel").removeClass("active");
        $("#textval").val("");
        $('#textSearch option[value=menuID]').attr('selected','selected');
        this.filterSearch();
    },
    loaduser:function(){
      var memberDetails  = new singlememberDataModel();
    },
    addOne: function(objectModel){
        var template = _.template(menuRowTemp);
        $("#menuList").append(template({menuDetails:objectModel}));
    },
    addAll: function(){
        $("#menuList").empty();
        this.collection.forEach(this.addOne,this);
    },
    filterRender:function(){
      $(".modal-dialog").removeClass("modal-lg");
      $(".modal-title").html("Filter Data");
      $(".modelbox").hide();
      if($('#filterData').length){
        $('#filterData').css("display","block");
      }else{
        var template = _.template(menuFilterTemp);
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
        searchmenu.reset();
        var selfobj = this;
        readyState = true;
        filterOption.set({curpage: 0});
        var $element = $('#loadMember');
        
        $(".profile-loader").show();
       
        $element.attr("data-index",1);
        $element.attr("data-currPage",0);
       
        searchmenu.fetch({ headers:{
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
    /*loadData: function(){
        var selfobj = this;
        var $element = $('#loadMember'),
        $window = $(window),
        docViewTop = $window.scrollTop(),
        docViewBottom =  700 - docViewTop + $window.height(),
        elementTop = $element.offset().top,
        elementBottom = elementTop + $element.height();
        if(elementBottom <= docViewBottom){

            var index = $element.attr("data-index");
            var currPage = $element.attr("data-currPage");
            if(readyState){
              
                readyState = false;
                filterOption.set({curpage: index});
                var requestData = filterOption.attributes;
                if(searchmenu.loadstate){
                    $(".profile-loader").show();
                    searchmenu.fetch({ headers: {
                        'contentType':'application/x-www-form-urlencoded','SadminID':$.cookie('authid'),'token':$.cookie('_bb_key'),'Accept':'application/json'
                      },add: true, remove: false, merge: false,type:'post',error: selfobj.onErrorHandler,data:requestData}).done(function(res){
                        
                        $(".profile-loader").hide();
                        if(res.statusCode == 994){app_router.navigate("logout",{trigger:true});}
                        
                        if(res.paginginfo.end > res.paginginfo.totalRecords)
                          var recset = res.paginginfo.totalRecords+"/"+res.paginginfo.totalRecords;
                        else
                          var recset = res.paginginfo.end+"/"+res.paginginfo.totalRecords;
                  
                        $(".page-info").html(recset);

                        if(res.loadstate === false){
                            $(".profile-loader-msg").html(res.msg);
                            $(".profile-loader-msg").show();
                        }else{
                            $(".profile-loader-msg").hide();
                        }
                        $element.attr("data-currPage",index);
                        $element.attr("data-index",res.paginginfo.nextpage);
                        setTimeout(function(){
                            readyState = true;
                        }, 3000);
                    });
                }else{
                    $(".profile-loader-msg").show();
                }
            }
        }
        setTimeout(function(){
        var height = $(window).height();
        $( ".overflow-hidden" ).css("max-height",height-74);
        $( ".overflow-hidden" ).css("height",height-74);
        }, 2000);*/
         loadData: function(e){
        var selfobj = this;
        var $element = $('#loadMember');
        var cid = $(e.currentTarget).attr("data-dt-idx");
        var isdiabled = $(e.currentTarget).hasClass("disabled");
        if(isdiabled){
          //
        }else{

        $element.attr("data-index",cid);
        searchmenu.reset();
        var index = $element.attr("data-index");
        var currPage = $element.attr("data-currPage");
        
        filterOption.set({curpage: index});
        var requestData = filterOption.attributes;
        
          $(".profile-loader").show();
          searchmenu.fetch({ headers: {
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
        var template = _.template(menuTemp);
        this.$el.html(template());
        $(".main_container").append(this.$el);
        return this;
    }
});

  return menuView;
  
});
