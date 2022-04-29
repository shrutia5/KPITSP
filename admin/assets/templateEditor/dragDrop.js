(function ( $ ) {
 
    $.fn.templateDesign = function( options ) {
    
        var __rows =0;
        var __current_col_edit = "";
        var __elementsfn = [];
        var __columnsSize = {"col-1":{"type":"col-1","size":"12"},"col-2":{"type":"col-2","size":"6,6"},"col-3":{"type":"col-3","size":"8,4"},"col-4":{"type":"col-4","size":"4,4,4"},"col-5":{"type":"col-5","size":"3,3,3,3"},"col-6":{"type":"col-6","size":"3,9"},"col-6":{"type":"col-6","size":"3,9"},"col-7":{"type":"col-7","size":"3,6,3"},"col-8":{"type":"col-8","size":"9,3"},"col-9":{"type":"col-9","size":"2,2,2,2,2,2"},"col-10":{"type":"col-10","size":"2,8,2"},"col-11":{"type":"col-11","size":"2,2,2,6"},"col-12":{"type":"col-12","size":"3,2,2,2,3"}};
        var __margintype= {"ws_m_0":"margin-top","ws_m_1":"margin-right","ws_m_2":"margin-bottom","ws_m_3":"margin-left"};
        var __paddingtype= {"ws_p_0":"padding-top","ws_p_1":"padding-right","ws_p_2":"padding-bottom","ws_p_3":"padding-left"};
        var __bordertype= {"ws_b_0":"border-top","ws_b_1":"border-right","ws_b_2":"border-bottom","ws_b_3":"border-left"};
        var __coltypeMob= {"12/12":"col-xs-12","11/12":"col-xs-11","10/12":"col-xs-10","9/12":"col-xs-9","8/12":"col-xs-8","7/12":"col-xs-7","6/12":"col-xs-6","5/12":"col-xs-5","4/12":"col-xs-4","3/12":"col-xs-3","2/12":"col-xs-2","1/12":"col-xs-1"};
        var __coltypTab= {"12/12":"col-sm-12","11/12":"col-sm-11","10/12":"col-sm-10","9/12":"col-sm-9","8/12":"col-sm-8","7/12":"col-sm-7","6/12":"col-sm-6","5/12":"col-sm-5","4/12":"col-sm-4","3/12":"col-sm-3","2/12":"col-sm-2","1/12":"col-sm-1"};
        var __toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
            ['blockquote', 'code-block'],
          
            [{ 'header': 1 }, { 'header': 2 }],               // custom button values
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
            [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
            [{ 'direction': 'rtl' }],                         // text direction
          
            [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
          
            [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
            [{ 'font': [] }],
            [{ 'align': [] }],
            ['link'],
            ['clean']                                         // remove formatting button
          ];
        
    // Plugin defaults – added as a property on our plugin function.
    $.fn.templateDesign.defaults = {
        color: "red",
        background: "yellow",
        playground:null,
        nextbtn:null,
        savebtn:null,
        temptemplate:null,
        version:"inline",
        playgroundElements:null,
        elements:{
            heading:false,
            paragraph:true,
            image:true,
            button:true,
            link:true,
            video:true,
            social:true,
            customHtml:true,
        },
        layout:{
            row:true,
        },
        setupPlayground:function(){
            
        },
        HTMLUpdate : function(){
        
        },
    };  
    
    // This is the easiest way to have default options.
    var settings = $.extend({},$.fn.templateDesign.defaults, options );
    var playground = settings.playground;
    var savebtn = settings.savebtn;
    var temptemplate = settings.temptemplate;
    var playgroundElements = settings.playgroundElements;
    setupDropable();
    function setupPlayground(){
        if(playground == null){
            console.log("playground element not found");
            return false;
        }else{
            //playground.empty();
            playground.addClass("ws-playground");
        }
    }

    function setuppPlaygroundElements(){

        if(playgroundElements == null){
            console.log("playground elements element not found");
            return false;
        }else{
            playgroundElements.empty();
            playgroundElements.addClass("ws-playground-elements");
        }

        playgroundElements.append("<div class='ws-element-container ws-right-actions'></div>");
        $(".ws-element-container").append("<div class='ws-section-header' data-show='element-list'><h2>Elements</h2></div><div class='element-list ws-list-view'></div>");
        $.each(settings.elements,function(index,val){

            if(val){
                __elementsfn[index]();
            }
        });
        if(settings.layout != ""){

            playgroundElements.append("<div class='ws-layout-container ws-right-actions'></div>");
            $(".ws-layout-container").append("<div class='ws-section-header' data-show='layout-list'><h2>Layouts</h2></div><div class='layout-list ws-list-view'></div>");
            $.each(settings.layout,function(index,val){
    
                if(val){
                    __elementsfn[index]();
                }
            }); 
        }
    }
    function editColSetting(e,type){
        if(type == "col"){
            var colEl = $(e.currentTarget).closest(".ws-row-col");
            __current_col_edit = colEl;
        }else{
            var colEl = $(e.currentTarget).closest(".rowData").find(".ws-element-wrapper");
            __current_col_edit = colEl;
        }
        if($('.ws-remove-section').length > 0 ){
            $('.ws-remove-section').remove();
        }
        var rr = $("<div/>",{
            class:"ws-column-container ws-remove-section ws-right-actions",
            "data-setting":$(colEl).attr("id"),
        });
        var ee = $("<div/>",{
            class:"column-list ws-list-view"
        }).append(getMarginpadding());
        if(type != "col"){
            var selcf = "";
            var selc="";
            //__current_col_edit.closest(".rowData").attr("data-row-type","container-with-row");
            var curtype = __current_col_edit.closest(".rowData").attr("data-row-type");
            if(typeof(curtype) != "undefined" && curtype !=""){
                if(curtype == "container-fluid"){
                    selcf = "selected";
                }
                if(curtype == "container"){
                    selc = "selected";
                }
            } 
            var rowType = "<select class='row-type'><option "+selcf+" value='container-fluid'>Full Screen</option><option "+selc+" value='container'>center Screen</option></select>";
            ee.append("<strong>Row size</strong>");
            ee.append(rowType);
            if(curtype == "container-with-row"){
                ee.append("<br/><strong>Full container with center content</strong>&nbsp;&nbsp;<input type='checkbox' checked=checked class='row-type-check'/>");                
            }else{
                ee.append("<br/><strong>Full container with center content</strong>&nbsp;&nbsp;<input type='checkbox' class='row-type-check'/>");                
            }
            
        }
        ee.append("<p>Border</p>");
        ee.append(borderSetting());
        ee.append(getAlignment());
        ee.append(getMobileSetting());
        
        ee.append(backgroundSetting(true));
        
        ee.append("<p>Width and Height</p>");
        ee.append(whScroll(true));
        var am =$("<div/>",{
            class:"ws-section-header",
            "data-show":'column-list'
        });
        if(type == "col"){
            am.append("<h2>Column Settings</h2>");
        }else{
            am.append("<h2>Row Settings</h2>");
        }
        am.append(ee);
        rr.append(am);
        $(".ws-list-view").hide();
        ee.show();
        playgroundElements.append(rr);
    }
    function editTextSetting(colEl){

        __current_col_edit = colEl;

        var curCss = __current_col_edit.attr("data-meta-css");
        /*if(typeof(curCss) != "undefined" ){
            curCss = JSON.parse(__current_col_edit.attr("data-meta-css"));
        }else{
            curCss = {}
        }*/
        var htmlTxt = __current_col_edit.closest(".paragraph-text").find(".p-txt").html();

        console.log(colEl.attr("class"));
        if($('.ws-remove-section').length > 0 ){
            $('.ws-remove-section').remove(); 
        }
        var rr = $("<div/>",{
            class:"ws-text-container ws-remove-section ws-right-actions",
            "data-setting":$(colEl).attr("id"),
        });

        var editer1 = $("<div/>",{
            id:"text-editor"});
        var el = $(editer1).get(0);
        
        var ee = $("<div/>",{
            class:"text-list ws-list-view"
        }).append($("<div/>",{class:"ws-editer"}).append(editer1));
        ee.append(getMarginpadding());
        ee.append("<p>Border</p>");
        ee.append(borderSetting());
        ee.append(getAlignment());
        ee.append(backgroundSetting(false));
        var am =$("<div/>",{
            class:"ws-section-header",
            "data-show":'text-list'
        });

        var save = $("<button/>",{
            id:"updatepara",
            class:"ws_r_action_btn"
        });
        save.html("Save");
        am.append("<h2>Edit Paragraph</h2>");
        am.append(save);
        am.append(ee);
        rr.append(am);

        playgroundElements.append(rr);
        var editor = new Quill(el,{
        modules: {
            toolbar: __toolbarOptions
        },
        theme: 'snow'  // or 'bubble'
        });

        const delta = editor.clipboard.convert(htmlTxt);
        editor.setContents(delta, 'silent');
        editor.on('text-change', function(delta, oldDelta, source) {
            if (source == 'api') {
                console.log("An API call triggered this change.");
              } else if (source == 'user') {
                var delta = editor.getContents();
                var text = editor.getText();
                var justHtml = editor.root.innerHTML;
                //console.log(colEl.attr("class"));
                colEl.find(".p-txt").html(justHtml);
                //console.log(justHtml);
              }
        });
        $(".ws-list-view").hide();
        ee.show();
        
    }
    function editSocialSetting(colEl){

        __current_col_edit = colEl;

        var curCss = __current_col_edit.attr("data-meta-css");
        var fblink = __current_col_edit.attr("data-fb");
        var twlink = __current_col_edit.attr("data-tw");
        var instalink = __current_col_edit.attr("data-insta");
        var linkinlink = __current_col_edit.attr("data-linkin");
        /*if(typeof(curCss) != "undefined" ){
            curCss = JSON.parse(__current_col_edit.attr("data-meta-css"));
        }else{
            curCss = {}
        }*/
        
        if($('.ws-remove-section').length > 0 ){
            $('.ws-remove-section').remove(); 
        }
        var rr = $("<div/>",{
            class:"ws-text-container ws-remove-section ws-right-actions",
            "data-setting":$(colEl).attr("id"),
        });

        var ee = $("<div/>",{
            class:"social-list ws-list-view"
        }).append($("<div/>",{class:"ws-social"}));
        
        var fbCon = $("<div/>",{
            class:"social-link"
        });
        var fb = $("<input>",{
            class:"social-link-txt",
            "data-type":"fb",
            value:fblink
        });
        
        fbCon.append("<label>Facebook Link</label>");
        fbCon.append(fb);
        
        var twCon = $("<div/>",{
            class:"social-link-txt"
        });
        var tw = $("<input>",{
            class:"social-link-txt",
            value:twlink,
            "data-type":"tw",
        });
        
        twCon.append("<label>Twitter Link</label>");
        twCon.append(tw);

        var insCon = $("<div/>",{
            class:"social-link"
        });
        var ins = $("<input>",{
            class:"social-link-txt",
            value:instalink,
            "data-type":"insta",
        });
        
        insCon.append("<label>Instagram Link</label>");
        insCon.append(ins);
        

        var linkinCon = $("<div/>",{
            class:"social-link"
        });
        var linkin = $("<input>",{
            class:"social-link-txt",
            value:linkinlink,
            "data-type":"linkin",
        });
        
        linkinCon.append("<label>Linkedin Link</label>");
        linkinCon.append(linkin);

        ee.append(fbCon);
        ee.append(twCon);
        ee.append(insCon);
        ee.append(linkinCon);
        ee.append(getMarginpadding());
        ee.append("<p>Border</p>");
        ee.append(borderSetting());
        ee.append(getAlignment());
        ee.append(backgroundSetting(false));

        var am =$("<div/>",{
            class:"ws-section-header",
            "data-show":'social-list'
        });

        am.append("<h2>Edit Soical Media Links</h2>");
        am.append(ee);
        rr.append(am);

        playgroundElements.append(rr);
        $(".ws-list-view").hide();
        ee.show();
        
    }
    function editHtmlSetting(colEl){

        __current_col_edit = colEl;

        var curCss = __current_col_edit.attr("data-meta-css");
        var curHtml = __current_col_edit.closest(".ws-customHtml-link").find(".custom-html-txt").html();
        
        if($('.ws-remove-section').length > 0 ){
            $('.ws-remove-section').remove(); 
        }
        var rr = $("<div/>",{
            class:"ws-text-container ws-remove-section ws-right-actions",
            "data-setting":$(colEl).attr("id"),
        });
        var textel = $("<textarea>",{
            class:"custom-html",
            
        });
        textel.val(curHtml);
        var ee = $("<div/>",{
            class:"html-list ws-list-view"
        }).append($("<div/>",{class:"ws-editer"}));
        ee.append(textel);
        ee.append(getMarginpadding());
        var am =$("<div/>",{
            class:"ws-section-header",
            "data-show":'html-list'
        });
        am.append("<h2>Custom HTML</h2>");
        am.append(ee);
        rr.append(am);
        playgroundElements.append(rr);
        $(".ws-list-view").hide();
        ee.show();
        
    }
    function editVideoSetting(colEl){

        __current_col_edit = colEl;

        var curCss = __current_col_edit.attr("data-meta-css");
        var url = __current_col_edit.attr("data-url");
        //var htmlTxt = __current_col_edit.closest(".ws-video").find(".p-txt").html();
        if($('.ws-remove-section').length > 0 ){
            $('.ws-remove-section').remove(); 
        }
        var rr = $("<div/>",{
            class:"ws-text-container ws-remove-section ws-right-actions",
            "data-setting":$(colEl).attr("id"),
        });
        var url = $("<input>",{
            class:"text-list ws-video-url",
            type:"text",
            name:"url",
            value:url,
        });
        var ee = $("<div/>",{
            class:"video-list ws-list-view"
        });

        ee.append("<p>Video URL</p>");
        ee.append(url);
        ee.append("<p>Video width X Height. Default is auto responsive.</p>");
        ee.append(whScroll(false));
        ee.append(getMarginpadding());
        //ee.append("<p>Video</p>");
        ///ee.append(borderSetting());
        //ee.append(backgroundSetting());
        var am =$("<div/>",{
            class:"ws-section-header",
            "data-show":'video-list'
        });
        am.append("<h2>Edit Video</h2>");
        am.append(ee);
        rr.append(am);

        playgroundElements.append(rr);
        $(".ws-list-view").hide();
        ee.show();
        
    }

    function editImageSetting(colEl){

        __current_col_edit = colEl;

        var curCss = __current_col_edit.attr("data-meta-css");
        if($('.ws-remove-section').length > 0 ){
            $('.ws-remove-section').remove(); 
        }
        var rr = $("<div/>",{
            class:"ws-text-container ws-remove-section ws-right-actions",
            "data-setting":$(colEl).attr("id"),
        });
        var curUrl = __current_col_edit.attr("data-url");
        if(typeof(curUrl) != "undefined" && curUrl !=""){
            var url = curUrl;
        }else{
            var url = "";
        }
        var url = $("<input>",{
            class:"text-list ws-image-url",
            type:"text",
            value:url,
            name:"url"
        });
        var curLink = __current_col_edit.attr("data-link");
        if(typeof(curLink) != "undefined" && curLink !=""){
            var link = curLink;
        }else{
            var link = "";
        }
        var link = $("<input>",{
            class:"text-list ws-image-link",
            type:"text",
            value:link,
            name:"link"
        });
        var curAlt = __current_col_edit.attr("data-alt");
        if(typeof(curAlt) != "undefined" && curAlt !=""){
            var alttxt = curAlt;
        }else{
            var alttxt = "";
        }
        var alt = $("<input>",{
            class:"text-list ws-image-alt",
            type:"text",
            value:alttxt,
            name:"altText"
        });
        var ee = $("<div/>",{
            class:"image-list ws-list-view"
        });

        ee.append("<p>Image URL</p>");
        ee.append(url);
        ee.append("<p>Image Width X Height. Default is Auto Responsive</p>");
        ee.append(whScroll(false));
        ee.append("<p>Image Link</p>");
        ee.append(link);
        ee.append("<p>Image Alt</p>");
        ee.append(alt);
        ee.append(getAlignment());
        ee.append(getMarginpadding());
        var am = $("<div/>",{
            class:"ws-section-header",
            "data-show":'image-list'
        });
        am.append("<h2>Edit Image</h2>");
        am.append(ee);
        rr.append(am);

        playgroundElements.append(rr);
        $(".ws-list-view").hide();
        ee.show();
        
    }

    function editButtonSetting(colEl){

        __current_col_edit = colEl;

        var curCss = __current_col_edit.attr("data-meta-css");
        if($('.ws-remove-section').length > 0 ){
            $('.ws-remove-section').remove(); 
        }
        var rr = $("<div/>",{
            class:"ws-text-container ws-remove-section ws-right-actions",
            "data-setting":$(colEl).attr("id"),
        });
        
        var curLink = __current_col_edit.attr("data-link");
        if(typeof(curLink) != "undefined" && curLink !=""){
            var link = curLink;
        }else{
            var link = "";
        }
        var link = $("<input>",{
            class:"text-list ws-button-link",
            type:"text",
            value:link,
            name:"buttonLink"
        });
        var curAlt = __current_col_edit.attr("data-alt");
        if(typeof(curAlt) != "undefined" && curAlt !=""){
            var alttxt = curAlt;
        }else{
            var alttxt = "";
        }
        var alt = $("<input>",{
            class:"text-list ws-button-title",
            type:"text",
            value:alttxt,
            name:"altTextBtn"
        });
        var ee = $("<div/>",{
            class:"button-list ws-list-view"
        });
        ee.append("<p>Button Link</p>");
        ee.append(link);
        ee.append("<p>Button Width X Height. Default is Auto Responsive</p>");
        ee.append(whScroll(false));
        
        ee.append("<p>Button Title and Text</p>");
        ee.append(alt);
        ee.append(getAlignment());
        ee.append(getMarginpadding());
        ee.append(borderSetting());
        ee.append(backgroundSetting(false));
        var am = $("<div/>",{
            class:"ws-section-header",
            "data-show":'button-list'
        });
        am.append("<h2>Edit Button</h2>");
        am.append(ee);
        rr.append(am);

        playgroundElements.append(rr);
        $(".ws-list-view").hide();
        ee.show();
        
    }
    function editLinkSetting(colEl){

        __current_col_edit = colEl;

        var curCss = __current_col_edit.attr("data-meta-css");
        if($('.ws-remove-section').length > 0 ){
            $('.ws-remove-section').remove(); 
        }
        var rr = $("<div/>",{
            class:"ws-text-container ws-remove-section ws-right-actions",
            "data-setting":$(colEl).attr("id"),
        });
        
        var curLink = __current_col_edit.attr("data-link");
        if(typeof(curLink) != "undefined" && curLink !=""){
            var link = curLink;
        }else{
            var link = "";
        }
        var link = $("<input>",{
            class:"text-list ws-link-text",
            type:"text",
            value:link,
            name:"LinkText"
        });
        var curAlt = __current_col_edit.attr("data-alt");
        if(typeof(curAlt) != "undefined" && curAlt !=""){
            var alttxt = curAlt;
        }else{
            var alttxt = "";
        }
        var alt = $("<input>",{
            class:"text-list ws-link-title",
            type:"text",
            value:alttxt,
            name:"altTextLink"
        });
        var ee = $("<div/>",{
            class:"link-list ws-list-view"
        });
        ee.append("<p>Link</p>");
        ee.append(link);
        ee.append("<p>Link Title and Text</p>");
        ee.append(alt);
        ee.append(getAlignment());
        ee.append(getMarginpadding());
        var am = $("<div/>",{
            class:"ws-section-header",
            "data-show":'link-list'
        });
        am.append("<h2>Edit Link</h2>");
        am.append(ee);
        rr.append(am);

        playgroundElements.append(rr);
        $(".ws-list-view").hide();
        ee.show();
        
    }
    

    function getMarginpadding(){
        var elMain = $("<div/>",{class:"col-ma"});
        var curCss = __current_col_edit.attr("data-meta-css");
        var addCss = __current_col_edit.attr("data-add-css");
        if(typeof(addCss) == "undefined" ){
            addCss ="";
        }
        if(typeof(curCss) != "undefined" ){
            curCss = JSON.parse(__current_col_edit.attr("data-meta-css"));
        }
        
        console.log("current Css");
        console.log(curCss);
        var addionalCss =$("<div/>",{class:"col-setting"});
        addionalCss.append("<strong>Additional Css Class</strong>");
        var addCssEl = $("<input/>",{
            type:'text',
            class:'addCss',
            value:addCss,
        });
        addionalCss.append("<br/>");
        addionalCss.append(addCssEl);

        var el = $("<div/>",{class:"col-setting-holder"});
        var elm = $("<div/>",{class:"ws-margin-list"});
        var elb = $("<div/>",{class:"ws-border-list"});
        var elp = $("<div/>",{class:"ws-padding-list"});
        var elho = $("<div/>",{class:"ws-holder-list"});
        for (let index = 0; index < 4; index++){
            var vl = "";
            if(typeof(curCss) != "undefined" ){
                if(typeof(curCss[__margintype["ws_m_"+index]]) != "undefined"){
                    vl = curCss[__margintype["ws_m_"+index]];
                }else{
                    vl ="";
                }
            }
            var eli = $("<input/>",{
                id:"ws_m_"+index,
                type:"text",
                value:vl,
                class:"ws-col-m"
            });
            elm.append(eli);
        }
        for (let index = 0; index < 4; index++) {
            var vb = "";
            if(typeof(curCss) != "undefined" ){
                if(typeof(curCss[__bordertype["ws_b_"+index]]) != "undefined"){
                    vb = (curCss[__bordertype["ws_b_"+index]]).split(" ");
                    vb = vb[0];
                }else{
                    vb ="";
                }
            }
            var eli = $("<input/>",{
                id:"ws_b_"+index,
                type:"text",
                value:vb,
                class:"ws-col-b"
            });
            elb.append(eli);
        }
        elb.append("<label>Border</label>");
        elm.append("<label>Margin</label>");
        elm.append(elb);
        for (let index = 0; index < 4; index++) {

            var vp = "";
            if(typeof(curCss) != "undefined" ){
                if(typeof(curCss[__paddingtype["ws_p_"+index]]) != "undefined"){
                    vp = curCss[__paddingtype["ws_p_"+index]];
                }else{
                    vp ="";
                }
            }
            var eli = $("<input/>",{
                id:"ws_p_"+index,
                type:"text",
                value:vp,
                class:"ws-col-p"
            });
            
            elp.append(eli);
        }
        elp.append("<label>Padding</label>");
        elp.append(elho);
        elb.append(elp);
        el.append(elm);
        elMain.append(addionalCss);
        elMain.append(el);
        return elMain;
    }
    function whScroll(isScroll){

        var curCss = __current_col_edit.attr("data-meta-css");
        if(typeof(curCss) != "undefined" ){
            curCss = JSON.parse(__current_col_edit.attr("data-meta-css"));
        }else{
            curCss = {};
        }
        var curWidth = __current_col_edit.attr("data-width");
        if(typeof(curWidth) != "undefined" && curWidth !=""){
            var wid = curWidth;
        }else{
            var wid = "";
        }
        var width = $("<input>",{
            id:"ws-element-width",
            class:"ws-input",
            value:wid,
            type:"text"
        });
        var curHeight = __current_col_edit.attr("data-height");
        if(typeof(curHeight) != "undefined" && curHeight !=""){
            var hei = curHeight;
        }else{
            var hei = "";
        }
        var height = $("<input>",{
            id:"ws-element-height",
            class:"ws-input",
            value:hei,
            type:"text"
        });
        if(isScroll){

            var overList = ["none","visible","hidden","scroll","auto"];
            var sel = $("<select/>",{
                class:"ws-scroll-type"
            });
            for (let i = 0; i < overList.length; i++) {
                if(curCss["overflow"] != "undefined" && overList[i] == curCss["overflow"]){
                    sel.append(new Option(overList[i],overList[i],true,true));
                }else{
                    sel.append(new Option(overList[i],overList[i]));
                }
            }
        }
        
        var wh = $("<div/>",{
            class:"ws-who"
        });
        var whs = $("<div/>",{
            class:"ws-wh"
        });
        whs.append(width);
        whs.append(height);
        wh.append(whs);
        if(isScroll){
            wh.append("Content Overflow");
            wh.append(sel);
        }
        return wh;
        
    }
    
    function getMobileSetting(){

        var mobile = __current_col_edit.attr("data-mobile");
        if(typeof(mobile) != "undefined" && mobile !=""){
            var mobileView = mobile;
        }else{
            var mobileView = "";
        }

        var tablet = __current_col_edit.attr("data-tablet");
        if(typeof(tablet) != "undefined" && tablet !=""){
            var tabletView = tablet;
        }else{
            var tabletView = "";
        }
            var mobileVList = ["Select","none","12/12","11/12","10/12","9/12","8/12","7/12","6/12","5/12","4/12","3/12","2/12","1/12"];
            var selm = $("<select/>",{
                class:"ws-mobile-res"
            });
            for (let i = 0; i < mobileVList.length; i++) {
                if(mobile != "undefined" && mobileVList[i] == mobileView){
                    selm.append(new Option(mobileVList[i],mobileVList[i],true,true));
                }else{
                    selm.append(new Option(mobileVList[i],mobileVList[i]));
                }
            }
            var selt = $("<select/>",{
                class:"ws-tablet-res"
            });
            for (let i = 0; i < mobileVList.length; i++) {
                if(tabletView != "undefined" && mobileVList[i] == tabletView){
                    selt.append(new Option(mobileVList[i],mobileVList[i],true,true));
                }else{
                    selt.append(new Option(mobileVList[i],mobileVList[i]));
                }
            }
        
            var whMob = $("<div/>",{
                class:"ws-mobile-view"
            });
            var tab = $("<div/>",{
                class:"ws-tablet-view"
            });
            whMob.append("Mobile Size");
            whMob.append(selm);
            tab.append("Tablet Size");
            tab.append(selt);

            var DisMob = $("<div/>",{
                class:"ws-responsive-view"
            });
            DisMob.append(whMob);
            DisMob.append(tab);
        return DisMob;
        
    }
    
    function getAlignment(){

        var curCss = __current_col_edit.attr("data-meta-css");
        if(typeof(curCss) != "undefined" ){
            curCss = JSON.parse(__current_col_edit.attr("data-meta-css"));
        }else{
            curCss = {};
        }
            var alignmentList = ["center","left","right","end","inherit","revert","unset"];
            var sel = $("<select/>",{
                class:"ws-align-text"
            });
            for (let i = 0; i < alignmentList.length; i++) {
                if(curCss["text-align"] != "undefined" && alignmentList[i] == curCss["text-align"]){
                    sel.append(new Option(alignmentList[i],alignmentList[i],true,true));
                }else{
                    sel.append(new Option(alignmentList[i],alignmentList[i]));
                }
            }
        
            var wh = $("<div/>",{
                class:"ws-aligment"
            });
        wh.append("Content align");
        wh.append(sel);
        return wh;
        
    }
    function borderSetting(){
        
        var curCss = __current_col_edit.attr("data-meta-css");
        if(typeof(curCss) != "undefined" ){
            curCss = JSON.parse(__current_col_edit.attr("data-meta-css"));
        }else{
            curCss = {};
        }
        console.log(curCss);
        var borList = $("<div/>",{
            class:"ws-border-setting"
        });
        var bList = ["none","dotted","dashed","solid","double","groove","ridge","inset","outset"];
        var sel = $("<select/>",{
            class:"ws-border-type"
        });
        for (let i = 0; i < bList.length; i++) {
            if(curCss["border-style"] != "undefined" && bList[i] == curCss["border-style"]){
                sel.append(new Option(bList[i],bList[i],true,true));
            }else{
                sel.append(new Option(bList[i],bList[i]));
            }
        }
        borList.append(sel);

        if(typeof(curCss["border-color"]) != 'undefined'){
            var cor = curCss["border-color"];
        }else{
            var cor = "#000000";
        }
        
        var color = $("<input/>",{
            type:"text",
            value:cor,
            class:"ws-picker",
        });
        borList.append(color);
        colorPicker(color);
        return borList;
        
    }
    function backgroundSetting(isImage){
        
        var backList = $("<div/>",{
            class:"ws-background-setting"
        });
        var curCss = __current_col_edit.attr("data-meta-css");
        if(typeof(curCss) != "undefined" ){
            curCss = JSON.parse(__current_col_edit.attr("data-meta-css"));
        }else{
            curCss = {};
        }

        if(typeof(curCss["background-color"]) != 'undefined'){
            var cor = curCss["background-color"];
        }else{
            var cor = "#000000";
        }
        if(typeof(curCss["color"]) != 'undefined'){
            var corr = curCss["color"];
        }else{
            var corr= "#000000";
        }
        if(typeof(curCss["background-image"]) != 'undefined'){
            var bgimg = curCss["background-image"];
        }else{
            var bgimg= "";
        }

        var iscolor = $("<input/>",{
            id:"isbackground",
            type:"checkbox",
            class:"ws-picker-bgcheck",
        });

        var color = $("<input/>",{
            type:"text",
            value:cor,
            class:"ws-picker-bg backgroundColor",
        });
        if(isImage == true){
            var img = $("<input/>",{
                type:"text",
                value:bgimg,
                class:"ws-bg-image backgroundImage",
            });

            var bgPosList = ["center","inherit","initial","left","revert","right","unset"];
            var selx = $("<select/>",{
                class:"ws-bg-x"
            });
            for (let i = 0; i < bgPosList.length; i++) {
                if(typeof(curCss["background-position-x"]) != "undefined" && bgPosList[i] == curCss["background-position-x"]){
                    selx.append(new Option(bgPosList[i],bgPosList[i],true,true));
                }else{
                    selx.append(new Option(bgPosList[i],bgPosList[i]));
                }
            }
            var sely = $("<select/>",{
                class:"ws-bg-y"
            });
            for (let i = 0; i < bgPosList.length; i++) {
                if(typeof(curCss["background-position-y"]) != "undefined" && bgPosList[i] == curCss["background-position-y"]){
                    sely.append(new Option(bgPosList[i],bgPosList[i],true,true));
                }else{
                    sely.append(new Option(bgPosList[i],bgPosList[i]));
                }
            }
            var bgsize = ["auto","contain","cover","inherit","initial","revert","unset"];
            var selsize = $("<select/>",{
                class:"ws-bg-size"
            });
            for (let i = 0; i < bgsize.length; i++) {
                if(typeof(curCss["background-size"]) != "undefined" && bgsize[i] == curCss["background-size"]){
                    selsize.append(new Option(bgsize[i],bgsize[i],true,true));
                }else{
                    selsize.append(new Option(bgsize[i],bgsize[i]));
                }
            }
            var selrepeat = $("<input/>",{
                type:"checkbox",
                class:"ws-bg-repeat"
            });
            if(typeof(curCss["background-repeat"]) != "undefined" && curCss["background-repeat"] !=""){
                
                selrepeat.prop("checked", true); 
                
            }else{
                selrepeat.prop("checked", false); 
            }

        }
        var txtcolor = $("<input/>",{
            type:"text",
            value:corr,
            class:"ws-picker-text textColor",
        });
        
        backList.append("None background");
        backList.append(iscolor);
        if(isImage == true){
            backList.append("<br/>Background image<br/>");
            backList.append(img);
            backList.append("<br/>Background poition x<br/>");
            backList.append(selx);
            backList.append("<br/>Background poition y<br/>");
            backList.append(sely);
            backList.append("<br/>Background size<br/>");
            backList.append(selsize);
            backList.append("<br/>Is Background Repeat<br/>");
            backList.append(selrepeat);
        }
        backList.append(color);
        backList.append("<br/>Text Color<br/>");
        backList.append(txtcolor);
        colorPicker(color);
        colorPicker(txtcolor);
        return backList;
    }
    
    function colorPicker(obj){
        
        obj.minicolors({
            change: function(value, opacity) {
              if( !value ) return;
              if( opacity ) value += ', ' + opacity;
              if( typeof console === 'object' ) {
              }
            },
            theme: 'bootstrap'
          });
    }
    settings.nextbtn.on("click",showNextImage);
    
    $("body").on("click",".ws-element-list",function(){
    });
    $("body").on("click",".addRow",function(e){
       e.stopImmediatePropagation();
       $(".ws-playground").append(setItemPreview("row"));
        $( ".ws-playground" ).sortable({
            items: '.rowData',
        });
    });
    $("body").on("click",".col-action",function(e){
        e.stopImmediatePropagation();
        editColSetting(e,"col");
    });
    
    $("body").on("click",".row-action",function(e){
        e.stopImmediatePropagation();
        var act = $(this).attr("data-action");
        switch (act) {
            case "edit":{
                editColSetting(e,"row");
                break;
            }
            case "delete":{
                deleteRow(e);
            }
            default:
                break;
        }
        
    });
    
    
    // arrange the columns
    $("body").on("click",".col-type",function(e){
        e.stopImmediatePropagation();
        var columntype = $(this).data("column");
        if(typeof(columntype) != "undefined"){
            var rowSection = $(this).closest(".rowData");
            var rowNo = rowSection.attr("data-count");
            var innerwrapper = rowSection.find(".ws-element-wrapper");
            performColumnsArrgements(innerwrapper,columntype);
            $(".ws-row-col").droppable( {
                hoverClass: "ws-hovered",
                drop: handleDropEvent
            });
        }
     });

    function showNextImage(){
        settings.setupPlayground.call();
    }
    __elementsfn['heading'] = function () { 
        playgroundElements.find(".element-list").append("<span class='ws-element-list' data-type='heading'><div class='icon'><span class='material-icons'>h_mobiledata</span></div><div class='text'>Heading</div></span>");
        setupDragable();
    };
    __elementsfn['paragraph'] = function() { 
        playgroundElements.find(".element-list").append("<span class='ws-element-list' data-type='paragraph'><div class='icon'><span class='material-icons'>format_align_left</span></div><div class='text'>Paragraph</div></span>");
        setupDragable();
    };
    __elementsfn['image'] = function() { 
        playgroundElements.find(".element-list").append("<span class='ws-element-list' data-type='image'><div class='icon'><span class='material-icons'>insert_photo</span></div><div class='text'>image</div></span>");
        setupDragable();
    };
    __elementsfn['button'] = function() { 
        playgroundElements.find(".element-list").append("<span class='ws-element-list' data-type='button'><div class='icon'><span class='material-icons'>smart_button</span></div><div class='text'>Button</div></span>");
        setupDragable();
    };
    __elementsfn['link'] = function() { 
        playgroundElements.find(".element-list").append("<span class='ws-element-list' data-type='link'><div class='icon'><span class='material-icons'>link</span></div><div class='text'>Link</div></span>");
        setupDragable();
    };
    __elementsfn['video'] = function() { 
        playgroundElements.find(".element-list").append("<span class='ws-element-list' data-type='video'><div class='icon'><span class='material-icons'>videocam</span></div><div class='text'>Video</div></span>");
        setupDragable();
    };
    __elementsfn['social'] = function() { 
        playgroundElements.find(".element-list").append("<span class='ws-element-list' data-type='social'><div class='icon'><span class='material-icons'>share</span></div><div class='text'>Social</div></span>");
        setupDragable();
    };
    __elementsfn['customHtml'] = function() { 
        playgroundElements.find(".element-list").append("<span class='ws-element-list' data-type='customHtml'><div class='icon'><span class='material-icons'>code</span></div><div class='text'>HTML Code</div></span>");
        setupDragable();
    };
    __elementsfn['row'] = function() {
        playgroundElements.find(".layout-list").append("<span class='ws-element-list addRow' data-type='row'><div class='icon'><span class='material-icons'>link</span></div><div class='text'>Row</div></span>");
        setupDragable();
    };
    
    function setupDragable() {
        $("body").find(".ws-element-list").draggable({
        cursor: 'move',
        containment: 'document',
        helper:addElement,
        stop: handleDragStop,
        });
        // for moveable sections
        $("body").find(".ws-right-actions").draggable();
    }
    function setupDropable() {
        $("body").find(".ws-row-col").droppable({
            hoverClass: "ws-hovered",
            drop: handleDropEvent
        });
        $( ".ws-row-col" ).sortable({
            connectWith: ".ws-row-col",
            cancel: ".ws-col-header",
            change: function(event, ui) {
                //var currentClass = $(ui.placeholder)[0].classList[0];
                //alert(currentClass);
                //if (!$(ui.placeholder).prev().hasClass(currentClass) && !$(ui.placeholder).next().hasClass(currentClass))
                //  return false;
              }
          });
    }
    
    function addElement(e){
        //console.log("selected element"+$(e.currentTarget).attr("data-type"));
        return getItemPreview($(e.currentTarget).attr("data-type"));
    }
    
    function handleDragStop(){
        //alert('<div id="draggableHelper">I am a helper - drag me!</div>');
    }
    
    function handleDropEvent(event,ui){
        var doDrag = $(ui.draggable).attr("data-act");
        if(typeof(doDrag) == "undefined"){
            if((ui.draggable).attr("data-type") !="row"){
                var ht = setItemPreview($(ui.draggable).attr("data-type"))
                $(this).append(ht);
                setupDropable();
            }
        }
    }
    function deleteRow(e){
        $(e.currentTarget).closest(".rowData").remove();
    }

    // create dragable item preview
    function getItemPreview(type){

        switch(type){
            case 'heading':{
                return "<div class='ws-preview-items' data-type='heading'><h1>Heading</h1></div>";
                break;
            }
            case 'paragraph':{
                return "<div class='ws-preview-items' data-type='paragraph'><strong>What is Lorem Ipsum?</strong>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>";
                break;
            }
            case 'image':{
                return "<div class='ws-preview-items' data-type='image'><h1>Image</h1></div>";
                break;
            }
            case 'button':{
                return "<div class='ws-preview-items' data-type='button'><h1>Button</h1></div>";
                break;
            }
            case 'link':{
                return "<div class='ws-preview-items' data-type='link'><h1>Link</h1></div>";
                break;
            }
            case 'video':{
                
                return "<div class='ws-preview-items' data-type='video'><span class='material-icons'>videocam</span></div>";
                break;
            }
            case 'social':{
                
                return "<div class='ws-preview-items' data-type='social'><span class='material-icons'>share</span></div>";
                break;
            }
            case 'customHtml':{
                
                return "<div class='ws-preview-items' data-type='customHtml'><span class='material-icons'>code</span></div>";
                break;
            }
            
            case 'row':{
                return "<div class='ws-preview-items' data-type='row'><h1>row</h1></div>";
                break;
            }
        }
    }

    // create dragable item
    function setItemPreview(type){
        var d = new Date();
        var n = d.getTime();
        var newId = "ws_"+n;
        var ediDetails = '<div class="row-action-header"><span data-action="edit" class="row-action material-icons">edit</span><span data-action="delete" class="row-action material-icons">close</span></div>';

        switch(type){
            case 'heading':{
                return "<div class='ui-state-default' data-type='heading'><h1>Heading</h1></div>";
                break;
            }
            case 'paragraph':{
                
                return "<div id='"+newId+"' class='paragraph-text ws-data-element ui-state-default' data-act='no-drag' data-type='paragraph'><span class='p-txt'><strong>What is Lorem Ipsum?</strong>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span><span class='elm-action'><a class='wc_control-btn-move' href='#' title='Move Block'><i class='material-icons'>open_with</i></a><a class='wc_control-btn-edit' href='#' title='Edit Block'><i class='material-icons'>edit</i></a><a class='wc_control-btn-del' href='#' title='Remove Block'><i class='material-icons'>close</i></a></span></div>";
                break;
            }
            case 'image':{
                return "<div id='"+newId+"' class='ws-image-link ws-data-element' data-act='no-drag' data-type='image'><span class='material-icons'>insert_photo</span><span class='elm-action'><a class='wc_control-btn-move' href='#' title='Move Image Block'><i class='material-icons'>open_with</i></a><a class='wc_control-btn-edit' href='#' title='Edit Image Block'><i class='material-icons'>edit</i></a><a class='wc_control-btn-del' href='#' title='Remove Image Block'><i class='material-icons'>close</i></a></span></div>";
                break;
            }
            case 'button':{
                return "<div id='"+newId+"' class='ws-button-link ws-data-element' data-act='no-drag' data-type='button'><span class='material-icons'>smart_button</span><span class='elm-action'><a class='wc_control-btn-move' href='#' title='Move Button'><i class='material-icons'>open_with</i></a><a class='wc_control-btn-edit' href='#' title='Edit Button'><i class='material-icons'>edit</i></a><a class='wc_control-btn-del' href='#' title='Remove Button'><i class='material-icons'>close</i></a></span></div>";
                break;
            }
            case 'link':{
                return "<div id='"+newId+"' class='ws-link-text ws-data-element' data-act='no-drag' data-type='link'><span class='material-icons'>link</span><span class='elm-action'><a class='wc_control-btn-move' href='#' title='Move Link'><i class='material-icons'>open_with</i></a><a class='wc_control-btn-edit' href='#' title='Edit Link'><i class='material-icons'>edit</i></a><a class='wc_control-btn-del' href='#' title='Remove Link'><i class='material-icons'>close</i></a></span></div>";
                break;
            }
            case 'video':{
                return "<div id='"+newId+"' class='ws-video-link ws-data-element' data-act='no-drag' data-type='video'><span class='material-icons'>videocam</span><span class='elm-action'><a class='wc_control-btn-move' href='#' title='Move Video BLock'><i class='material-icons'>open_with</i></a><a class='wc_control-btn-edit' href='#' title='Edit Block'><i class='material-icons'>edit</i></a><a class='wc_control-btn-del' href='#' title='Remove Block'><i class='material-icons'>close</i></a></span></div>";
                break;
            }
            case 'social':{
                return "<div id='"+newId+"' class='ws-social-link ws-data-element' data-act='no-drag' data-type='social'><span class='material-icons'>share</span><span class='elm-action'><a class='wc_control-btn-move' href='#' title='Move Social BLock'><i class='material-icons'>open_with</i></a><a class='wc_control-btn-edit' href='#' title='Edit Block'><i class='material-icons'>edit</i></a><a class='wc_control-btn-del' href='#' title='Remove Block'><i class='material-icons'>close</i></a></span></div>";
                break;
            }
            case 'customHtml':{
                return "<div id='"+newId+"' class='ws-customHtml-link ws-data-element' data-act='no-drag' data-type='customHtml'><span class='material-icons'>code</span><span class='elm-action'><a class='wc_control-btn-move' href='#' title='Move HTML BLock'><i class='material-icons'>open_with</i></a><a class='wc_control-btn-edit' href='#' title='Edit Block'><i class='material-icons'>edit</i></a><a class='wc_control-btn-del' href='#' title='Remove Block'><i class='material-icons'>close</i></a></span></div>";
                break;
            }
            
            case 'row':{

                if(__rows !=0){
                    __rows = __rows + 1;
                }else if(parseInt($(".rowData").length) <=0){
                    __rows = __rows + 1;
                }else{
                    __rows = parseInt($(".rowData").length);
                }
                var rowName = "ws-row-data-"+__rows;
                var _col = createColumnSection();
                
                return "<div class='rowData' data-count='"+__rows+"' data-type='row'><div class='rowHeaders'><ul class='act-headers'><li class='col-type move-row'><span class='material-icons'>open_with</span></li><li class='col-type column-selected'></li>"+_col+"</ul>"+ediDetails+"</div><div id='"+rowName+"' class='ws-element-wrapper ws-dropable-items'></div></div>";
                break;
            }
        }
    }

    function createColumnSection(){

        var col = "";
        for (let index = 1; index <= 12; index++) {
            
            col = col + "<li data-column='col-"+index+"' class='col-type moreoption col-type-"+index+"'></li>";
        }
        return col;
    }
    function performColumnsArrgements(element,type){
        
        var __copydata = element.html();
        var tempDiv = $("<div/>",{
            id:"tempTxt"
        });
        element.find(".ws-row-col").each(function() {
            console.log($(this));
            $(this).find(".ws-col-header").remove();
            if($(this).is(':empty')){
                //
            }else{
                var ht = $(this).html();
                tempDiv.append(ht);
            }
            
        });
        
        //console.log(" Data HTML == >");
        //console.log(tempDiv);
        $(element).html("");
                var sizes = __columnsSize[type].size;
                var tcol = sizes.split(",");
                
                jQuery.each(tcol,function(index,value){
                    var rm = Math.floor(Math.random()* 100);
                    var id = "ws-"+new Date().valueOf()+"_"+rm;
                    var cls = 'ws-row-col ws-col-size-'+value+' '+settings.version;
                    var edit = $("<div/>",{
                        class:"ws-col-header"
                    });
                    
                    edit.html('<span data-action="edit" class="col-action material-icons">edit</span>');//<span data-action="delete" class="col-action material-icons">close</span>
                    if(index == 0 ){
                        $('<div />', {
                            id:id,
                            class: cls,
                        }).append(edit).append(tempDiv.html()).appendTo(element);
                    }else{
                        $('<div />', {
                            id:id,
                            class: cls,
                        }).append(edit).appendTo(element);
                        
                    }
                });
    }
    // show row column optons

    // make playground drop able to create new events
    /*$(playground).droppable( {
    hoverClass: "ws-hovered",
    drop: handleDropEvent
    });*/
    
    // setup all playground elements
    setuppPlaygroundElements();
    setupPlayground();
    
    const styleToString = (style) => {
        return Object.keys(style).reduce((acc, key) => (
            acc + key.split(/(?=[A-Z])/).join('-').toLowerCase() + ':' + style[key] + ';'
        ), '');
    };

    // show and hide right side sections
    $("body").on("click",".ws-section-header",function(e){
        e.stopImmediatePropagation();
        var show = $(e.currentTarget).data("show");
        $(".ws-list-view").hide();
        $("."+show).show();
    });

    // make text as editable
    
    $("body").on("click",".wc_control-btn-edit",function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        var colEl = $(e.currentTarget).closest(".ws-data-element");
        var checkType = colEl.attr("data-type");
        
        switch(checkType){
            case "paragraph" :{
                editTextSetting(colEl);
                break;
            }
            case "video" :{
                editVideoSetting(colEl);
                break;
            }
            case "image" :{
                editImageSetting(colEl);
                break;
            }
            case "button" :{
                editButtonSetting(colEl);
                break;
            }
            case "link" :{
                editLinkSetting(colEl);
                break;
            }
            case "social" :{
                editSocialSetting(colEl);
                break;
            }
            case "customHtml" :{
                editHtmlSetting(colEl);
                break;
            }
            
        }
        
    });
    $("body").on("click",".wc_control-btn-del",function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        $(e.currentTarget).closest(".ws-data-element").remove();
    });
    

    // Appying css changes
    $("body").on("keyup",".ws-col-m",function(e){
        e.stopImmediatePropagation();
        var tochange = __margintype[$(this).attr("id")];
        console.log(tochange);
        if(settings.version == "inline"){
            __current_col_edit.css(tochange,$(this).val());
        }

        var metaCss = __current_col_edit.attr("data-meta-css");
        if(metaCss !="" && typeof(metaCss) != "undefined"){
            var metaCss1 = JSON.parse(metaCss);
        }else{
            var metaCss1={};
        }
        if($(this).val() == ""){
            delete metaCss1[tochange];
        }else{
            metaCss1[tochange] = $(this).val();
        }
        __current_col_edit.attr("data-meta-css",JSON.stringify(metaCss1));
        
    });
    // Appying css changes
    $("body").on("keyup",".ws-col-b",function(e){
        e.stopImmediatePropagation();
        var tochange = __bordertype[$(this).attr("id")];
        console.log(tochange);
        if(settings.version == "inline"){
            __current_col_edit.css(tochange,$(this).val());
        }

        var metaCss = __current_col_edit.attr("data-meta-css");
        if(metaCss !="" && typeof(metaCss) != "undefined"){
            var metaCss1 = JSON.parse(metaCss);
        }else{
            var metaCss1={};
        }
        if($(this).val() == ""){
            delete metaCss1[tochange];
        }else{
            metaCss1[tochange] = $(this).val();
        }
        __current_col_edit.attr("data-meta-css",JSON.stringify(metaCss1));
        
    });
    $("body").on("keyup",".ws-col-p",function(e){
        e.stopImmediatePropagation();
        var tochange = __paddingtype[$(this).attr("id")];
        console.log(tochange);
        if(settings.version == "inline"){
            __current_col_edit.css(tochange,$(this).val());
        }
        var metaCss = __current_col_edit.attr("data-meta-css");
        if(metaCss !="" && typeof(metaCss) != "undefined"){
            var metaCss1 = JSON.parse(metaCss);
        }else{
            var metaCss1={};
        }
        if($(this).val() == ""){
            delete metaCss1[tochange];
        }else{
            metaCss1[tochange] = $(this).val();
        }
        __current_col_edit.attr("data-meta-css",JSON.stringify(metaCss1));
        
    });
    $("body").on("keyup",".social-link-txt",function(e){
        e.stopImmediatePropagation();
        
        var type = $(this).attr("data-type");
        if($(this).val() ==""){
            __current_col_edit.attr(dtype,"");
        }else{
            var dtype = "data-"+type;
            __current_col_edit.attr(dtype,$(this).val());
        }
    });
    $("body").on("change",".custom-html",function(e){
        e.stopImmediatePropagation();
        __current_col_edit.find(".custom-html-txt").remove();
        var txt = $(this).val();
        if($(this).val() !=""){
           var tt = $("<div/>",{
               class:"custom-html-txt"
           });
           tt.append(txt);
           __current_col_edit.append(tt);
        }
    });
    $("body").on("change",".row-type",function(e){
        e.stopImmediatePropagation();
        __current_col_edit.closest(".rowData").attr("data-row-type",$(this).val());
    });
    $("body").on("change",".row-type-check",function(e){
        e.stopImmediatePropagation();
        if(this.checked){
            __current_col_edit.closest(".rowData").attr("data-row-type","container-with-row");
        }else{
            __current_col_edit.closest(".rowData").attr("data-row-type",$(".row-type").val());
        }

    });

    $("body").on("change",".ws-scroll-type",function(e){
        e.stopImmediatePropagation();
        var metaCss = __current_col_edit.attr("data-meta-css");
        if(metaCss !="" && typeof(metaCss) != "undefined"){
            var metaCss1 = JSON.parse(metaCss);
        }else{
            var metaCss1={};
        }
        if($(this).val() == "none"){
            delete metaCss1["overflow"];
        }else{
            metaCss1["overflow"] =  $(this).val();  
        }

        __current_col_edit.attr("data-meta-css",JSON.stringify(metaCss1));
    });

    

    $("body").on("change",".ws-border-type",function(e){
        e.stopImmediatePropagation();
        var metaCss = __current_col_edit.attr("data-meta-css");
        if(metaCss !="" && typeof(metaCss) != "undefined"){
            var metaCss1 = JSON.parse(metaCss);
        }else{
            var metaCss1={};
        }
        if($(this).val() == "none"){
            delete metaCss1["border-style"];
        }else{
            metaCss1["border-style"] =  $(this).val();  
        }
        if(settings.version == "inline"){
            __current_col_edit.css("border-style",$(this).val());
        }
        /*
        for (let index = 0; index < 4; index++) {

            var vb = "";
            if(typeof(metaCss1) != "undefined" ){
                if(typeof(metaCss1[__bordertype["ws_b_"+index]]) != "undefined"){
                    console.log("B type ==>",__bordertype["ws_b_"+index]);
                    //vb = metaCss1[__bordertype["ws_b_"+index]];
                    var svb = (metaCss1[__bordertype["ws_b_"+index]]).split(" ");
                    if(settings.version == "inline"){
                        vb =  svb[0]+ " " + $(this).val() +" "+$(".ws-picker").val();
                        metaCss1[__bordertype["ws_b_"+index]] = vb;    
                        
                        __current_col_edit.css(__bordertype["ws_b_"+index],vb);
                    }else{
                        vb =  svb[0]+ " " + $(this).val() +" "+$(".ws-picker").val();
                        metaCss1[__bordertype["ws_b_"+index]] = vb;    
                    }
                    console.log(metaCss1);
                }
            }
        }*/
        __current_col_edit.attr("data-meta-css",JSON.stringify(metaCss1));
        
    });

    $("body").on("change",".ws-bg-x",function(e){
        e.stopImmediatePropagation();
        var metaCss = __current_col_edit.attr("data-meta-css");
        if(metaCss !="" && typeof(metaCss) != "undefined"){
            var metaCss1 = JSON.parse(metaCss);
        }else{
            var metaCss1={};
        }
        if($(this).val() == "none"){
            delete metaCss1["background-position-x"];
        }else{
            metaCss1["background-position-x"] =  $(this).val();  
        }
        if(settings.version == "inline"){
            __current_col_edit.css("background-position-x",$(this).val());
        }
        __current_col_edit.attr("data-meta-css",JSON.stringify(metaCss1));
        
    });

    $("body").on("change",".ws-bg-y",function(e){
        e.stopImmediatePropagation();
        var metaCss = __current_col_edit.attr("data-meta-css");
        if(metaCss !="" && typeof(metaCss) != "undefined"){
            var metaCss1 = JSON.parse(metaCss);
        }else{
            var metaCss1={};
        }
        if($(this).val() == "none"){
            delete metaCss1["background-position-y"];
        }else{
            metaCss1["background-position-y"] =  $(this).val();  
        }
        if(settings.version == "inline"){
            __current_col_edit.css("background-position-y",$(this).val());
        }
        __current_col_edit.attr("data-meta-css",JSON.stringify(metaCss1));
        
    });

    $("body").on("change",".ws-align-text",function(e){
        e.stopImmediatePropagation();
        var metaCss = __current_col_edit.attr("data-meta-css");
        if(metaCss !="" && typeof(metaCss) != "undefined"){
            var metaCss1 = JSON.parse(metaCss);
        }else{
            var metaCss1={};
        }
        if($(this).val() == "none"){
            delete metaCss1["text-align"];
        }else{
            metaCss1["text-align"] =  $(this).val();  
        }
        if(settings.version == "inline"){
            __current_col_edit.css("text-align",$(this).val());
        }
        __current_col_edit.attr("data-meta-css",JSON.stringify(metaCss1));
        
    });
    
    $("body").on("change",".ws-mobile-res",function(e){
        e.stopImmediatePropagation();
        __current_col_edit.attr("data-mobile",$(this).val());
        
    });
    $("body").on("change",".ws-tablet-res",function(e){
        e.stopImmediatePropagation();
        __current_col_edit.attr("data-tablet",$(this).val());
        
    });
    
    $("body").on("change",".ws-picker",function(){
        
        var metaCss = __current_col_edit.attr("data-meta-css");
        console.log(__current_col_edit);
        if(metaCss !="" && typeof(metaCss) != "undefined"){
            var metaCss1 = JSON.parse(metaCss);
        }else{
            var metaCss1={};
        }
        metaCss1["border-color"] =  $(this).val();  
        console.log(metaCss1);
        if(settings.version == "inline"){
            __current_col_edit.css("border-color",$(this).val());
        }
        
        /*
        for (let index = 0; index < 4; index++) {

            var vb = "";
            if(typeof(metaCss1) != "undefined" ){
                if(typeof(metaCss1[__bordertype["ws_b_"+index]]) != "undefined"){
                    
                    var svb = (metaCss1[__bordertype["ws_b_"+index]]).split(" ");
                    
                    if(settings.version == "inline"){
                        if(typeof(svb[1]) != "undefined" && svb.length >= 3){
                            vb =  svb[0] + " " + svb[1] +" "+$(this).val();
                        }else{""
                            vb =  svb[0]+" "+$(".ws-border-type").val()+" "+ $(this).val();
                        }
                        console.log(vb);
                        metaCss1[__bordertype["ws_b_"+index]] = vb;
                        __current_col_edit.css(__bordertype["ws_b_"+index],vb);
                    }
                }
            }
        }*/
        __current_col_edit.attr("data-meta-css",JSON.stringify(metaCss1));
        
    });
    $("body").on("change",".ws-picker-bg",function(){
        var metaCss = __current_col_edit.attr("data-meta-css");
        console.log(__current_col_edit);
        if(metaCss !="" && typeof(metaCss) != "undefined"){
            var metaCss1 = JSON.parse(metaCss);
        }else{
            var metaCss1={};
        }
        if ($("#isbackground").is(":checked")) {
            metaCss1["background-color"] = "";
        }else{
            metaCss1["background-color"] = $(this).val();
        }

        __current_col_edit.attr("data-meta-css",JSON.stringify(metaCss1));    
        
    });
    $("body").on("change",".ws-picker-text",function(){
        var metaCss = __current_col_edit.attr("data-meta-css");
        console.log(__current_col_edit);
        if(metaCss !="" && typeof(metaCss) != "undefined"){
            var metaCss1 = JSON.parse(metaCss);
        }else{
            var metaCss1={};
        }
        metaCss1["color"] = $(this).val();
        

        __current_col_edit.attr("data-meta-css",JSON.stringify(metaCss1));    
        
    });
    $("body").on("change",".ws-bg-image",function(){
        var metaCss = __current_col_edit.attr("data-meta-css");
        console.log(__current_col_edit);
        if(metaCss !="" && typeof(metaCss) != "undefined"){
            var metaCss1 = JSON.parse(metaCss);
        }else{
            var metaCss1={};
        }
        metaCss1["background-image"] = "url("+$(this).val()+")";
        

        __current_col_edit.attr("data-meta-css",JSON.stringify(metaCss1));    
        
    });
    
    $("body").on("change",".ws-video-url",function(){
        __current_col_edit.attr("data-url",$(this).val());
    });
    $("body").on("change",".ws-image-url",function(){
        __current_col_edit.attr("data-url",$(this).val());
    });
    $("body").on("change",".ws-image-link",function(){
        __current_col_edit.attr("data-link",$(this).val());
    });
    $("body").on("change",".ws-image-alt",function(){
        __current_col_edit.attr("data-alt",$(this).val());
    });
    $("body").on("change",".ws-button-link",function(){
        __current_col_edit.attr("data-link",$(this).val());
    });
    $("body").on("change",".ws-button-title",function(){
        __current_col_edit.attr("data-alt",$(this).val());
    });
    $("body").on("change",".ws-link-text",function(){
        __current_col_edit.attr("data-link",$(this).val());
    });
    $("body").on("change",".ws-link-title",function(){
        __current_col_edit.attr("data-alt",$(this).val());
    });

   
    
    
    $("body").on("change","#ws-element-width",function(){
        __current_col_edit.attr("data-width",$(this).val());

        var metaCss = __current_col_edit.attr("data-meta-css");
        console.log(__current_col_edit);
        if(metaCss !="" && typeof(metaCss) != "undefined"){
            var metaCss1 = JSON.parse(metaCss);
        }else{
            var metaCss1={};
        }
        metaCss1["width"] = $(this).val();
        __current_col_edit.attr("data-meta-css",JSON.stringify(metaCss1));    

    });
    $("body").on("change","#ws-element-height",function(){
        __current_col_edit.attr("data-height",$(this).val());
       
        var metaCss = __current_col_edit.attr("data-meta-css");
        console.log(__current_col_edit);
        if(metaCss !="" && typeof(metaCss) != "undefined"){
            var metaCss1 = JSON.parse(metaCss);
        }else{
            var metaCss1={};
        }
        metaCss1["height"] = $(this).val();
        __current_col_edit.attr("data-meta-css",JSON.stringify(metaCss1));    

    });
    $("body").on("change",".ws-bg-repeat",function(){
        var metaCss = __current_col_edit.attr("data-meta-css");
        console.log(__current_col_edit);
        if(metaCss !="" && typeof(metaCss) != "undefined"){
            var metaCss1 = JSON.parse(metaCss);
        }else{
            var metaCss1={};
        }
        metaCss1["background-repeat"] = $(this).val();
        __current_col_edit.attr("data-meta-css",JSON.stringify(metaCss1));    

    });
    $("body").on("change",".addCss",function(){
        __current_col_edit.attr("data-add-css",$(this).val());        
    });

    savebtn.on("click",function(els){
        var allCss = "";
        temptemplate.html($(".playgrounddiv").html());
        temptemplate.find(".rowHeaders").remove();
        temptemplate.find(".elm-action").remove();
        temptemplate.find(".ws-col-header").remove();
        //temptemplate.find(".rowData").addClass("container");
        temptemplate.find(".ws-element-wrapper").addClass("row");
        //temptemplate.find(".rowData").addClass("container");
        temptemplate.find(".rowData").removeClass("row");
        temptemplate.find(".rowData").each(function(e){
            var tt = $(this).attr("data-row-type");
            $(this).removeClass("container-fluid");
            $(this).removeClass("container");
            var acss = $(this).attr("data-add-css");
            if(typeof(acss) != "undefined"  && acss != ""){
                $(this).addClass(acss);
            }
            if(typeof(tt) == "undefined"  || tt == ""){
                    $(this).addClass("container-fluid");    
            }else{

                if(tt == "container-with-row"){
                    var rels = $("<div/>",{
                        class:"container"
                    });
                    rels.append($(this).html());
                    $(this).empty();
                    $(this).addClass("container-fluid");
                    $(this).append(rels);
                }else{
                    $(this).addClass(tt);
                }
            }

        });
        temptemplate.find(".ws-row-col").each(function(e){
            //$(this).addClass("row");
            // check mobile and tablet view
            var mobileView = $(this).attr("data-mobile");
            var tabletView = $(this).attr("data-tablet"); 
           
            
            
            var csfull = $(this).attr("data-meta-css");
            var css = "";
            if(typeof(csfull) != "undefined"){
                var css = "."+$(this).attr("id")+" {" + styleToString(JSON.parse($(this).attr("data-meta-css")))+ "} ";
            }
            var btClass="";
            for (let index = 1; index <= 12; index++) {
                var cc = "ws-col-size-"+index;
                if($(this).hasClass(cc)){
                    console.log($(this).attr("class"));
                    btClass = "col-lg-"+index;
                }else{
                    console.log("no class");
                }
            }
            if(typeof(mobileView) != "undefined" && mobileView !="select"){
                
                if(mobileView == "none"){
                    
                    btClass = btClass+" d-none d-sm-block d-md-block";
                }else{
                    btClass = btClass+" "+__coltypeMob[""+mobileView];
                }

            }
            if(typeof(tabletView) != "undefined" && tabletView !="select"){
                if(tabletView == "none"){
                    btClass = btClass+" d-none d-md-block d-lg-block";
                }else{
                    btClass = btClass+" "+__coltypTab[""+tabletView];
                }
            }

            $(this).removeClass();
            $(this).addClass(btClass);
            $(this).addClass($(this).attr("id"));
            allCss = allCss+css;
            var acss = $(this).attr("data-add-css");
            if(typeof(acss) != "undefined"  && acss != ""){
                $(this).addClass(acss);
            }
            
            $(this).removeAttr("data-add-css");
            $(this).removeAttr("data-meta-css");
        });
        
        temptemplate.find(".ws-element-wrapper").each(function(e){
            var csfull = $(this).attr("data-meta-css");
            var css = "";
            
            
            if(typeof(csfull) != "undefined"){
                var css = "."+$(this).attr("id")+" { " + styleToString(JSON.parse($(this).attr("data-meta-css")))+ " } ";
            }
            $(this).removeClass();
            var rlccss = $(this).attr("id") + " row";
            $(this).closest(".rowData").addClass(rlccss);
            $(this).closest(".rowData").removeClass("row");
            $(this).addClass("row");
            allCss = allCss+css;
            var acss = $(this).attr("data-add-css");
            if(typeof(acss) != "undefined"  && acss != ""){
                //$(this).addClass(acss);
                $(this).closest(".rowData").addClass(acss);
            }
            $(this).removeAttr("data-add-css");
            $(this).removeAttr("data-meta-css");
        });

        temptemplate.find(".paragraph-text").each(function(e){
            var csfull = $(this).attr("data-meta-css");
            var css = "";
            if(typeof(csfull) != "undefined"){
                var css = "."+$(this).attr("id")+" { " + styleToString(JSON.parse($(this).attr("data-meta-css")))+ " } ";
            }
            $(this).removeClass();
            $(this).addClass($(this).attr("id"));
            allCss = allCss+css;
            var acss = $(this).attr("data-add-css");
            if(typeof(acss) != "undefined"  && acss != ""){
                //$(this).addClass(acss);
                $(this).addClass("row");
            }
            $(this).removeAttr("data-add-css");
            $(this).removeAttr("data-meta-css");
        });

        // video extract
        temptemplate.find(".ws-video-link").each(function(e){
            var csfull = $(this).attr("data-meta-css");
            var css = "";
            
            if(typeof(csfull) != "undefined"){
                
                var ss = JSON.parse($(this).attr("data-meta-css"));
                delete ss["width"];
                delete ss["height"];
                console.log("asdasd asd");
                console.log(ss);
                var css = "."+$(this).attr("id")+" { " + styleToString(ss)+ " } ";
            }
            $(this).removeClass();
            $(this).addClass($(this).attr("id"));
            allCss = allCss+css;
            $(this).removeAttr("data-meta-css");
            var acss = $(this).attr("data-add-css");
            if(typeof(acss) != "undefined"  && acss != ""){
                $(this).addClass(acss);
            }
            $(this).removeAttr("data-add-css");
            var ifm = $("<iframe>",{
                width:$(this).attr('data-width'),
                height:$(this).attr('data-height'),
                src:$(this).attr('data-url'),
            });
            $(this).empty();
            $(this).append(ifm);

        });

        // image  extract
        temptemplate.find(".ws-image-link").each(function(e){
            var csfull = $(this).attr("data-meta-css");
            var css = "";
            if(typeof(csfull) != "undefined"){
                var css = "."+$(this).attr("id")+" { " + styleToString(JSON.parse($(this).attr("data-meta-css")))+ " } ";
            }

            $(this).removeClass();
            $(this).addClass($(this).attr("id"));
            allCss = allCss+css;
            $(this).removeAttr("data-meta-css");
            var acss = $(this).attr("data-add-css");
            if(typeof(acss) != "undefined"  && acss != ""){
                $(this).addClass(acss);
            }
            $(this).removeAttr("data-add-css");
            var img = $("<image>",{
                width:$(this).attr('data-width'),
                height:$(this).attr('data-height'),
                src:$(this).attr('data-url'),
                alt:$(this).attr('data-alt'),
            });
            var islink = $(this).attr('data-link');
            if(islink != ""){
                var link = $("<a>",{
                    href:$(this).attr('data-link'),
                    title:$(this).attr('data-alt'),
                });
                link.append(img);
                $(this).empty();
                $(this).append(link);
            }else{
                $(this).empty();
                $(this).append(img);
            }
            

        });
        // button  extract
        temptemplate.find(".ws-button-link").each(function(e){
            var csfull = $(this).attr("data-meta-css");
            var css = "";
            if(typeof(csfull) != "undefined"){
                var css = "."+$(this).attr("id")+" { " + styleToString(JSON.parse($(this).attr("data-meta-css")))+ " } ";
            }
            $(this).removeClass();
            //$(this).addClass($(this).attr("id"));
            allCss = allCss+css;
            $(this).removeAttr("data-meta-css");
            var acss = $(this).attr("data-add-css");
            if(typeof(acss) != "undefined"  && acss != ""){
                $(this).addClass(acss);
            }
            $(this).removeAttr("data-add-css");
            var btn = $("<button>",{
                width:$(this).attr('data-width'),
                height:$(this).attr('data-height'),
                onclick:"location.href='"+$(this).attr('data-link')+"';",
                title:$(this).attr('data-alt'),
            });
            btn.append($(this).attr('data-alt'));
            btn.addClass($(this).attr("id"));
            $(this).empty();
            $(this).append(btn);

        });
        // button  extract
        temptemplate.find(".ws-link-text").each(function(e){
            var csfull = $(this).attr("data-meta-css");
            var css = "";
            if(typeof(csfull) != "undefined"){
                var css = "."+$(this).attr("id")+" { " + styleToString(JSON.parse($(this).attr("data-meta-css")))+ " } ";
            }
            $(this).removeClass();
            $(this).addClass($(this).attr("id"));
            allCss = allCss+css;
            $(this).removeAttr("data-meta-css");
            var acss = $(this).attr("data-add-css");
            if(typeof(acss) != "undefined"  && acss != ""){
                $(this).addClass(acss);
            }
            $(this).removeAttr("data-add-css");
            var link = $("<a>",{
                href:$(this).attr('data-link'),
                title:$(this).attr('data-alt'),
            });
            link.append($(this).attr('data-alt'));
            $(this).empty();
            $(this).append(link);

        });
        temptemplate.find(".ws-customHtml-link").each(function(e){
            $(this).find(".material-icons").remove();
        });
        
        // social  extract
        temptemplate.find(".ws-social-link").each(function(e){
            var csfull = $(this).attr("data-meta-css");
            var css = "";
            if(typeof(csfull) != "undefined"){
                var css = "."+$(this).attr("id")+" { " + styleToString(JSON.parse($(this).attr("data-meta-css")))+ " } ";
            }
            $(this).removeClass();
            $(this).addClass($(this).attr("id"));
            allCss = allCss+css;
            $(this).removeAttr("data-meta-css");
            var allLink = $("<div/>",{
                class:"social-link"
            });
            var acss = $(this).attr("data-add-css");
            if(typeof(acss) != "undefined"  && acss != ""){
                $(this).addClass(acss);
            }
            $(this).removeAttr("data-add-css");
            //check for FB
            var fblink = $(this).attr("data-fb");
            if(typeof(fblink) != "undefined" && fblink !=""){

                var link = $("<a>",{
                    href:fblink,
                    title:"FaceBook",
                });
                link.append('<i class="fab fa-2x fa-facebook"></i>');
                allLink.append(link);
            }
            //check for Twiiter
            var twlink = $(this).attr("data-tw");
            if(typeof(twlink) != "undefined" && twlink !=""){

                var link = $("<a>",{
                    href:twlink,
                    title:"Twiiter",
                });
                link.append('<i class="fab fa-2x fa-twitter"></i>');
                allLink.append(link);
            }
            //check for Instagram
            var insta = $(this).attr("data-insta");
            if(typeof(insta) != "undefined" && insta !=""){

                var link = $("<a>",{
                    href:insta,
                    title:"Twiiter",
                });
                link.append('<i class="fab fa-2x fa-instagram"></i>');
                allLink.append(link);
            }
            //Check for Linkedin
            var linkin = $(this).attr("data-linkin");
            if(typeof(linkin) != "undefined" && linkin !=""){

                var link = $("<a>",{
                    href:linkin,
                    title:"Linked In",
                });
                link.append('<i class="fab fa-2x fa-linkedin"></i>');
                allLink.append(link);
            }
            $(this).empty();
            $(this).append(allLink);

        }); 

        console.log(temptemplate.html());
        console.log(allCss);
        console.log(els);
        var ob=[] ; 
        ob["els"] = els;
        ob["css"] = allCss;
        settings.HTMLUpdate.call(this,ob);
    });
    
    
};
}( jQuery ));
