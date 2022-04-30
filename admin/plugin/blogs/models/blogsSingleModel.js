define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var blogsSingleModel = Backbone.Model.extend({
    idAttribute: "blogID",
     defaults: {
        blogID:null,
        blogTitle:null,
        addblogImage:null,
        blogImage:null,
        description:null,
        category:null,
        blogLink:null,
        blogSubTitle:null,
        metaKeywords:null,
        metaDesc:null,
        pageCode:null,
        pageContent:null,
        pageCss:null,
        createdBy:null,
        modifiedBy:null,
        createdDate:null,
        modifiedDate:null,
        status:'active',
    },
  	urlRoot:function(){
      return APIPATH+'blogs/'
    },
    parse : function(response) {
        return response.data[0];
      }
  });
  return blogsSingleModel;
});
