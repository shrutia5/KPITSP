define([
  'underscore',
  'backbone',
  '../models/companyModel'
], function(_, Backbone, companyModel){

  var companyCollection = Backbone.Collection.extend({
      companyID:null,
      model: companyModel,
      initialize : function(){

      },
      url : function() {
        return APIPATH+'companyMasterList';
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

  return companyCollection;

});