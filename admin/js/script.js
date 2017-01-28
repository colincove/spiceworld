var prepend = "/spiceworld";

var api = 
{
	install:site_uri+prepend+"/admin/install", 
	uninstall:site_uri+prepend+"/admin/uninstall",
	create_trade_status:site_uri+prepend+"/admin/trades/status/create",
	trades_status_get:site_uri+prepend+"/admin/trades/status/get",
	items_create:site_uri+prepend+"/admin/items/create",
	items_get:site_uri+prepend+"/admin/items/get",
	items_grant:site_uri+prepend+"/admin/items/grant",
	trade_create:site_uri+prepend+"/trade/create",
	get_user:site_uri+prepend+"/user/massinfo",
	trade_update:site_uri+prepend+"/trade/update",
	get_trades:site_uri+prepend+"/trade/get",
	user_inventory:site_uri+prepend+"/user/inventory"
};

window.onload  =function()
{
	$("#install-btn").click(function(){
		$.post(api.install, function(data){alert(data);});
	});
	$("#uninstall-btn").click(function(){
		$.post(api.uninstall, function(data){alert(data);});
	});
	
	$("#StatusForm").submit(function( e ){
		//$(this).find("");
		//var values = .serialize();
		
		var val = $(this).find('input[name="name"]').val();
		
		if(val === "")
		{
			return;
		}
		
		/*$.post(api.create_trade_status, {name:$(this).}).done(function(data){
			alert(data);
		});*/
		
		event.preventDefault();
	});
};
