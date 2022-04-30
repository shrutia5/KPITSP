define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var trlLevelMasterFilterOptionModel = Backbone.Model.extend({
  	idAttribute: "id",
  	 defaults:{
        textSearch:'trl_name',
        textval: null,
        is_del:0,
        orderBy:'id',
        order:'DESC',
    }
  });
  return trlLevelMasterFilterOptionModel;
});

