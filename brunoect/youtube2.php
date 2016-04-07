<?php
date_default_timezone_set('America/New_York');

/*
/brunoect/google-api-php-client-master/src/Google/IO/Curl.php
  public function executeRequest(Google_Http_Request $request)
    $curl = curl_init();
    >>>>>>>>>>>>>>>>>>>>>>>>> added:
    curl_setopt($curl, CURLOPT_PROXY, "127.0.0.1:8080");
    curl_setopt($curl, CURLOPT_PROXYUSERPWD, 'user1:itxn0l');
    <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
*/

$htmlBody = <<<END
<form method="GET">
  <div>
    Search Term: <input type="search" id="q" name="q" placeholder="Enter Search Term">
  </div>
  <div>
    Max Results: <input type="number" id="maxResults" name="maxResults" min="1" max="50" step="1" value="25">
  </div>
  <div>
    Order By: <select name="orderBy">
        <option value="date">date</option>
        <option value="rating">rating</option>
        <option value="viewCount">viewCount</option>
        <option value="relevance">relevance</option>
        <option value="title">title</option>
        <!--<option value="videoCount">videoCount</option>-->
      </select>
  </div>
  <div>
    Type: <select name="type">
        <option value="video">video</option>
        <option value="playlist">playlist</option>
        <option value="channel">channel</option>
      </select>
  </div>
  <input type="submit" value="Search">
</form>
END;

// This code will execute if the user entered a search query in the form
// and submitted the form. Otherwise, the page displays the form above.
if ( isset($_GET['q'])
    && isset($_GET['maxResults'])
    && isset($_GET['orderBy'])
    && isset($_GET['type'])
    ) {

  // Call set_include_path() as needed to point to your client library.
// require_once 'google-api-php-client-master/src/Google/Client.php';
// require_once 'google-api-php-client-master/src/Google/Service/YouTube.php';

  require_once 'google-api-php-client-master/src/Google/autoload.php';

  /*
   * Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the
   * Google Developers Console <https://console.developers.google.com/>
   * Please ensure that you have enabled the YouTube Data API for your project.
   */
  $DEVELOPER_KEY = 'AIzaSyALVHLgG5Oj98oGN9ZJr1z3TGRYUO6NsA0';

  $client = new Google_Client();
  $client->setDeveloperKey($DEVELOPER_KEY);

  // Define an object that will be used to make all API requests.
  $youtube = new Google_Service_YouTube($client);

  try {
    // Call the search.list method to retrieve results matching the specified
    // query term.
    $searchResponse = $youtube->search->listSearch('id,snippet', array(
      'q' => $_GET['q'],
      'maxResults' => $_GET['maxResults'],
      'order' => $_GET['orderBy'],
      'type' => $_GET['type'],
    ));
    /*
    //var_dump($searchResponse);die();
      object(Google_Service_YouTube_SearchListResponse)#32 (16) {
        ["collection_key":protected]=&gt;
        string(5) "items"
        ["internal_gapi_mappings":protected]=&gt;
        array(0) {
        }
        ["etag"]=&gt;
        string(57) ""sGDdEsjSJ_SnACpEvVQ6MtTzkrI/kglG9iTw46s3fKdI17EBSdbmet4""
        ["eventId"]=&gt;
        NULL
        ["itemsType":protected]=&gt;
        string(35) "Google_Service_YouTube_SearchResult"
        ["itemsDataType":protected]=&gt;
        string(5) "array"
        ["kind"]=&gt;
        string(26) "youtube#searchListResponse"
        ["nextPageToken"]=&gt;
        string(6) "CBkQAA"
        ["pageInfoType":protected]=&gt;
        string(31) "Google_Service_YouTube_PageInfo"
        ["pageInfoDataType":protected]=&gt;
        string(0) ""
        ["prevPageToken"]=&gt;
        NULL
        ["tokenPaginationType":protected]=&gt;
        string(38) "Google_Service_YouTube_TokenPagination"
        ["tokenPaginationDataType":protected]=&gt;
        string(0) ""
        ["visitorId"]=&gt;
        NULL
        ["modelData":protected]=&gt;
        array(2) {
          ["pageInfo"]=&gt;
          array(2) {
            ["totalResults"]=&gt;
            int(90656)
            ["resultsPerPage"]=&gt;
            int(25)
          }
          ["items"]=&gt;
          array(25) {
            [0]=&gt;
            array(4) {
              ["kind"]=&gt;
              string(20) "youtube#searchResult"
              ["etag"]=&gt;
              string(57) ""sGDdEsjSJ_SnACpEvVQ6MtTzkrI/M8O1rWOLkn_PBUh6ZkYgSbaWV0c""
              ["id"]=&gt;
              array(2) {
                ["kind"]=&gt;
                string(13) "youtube#video"
                ["videoId"]=&gt;
                string(11) "umfAeOjFB68"
              }
              ["snippet"]=&gt;
              array(7) {
                ["publishedAt"]=&gt;
                string(24) "2014-11-13T23:00:06.000Z"
                ["channelId"]=&gt;
                string(24) "UCTJHGpauHIhpzXDVlpRvINA"
                ["title"]=&gt;
                string(52) "Uniwigs Install &amp; Styling + Giveaway|DollFaceBeautyx"
                ["description"]=&gt;
                string(155) "Read Me For Info â™¡ Make sure to switch to 1080 HD PLEASE THUMBS UPâ™¡ Hey Dolls! Sorry this video is a little out of focus! xx Giveaway Rules must be ..."
                ["thumbnails"]=&gt;
                array(3) {
                  ["default"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(46) "https://i.ytimg.com/vi/umfAeOjFB68/default.jpg"
                  }
                  ["medium"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/umfAeOjFB68/mqdefault.jpg"
                  }
                  ["high"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/umfAeOjFB68/hqdefault.jpg"
                  }
                }
                ["channelTitle"]=&gt;
                string(12) "AsianPurette"
                ["liveBroadcastContent"]=&gt;
                string(4) "none"
              }
            }
            [1]=&gt;
            array(4) {
              ["kind"]=&gt;
              string(20) "youtube#searchResult"
              ["etag"]=&gt;
              string(57) ""sGDdEsjSJ_SnACpEvVQ6MtTzkrI/zlWMSUeSy5bbMn2YCT9aIxFNcWI""
              ["id"]=&gt;
              array(2) {
                ["kind"]=&gt;
                string(13) "youtube#video"
                ["videoId"]=&gt;
                string(11) "Kbw0c7yGMto"
              }
              ["snippet"]=&gt;
              array(7) {
                ["publishedAt"]=&gt;
                string(24) "2015-07-28T01:42:12.000Z"
                ["channelId"]=&gt;
                string(24) "UCpHyTbpK_2WI_1ZLmJFu9Yw"
                ["title"]=&gt;
                string(62) "PASSION JONESZ | *NEW* WHITE BLONDE WIG FROM UNIWIGS &amp; STYLING"
                ["description"]=&gt;
                string(97) "Get 10% off your entire order from UNIWIGS by using my code : passion10 Check out my wig here ..."
                ["thumbnails"]=&gt;
                array(3) {
                  ["default"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(46) "https://i.ytimg.com/vi/Kbw0c7yGMto/default.jpg"
                  }
                  ["medium"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/Kbw0c7yGMto/mqdefault.jpg"
                  }
                  ["high"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/Kbw0c7yGMto/hqdefault.jpg"
                  }
                }
                ["channelTitle"]=&gt;
                string(13) "PassionJonesz"
                ["liveBroadcastContent"]=&gt;
                string(4) "none"
              }
            }
            [2]=&gt;
            array(4) {
              ["kind"]=&gt;
              string(20) "youtube#searchResult"
              ["etag"]=&gt;
              string(57) ""sGDdEsjSJ_SnACpEvVQ6MtTzkrI/hXHMA0xWIWpligjVds6tjg8TaBI""
              ["id"]=&gt;
              array(2) {
                ["kind"]=&gt;
                string(13) "youtube#video"
                ["videoId"]=&gt;
                string(11) "GvHVfBtNXOk"
              }
              ["snippet"]=&gt;
              array(7) {
                ["publishedAt"]=&gt;
                string(24) "2015-07-17T18:04:45.000Z"
                ["channelId"]=&gt;
                string(24) "UCeNgRHpH7OHZetYjC5JZXGw"
                ["title"]=&gt;
                string(46) "WEAVE WEVIEW: UniWigs Tamar Remy Full Lace Wig"
                ["description"]=&gt;
                string(43) "USE THE COUPON CODE "miles" TO GET 10% OFF!"
                ["thumbnails"]=&gt;
                array(3) {
                  ["default"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(46) "https://i.ytimg.com/vi/GvHVfBtNXOk/default.jpg"
                  }
                  ["medium"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/GvHVfBtNXOk/mqdefault.jpg"
                  }
                  ["high"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/GvHVfBtNXOk/hqdefault.jpg"
                  }
                }
                ["channelTitle"]=&gt;
                string(19) "MilesJaiProductions"
                ["liveBroadcastContent"]=&gt;
                string(4) "none"
              }
            }
            [3]=&gt;
            array(4) {
              ["kind"]=&gt;
              string(20) "youtube#searchResult"
              ["etag"]=&gt;
              string(57) ""sGDdEsjSJ_SnACpEvVQ6MtTzkrI/N7GSDTCrVpTISGDYzjhY3pkt13w""
              ["id"]=&gt;
              array(2) {
                ["kind"]=&gt;
                string(13) "youtube#video"
                ["videoId"]=&gt;
                string(11) "p1VcO3aG9tw"
              }
              ["snippet"]=&gt;
              array(7) {
                ["publishedAt"]=&gt;
                string(24) "2015-03-11T11:33:59.000Z"
                ["channelId"]=&gt;
                string(24) "UCSGK5KVtylbPYPViZXXn4YQ"
                ["title"]=&gt;
                string(53) "Uniwigs Sweety Futura Synthetic Lace Front Wig Review"
                ["description"]=&gt;
                string(139) "Follow Us on IG @Uniwigs @Malibudollface The Wig I have in the video is from uniwigs.com. Sweety Futura Synthetic Lace Front Wig(Y-201) ..."
                ["thumbnails"]=&gt;
                array(3) {
                  ["default"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(46) "https://i.ytimg.com/vi/p1VcO3aG9tw/default.jpg"
                  }
                  ["medium"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/p1VcO3aG9tw/mqdefault.jpg"
                  }
                  ["high"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/p1VcO3aG9tw/hqdefault.jpg"
                  }
                }
                ["channelTitle"]=&gt;
                string(16) "DollFaceBarbieTV"
                ["liveBroadcastContent"]=&gt;
                string(4) "none"
              }
            }
            [4]=&gt;
            array(4) {
              ["kind"]=&gt;
              string(20) "youtube#searchResult"
              ["etag"]=&gt;
              string(57) ""sGDdEsjSJ_SnACpEvVQ6MtTzkrI/xl0GVlBxZ9n2o6pgBCqG7qTu-uc""
              ["id"]=&gt;
              array(2) {
                ["kind"]=&gt;
                string(13) "youtube#video"
                ["videoId"]=&gt;
                string(11) "p65939y1Z5M"
              }
              ["snippet"]=&gt;
              array(7) {
                ["publishedAt"]=&gt;
                string(24) "2014-09-30T17:00:08.000Z"
                ["channelId"]=&gt;
                string(24) "UCX6dP7TzIjxm--oDTPVQ0LQ"
                ["title"]=&gt;
                string(47) "Long Blonde Lace Front Wig Review - Uniwigs.com"
                ["description"]=&gt;
                string(164) "G'day Everyone! I love this wig soooo much!! The wig in this video: http://www.uniwigs.com/synthetic-wigs/40922-sweety-futura-synthetic-lace-front-wig.html Find ..."
                ["thumbnails"]=&gt;
                array(3) {
                  ["default"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(46) "https://i.ytimg.com/vi/p65939y1Z5M/default.jpg"
                  }
                  ["medium"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/p65939y1Z5M/mqdefault.jpg"
                  }
                  ["high"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/p65939y1Z5M/hqdefault.jpg"
                  }
                }
                ["channelTitle"]=&gt;
                string(13) "SuperMaryFace"
                ["liveBroadcastContent"]=&gt;
                string(4) "none"
              }
            }
            [5]=&gt;
            array(4) {
              ["kind"]=&gt;
              string(20) "youtube#searchResult"
              ["etag"]=&gt;
              string(57) ""sGDdEsjSJ_SnACpEvVQ6MtTzkrI/t_OCHSLuGQFmum6yC0ifH3DUrN4""
              ["id"]=&gt;
              array(2) {
                ["kind"]=&gt;
                string(13) "youtube#video"
                ["videoId"]=&gt;
                string(11) "rIrZgS05Xe8"
              }
              ["snippet"]=&gt;
              array(7) {
                ["publishedAt"]=&gt;
                string(24) "2015-05-16T05:39:27.000Z"
                ["channelId"]=&gt;
                string(24) "UCNBvzAJI3N92Sgl0guRxSxQ"
                ["title"]=&gt;
                string(48) "UniWigs Grey Lace Front Wig REVIEW // Nyc Dragun"
                ["description"]=&gt;
                string(153) "email: NycDragun@gmail.com Hi DRAGUNS! so i have been getting so many questions on my wigs in general so i am going to start reviewing them. this wig ..."
                ["thumbnails"]=&gt;
                array(3) {
                  ["default"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(46) "https://i.ytimg.com/vi/rIrZgS05Xe8/default.jpg"
                  }
                  ["medium"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/rIrZgS05Xe8/mqdefault.jpg"
                  }
                  ["high"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/rIrZgS05Xe8/hqdefault.jpg"
                  }
                }
                ["channelTitle"]=&gt;
                string(9) "NycDRAGUN"
                ["liveBroadcastContent"]=&gt;
                string(4) "none"
              }
            }
            [6]=&gt;
            array(4) {
              ["kind"]=&gt;
              string(20) "youtube#searchResult"
              ["etag"]=&gt;
              string(57) ""sGDdEsjSJ_SnACpEvVQ6MtTzkrI/0fWb3a2Nm0V6raEuIRrSXGY3RZQ""
              ["id"]=&gt;
              array(2) {
                ["kind"]=&gt;
                string(13) "youtube#video"
                ["videoId"]=&gt;
                string(11) "RZV6RwaMP_M"
              }
              ["snippet"]=&gt;
              array(7) {
                ["publishedAt"]=&gt;
                string(24) "2014-11-14T08:06:52.000Z"
                ["channelId"]=&gt;
                string(24) "UC9sl807Cmwxr8cKhPKoIYNQ"
                ["title"]=&gt;
                string(33) "Simple &amp; Sleek  | www.uniwigs.com"
                ["description"]=&gt;
                string(141) "MAC Fashion Revival MATTE LIPSTICK Please use code IVY FOR 10 % 0FF UniWigs Straight 100% Top Quality Remy Human Hair Full Lace Wig (SKU: ..."
                ["thumbnails"]=&gt;
                array(3) {
                  ["default"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(46) "https://i.ytimg.com/vi/RZV6RwaMP_M/default.jpg"
                  }
                  ["medium"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/RZV6RwaMP_M/mqdefault.jpg"
                  }
                  ["high"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/RZV6RwaMP_M/hqdefault.jpg"
                  }
                }
                ["channelTitle"]=&gt;
                string(15) "poisonflowerivy"
                ["liveBroadcastContent"]=&gt;
                string(4) "none"
              }
            }
            [7]=&gt;
            array(4) {
              ["kind"]=&gt;
              string(20) "youtube#searchResult"
              ["etag"]=&gt;
              string(57) ""sGDdEsjSJ_SnACpEvVQ6MtTzkrI/yk6u20cLgiZbaUe9PajTVaQG0K4""
              ["id"]=&gt;
              array(2) {
                ["kind"]=&gt;
                string(13) "youtube#video"
                ["videoId"]=&gt;
                string(11) "bsg-0Wj632o"
              }
              ["snippet"]=&gt;
              array(7) {
                ["publishedAt"]=&gt;
                string(24) "2015-05-20T03:18:02.000Z"
                ["channelId"]=&gt;
                string(24) "UCSGK5KVtylbPYPViZXXn4YQ"
                ["title"]=&gt;
                string(60) "Uniwigs Ciara Inspired Glueless Full Lace Wig Review #AVADIM"
                ["description"]=&gt;
                string(39) "The Wig I wear is from www.uniwigs.com."
                ["thumbnails"]=&gt;
                array(3) {
                  ["default"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(46) "https://i.ytimg.com/vi/bsg-0Wj632o/default.jpg"
                  }
                  ["medium"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/bsg-0Wj632o/mqdefault.jpg"
                  }
                  ["high"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/bsg-0Wj632o/hqdefault.jpg"
                  }
                }
                ["channelTitle"]=&gt;
                string(16) "DollFaceBarbieTV"
                ["liveBroadcastContent"]=&gt;
                string(4) "none"
              }
            }
            [8]=&gt;
            array(4) {
              ["kind"]=&gt;
              string(20) "youtube#searchResult"
              ["etag"]=&gt;
              string(57) ""sGDdEsjSJ_SnACpEvVQ6MtTzkrI/6kxegRNbSEiRq0Eh5lmzk6WUMRY""
              ["id"]=&gt;
              array(2) {
                ["kind"]=&gt;
                string(13) "youtube#video"
                ["videoId"]=&gt;
                string(11) "NWSHkM69pAA"
              }
              ["snippet"]=&gt;
              array(7) {
                ["publishedAt"]=&gt;
                string(24) "2014-06-18T08:12:07.000Z"
                ["channelId"]=&gt;
                string(24) "UCYWNY1bb_QT2byoXDjkjNsg"
                ["title"]=&gt;
                string(34) "PSA: DO NOT ORDER FROM UNIWIGS.COM"
                ["description"]=&gt;
                string(157) "Uni-wigs made a blog post that I particularly found very disrespectful as an African-American women. Yes I am Black, and yes I wear wigs and weaves, that ..."
                ["thumbnails"]=&gt;
                array(3) {
                  ["default"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(46) "https://i.ytimg.com/vi/NWSHkM69pAA/default.jpg"
                  }
                  ["medium"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/NWSHkM69pAA/mqdefault.jpg"
                  }
                  ["high"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/NWSHkM69pAA/hqdefault.jpg"
                  }
                }
                ["channelTitle"]=&gt;
                string(15) "masturKEIZZtion"
                ["liveBroadcastContent"]=&gt;
                string(4) "none"
              }
            }
            [9]=&gt;
            array(4) {
              ["kind"]=&gt;
              string(20) "youtube#searchResult"
              ["etag"]=&gt;
              string(57) ""sGDdEsjSJ_SnACpEvVQ6MtTzkrI/Xjy4IBJZ8prZjxO52X-RxCwxtpA""
              ["id"]=&gt;
              array(2) {
                ["kind"]=&gt;
                string(13) "youtube#video"
                ["videoId"]=&gt;
                string(11) "5jLUSLDauD8"
              }
              ["snippet"]=&gt;
              array(7) {
                ["publishedAt"]=&gt;
                string(24) "2014-09-28T03:20:46.000Z"
                ["channelId"]=&gt;
                string(24) "UCSGK5KVtylbPYPViZXXn4YQ"
                ["title"]=&gt;
                string(71) "Uniwigs Wave 100% Indian Remy Human Hair Full Lace Wig | #LS0009 Review"
                ["description"]=&gt;
                string(58) "Uniwigs Wave 100% Indian Remy Human Hair Full Lace Wig ..."
                ["thumbnails"]=&gt;
                array(3) {
                  ["default"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(46) "https://i.ytimg.com/vi/5jLUSLDauD8/default.jpg"
                  }
                  ["medium"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/5jLUSLDauD8/mqdefault.jpg"
                  }
                  ["high"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/5jLUSLDauD8/hqdefault.jpg"
                  }
                }
                ["channelTitle"]=&gt;
                string(16) "DollFaceBarbieTV"
                ["liveBroadcastContent"]=&gt;
                string(4) "none"
              }
            }
            [10]=&gt;
            array(4) {
              ["kind"]=&gt;
              string(20) "youtube#searchResult"
              ["etag"]=&gt;
              string(57) ""sGDdEsjSJ_SnACpEvVQ6MtTzkrI/ryqG6KfQJJns4mr6RlIcAv337Yw""
              ["id"]=&gt;
              array(2) {
                ["kind"]=&gt;
                string(13) "youtube#video"
                ["videoId"]=&gt;
                string(11) "wl7ZkbSTIFU"
              }
              ["snippet"]=&gt;
              array(7) {
                ["publishedAt"]=&gt;
                string(24) "2014-04-25T21:15:11.000Z"
                ["channelId"]=&gt;
                string(24) "UCEW8DXMRbo8e1psxSbH6FzQ"
                ["title"]=&gt;
                string(55) "1st impression: Uniwigs.com CL0457 Ombre Lace Front Wig"
                ["description"]=&gt;
                string(152) "http://www.uniwigs.com/human-hair-wigs/40694-custom-jennifer-james-22-wave-indian-remy-human-hair-ombre-color-lace-front-wig.html Top quality Indian ..."
                ["thumbnails"]=&gt;
                array(3) {
                  ["default"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(46) "https://i.ytimg.com/vi/wl7ZkbSTIFU/default.jpg"
                  }
                  ["medium"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/wl7ZkbSTIFU/mqdefault.jpg"
                  }
                  ["high"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/wl7ZkbSTIFU/hqdefault.jpg"
                  }
                }
                ["channelTitle"]=&gt;
                string(14) "prettypcollins"
                ["liveBroadcastContent"]=&gt;
                string(4) "none"
              }
            }
            [11]=&gt;
            array(4) {
              ["kind"]=&gt;
              string(20) "youtube#searchResult"
              ["etag"]=&gt;
              string(57) ""sGDdEsjSJ_SnACpEvVQ6MtTzkrI/tOZdhCZ7Pb6bDZ4NjEicmDi0nis""
              ["id"]=&gt;
              array(2) {
                ["kind"]=&gt;
                string(13) "youtube#video"
                ["videoId"]=&gt;
                string(11) "rFDVxkiEjzg"
              }
              ["snippet"]=&gt;
              array(7) {
                ["publishedAt"]=&gt;
                string(24) "2014-02-02T18:45:54.000Z"
                ["channelId"]=&gt;
                string(24) "UC5A-hTyCg7OEE1e0IH0MyTQ"
                ["title"]=&gt;
                string(20) "REVIEW - Uniwigs.com"
                ["description"]=&gt;
                string(101) "SALE COUPON CODE: EMY10 (youÂ´ll get 10dollar off if you buy for 89!) http://uniwigs.com HOMEPAGE ..."
                ["thumbnails"]=&gt;
                array(3) {
                  ["default"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(46) "https://i.ytimg.com/vi/rFDVxkiEjzg/default.jpg"
                  }
                  ["medium"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/rFDVxkiEjzg/mqdefault.jpg"
                  }
                  ["high"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/rFDVxkiEjzg/hqdefault.jpg"
                  }
                }
                ["channelTitle"]=&gt;
                string(9) "EmyExtasy"
                ["liveBroadcastContent"]=&gt;
                string(4) "none"
              }
            }
            [12]=&gt;
            array(4) {
              ["kind"]=&gt;
              string(20) "youtube#searchResult"
              ["etag"]=&gt;
              string(57) ""sGDdEsjSJ_SnACpEvVQ6MtTzkrI/LFwouIG75F4f2RrHOU8d5hXBa-0""
              ["id"]=&gt;
              array(2) {
                ["kind"]=&gt;
                string(13) "youtube#video"
                ["videoId"]=&gt;
                string(11) "CMgtYfovIYI"
              }
              ["snippet"]=&gt;
              array(7) {
                ["publishedAt"]=&gt;
                string(24) "2015-09-03T05:00:01.000Z"
                ["channelId"]=&gt;
                string(24) "UCszE6JPoQGDHE2vccrpD40g"
                ["title"]=&gt;
                string(49) "REALISTIC KINKY STRAIGHT WIG || FEATURING UNIWIGS"
                ["description"]=&gt;
                string(128) "COMMENT LIKE SUBSCRIBE! FOLLOW IG @SHEKIARENEA REALISTIC KINKY STRAIGHT WIG FEATURING UNIWIGS. Hey BooThangs! I am back with ..."
                ["thumbnails"]=&gt;
                array(3) {
                  ["default"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(46) "https://i.ytimg.com/vi/CMgtYfovIYI/default.jpg"
                  }
                  ["medium"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/CMgtYfovIYI/mqdefault.jpg"
                  }
                  ["high"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/CMgtYfovIYI/hqdefault.jpg"
                  }
                }
                ["channelTitle"]=&gt;
                string(11) "shekiarenea"
                ["liveBroadcastContent"]=&gt;
                string(4) "none"
              }
            }
            [13]=&gt;
            array(4) {
              ["kind"]=&gt;
              string(20) "youtube#searchResult"
              ["etag"]=&gt;
              string(57) ""sGDdEsjSJ_SnACpEvVQ6MtTzkrI/RBE27euM5JlvY82TG55vWhERiQw""
              ["id"]=&gt;
              array(2) {
                ["kind"]=&gt;
                string(13) "youtube#video"
                ["videoId"]=&gt;
                string(11) "eF7KG526n_8"
              }
              ["snippet"]=&gt;
              array(7) {
                ["publishedAt"]=&gt;
                string(24) "2014-12-19T00:59:23.000Z"
                ["channelId"]=&gt;
                string(24) "UC1ydEofv1-xwRMmjorfVMOw"
                ["title"]=&gt;
                string(39) "White Blonde Bombshellâ”‚Uniwigs Review"
                ["description"]=&gt;
                string(143) "SAVE 10% with coupon code: Beigeojai10 http://www.uniwigs.com/human-hair-wigs/40677-ciara-wave-remy-human-hair-ombre-blond-color-lace-wig.html?"
                ["thumbnails"]=&gt;
                array(3) {
                  ["default"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(46) "https://i.ytimg.com/vi/eF7KG526n_8/default.jpg"
                  }
                  ["medium"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/eF7KG526n_8/mqdefault.jpg"
                  }
                  ["high"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/eF7KG526n_8/hqdefault.jpg"
                  }
                }
                ["channelTitle"]=&gt;
                string(12) "MahoghanyBlu"
                ["liveBroadcastContent"]=&gt;
                string(4) "none"
              }
            }
            [14]=&gt;
            array(4) {
              ["kind"]=&gt;
              string(20) "youtube#searchResult"
              ["etag"]=&gt;
              string(57) ""sGDdEsjSJ_SnACpEvVQ6MtTzkrI/luNovUbR75916JKjtol8J9gEG3Q""
              ["id"]=&gt;
              array(2) {
                ["kind"]=&gt;
                string(13) "youtube#video"
                ["videoId"]=&gt;
                string(11) "2pGV4gzlN-A"
              }
              ["snippet"]=&gt;
              array(7) {
                ["publishedAt"]=&gt;
                string(24) "2015-07-16T21:36:42.000Z"
                ["channelId"]=&gt;
                string(24) "UC1ydEofv1-xwRMmjorfVMOw"
                ["title"]=&gt;
                string(37) "Perfect Summer Curlsâ”‚Uniwigs Review"
                ["description"]=&gt;
                string(171) "This wig is EVERYTHING &amp; more! I am sooo in love with the curl pattern, the length, the feel of the hair, the movement of it! This is at the top of my list of favorite ..."
                ["thumbnails"]=&gt;
                array(3) {
                  ["default"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(46) "https://i.ytimg.com/vi/2pGV4gzlN-A/default.jpg"
                  }
                  ["medium"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/2pGV4gzlN-A/mqdefault.jpg"
                  }
                  ["high"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/2pGV4gzlN-A/hqdefault.jpg"
                  }
                }
                ["channelTitle"]=&gt;
                string(12) "MahoghanyBlu"
                ["liveBroadcastContent"]=&gt;
                string(4) "none"
              }
            }
            [15]=&gt;
            array(4) {
              ["kind"]=&gt;
              string(20) "youtube#searchResult"
              ["etag"]=&gt;
              string(57) ""sGDdEsjSJ_SnACpEvVQ6MtTzkrI/Y8oZFE3TnzxRGfOaUorPxt_6Z2w""
              ["id"]=&gt;
              array(2) {
                ["kind"]=&gt;
                string(13) "youtube#video"
                ["videoId"]=&gt;
                string(11) "lh0rhwkaghw"
              }
              ["snippet"]=&gt;
              array(7) {
                ["publishedAt"]=&gt;
                string(24) "2015-04-12T18:51:36.000Z"
                ["channelId"]=&gt;
                string(24) "UC_aYBp9t1wzrze6M0E2Ijrw"
                ["title"]=&gt;
                string(49) "Sleek 26' inch Wig | UniWigs Review | Jaz Jackson"
                ["description"]=&gt;
                string(162) "Sleek 26 inch wig from UniWigs.com. In this video I will be reviewing a celebrity inspired wig unit from UniWigs. The Wig I wear in the video is from uniwigs.com."
                ["thumbnails"]=&gt;
                array(3) {
                  ["default"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(46) "https://i.ytimg.com/vi/lh0rhwkaghw/default.jpg"
                  }
                  ["medium"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/lh0rhwkaghw/mqdefault.jpg"
                  }
                  ["high"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/lh0rhwkaghw/hqdefault.jpg"
                  }
                }
                ["channelTitle"]=&gt;
                string(13) "concealerthis"
                ["liveBroadcastContent"]=&gt;
                string(4) "none"
              }
            }
            [16]=&gt;
            array(4) {
              ["kind"]=&gt;
              string(20) "youtube#searchResult"
              ["etag"]=&gt;
              string(57) ""sGDdEsjSJ_SnACpEvVQ6MtTzkrI/6Bjo4QZ4OmFOt22KHAzaP2W1Qpo""
              ["id"]=&gt;
              array(2) {
                ["kind"]=&gt;
                string(13) "youtube#video"
                ["videoId"]=&gt;
                string(11) "x2ludebxloA"
              }
              ["snippet"]=&gt;
              array(7) {
                ["publishedAt"]=&gt;
                string(24) "2015-09-03T03:32:00.000Z"
                ["channelId"]=&gt;
                string(24) "UCpb4_rwq20GxYsPDYZ1xAoA"
                ["title"]=&gt;
                string(20) "Uniwigs Silver Ombre"
                ["description"]=&gt;
                string(124) "Coupon Code "lanana10" to save an extra 10% off for you guys!! Link to Uniwigs! http://www.uniwigs.com/ Link to the unit ..."
                ["thumbnails"]=&gt;
                array(3) {
                  ["default"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(46) "https://i.ytimg.com/vi/x2ludebxloA/default.jpg"
                  }
                  ["medium"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/x2ludebxloA/mqdefault.jpg"
                  }
                  ["high"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/x2ludebxloA/hqdefault.jpg"
                  }
                }
                ["channelTitle"]=&gt;
                string(9) "lananaXxX"
                ["liveBroadcastContent"]=&gt;
                string(4) "none"
              }
            }
            [17]=&gt;
            array(4) {
              ["kind"]=&gt;
              string(20) "youtube#searchResult"
              ["etag"]=&gt;
              string(57) ""sGDdEsjSJ_SnACpEvVQ6MtTzkrI/XcoZpirAmi1amT_vXWFIty-ngzs""
              ["id"]=&gt;
              array(2) {
                ["kind"]=&gt;
                string(13) "youtube#video"
                ["videoId"]=&gt;
                string(11) "W1Nfj2SqaDs"
              }
              ["snippet"]=&gt;
              array(7) {
                ["publishedAt"]=&gt;
                string(24) "2015-07-10T15:30:00.000Z"
                ["channelId"]=&gt;
                string(24) "UCX6dP7TzIjxm--oDTPVQ0LQ"
                ["title"]=&gt;
                string(56) "Uniwigs Ariel The Little Mermaid Wig - Unboxing + Review"
                ["description"]=&gt;
                string(162) "G'day Everyone! This wig makes me want to dye my hair red! What do you think? Here's the link to this exact wig: http://goo.gl/mVQeHY Music kindly provided by ..."
                ["thumbnails"]=&gt;
                array(3) {
                  ["default"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(46) "https://i.ytimg.com/vi/W1Nfj2SqaDs/default.jpg"
                  }
                  ["medium"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/W1Nfj2SqaDs/mqdefault.jpg"
                  }
                  ["high"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/W1Nfj2SqaDs/hqdefault.jpg"
                  }
                }
                ["channelTitle"]=&gt;
                string(13) "SuperMaryFace"
                ["liveBroadcastContent"]=&gt;
                string(4) "none"
              }
            }
            [18]=&gt;
            array(4) {
              ["kind"]=&gt;
              string(20) "youtube#searchResult"
              ["etag"]=&gt;
              string(57) ""sGDdEsjSJ_SnACpEvVQ6MtTzkrI/m1xaLt7JmimkTcw9Q5FqFFC1cPA""
              ["id"]=&gt;
              array(2) {
                ["kind"]=&gt;
                string(13) "youtube#video"
                ["videoId"]=&gt;
                string(11) "V-VMgj6ud8Q"
              }
              ["snippet"]=&gt;
              array(7) {
                ["publishedAt"]=&gt;
                string(24) "2015-04-17T16:30:16.000Z"
                ["channelId"]=&gt;
                string(24) "UC_oNUg-2dzw-_exGo66on2g"
                ["title"]=&gt;
                string(58) "(Uniwigs) Allison Futura Synthetic Lace Front Wig (Review)"
                ["description"]=&gt;
                string(99) "Enjoy 10% off your extensions! using the code: AmberTalitha The wig I wear is from uniwigs.com: ..."
                ["thumbnails"]=&gt;
                array(3) {
                  ["default"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(46) "https://i.ytimg.com/vi/V-VMgj6ud8Q/default.jpg"
                  }
                  ["medium"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/V-VMgj6ud8Q/mqdefault.jpg"
                  }
                  ["high"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/V-VMgj6ud8Q/hqdefault.jpg"
                  }
                }
                ["channelTitle"]=&gt;
                string(15) "AmberandTalitha"
                ["liveBroadcastContent"]=&gt;
                string(4) "none"
              }
            }
            [19]=&gt;
            array(4) {
              ["kind"]=&gt;
              string(20) "youtube#searchResult"
              ["etag"]=&gt;
              string(57) ""sGDdEsjSJ_SnACpEvVQ6MtTzkrI/9sIOd9mpbn51LMwNbgocpDhV0rw""
              ["id"]=&gt;
              array(2) {
                ["kind"]=&gt;
                string(13) "youtube#video"
                ["videoId"]=&gt;
                string(11) "0R3zatvo8-k"
              }
              ["snippet"]=&gt;
              array(7) {
                ["publishedAt"]=&gt;
                string(24) "2014-11-21T15:41:04.000Z"
                ["channelId"]=&gt;
                string(24) "UCDyoacYiYcps7cDHNKFloWQ"
                ["title"]=&gt;
                string(41) "Uniwigs Remy Hair | Straight Hair Curled!"
                ["description"]=&gt;
                string(61) "Link to the wig! Enjoy 10% off using coupon code: GLAMFUN ..."
                ["thumbnails"]=&gt;
                array(3) {
                  ["default"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(46) "https://i.ytimg.com/vi/0R3zatvo8-k/default.jpg"
                  }
                  ["medium"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/0R3zatvo8-k/mqdefault.jpg"
                  }
                  ["high"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/0R3zatvo8-k/hqdefault.jpg"
                  }
                }
                ["channelTitle"]=&gt;
                string(7) "glamfun"
                ["liveBroadcastContent"]=&gt;
                string(4) "none"
              }
            }
            [20]=&gt;
            array(4) {
              ["kind"]=&gt;
              string(20) "youtube#searchResult"
              ["etag"]=&gt;
              string(57) ""sGDdEsjSJ_SnACpEvVQ6MtTzkrI/3hbzFfsLLec9RGpN2wsqg_8zHoY""
              ["id"]=&gt;
              array(2) {
                ["kind"]=&gt;
                string(13) "youtube#video"
                ["videoId"]=&gt;
                string(11) "xvFIkogAFSQ"
              }
              ["snippet"]=&gt;
              array(7) {
                ["publishedAt"]=&gt;
                string(24) "2015-06-11T01:05:14.000Z"
                ["channelId"]=&gt;
                string(24) "UCzehSNfvLzNZBaDWl9gjisw"
                ["title"]=&gt;
                string(42) "How To Style A Synthetic Wig | Uniwigs.com"
                ["description"]=&gt;
                string(91) "PLEASE CHECK OUT MY CHANNELâ™¡ https://www.youtube.com/channel/UCzehSNfvLzNZBaDWl9gjisw ..."
                ["thumbnails"]=&gt;
                array(3) {
                  ["default"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(46) "https://i.ytimg.com/vi/xvFIkogAFSQ/default.jpg"
                  }
                  ["medium"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/xvFIkogAFSQ/mqdefault.jpg"
                  }
                  ["high"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/xvFIkogAFSQ/hqdefault.jpg"
                  }
                }
                ["channelTitle"]=&gt;
                string(10) "MissPlu561"
                ["liveBroadcastContent"]=&gt;
                string(4) "none"
              }
            }
            [21]=&gt;
            array(4) {
              ["kind"]=&gt;
              string(20) "youtube#searchResult"
              ["etag"]=&gt;
              string(57) ""sGDdEsjSJ_SnACpEvVQ6MtTzkrI/t73edfW4s-0xbDUAsQ93Kfm0_Uk""
              ["id"]=&gt;
              array(2) {
                ["kind"]=&gt;
                string(13) "youtube#video"
                ["videoId"]=&gt;
                string(11) "Bic1uj6WdLY"
              }
              ["snippet"]=&gt;
              array(7) {
                ["publishedAt"]=&gt;
                string(24) "2015-05-28T00:34:01.000Z"
                ["channelId"]=&gt;
                string(24) "UC8wPU3CDeOjXl8k46cQ3OnA"
                ["title"]=&gt;
                string(50) "Uniwigs Butterfly Lace Front Wig Unboxing + Try On"
                ["description"]=&gt;
                string(155) "Hey agents! Today I am unboxing the Butterfly synthetic lace front wig from uniwigs! Get the wig here: http://goo.gl/Jrnu0J Use code Shawnee10 for 10% off!"
                ["thumbnails"]=&gt;
                array(3) {
                  ["default"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(46) "https://i.ytimg.com/vi/Bic1uj6WdLY/default.jpg"
                  }
                  ["medium"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/Bic1uj6WdLY/mqdefault.jpg"
                  }
                  ["high"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/Bic1uj6WdLY/hqdefault.jpg"
                  }
                }
                ["channelTitle"]=&gt;
                string(12) "agentshawnee"
                ["liveBroadcastContent"]=&gt;
                string(4) "none"
              }
            }
            [22]=&gt;
            array(4) {
              ["kind"]=&gt;
              string(20) "youtube#searchResult"
              ["etag"]=&gt;
              string(57) ""sGDdEsjSJ_SnACpEvVQ6MtTzkrI/71Y6ten633h0QymXfGv8a6DvSYw""
              ["id"]=&gt;
              array(2) {
                ["kind"]=&gt;
                string(13) "youtube#video"
                ["videoId"]=&gt;
                string(11) "WN7KlhQsWno"
              }
              ["snippet"]=&gt;
              array(7) {
                ["publishedAt"]=&gt;
                string(24) "2015-08-29T19:24:09.000Z"
                ["channelId"]=&gt;
                string(24) "UC7afFvLLvTiWI97M0jaqgKQ"
                ["title"]=&gt;
                string(44) "My 1 Minute Hair Transformation! Ft. UniWigs"
                ["description"]=&gt;
                string(162) "I got a coupon code!! Gabrielle10 gives you 10% off anything! :D Here is the wig I got! http://goo.gl/LcsGI5 This video features a tutorial and demo on how to ..."
                ["thumbnails"]=&gt;
                array(3) {
                  ["default"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(46) "https://i.ytimg.com/vi/WN7KlhQsWno/default.jpg"
                  }
                  ["medium"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/WN7KlhQsWno/mqdefault.jpg"
                  }
                  ["high"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/WN7KlhQsWno/hqdefault.jpg"
                  }
                }
                ["channelTitle"]=&gt;
                string(13) "GlamSolutions"
                ["liveBroadcastContent"]=&gt;
                string(4) "none"
              }
            }
            [23]=&gt;
            array(4) {
              ["kind"]=&gt;
              string(20) "youtube#searchResult"
              ["etag"]=&gt;
              string(57) ""sGDdEsjSJ_SnACpEvVQ6MtTzkrI/JbDxZrpnu_OECfDTZ4z0XoVzqd0""
              ["id"]=&gt;
              array(2) {
                ["kind"]=&gt;
                string(13) "youtube#video"
                ["videoId"]=&gt;
                string(11) "fc5neDkfGIc"
              }
              ["snippet"]=&gt;
              array(7) {
                ["publishedAt"]=&gt;
                string(24) "2014-12-28T11:55:08.000Z"
                ["channelId"]=&gt;
                string(24) "UCBCpkSlSWO1xLgo5eRgpBgw"
                ["title"]=&gt;
                string(40) "Uniwigs Lacefront and Extensions Review!"
                ["description"]=&gt;
                string(153) "Use the code KELSEY for 10% off The product link Wig http://www.uniwigs.com/synthetic-wigs/40923-allison-futura-synthetic-lace-front-wig.html?=Y-0185 ..."
                ["thumbnails"]=&gt;
                array(3) {
                  ["default"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(46) "https://i.ytimg.com/vi/fc5neDkfGIc/default.jpg"
                  }
                  ["medium"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/fc5neDkfGIc/mqdefault.jpg"
                  }
                  ["high"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/fc5neDkfGIc/hqdefault.jpg"
                  }
                }
                ["channelTitle"]=&gt;
                string(10) "KimonoTime"
                ["liveBroadcastContent"]=&gt;
                string(4) "none"
              }
            }
            [24]=&gt;
            array(4) {
              ["kind"]=&gt;
              string(20) "youtube#searchResult"
              ["etag"]=&gt;
              string(57) ""sGDdEsjSJ_SnACpEvVQ6MtTzkrI/_8twcc-lRazp9jnxOPZ7qAdUCRg""
              ["id"]=&gt;
              array(2) {
                ["kind"]=&gt;
                string(13) "youtube#video"
                ["videoId"]=&gt;
                string(11) "XHpXkI9oaGE"
              }
              ["snippet"]=&gt;
              array(7) {
                ["publishedAt"]=&gt;
                string(24) "2014-11-12T12:47:04.000Z"
                ["channelId"]=&gt;
                string(24) "UCSGK5KVtylbPYPViZXXn4YQ"
                ["title"]=&gt;
                string(41) "Uniwigs Red Rihanna Wave Lace Wig #CL0444"
                ["description"]=&gt;
                string(45) "Uniwigs Red Rihanna Wave Lace Wig #CL0444 ..."
                ["thumbnails"]=&gt;
                array(3) {
                  ["default"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(46) "https://i.ytimg.com/vi/XHpXkI9oaGE/default.jpg"
                  }
                  ["medium"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/XHpXkI9oaGE/mqdefault.jpg"
                  }
                  ["high"]=&gt;
                  array(1) {
                    ["url"]=&gt;
                    string(48) "https://i.ytimg.com/vi/XHpXkI9oaGE/hqdefault.jpg"
                  }
                }
                ["channelTitle"]=&gt;
                string(16) "DollFaceBarbieTV"
                ["liveBroadcastContent"]=&gt;
                string(4) "none"
              }
            }
          }
        }
        ["processed":protected]=&gt;
        array(0) {
        }
      }
    */

    $videoResults = array();
    # Merge video ids
    foreach ($searchResponse['items'] as $searchResult) {
      array_push($videoResults, $searchResult['id']['videoId']);
    }
    $videoIds = join(',', $videoResults);

    /*
    # Call the videos.list method to retrieve location details for each video.
    $videosResponse = $youtube->videos->listVideos('snippet, recordingDetails', array(
    'id' => $videoIds,
    ));
    $videos = '';
    // Display the list of matching videos.
    foreach ($videosResponse['items'] as $videoResult) {
      $videos .= sprintf('<li>%s (%s,%s)</li>',
          $videoResult['snippet']['title'],
          $videoResult['recordingDetails']['location']['latitude'],
          $videoResult['recordingDetails']['location']['longitude']);
    }*/
    $videosResponse = $youtube->videos->listVideos('contentDetails,snippet,statistics', array(
      'id' => $videoIds,
    ));

/*
    $videos = '';
    $channels = '';
    $playlists = '';

    // Add each result to the appropriate list, and then display the lists of
    // matching videos, channels, and playlists.
    foreach ($searchResponse['items'] as $searchResult) {
      switch ($searchResult['id']['kind']) {
        case 'youtube#video':
          $videos .= sprintf('<li>%s (%s)</li>',
              $searchResult['snippet']['title'], $searchResult['id']['videoId']);
          break;
        case 'youtube#channel':
          $channels .= sprintf('<li>%s (%s)</li>',
              $searchResult['snippet']['title'], $searchResult['id']['channelId']);
          break;
        case 'youtube#playlist':
          $playlists .= sprintf('<li>%s (%s)</li>',
              $searchResult['snippet']['title'], $searchResult['id']['playlistId']);
          break;
      }
    }

    $htmlBody .= <<<END
    <h3>Videos</h3>
    <ul>$videos</ul>
    <h3>Channels</h3>
    <ul>$channels</ul>
    <h3>Playlists</h3>
    <ul>$playlists</ul>
END;
*/

  } catch (Google_Service_Exception $e) {
    $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
      htmlspecialchars($e->getMessage()));
  } catch (Google_Exception $e) {
    $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
      htmlspecialchars($e->getMessage()));
  }
}
?>

<!doctype html>
<html>
  <head>
    <title>YouTube Search</title>
    <style>
    form{
      display: none;
    }
    img {
      padding: 2px; 
      margin-bottom: 15px;
      border: solid 1px silver; 
    }
    td {
      vertical-align: top;
    }
    td.line {
      border-bottom: solid 1px black;  
    }
    </style>
  </head>
  <body>
    <?=$htmlBody?>

    <h3>Videos</h3>

    <?php /*if (!empty($searchResponse)): ?>
    <table>
      <?php foreach ($searchResponse['items'] as $searchResult): ?>
      <?php if ($searchResult['id']['kind'] == 'youtube#video'): ?>
      <tr><td colspan="2" class="line"></td></tr>
      <tr>
          <td><a href="https://www.youtube.com/watch?v=<?php echo $searchResult['id']['videoId'] ?>" target="_blank"><img src="<?php echo $searchResult['snippet']['thumbnails']['default']['url']; ?>"/></a></td>
          <td>
            <strong><?php echo $searchResult['snippet']['title'] ?></strong><br/>
            <?php echo $searchResult['snippet']['description'] ?><br/><br/>
            channelTitle: <?php echo $searchResult['snippet']['channelTitle'] ?><br/>
          </td>
      </tr>
      <?php endif; ?>
      <?php endforeach; ?>
    </table>
    <?php else: ?>
    <?php endif; */?>

    <?php if (!empty($videosResponse)): ?>
    <table>
      <?php foreach ($videosResponse['items'] as $videoResult): ?>
      <?php if ($videoResult['kind'] == 'youtube#video'): ?>
      <tr><td colspan="2" class="line"></td></tr>
      <tr>
          <td><a href="https://www.youtube.com/watch?v=<?php echo $videoResult['id'] ?>" target="_blank"><img src="<?php echo $videoResult['snippet']['thumbnails']['default']['url']; ?>"/></a></td>
          <td>
            <strong><?php echo $videoResult['snippet']['title'] ?></strong><br/>
            <?php echo $videoResult['snippet']['description'] ?><br/>
            <br/>
            publishedAt: <?php echo $videoResult['snippet']['publishedAt'] ?><br/>
            tags: <?php if (!empty($videoResult['snippet']['tags'])) echo implode(', ', $videoResult['snippet']['tags']) ?><br/>
            channelTitle: <?php echo $videoResult['snippet']['channelTitle'] ?><br/>
            duration: <?php echo $videoResult['contentDetails']['duration'] ?><br/>
            dimension: <?php echo $videoResult['contentDetails']['dimension'] ?><br/>
            definition: <?php echo $videoResult['contentDetails']['definition'] ?><br/>
            caption: <?php echo $videoResult['contentDetails']['caption'] ?><br/>
            licensedContent: <?php echo $videoResult['contentDetails']['licensedContent'] ?><br/>
            viewCount: <?php echo $videoResult['statistics']['viewCount'] ?><br/>
            likeCount: <?php echo $videoResult['statistics']['likeCount'] ?><br/>
            dislikeCount: <?php echo $videoResult['statistics']['dislikeCount'] ?><br/>
            favoriteCount: <?php echo $videoResult['statistics']['favoriteCount'] ?><br/>
            commentCount: <?php echo $videoResult['statistics']['commentCount'] ?><br/>
          </td>
      </tr>
      <?php endif; ?>
      <?php endforeach; ?>
    </table>
    <?php else: ?>
    <?php endif; ?>

  </body>
</html>