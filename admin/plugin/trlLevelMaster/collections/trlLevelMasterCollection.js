define([
  'underscore',
  'backbone',
  '../models/trlLevelMasterModel'
], function(_, Backbone,trlLevelMasterModel){

  var trlLevelMasterCollection = Backbone.Collection.extend({
      id:null,
      model: trlLevelMasterModel,
      initialize : function(){

      },
      url : function() {
        return APIPATH+'trlLevelMasterList';
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

  return trlLevelMasterCollection;

});