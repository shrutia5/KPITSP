$.fn.digits = function(){ 
    return this.each(function(){ 
      $(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") ); 
  })
  }
  $(document).ready(function() {
  
     
  
      var height = $(window).height();
      $( ".overflow-hidden" ).css("max-height",height-100);
      $( ".overflow-hidden" ).css("height",height-100);
      
      $(window).on('hashchange', function(e){
          setsidbar();
          var height = $(window).height();
          $(".overflow-hidden").css("max-height",height-100);
          $(".overflow-hidden").css("height",height-100);
          $(".overflow-hidden").css("overflow-x","scroll");
          setTimeout(function(){
              $(".overflow-hidden").css("max-height",height-100);
              $(".overflow-hidden").css("height",height-100);
              $(".overflow-hidden").css("overflow-x","scroll");
          }, 2000);
      });
      
      $(window).resize(function(){
          var height = $(window).height();
          $(".overflow-hidden").css("max-height",height-100);
          $(".overflow-hidden").css("height",height-100);
      });
  
      $("body").on("click",".item-container li",function(){
  
          var isSingle = $(this).attr("data-single");
          var validFor = $(this).parent().attr("data-valid");
          if(isSingle =="Y")
          {
              console.log(validFor);
              $(".item-container li."+validFor).removeClass("active");
              $(this).addClass("active");
          }
          else
          {
              $(this).toggleClass("active");
          }
  
      });
        if ($("input.flat")[0]) {
          $(document).ready(function () {
              $('input.flat').iCheck({
                  checkboxClass: 'icheckbox_flat-green',
                  radioClass: 'iradio_flat-green'
              });
          });
      }
      $("body").on("click",".checkall",function(){
          var id = $(this).attr("data-tocheck");
          if($(this).is(":checked"))
          {
              $('#'+id+' input:checkbox').each(function(){
                  $(this).prop("checked", true );
                  $(this).closest("div").addClass("active");
              });
  
          }else{
              $('#'+id+' input:checkbox').each(function(){
                  $(this).prop("checked", false );
                  $(this).closest("div").removeClass("active");
              });
          }
      });
      $(document).on('change', 'input[type="checkbox"]', function(e){
  
        if(!$(this).hasClass("checkall")){
          
          if($(this).is(":checked")){
            $(this).closest("div").addClass("active");
          }else{
            $(this).closest("div").removeClass("active");
          }
        }
      });
  });
    getLocalData = function() {
  
      console.log("sdfsfsfdsdfsdffsd");
      if (typeof(Storage) == "undefined") {
          alert("Sorry! Your browser not support web storage. Some functionality may not work.Please Update your browser with latest version.");
      }else{
          console.log("OK local storage");
      }
      localStorage.removeItem("roleDetails");
       
  
      if(typeof(localStorage.roleDetails) == "undefined"){
          $.ajax({
            url:APIPATH+'getUserPermission/',
            method:'GET',
            async: false,
            data:{},
            datatype:'JSON',
             beforeSend: function(request){
              request.setRequestHeader("token",$.cookie('_bb_key'));
              request.setRequestHeader("SadminID",$.cookie('authid'));
              request.setRequestHeader("contentType",'application/x-www-form-urlencoded');
              request.setRequestHeader("Accept",'application/json');
            },
            success:function(res){
              if(res.flag == "F"){
                alert(res.msg);
                app_router.navigate("logout",{trigger:true});
              }
              console.log(res.data);
              localStorage.setItem("roleDetails",JSON.stringify(res.data));
                  
              }
          });
      }
    }
  setsidbar = function(){
  
          var CURRENT_URL = window.location.href.split('#')[0].split('?')[0],
          $BODY = $('body'),
          $MENU_TOGGLE = $('#menu_toggle'),
          $SIDEBAR_MENU = $('#sidebar-menu'),
          $SIDEBAR_FOOTER = $('.sidebar-footer'),
          $LEFT_COL = $('.left_col'),
          $RIGHT_COL = $('.right_col'),
          $NAV_MENU = $('.nav_menu'),
          $FOOTER = $('footer');
         // TODO: This is some kind of easy fix, maybe we can improve this
          var setContentHeight = function () {
              // reset height
              $RIGHT_COL.css('min-height', $(window).height());
  
              var bodyHeight = $BODY.outerHeight(),
                  footerHeight = $BODY.hasClass('footer_fixed') ? -10 : $FOOTER.height(),
                  leftColHeight = $LEFT_COL.eq(1).height() + $SIDEBAR_FOOTER.height(),
                  contentHeight = bodyHeight < leftColHeight ? leftColHeight : bodyHeight;
  
              // normalize content
              contentHeight -= $NAV_MENU.height() + footerHeight;
  
              $RIGHT_COL.css('min-height', contentHeight);
          };
          $SIDEBAR_MENU.find('a').off("click");
          $SIDEBAR_MENU.find('a').on('click', function(ev) {
              var $li = $(this).parent();
  
              if ($li.is('.active')) {
                  $li.removeClass('active active-sm');
                  $('ul:first', $li).slideUp(function() {
                      setContentHeight();
                  });
              } else {
                  // prevent closing menu if we are on child menu
                  if (!$li.parent().is('.child_menu')) {
                      $SIDEBAR_MENU.find('li').removeClass('active active-sm');
                      $SIDEBAR_MENU.find('li ul').slideUp();
                  }
                  
                  $li.addClass('active');
  
                  $('ul:first', $li).slideDown(function() {
                      setContentHeight();
                  });
              }
          });
          // toggle small or large menu
          $MENU_TOGGLE.off("click");
          $MENU_TOGGLE.on('click', function() {
              if ($BODY.hasClass('nav-md')) {
                  $SIDEBAR_MENU.find('li.active ul').hide();
                  $SIDEBAR_MENU.find('li.active').addClass('active-sm').removeClass('active');
              } else {
                  $SIDEBAR_MENU.find('li.active-sm ul').show();
                  $SIDEBAR_MENU.find('li.active-sm').addClass('active').removeClass('active-sm');
              }
  
              $BODY.toggleClass('nav-md nav-sm');
  
              setContentHeight();
          });
  
          // check active menu
          $SIDEBAR_MENU.find('a[href="' + CURRENT_URL + '"]').parent('li').addClass('current-page');
  
          $SIDEBAR_MENU.find('a').filter(function () {
              return this.href == CURRENT_URL;
          }).parent('li').addClass('current-page').parents('ul').slideDown(function() {
              setContentHeight();
          }).parent().addClass('active');
          setContentHeight();
          // fixed sidebar
          if ($.fn.mCustomScrollbar) {
              $('.menu_fixed').mCustomScrollbar({
                  autoHideScrollbar: true,
                  theme: 'minimal',
                  mouseWheel:{ preventDefault: true }
              });
          }
          var height = $(window).height();
      }
      //setsidbar();
      setPagging = function(paginginfo,loadstate,msg){
        
        $(".showPageDetails .pagination").empty();
        var showlink = true;
        if(paginginfo.end > paginginfo.totalRecords){
              var recset = "Showing "+(paginginfo.start+1)+" to "+paginginfo.totalRecords+" of "+paginginfo.totalRecords+" entries";
        }
        else{
          var recset = "Showing "+(paginginfo.start+1)+" to "+paginginfo.end+" of "+paginginfo.totalRecords+" entries";
        }
            
        $(".page-info").html(recset);
        // check total page
        var className="";
        var pageSet =16;
        if(showlink){
          var lik = '<li class="paginate_button previous showpage" id="datatable-checkbox_previous" data-dt-idx="'+paginginfo.prevPage+'"><a href="javascript:;">Previous</a></li>';
          $(".showPageDetails .pagination").append(lik);
          var totpage = Math.ceil(paginginfo.totalRecords / paginginfo.pageLimit);
          if(totpage == 1){
            totpage =0;
          }
  
           var cpa = (paginginfo.curPage);
          
          if(paginginfo.prevPage !=0){
            var startto = (cpa - (pageSet /2));
            if(startto < 0){
              startto = 0;
            }
           }else{
            var startto = 0;
           }
          for(var i=startto;i<=(parseInt(cpa)+(pageSet /2));i++){
            if(i < totpage){
              if( i== cpa){
                className = "active";
              }else{
                className = "";
              }
              var lik = '<li class="paginate_button showpage '+className+'" data-dt-idx="'+(i)+'"><a href="javascript:;" aria-controls="datatable-checkbox">'+(i+1)+'</a></li>';
              $(".showPageDetails .pagination").append(lik);
            }
          }
          var lik = '<li class="paginate_button next showpage" id="datatable-checkbox_next" data-dt-idx="'+(paginginfo.nextpage)+'"><a href="javascript:;" aria-controls="datatable-checkbox" tabindex="0">Next</a></li>';
          $(".showPageDetails .pagination").append(lik);
  
        }
        if(cpa == 0){
          $(".showPageDetails .pagination .previous").addClass("disabled"); 
        }
        
        if(loadstate === false){
          $(".showPageDetails .pagination .next").addClass("disabled"); 
          $(".profile-loader-msg").html(msg);
          $(".profile-loader-msg").show();
        }else{
          $(".profile-loader-msg").hide();
          //$(".showPageDetails .pagination .next").show(); 
  
        }
  
  
      }
      numberFormat = function(num,tonm){
        var isn = $.isNumeric(num);
        if(isn){
          console.log(num);
          return Number.parseFloat(num).toFixed(tonm);
        }else{
          return 0.00;
        }
      };
      formatDate = function (date,disTime) {
          
          if(date != "0000-00-00 00:00:00" && date != "0000-00-00" && date != null && date != "") {   
          var monthNames = ["January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"];
          var timezone = "AM";
          var hour = "",minutes = "";
          var d = new Date(date),
              fragments = [
                  d.getHours(),
                  d.getMinutes(),
                  d.getDate(),
                  d.getMonth(),
                  d.getFullYear()
              ];
            if(fragments[0] > 12){
              timezone = "PM";
              hour = ((fragments[0]) - 12);
            }else{
              if(fragments[0]>9){hour = fragments[0]}else{hour = "0"+fragments[0]};
            }
            if(fragments[1] < 9){ minutes = "0"+fragments[1];}else{minutes =fragments[1];}
            if(hour != null &&  minutes != null){
              if(disTime=='yes'){
                  return monthNames[fragments[3]]+" "+fragments[2]+", "+fragments[4]+" "+hour+":"+minutes+" "+timezone;
              }else
              {
                  return monthNames[fragments[3]]+" "+fragments[2]+", "+fragments[4];
              }
            }
            else{
              return monthNames[fragments[3]]+" "+fragments[2]+", "+fragments[4];
            }
          }else
          {
              return "--";
          }
      };
  
      sha1 = function (str){
        //  discuss at: http://phpjs.org/functions/sha1/
        // original by: Webtoolkit.info (http://www.webtoolkit.info/)
        // improved by: Michael White (http://getsprink.com)
        // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
        //    input by: Brett Zamir (http://brett-zamir.me)
        //  depends on: utf8_encode
        //   example 1: sha1('Kevin van Zonneveld');
        //   returns 1: '54916d2e62f65b3afa6e192e6a601cdbe5cb5897'
  
        var rotate_left = function(n, s) {
          var t4 = (n << s) | (n >>> (32 - s));
          return t4;
        };
  
          var cvt_hex = function(val) {
          var str = '';
          var i;
          var v;
  
          for (i = 7; i >= 0; i--) {
            v = (val >>> (i * 4)) & 0x0f;
            str += v.toString(16);
          }
          return str;
        };
  
        var blockstart;
        var i, j;
        var W = new Array(80);
        var H0 = 0x67452301;
        var H1 = 0xEFCDAB89;
        var H2 = 0x98BADCFE;
        var H3 = 0x10325476;
        var H4 = 0xC3D2E1F0;
        var A, B, C, D, E;
        var temp;
  
      // str = this.utf8_encode(str);
        var str_len = str.length;
  
        var word_array = [];
        for (i = 0; i < str_len - 3; i += 4) {
          j = str.charCodeAt(i) << 24 | str.charCodeAt(i + 1) << 16 | str.charCodeAt(i + 2) << 8 | str.charCodeAt(i + 3);
          word_array.push(j);
        }
  
        switch (str_len % 4) {
          case 0:
            i = 0x080000000;
            break;
          case 1:
            i = str.charCodeAt(str_len - 1) << 24 | 0x0800000;
            break;
          case 2:
            i = str.charCodeAt(str_len - 2) << 24 | str.charCodeAt(str_len - 1) << 16 | 0x08000;
            break;
          case 3:
            i = str.charCodeAt(str_len - 3) << 24 | str.charCodeAt(str_len - 2) << 16 | str.charCodeAt(str_len - 1) <<
              8 | 0x80;
            break;
        }
  
        word_array.push(i);
  
        while ((word_array.length % 16) != 14) {
          word_array.push(0);
        }
  
        word_array.push(str_len >>> 29);
        word_array.push((str_len << 3) & 0x0ffffffff);
  
        for (blockstart = 0; blockstart < word_array.length; blockstart += 16) {
          for (i = 0; i < 16; i++) {
            W[i] = word_array[blockstart + i];
          }
          for (i = 16; i <= 79; i++) {
            W[i] = rotate_left(W[i - 3] ^ W[i - 8] ^ W[i - 14] ^ W[i - 16], 1);
          }
  
          A = H0;
          B = H1;
          C = H2;
          D = H3;
          E = H4;
  
          for (i = 0; i <= 19; i++) {
            temp = (rotate_left(A, 5) + ((B & C) | (~B & D)) + E + W[i] + 0x5A827999) & 0x0ffffffff;
            E = D;
            D = C;
            C = rotate_left(B, 30);
            B = A;
            A = temp;
          }
  
          for (i = 20; i <= 39; i++) {
            temp = (rotate_left(A, 5) + (B ^ C ^ D) + E + W[i] + 0x6ED9EBA1) & 0x0ffffffff;
            E = D;
            D = C;
            C = rotate_left(B, 30);
            B = A;
            A = temp;
          }
  
          for (i = 40; i <= 59; i++) {
            temp = (rotate_left(A, 5) + ((B & C) | (B & D) | (C & D)) + E + W[i] + 0x8F1BBCDC) & 0x0ffffffff;
            E = D;
            D = C;
            C = rotate_left(B, 30);
            B = A;
            A = temp;
          }
  
          for (i = 60; i <= 79; i++) {
            temp = (rotate_left(A, 5) + (B ^ C ^ D) + E + W[i] + 0xCA62C1D6) & 0x0ffffffff;
            E = D;
            D = C;
            C = rotate_left(B, 30);
            B = A;
            A = temp;
          }
  
          H0 = (H0 + A) & 0x0ffffffff;
          H1 = (H1 + B) & 0x0ffffffff;
          H2 = (H2 + C) & 0x0ffffffff;
          H3 = (H3 + D) & 0x0ffffffff;
          H4 = (H4 + E) & 0x0ffffffff;
        }
  
        temp = cvt_hex(H0) + cvt_hex(H1) + cvt_hex(H2) + cvt_hex(H3) + cvt_hex(H4);
        return temp.toLowerCase();
      }
      md5 = function (str) {
        var xl;
        var rotateLeft = function (lValue, iShiftBits) {
          return (lValue << iShiftBits) | (lValue >>> (32 - iShiftBits));
        };
        var addUnsigned = function (lX, lY) {
          var lX4, lY4, lX8, lY8, lResult;
          lX8 = (lX & 0x80000000);
          lY8 = (lY & 0x80000000);
          lX4 = (lX & 0x40000000);
          lY4 = (lY & 0x40000000);
          lResult = (lX & 0x3FFFFFFF) + (lY & 0x3FFFFFFF);
          if (lX4 & lY4) {
            return (lResult ^ 0x80000000 ^ lX8 ^ lY8);
          }
          if (lX4 | lY4) {
            if (lResult & 0x40000000) {
              return (lResult ^ 0xC0000000 ^ lX8 ^ lY8);
            } else {
              return (lResult ^ 0x40000000 ^ lX8 ^ lY8);
            }
          } else {
            return (lResult ^ lX8 ^ lY8);
          }
        };
  
        var _F = function (x, y, z) {
          return (x & y) | ((~x) & z);
        };
        var _G = function (x, y, z) {
          return (x & z) | (y & (~z));
        };
        var _H = function (x, y, z) {
          return (x ^ y ^ z);
        };
        var _I = function (x, y, z) {
          return (y ^ (x | (~z)));
        };
  
        var _FF = function (a, b, c, d, x, s, ac) {
          a = addUnsigned(a, addUnsigned(addUnsigned(_F(b, c, d), x), ac));
          return addUnsigned(rotateLeft(a, s), b);
        };
  
        var _GG = function (a, b, c, d, x, s, ac) {
          a = addUnsigned(a, addUnsigned(addUnsigned(_G(b, c, d), x), ac));
          return addUnsigned(rotateLeft(a, s), b);
        };
  
        var _HH = function (a, b, c, d, x, s, ac) {
          a = addUnsigned(a, addUnsigned(addUnsigned(_H(b, c, d), x), ac));
          return addUnsigned(rotateLeft(a, s), b);
        };
  
        var _II = function (a, b, c, d, x, s, ac) {
          a = addUnsigned(a, addUnsigned(addUnsigned(_I(b, c, d), x), ac));
          return addUnsigned(rotateLeft(a, s), b);
        };
  
        var convertToWordArray = function (str) {
          var lWordCount;
          var lMessageLength = str.length;
          var lNumberOfWords_temp1 = lMessageLength + 8;
          var lNumberOfWords_temp2 = (lNumberOfWords_temp1 - (lNumberOfWords_temp1 % 64)) / 64;
          var lNumberOfWords = (lNumberOfWords_temp2 + 1) * 16;
          var lWordArray = new Array(lNumberOfWords - 1);
          var lBytePosition = 0;
          var lByteCount = 0;
          while (lByteCount < lMessageLength) {
            lWordCount = (lByteCount - (lByteCount % 4)) / 4;
            lBytePosition = (lByteCount % 4) * 8;
            lWordArray[lWordCount] = (lWordArray[lWordCount] | (str.charCodeAt(lByteCount) << lBytePosition));
            lByteCount++;
          }
          lWordCount = (lByteCount - (lByteCount % 4)) / 4;
          lBytePosition = (lByteCount % 4) * 8;
          lWordArray[lWordCount] = lWordArray[lWordCount] | (0x80 << lBytePosition);
          lWordArray[lNumberOfWords - 2] = lMessageLength << 3;
          lWordArray[lNumberOfWords - 1] = lMessageLength >>> 29;
          return lWordArray;
        };
  
        var wordToHex = function (lValue) {
          var wordToHexValue = "",
            wordToHexValue_temp = "",
            lByte, lCount;
          for (lCount = 0; lCount <= 3; lCount++) {
            lByte = (lValue >>> (lCount * 8)) & 255;
            wordToHexValue_temp = "0" + lByte.toString(16);
            wordToHexValue = wordToHexValue + wordToHexValue_temp.substr(wordToHexValue_temp.length - 2, 2);
          }
          return wordToHexValue;
        };
  
        var x = [],
          k, AA, BB, CC, DD, a, b, c, d, S11 = 7,
          S12 = 12,
          S13 = 17,
          S14 = 22,
          S21 = 5,
          S22 = 9,
          S23 = 14,
          S24 = 20,
          S31 = 4,
          S32 = 11,
          S33 = 16,
          S34 = 23,
          S41 = 6,
          S42 = 10,
          S43 = 15,
          S44 = 21;
  
        //str = this.utf8_encode(str);
        x = convertToWordArray(str);
        a = 0x67452301;
        b = 0xEFCDAB89;
        c = 0x98BADCFE;
        d = 0x10325476;
  
        xl = x.length;
        for (k = 0; k < xl; k += 16) {
          AA = a;
          BB = b;
          CC = c;
          DD = d;
          a = _FF(a, b, c, d, x[k + 0], S11, 0xD76AA478);
          d = _FF(d, a, b, c, x[k + 1], S12, 0xE8C7B756);
          c = _FF(c, d, a, b, x[k + 2], S13, 0x242070DB);
          b = _FF(b, c, d, a, x[k + 3], S14, 0xC1BDCEEE);
          a = _FF(a, b, c, d, x[k + 4], S11, 0xF57C0FAF);
          d = _FF(d, a, b, c, x[k + 5], S12, 0x4787C62A);
          c = _FF(c, d, a, b, x[k + 6], S13, 0xA8304613);
          b = _FF(b, c, d, a, x[k + 7], S14, 0xFD469501);
          a = _FF(a, b, c, d, x[k + 8], S11, 0x698098D8);
          d = _FF(d, a, b, c, x[k + 9], S12, 0x8B44F7AF);
          c = _FF(c, d, a, b, x[k + 10], S13, 0xFFFF5BB1);
          b = _FF(b, c, d, a, x[k + 11], S14, 0x895CD7BE);
          a = _FF(a, b, c, d, x[k + 12], S11, 0x6B901122);
          d = _FF(d, a, b, c, x[k + 13], S12, 0xFD987193);
          c = _FF(c, d, a, b, x[k + 14], S13, 0xA679438E);
          b = _FF(b, c, d, a, x[k + 15], S14, 0x49B40821);
          a = _GG(a, b, c, d, x[k + 1], S21, 0xF61E2562);
          d = _GG(d, a, b, c, x[k + 6], S22, 0xC040B340);
          c = _GG(c, d, a, b, x[k + 11], S23, 0x265E5A51);
          b = _GG(b, c, d, a, x[k + 0], S24, 0xE9B6C7AA);
          a = _GG(a, b, c, d, x[k + 5], S21, 0xD62F105D);
          d = _GG(d, a, b, c, x[k + 10], S22, 0x2441453);
          c = _GG(c, d, a, b, x[k + 15], S23, 0xD8A1E681);
          b = _GG(b, c, d, a, x[k + 4], S24, 0xE7D3FBC8);
          a = _GG(a, b, c, d, x[k + 9], S21, 0x21E1CDE6);
          d = _GG(d, a, b, c, x[k + 14], S22, 0xC33707D6);
          c = _GG(c, d, a, b, x[k + 3], S23, 0xF4D50D87);
          b = _GG(b, c, d, a, x[k + 8], S24, 0x455A14ED);
          a = _GG(a, b, c, d, x[k + 13], S21, 0xA9E3E905);
          d = _GG(d, a, b, c, x[k + 2], S22, 0xFCEFA3F8);
          c = _GG(c, d, a, b, x[k + 7], S23, 0x676F02D9);
          b = _GG(b, c, d, a, x[k + 12], S24, 0x8D2A4C8A);
          a = _HH(a, b, c, d, x[k + 5], S31, 0xFFFA3942);
          d = _HH(d, a, b, c, x[k + 8], S32, 0x8771F681);
          c = _HH(c, d, a, b, x[k + 11], S33, 0x6D9D6122);
          b = _HH(b, c, d, a, x[k + 14], S34, 0xFDE5380C);
          a = _HH(a, b, c, d, x[k + 1], S31, 0xA4BEEA44);
          d = _HH(d, a, b, c, x[k + 4], S32, 0x4BDECFA9);
          c = _HH(c, d, a, b, x[k + 7], S33, 0xF6BB4B60);
          b = _HH(b, c, d, a, x[k + 10], S34, 0xBEBFBC70);
          a = _HH(a, b, c, d, x[k + 13], S31, 0x289B7EC6);
          d = _HH(d, a, b, c, x[k + 0], S32, 0xEAA127FA);
          c = _HH(c, d, a, b, x[k + 3], S33, 0xD4EF3085);
          b = _HH(b, c, d, a, x[k + 6], S34, 0x4881D05);
          a = _HH(a, b, c, d, x[k + 9], S31, 0xD9D4D039);
          d = _HH(d, a, b, c, x[k + 12], S32, 0xE6DB99E5);
          c = _HH(c, d, a, b, x[k + 15], S33, 0x1FA27CF8);
          b = _HH(b, c, d, a, x[k + 2], S34, 0xC4AC5665);
          a = _II(a, b, c, d, x[k + 0], S41, 0xF4292244);
          d = _II(d, a, b, c, x[k + 7], S42, 0x432AFF97);
          c = _II(c, d, a, b, x[k + 14], S43, 0xAB9423A7);
          b = _II(b, c, d, a, x[k + 5], S44, 0xFC93A039);
          a = _II(a, b, c, d, x[k + 12], S41, 0x655B59C3);
          d = _II(d, a, b, c, x[k + 3], S42, 0x8F0CCC92);
          c = _II(c, d, a, b, x[k + 10], S43, 0xFFEFF47D);
          b = _II(b, c, d, a, x[k + 1], S44, 0x85845DD1);
          a = _II(a, b, c, d, x[k + 8], S41, 0x6FA87E4F);
          d = _II(d, a, b, c, x[k + 15], S42, 0xFE2CE6E0);
          c = _II(c, d, a, b, x[k + 6], S43, 0xA3014314);
          b = _II(b, c, d, a, x[k + 13], S44, 0x4E0811A1);
          a = _II(a, b, c, d, x[k + 4], S41, 0xF7537E82);
          d = _II(d, a, b, c, x[k + 11], S42, 0xBD3AF235);
          c = _II(c, d, a, b, x[k + 2], S43, 0x2AD7D2BB);
          b = _II(b, c, d, a, x[k + 9], S44, 0xEB86D391);
          a = addUnsigned(a, AA);
          b = addUnsigned(b, BB);
          c = addUnsigned(c, CC);
          d = addUnsigned(d, DD);
        }
  
        var temp = wordToHex(a) + wordToHex(b) + wordToHex(c) + wordToHex(d);
  
        return temp.toLowerCase();
      }
  