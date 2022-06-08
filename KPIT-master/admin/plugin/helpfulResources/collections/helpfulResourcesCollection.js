define([
  'underscore',
  'backbone',
  '../models/helpfulResourcesModel'
], function(_, Backbone,helpfulResourcesModel){

  var helpfulResourcesCollection = Backbone.Collection.extend({
      faqID:null,
      model: helpfulResourcesModel,
      initialize : function(){

      },
      url : function() {
        return APIPATH+'helpfulResourcesList';
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

  return helpfulResourcesCollection;

});