window.onload  =function()
{
	/*-------------------------------------*/
	/*-------------Variables---------------*/
	/*-------------------------------------*/
	
	var selectedUserId = null;
	var offerUserId = null;
	var requestUserId = null;
	
	/*-------------------------------------*/
	/*-------------Load Initial Data-------*/
	/*-------------------------------------*/
	
	getStateEnums();
	getItems();
	getUsers();
	
	/*-------------------------------------*/
	/*-------------Page interactions-------*/
	/*-------------------------------------*/
	
	$("#install-btn").click(function(){
		SpiceWorld.install().done(function(data){alert(data);});
	});
	$("#uninstall-btn").click(function(){
		SpiceWorld.uninstall().done(function(data){alert(data);});
	});
	
	$("#StatusForm").submit(function( e ){
		
		var val = $(this).find('input[name="name"]').val();
				
		if(val === "")
		{
			return;
		}
		
		SpiceWorld.createTradeStatus().done(function(data){
			getStateEnums();
		});
		
		event.preventDefault();
	});
	
	$("#NewItemForm").submit(function( e ){
		
		var name = $(this).find('input[name="name"]').val();
		var value = $(this).find('input[name="value"]').val();
				
		if(name === "" || value === "")
		{
			return;
		}
		
		SpiceWorld.createItem(name, value).done(function(data){
			getItems();
		});
		
		event.preventDefault();
	});
	
	$("#GrantItem").submit(function( e ){
		event.preventDefault();
		
		var item = $(this).find('select option:selected').val();
				
		if(item === "")
		{
			return;
		}
		
		SpiceWorld.grantItem(selectedUserId, item).done(function(data){
			getUserInventory(selectedUserId);
		});
		
		
	});
	
	$("#offerUserList").change(function(e, i){
		offerUserId = $(e.currentTarget).val();
		SpiceWorld.getUserInventory(offerUserId).done(function(data){
			var json = JSON.parse(data);
			var $options = $("#OfferItems .inventoryList");
			
			$options.empty();
			
			json.forEach(function(item, i){
				var $option = $("<option>");
				
				$option.attr("value", item["ID"]);
				$option.text(loc['spices'][item['item']]);
				$options.append($option);
			});
		});
	});
	
	$("#targetUserList").change(function(e, i){
		requestUserId = $(e.currentTarget).val();
		SpiceWorld.getUserInventory(requestUserId).done(function(data){
			var json = JSON.parse(data);
			var $options = $("#RequestItems .inventoryList");
			
			$options.empty();
			
			json.forEach(function(item, i){
				var $option = $("<option>");
				
				$option.attr("value", item["ID"]);
				$option.text(loc["spices"][item['item']]);
				
				$options.append($option);
			});
		});
	});
	
	$("#OfferItems").submit(function( e ){
		event.preventDefault();
		
		var $selection = $("#OfferItems .inventoryList option:selected");
		var id = $selection.attr("value");
		var offerList = $("#OfferList");
		
		var exists = false;
		
		offerList.find("li").each(function( index ){
			if(jQuery.data(this, "ID") === id){
				exists = true;
			}
		});
		
		if(exists)
		{
			return;
		}
		var li = $("<li>");
		jQuery.data(li.get(0), "ID", id);
		offerList.append(li.text($selection.text()));		
	});
	
	$("#RequestItems").submit(function( e ){
		event.preventDefault();
		
		var $selection = $("#RequestItems .inventoryList option:selected");
		var id = $selection.attr("value");
		var requestList = $("#RequestList");
		
		var exists = false;
		
		requestList.find("li").each(function( index ){
			if(jQuery.data(this, "ID") === id){
				exists = true;
			}
		});
		
		if(exists)
		{
			return;
		}
		
		var li = $("<li>");
		jQuery.data(li.get(0), "ID", id);
		requestList.append(li.text($selection.text()));		
	});
	
	$("#MakeTrade").click(function( e ){
		
		var offer = [];
		var request = [];
		
		var offerList = $("#OfferList");
		offerList.find("li").each(function( index ){
			offer.push(jQuery.data(this, "ID"));
		});
		
		var requestList = $("#RequestList");
		requestList.find("li").each(function( index ){
			request.push(jQuery.data(this, "ID"));
		});
		
		if(offer.length ===0 || request.length === 0){
			return;
		}
		
		SpiceWorld.createTrade(offerUserId, requestUserId, "Hello! Would you like to Trade?", offer, request)
	});

	
	/*-------------------------------------*/
	/*-------------Functions---------------*/
	/*-------------------------------------*/
	
	function deleteStateEnums( id ){
		SpiceWorld.deleteStateEnums(id).done(function(data){
			getStateEnums();
		});
	}
	
	function deleteItem( id ){
		SpiceWorld.deleteItem(id).done(function(data){
			getItems();
		});
	}
	
	function deleteUserInventory(userId, id ){
		SpiceWorld.deleteUserInventory(userId, id).done(function(data){
			getUserInventory(userId);
		});
	}
	
	function getStateEnums(){
		SpiceWorld.getStateEnums().done(function(data){
			var json = JSON.parse(data);
			var $list = $("#TradeStatusList");
			
			$list.empty();
			
			appendListData($list, json, processListRow);
		});
		
		function processListRow($li){
			$li.append($("<button>").text("delete").click(function(){
				deleteStateEnums(jQuery.data($li, "ID"));
			}));
		}
	}
	
	function getItems(){
		SpiceWorld.getItems().done(function(data){
			var json = JSON.parse(data);
			var $list = $("#ItemsList");
			
			$list.empty();
			
			var $itemDropDown = $(".itemDropDown");
			
			json.forEach(function(item, i){
				var $option = $("<option>").text(loc['spices'][item['ID']]).attr("value", item['ID']);
				$itemDropDown.append($option);
			}, this);
			
			appendListData($list, json, processListRow);
		});
		
		function processListRow($li){
			$li.append($("<button>").text("delete").click(function(){
				deleteItem(jQuery.data($li, "ID"));
			}));
		}
	}
	
	function getUsers(){
		var $userSelectLists = $("select.userList");
		var userNames = {};
		SpiceWorld.getUsers().done(function(data){
			var json = JSON.parse(data);
			var $list = $("#UserList");
			
			json.forEach(function(item, i){
				userNames[item["ID"]] = item["user_nicename"];
			});
			
			$list.empty();
			
			//auto select first user in list
			if(json.length > 0)
			{
				selectUser(json[0]['ID']);
			}
			
			appendListData($list, json, processListRow);
		});
		
		function processListRow($li){
			
			var id = jQuery.data($li, "ID");
			$userSelectLists.append($("<option>").text(userNames[id]).attr("value", id));
			
			$li.click(function(){
				selectUser(jQuery.data($li, "ID"));
			});
		}
	}
	
	function selectUser( id )
	{
		selectedUserId = id;
		
		getUserTrades(id);
		getUserInventory(id);
	}
	
	function getUserTrades( id )
	{
		SpiceWorld.getTrades(id).done(function(data){
			var json = JSON.parse(data);
			var $list = $("#UserTrades");
			
			$list.empty();
			
			appendListData($list, json, processListRow);
		});
		
		function processListRow($li){
			$li.append($("<button>").text("Accept").click(function(){
				acceptTrade(jQuery.data($li, "ID"), jQuery.data($li, "owner"), jQuery.data($li, "target"));
			}));
		}
	}
	
	function acceptTrade( id ,offerUserId, requestUserId)
	{
		SpiceWorld.acceptTrade(id, offerUserId, requestUserId).done(function(){
			getUserTrades(selectedUserId);
		});
	}
	
	function getUserInventory( id )
	{
		SpiceWorld.getUserInventory(id).done(function(data){
			var json = JSON.parse(data);
			var $list = $("#UserInventory");
			
			$list.empty();
			
			appendListData($list, json, processListRow);
		});
		
		function processListRow($li){
			$li.append($("<button>").text("delete").click(function(){
				deleteUserInventory(id, jQuery.data($li, "ID"));
			}));
		}
	}
	
	/*-------------------------------------*/
	/*-------------Utils-------------------*/
	/*-------------------------------------*/
	
	function isFunction(functionToCheck) {
	 var getType = {};
	 return functionToCheck && getType.toString.call(functionToCheck) === '[object Function]';
	}
	
	function appendListData($list, $data, functPostProcess){
		$data.forEach(function(item, i){
			var $li = $("<li>");
			$list.append($li);
			
			jQuery.data($li, "ID", item['ID']);
		
			
			for (var property in item)
			{
				jQuery.data($li, property, item[property]);
				
				$li.append($("<span>").text(item[property]));
			}
			
			if(isFunction(functPostProcess))
			{
				functPostProcess($li);
			}
			
		}, this);
	}
};
