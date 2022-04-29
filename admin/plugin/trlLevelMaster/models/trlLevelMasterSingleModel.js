define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var trlLevelMasterSingleModel = Backbone.Model.extend({
    idAttribute: "id",
     defaults: {
      id:null,
      trl_name:null,
      trl_description:null,
      is_del:null,
    },
  	urlRoot:function(){
      return APIPATH+'trlLevelMaster/'
    },
    parse : function(response) {
        return response.data[0];
      }
  });
  return trlLevelMasterSingleModel;
});
