define([
  'underscore',
  'backbone',
  '../models/faqMasterModel'
], function(_, Backbone,faqMasterModel){

  var faqMasterCollection = Backbone.Collection.extend({
      faqID:null,
      model: faqMasterModel,
      initialize : function(){

      },
      url : function() {
        return APIPATH+'faqMasterList';
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

  return faqMasterCollection;

});