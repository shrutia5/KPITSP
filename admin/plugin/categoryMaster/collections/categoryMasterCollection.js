define([
  'underscore',
  'backbone',
  '../models/categoryMasterModel'
], function(_, Backbone,categoryMasterModel){

  var categoryMasterCollection = Backbone.Collection.extend({
      categoryID:null,
      model: categoryMasterModel,
      initialize : function(){

      },
      url : function() {
        return APIPATH+'categoryMasterList';
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

  return categoryMasterCollection;

});