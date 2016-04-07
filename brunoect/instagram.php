<?php error_reporting(E_ALL ^ E_DEPRECATED); ?>
<?php
/*
instagram api
  http://instafeedjs.com/

js date string timestamp format
  ~~~~Date、String、Timestamp之间的转换  http://blog.csdn.net/wangjinwei6912/article/details/6545868
  Convert a Unix timestamp to time in Javascript  http://stackoverflow.com/questions/847185/convert-a-unix-timestamp-to-time-in-javascript
  Is there a JQuery plugin to convert UTC datetimes to local user timezone?   http://stackoverflow.com/questions/3830418/is-there-a-jquery-plugin-to-convert-utc-datetimes-to-local-user-timezone
  Convert the local time to another time zone with this JavaScript   http://www.techrepublic.com/article/convert-the-local-time-to-another-time-zone-with-this-javascript/
*/
?>
<!DOCTYPE html 
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>Searching tags in instagram</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <style>
    #searchdiv,#instafeed{
      width:800px;
      margin:0 auto;
      padding:10px 0;
    }
    #instafeed{

    }
    img {
      padding: 2px; 
      margin-bottom: 15px;
      border: solid 1px silver; 
    }
    .box-info img{width:50px;}
    .box-info{height: 160px;overflow:hidden;}
    </style>

    <script type="text/javascript" src="/brunoect/instafeed-1.4.1.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript">
      Date.prototype.format = function(format) {
       var o = {
       "M+" : this.getMonth()+1, //month
       "d+" : this.getDate(),    //day
       "h+" : this.getHours(),   //hour
       "m+" : this.getMinutes(), //minute
       "s+" : this.getSeconds(), //second
       "q+" : Math.floor((this.getMonth()+3)/3),  //quarter
       "S" : this.getMilliseconds() //millisecond
       }
       if(/(y+)/.test(format)) format=format.replace(RegExp.$1,
       (this.getFullYear()+"").substr(4 - RegExp.$1.length));
       for(var k in o)if(new RegExp("("+ k +")").test(format))
       format = format.replace(RegExp.$1,
       RegExp.$1.length==1 ? o[k] :
       ("00"+ o[k]).substr((""+ o[k]).length));
       return format;
      }

      var currentDate = new Date();
      var tzoffset = -(currentDate.getTimezoneOffset() / 60);
      if (tzoffset[0] != '-') {
        tzoffset = '+'+tzoffset;
      }

      $(function(){
        $("#btnSearch").click(function() {
          $('#instafeed').html('');
          var tagName = $("#txtTagName").val() || 'uniwigs';
          var pageSize = $("#txtPageSize").val() || '33';
          window.feed = new Instafeed({
            get: 'tagged',
            tagName: tagName,
            limit: pageSize,
            template: '<div class="imgbox col-xs-4"><div class="box-img"><a target="_blank" href="{{link}}"><img src="{{image}}" /></a></div><div class="box-info"><span class="timestampstr">{{model.created_time}}</span><br/>{{model.type}}, {{likes}} liks, {{comments}} comments<br/>{{model.caption.from.full_name}}, {{model.caption.from.username}}, {{model.caption.from.id}}<br/><img src="{{model.caption.from.profile_picture}}" /></div></div>',
            clientId: '1cd9a1d8f8104ee19fe32971c243b4e7',
            sortBy:'most-recent',
            after: function() {
              $('.timestampstr').each(function(){
                if ($(this).hasClass('parsed')) return;
                $(this).text((new Date(parseInt($(this).text())*1000)).format('yyyy-MM-dd hh:mm:ss') + "("+tzoffset+")").addClass('parsed');
              });

              // disable button if no more results to load
              if (!this.hasNext()) {
                  window.loadButton.setAttribute('disabled', 'disabled');
              }
            }
          });
          feed.run();
        });

        $("#btnSearch").click();
        //$("#btnSearch").trigger('click');

        window.loadButton = document.getElementById('load-more');
        // bind the load more button
        loadButton.addEventListener('click', function() {
            feed.next();
        });
      });
    </script>
  </head>
  <body>
    <div id="searchdiv" class="row">
      <div class="col-xs-4">Tag: <input id="txtTagName" type="text" value="uniwigs"/></div>
      <div class="col-xs-4">Page Size: <input id="txtPageSize" type="number" value="33"/></div>
      <div class="col-xs-4"><button id="btnSearch" type="submit" name="op_search">Search</button></div>
    </div>
    <div id="instafeed" class="row fix">
    </div>
    <div style="text-align:center;padding: 10px 0 40px;">
      <button id="load-more">Load More</button>
    </div>
  </body>
</html>
