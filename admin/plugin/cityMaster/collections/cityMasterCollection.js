define([
  'underscore',
  'backbone',
  '../models/cityMasterModel'
], function(_, Backbone,cityMasterModel){

  var cityMasterCollection = Backbone.Collection.extend({
    cityID:null,
      model: cityMasterModel,
      initialize : function(){

      },
      url : function() {
        return APIPATH+'cityMasterList';
      },
      parse : function(response){
        this.pageinfo = response.paginginfo;
        this.totalRecords = response.totalRecords;
        this.endRecords = response.end;
        this.flag = response.flag;
        this.msg = response.msg;
        this.loadcity = response.loadcity;
        return response.data;
      }
  });

  return cityMasterCollection;

});