define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var helpfulResourcesSingleModel = Backbone.Model.extend({
    idAttribute: "resourceID",
     defaults: {
        resourceID:null,
        title:null,
        description:null,
        cover:null,
        link:null,
        createdBy:null,
        modifiedBy:null,
        createdDate:null,
        modifiedDate:null,
        status:'active',
    },
  	urlRoot:function(){
      return APIPATH+'helpfulResources/'
    },
    parse : function(response) {
        return response.data[0];
      }
  });
  return helpfulResourcesSingleModel;
});
