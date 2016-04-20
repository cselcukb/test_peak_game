  function sendAppRequest(){
  	FB.ui({method: 'apprequests',
    message: 'My Great Request'
    }, requestCallback);
  }
  function requestCallback(response){
  	if(response && response.request_ids) {
    	// Here, requests have been sent, facebook gives you the ids of all requests
      //console.log(response);
    } else {
      // No requests sent, you can do what you want (like...nothing, and stay on the page).
    }
  }
