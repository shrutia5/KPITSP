define([
  'underscore',
  'backbone',
  '../models/ourclientsMasterModel'
], function(_, Backbone,ourclientsMasterModel){

  var ourclientsMasterCollection = Backbone.Collection.extend({
      clientsID:null,
      model: ourclientsMasterModel,
      initialize : function(){

      },
      url : function() {
        return APIPATH+'ourclientsList';
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

  return ourclientsMasterCollection;

});