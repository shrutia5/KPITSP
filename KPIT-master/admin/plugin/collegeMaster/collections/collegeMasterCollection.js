define([
  'underscore',
  'backbone',
  '../models/collegeMasterModel'
], function(_, Backbone,collegeMasterModel){

  var collegeMasterCollection = Backbone.Collection.extend({
    collegeID:null,
      model: collegeMasterModel,
      initialize : function(){

      },
      url : function() {
        return APIPATH+'collegeMasterList';
      },
      parse : function(response){
        this.pageinfo = response.paginginfo;
        this.totalRecords = response.totalRecords;
        this.endRecords = response.end;
        this.flag = response.flag;
        this.msg = response.msg;
        this.loadcollege = response.loadcollege;
        return response.data;
      }
  });

  return collegeMasterCollection;

});