define([
  'underscore',
  'backbone',
  '../models/trlQuestionsModel'
], function(_, Backbone,trlQuestionsModel){

  var trlQuestionsCollection = Backbone.Collection.extend({
      faqID:null,
      model: trlQuestionsModel,
      initialize : function(){

      },
      url : function() {
        return APIPATH+'trlQuestionsList';
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

  return trlQuestionsCollection;

});