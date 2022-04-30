define([
  'underscore',
  'backbone',
  '../models/stateMasterModel'
], function(_, Backbone,stateMasterModel){

  var stateMasterCollection = Backbone.Collection.extend({
    stateID:null,
      model: stateMasterModel,
      initialize : function(){

      },
      url : function() {
        return APIPATH+'stateMasterList';
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

  return stateMasterCollection;

});