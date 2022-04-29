define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var blogsFilterOptionModel = Backbone.Model.extend({
  	idAttribute: "blogID",
  	 defaults:{
        textSearch:'blogTitle',
        textval: null,
        status:'active',
        orderBy:'blogTitle',
        order:'ASC',
    }
  });
  return blogsFilterOptionModel;
});

