  // Load the SDK Asynchronously
(function () {
  var e = document.createElement('script'); e.async = true;
  e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
  document.getElementById('fb-root').appendChild(e);
} ());

  // Additional JS functions here
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '234891310204449', // App ID
      xfbml      : true,
      version    : 'v2.6'
    });

    // Additional init code here
    FB.getLoginStatus(function(response) {
                if (response.status === 'connected') {
                        // connected
                } else if (response.status === 'not_authorized') {
                        // not_authorized
                                login();
                } else {
                        // not_logged_in
                                login();
                }
        });
  };
  function sendAppRequest(){
  	FB.ui({method: 'apprequests',
    message: 'My Great Request'
    }, requestCallback);
  }
  function buy() {
            var obj = {
                method: 'pay',
                action: 'purchaseitem',
                product: 'http://test.com'
            };

            FB.ui(obj, function(data) {
                console.log(data);
                });
            }
          
          function requestCallback(response)
            {
                if(response && response.request_ids) {
                    // Here, requests have been sent, facebook gives you the ids of all requests
                    //console.log(response);
                } else {
                    // No requests sent, you can do what you want (like...nothing, and stay on the page).
                }
            }
            
            
        function postToWall() {  
            var image= document.getElementById('postwallimage').value;
            var text= document.getElementById('postwalltext').value;
            FB.login(function(response) {
            if (response.authResponse) {
                FB.ui({
                    method: 'feed', 
                    name: 'Facebook Dialogs',
                    picture: image,
                    description: text,
                    link: 'https://developers.facebook.com/docs/reference/javascript/'
                },
                function(response) {
                if (response && response.post_id) {
                    alert('Post was published.');
                } else {
                    alert('Post was not published.');
                }
                });
            } else {
                alert('User cancelled login or did not fully authorize.');
            }
            }, {scope: 'user_likes,offline_access,publish_stream'});
            return false;
        }
