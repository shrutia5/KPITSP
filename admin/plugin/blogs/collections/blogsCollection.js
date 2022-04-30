define([
  'underscore',
  'backbone',
  '../models/blogsModel'
], function(_, Backbone,blogsModel){

  var blogsCollection = Backbone.Collection.extend({
      pageID:null,
      model: blogsModel,
      initialize : function(){

      },
      url : function() {
        return APIPATH+'blogsList';
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

  return blogsCollection;

});