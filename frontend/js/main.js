gift_buttons= document.getElementsByClassName('send_gift_button');
claim_gift_buttons= document.getElementsByClassName('claim_gift_button');
verify_claim_buttons= document.getElementsByClassName('verify_claim_button');
var i= 0;
while(gift_buttons[i]){
	gift_buttons[i].addEventListener('click', initGiftToUser);
	i++;
}
var i= 0;
while(claim_gift_buttons[i]){
	claim_gift_buttons[i].addEventListener('click', initClaimFromUser);
	i++;
}
var i= 0;
while(verify_claim_buttons[i]){
	verify_claim_buttons[i].addEventListener('click', initClaimVerification);
	i++;
}
// Elements Listener Functions
function initGiftToUser(){
	record_id= document.getElementById(this.id+'_data').value;
	giveGiftToUser(record_id);
}
function initClaimFromUser(elem){
	record_id= document.getElementById(this.id+'_data').value;
	claimGiftFromUser(record_id);
}
function initClaimVerification(elem){
	record_id= document.getElementById(this.id+'_data').value;
	verifyGiftClaim(record_id);
}
// AJAX Calls
// Send Gift to User
function giveGiftToUser(to_user_id){
    var xmlhttp;
    // get XMLHTTP Object Depending the Browser
    if(window.XMLHttpRequest){
        xmlhttp= new XMLHttpRequest();
    }else{
        xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange= function(){
        if(xmlhttp.readyState== 4 && xmlhttp.status== 200){
//            if(response.result == ""){
            if(xmlhttp.response != "Error"){
	            fetchUsersContent();
	            sendAppRequest();
            }else{
            	// on False
            	
            }
        }
    }
//    var to_user_id=encodeURIComponent(document.getElementById("").value)
    var parameters="params[to_user_id]="+to_user_id+"&task=assign_gift";
    // Send Request
    xmlhttp.open("POST","/ajax/controller.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(parameters);
}
// Claim Gift from User
function claimGiftFromUser(from_user_id){
    var xmlhttp;
    // get XMLHTTP Object Depending the Browser
    if(window.XMLHttpRequest){
        xmlhttp= new XMLHttpRequest();
    }else{
        xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange= function(){
        if(xmlhttp.readyState== 4 && xmlhttp.status== 200){
//            if(response.result == ""){
            if(xmlhttp.response != "Error"){
	            fetchUsersContent();
            }else{
            	// on False
            	
            }
        }
    }
//    var from_user_id=encodeURIComponent(document.getElementById("").value)
    var parameters="params[from_user_id]="+from_user_id+"&task=claim_gift";
    // Send Request
    xmlhttp.open("POST","/ajax/controller.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(parameters);
}
// Verify Gift Claim
function verifyGiftClaim(claim_id){
    var xmlhttp;
    // get XMLHTTP Object Depending the Browser
    if(window.XMLHttpRequest){
        xmlhttp= new XMLHttpRequest();
    }else{
        xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange= function(){
        if(xmlhttp.readyState== 4 && xmlhttp.status== 200){
//            if(response.result == ""){
            if(xmlhttp.response != "Error"){
	            fetchUsersContent();
	            fetchClaimsContent();
            }else{
            	// on False
            	
            }
        }
    }
//    var claim_id=encodeURIComponent(document.getElementById("").value)
    var parameters="params[claim_id]="+claim_id+"&task=claim_gift_verification";
    // Send Request
    xmlhttp.open("POST","/ajax/controller.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(parameters);
}
// Fetch Users Content as HTML Part
function fetchUsersContent(){
    var xmlhttp;
    // get XMLHTTP Object Depending the Browser
    if(window.XMLHttpRequest){
        xmlhttp= new XMLHttpRequest();
    }else{
        xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange= function(){
        if(xmlhttp.readyState== 4 && xmlhttp.status== 200){
//            var response= xmlhttp.response;
//            console.log(xmlhttp);
//            if(response.result == ""){
            if(xmlhttp.response != "Error"){
	            document.getElementById('users_table_body').innerHTML= xmlhttp.response;
	            gift_buttons= document.getElementsByClassName('send_gift_button');
							claim_gift_buttons= document.getElementsByClassName('claim_gift_button');
							var i= 0;
							while(gift_buttons[i]){
								gift_buttons[i].addEventListener('click', initGiftToUser);
								i++;
							}
							var i= 0;
							while(claim_gift_buttons[i]){
								claim_gift_buttons[i].addEventListener('click', initClaimFromUser);
								i++;
							}
            }
        }
    }
    var parameters= "task=fetch_users";
    // Send Request
    xmlhttp.open("POST","/ajax/controller.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(parameters);
}
// Fetch Claims Content as HTML Part
function fetchClaimsContent(){
    var xmlhttp;
    // get XMLHTTP Object Depending the Browser
    if(window.XMLHttpRequest){
        xmlhttp= new XMLHttpRequest();
    }else{
        xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange= function(){
        if(xmlhttp.readyState== 4 && xmlhttp.status== 200){
//            var response= xmlhttp.response;
//            console.log(xmlhttp);
//            if(response.result == ""){
            if(xmlhttp.response != "Error"){
	            document.getElementById('claims_table_body').innerHTML= xmlhttp.response;
							verify_claim_buttons= document.getElementsByClassName('verify_claim_button');
							var i= 0;
							while(verify_claim_buttons[i]){
								verify_claim_buttons[i].addEventListener('click', initClaimVerification);
								i++;
							}
            }
        }
    }
    var parameters= "task=fetch_claims";
    // Send Request
    xmlhttp.open("POST","/ajax/controller.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(parameters);
}
