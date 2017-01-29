var SpiceWorld = {};

SpiceWorld.prepend = site_uri+"/spiceworld";
SpiceWorld.api = 
{
	install:SpiceWorld.prepend+"/admin/install", 
	uninstall:SpiceWorld.prepend+"/admin/uninstall",
	create_trade_status:SpiceWorld.prepend+"/admin/trades/status/create",
	create_trade:SpiceWorld.prepend+"/trades/create",
	trades_status_get:SpiceWorld.prepend+"/admin/trades/status/get",
	items_create:SpiceWorld.prepend+"/admin/items/create",
	items_get:SpiceWorld.prepend+"/admin/items/get",
	items_grant:SpiceWorld.prepend+"/admin/items/grant",
	trade_create:SpiceWorld.prepend+"/trade/create",
	get_user:SpiceWorld.prepend+"/user/massinfo",
	get_user_list:SpiceWorld.prepend+"/user/list",
	trade_update:SpiceWorld.prepend+"/trade/update",
	get_trades:SpiceWorld.prepend+"/trade/get",
	get_trades_content:SpiceWorld.prepend+"/trades/content",
	user_inventory:SpiceWorld.prepend+"/user/inventory",
	delete_item:SpiceWorld.prepend+"/admin/items/delete",
	delete_trade_status:SpiceWorld.prepend+"/admin/trades/status/delete",
	delete_inventory:SpiceWorld.prepend+"/admin/user/inventory/delete",
	delete_trade:SpiceWorld.prepend+"/admin/trades/delete"
};
	
/*-------------------------------------*/
/*-------------Functions---------------*/
/*-------------------------------------*/

SpiceWorld.install = function( ){
	return $.post(this.api.install);
};

SpiceWorld.uninstall = function( ){
	return $.post(this.api.uninstall);
};

SpiceWorld.deleteStateEnums = function( id ){
	return $.post(this.api.delete_trade_status, {id:id});
};

SpiceWorld.deleteItem = function deleteItem( id ){
	return $.post(this.api.delete_item, {id:id});
};

SpiceWorld.deleteUserInventory = function(userId, id ){
	return $.post(this.api.delete_inventory, {id:id});
};

SpiceWorld.getStateEnums = function(){
	return $.post(this.api.trades_status_get);
};

SpiceWorld.getItems = function(){
	return $.post(this.api.items_get);
};

SpiceWorld.getUsers = function(){
	return $.post(this.api.get_user_list);
};

SpiceWorld.getUserInventory = function( id )
{
	return $.post(this.api.user_inventory, {id:id});
};

SpiceWorld.createTradeStatus = function(name){
	return $.post(this.api.create_trade_status, {name:name});
};

SpiceWorld.createItem = function(name, value){
	return $.post(this.api.items_create, {name:name, value:value});
};

SpiceWorld.grantItem = function(userId, item){
	return $.post(this.api.items_grant, {user:userId, item:item});
};

SpiceWorld.createTrade = function(owner, target,message, offerItems, requestItems){
	return $.post(this.api.create_trade, {owner:owner,target:target, message:message, offerItems:offerItems, requestItems:requestItems});
};

SpiceWorld.acceptTrade = function(trade_id, owner_id, target_id){
	return $.post(this.api.trade_update, {trade_id:trade_id, owner_id:owner_id, target_id:target_id});
};

SpiceWorld.getTrades = function(user_id){
	return $.post(this.api.get_trades, {user_id:user_id});
};