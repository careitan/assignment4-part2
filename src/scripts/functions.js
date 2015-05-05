

function DeleteAll() {
	var URL = "deleteall.php";
	var Return = AJAXRequest(URL,null);

  location.reload();
}

function DeleteItem(id) {
	var URL = "delete.php";
	var Param = {'id':id};
	var Return = AJAXRequest(URL,Param);

  location.reload();
}

function AJAXRequest(URL, Parameters) {
	var RetVal = {};
	var URLParams = [];
	var req = new XMLHttpRequest();
  if (!req) {
    throw 'Unable to create HTTPRequest';
  }

  if (Parameters !== null) {
  	for (var Key in Parameters) {
  		URLParams.push(encodeURIComponent(Key) + '=' +
  			encodeURIComponent(Parameters[Key]));
  	}
  }

  // Setting up for POST
  req.open("POST",URL,false);
  req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  req.onreadystatechange = function() {
    if (this.readyState === 4) {
      if (this.status !== 200) {
        RetVal.success = false;
      } else {
        RetVal.success = true;
      }

      RetVal.code = this.status;
      RetVal.codeDetail = this.responseText;
      RetVal.response = this.response;
    }
  };
  req.send(URLParams.join('&'));

  return RetVal;
}
