define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var menuFilterOptionModel = Backbone.Model.extend({
  	idAttribute: "menuID",
  	 defaults:{
        textSearch:'menuName',
        textval: null,
        status:null,
        orderBy:'menuName',
        order:'ASC',
    }
  });
  return menuFilterOptionModel;
});

