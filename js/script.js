window.onload  =function(){
	
	/*-------------------------------------*/
	/*-------------Drag amd Drop-----------*/
	/*-------------------------------------*/
	
	var containers = [document.querySelector('#User .inventory'), document.querySelector('#Friend .inventory'), document.querySelector(' #User .table'), document.querySelector('#Friend .table')];
	var userColumn = $("#User").get(0);
	var friendColumn = $("#Friend").get(0);
	dragula(containers, {
	  isContainer: function (el) {
		return false; // only elements in drake.containers will be taken into account
	  },
	  moves: function (el, source, handle, sibling) {
		return true; // elements are always draggable by default
	  },
	  accepts: function (el, target, source, sibling) {
		
		return $.contains(userColumn, target) === $.contains(userColumn, source); // elements can be dropped in any of the `containers` by default
	  },
	  invalid: function (el, handle) {
		return false; // don't prevent any drags from initiating by default
	  },
		
	  direction: 'vertical',             // Y axis is considered when determining where an element would be dropped
	  copy: false,                       // elements are moved by default, not copied
	  copySortSource: false,             // elements in copy-source containers can be reordered
	  revertOnSpill: false,              // spilling will put the element back where it was dragged from, if this is true
	  removeOnSpill: false,              // spilling will `.remove` the element, if this is true
	  mirrorContainer: document.body,    // set the element that gets mirror elements appended
	  ignoreInputTextSelection: true     // allows users to select input text, see details below
	}).on("drop", checkDrop);
	checkDrop();
	
	/*-------------------------------------*/
	/*-------------Variables---------------*/
	/*-------------------------------------*/
	
	var selectedFriendId = null;
	var offerUserId = null;
	var requestUserId = null;
	var userNames = {};
	
	/*-------------------------------------*/
	/*-------------Load Initial Data-------*/
	/*-------------------------------------*/
	
	getUsers().done(function(){
		getUserTrades(currentUserId, $("#Trades"));
		getUserInventory(currentUserId, $('#User .inventory'));
	});
	
	setInterval(refreshTrades, 5000);
	
	function refreshTrades(){
		getUserTrades(currentUserId, $("#Trades"));
	}
	
	/*-------------------------------------*/
	/*-------------Page interactions-------*/
	/*-------------------------------------*/
	
	$("#TradeButton").click(function(){
		var $offer = $("#User .table li");
		var $request = $("#Friend .table li");
		
		var offers = [];
		var requests = [];
		
		$offer.each(function( index ){
			offers.push(jQuery.data(this, "ID"));
		});
		$request.each(function( index ){
			requests.push(jQuery.data(this, "ID"));
		});
		
		if(offers.length ===0 || requests.length === 0){
			return;
		}
		
		SpiceWorld.createTrade(currentUserId, selectedFriendId, "Hello! Would you like to Trade?", offers, requests).done(reset_inventories);
	});
	
	/*-------------------------------------*/
	/*-------------Functions---------------*/
	/*-------------------------------------*/
	
	function reset_inventories(){
		$("#Friend .table").empty();
		$("#User .table").empty();
		getUserInventory(selectedFriendId, $("#Friend .inventory"));
		getUserInventory(currentUserId, $("#User .inventory"));
	}
	
	function getUsers()
	{
		return SpiceWorld.getUsers().done(function(data){
			var json = JSON.parse(data);
			var $list = $("#Friends");
			
			//Filter out current logged in user
			for(var i =0; i<json.length; i++){
				userNames[json[i]["ID"]] = json[i]["user_nicename"];
				if(json[i]["ID"] === currentUserId){
					json.splice(i--, 1);
				}
			}
			
			$('#User header img').attr("src", plugin_uri+"/img/"+userNames[currentUserId]+".png");
			$('#User header span').text(userNames[currentUserId]);
			
			//clear list
			$list.empty();
			
			
			
			json.forEach(function(item, i){
				var $li = $("<li>");
				$list.append($li);
				
				$li.append($("<img>").attr("src", plugin_uri+"/img/"+item["user_nicename"]+".png"));
								
				//set data
				jQuery.data($li.get(0), "ID", item['ID']);
				
				$li.click(function(){
					$("#Friends li").removeClass("active");
					$(this).addClass("active");
					selectFriend(jQuery.data(this, "ID"));
				});
				
			});
			//auto select first user in list
			if(json.length > 0)
			{
				selectFriend(json[0]['ID']);
				$("#Friends li").eq(0).addClass("active");
			}
		});
	}
	
	function selectFriend( id)
	{
		selectedFriendId = id;
		
		$('#Friend .table').empty();
		
		$('#Friend header img').attr("src", plugin_uri+"/img/"+userNames[id]+".png");
		$('#Friend header span').text(userNames[id]);
		
		getUserInventory(id, $("#Friend .inventory"));
	}
	
	function getUserTrades( id , $container)
	{
		return SpiceWorld.getTrades(id).done(function(data){
			var json = JSON.parse(data);
			
			$container.empty();
			
			json.forEach(function(item, i){
				var $li = $("<li>").addClass("trade");
				$container.append($li);
				var $btn = $("<button>").text("Accept").click(function(){
						acceptTrade(jQuery.data(this, "ID"), jQuery.data(this, "owner"), jQuery.data(this, "target"));
				});
				$li.append($("<span>").text("From "+userNames[item["owner"]]));
				$li.append($btn);
				
				jQuery.data($btn.get(0), "ID", item['ID']);
				jQuery.data($btn.get(0), "owner", item['owner']);
				jQuery.data($btn.get(0), "target", item['target']);
			});
		});
	}
	
	function acceptTrade( id ,offerUserId, requestUserId)
	{
		return SpiceWorld.acceptTrade(id, offerUserId, requestUserId).done(function(){
			getUserTrades(currentUserId, $("#Trades"));
			reset_inventories();
		});
	}
	
	function getUserInventory( id, $container )
	{
		return SpiceWorld.getUserInventory(id).done(function(data){
			var json = JSON.parse(data);
			
			$container.empty();
			
			json.forEach(function(item, i){
				var $li = $("<li>").addClass("inventory-item");
				$container.append($li);

				jQuery.data($li.get(0), "ID", item['ID']);
				
				$li.append($("<h1>").text(loc[item['ID']]));
				$li.append($("<span>").text(loc['spices'][item['item']]));
				$li.append($("<img>").attr("src", plugin_uri+"img/spice_"+item["item"]+".png"));
				
				$li.fadeIn("slow");
			
			}, this);
		});
	}
	function checkDrop(){
		
		var $offer = $("#User .table li");
		var $request = $("#Friend .table li");

		$("#TradeButton").toggleClass("disabled", $offer.length ===0 || $request.length === 0);
	}
};