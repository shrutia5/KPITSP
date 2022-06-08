define([
  'jquery',
  'underscore',
  'backbone',
  'custom',
  '../models/dashboardModel',
  'text!../templates/dashboard_temp.html',
], function($,_, Backbone,custom,dashboardModel,dashBoard_temp){

var dashboardView = Backbone.View.extend({
    model:dashboardModel,
    tagName: "div",
    initialize: function(options){
      selfobj = this;
          selfobj.render();
    },
    events:
    {
        "change .saveOtherDetail": "updateDetails",
        "click .getPaymentData": "getPaymentDetails",
    },
    onErrorHandler: function(collection, response, options){
        alert("Something was wrong ! Try to refresh the page or contact administer. :(");
        $(".profile-loader").hide();
    },
    addOne: function(objectModel){
        console.log(this.model);
    },
    updateNote: function(e){
      var note = $(e.currentTarget).val();
      this.model.set({note:note});
    },
    render: function(){
        var template = _.template(dashBoard_temp);
        var res = template({dashDetails:this.model.attributes});
        this.$el.html(res);
        $(".main_container").append(this.$el);
        return this;
    },
});

  return dashboardView;
  
});
