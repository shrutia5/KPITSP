define([
  'underscore',
  'backbone',
  '../models/registerUserModel'
], function(_, Backbone,registerUserModel){

  var registerUserCollection = Backbone.Collection.extend({
      roleID:null,
      model: registerUserModel,
      initialize : function(){

      },
      url : function() {
        return APIPATH+'registerUserMasterList';
      },
      parse : function(response){
        this.pageinfo = response.paginginfo;
        this.totalRecords = response.totalRecords;
        this.endRecords = response.end;
        this.flag = response.flag;
        this.msg = response.msg;
        this.loadstate = response.loadstate;
        return response.data;
      }
  });

  return registerUserCollection;

});