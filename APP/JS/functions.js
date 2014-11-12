$(function()
{

users = [];
currentUserId = 1;
	
	refresh();

});

	

function refresh()
{
	$.ajax({
		url: "../API/index.php?action=listUsers",
		type: "GET"
	}).done(function(response){
		$("#userInside ul").empty();
		for (i = 0; i < response.length; i++)
		{
			$("#userInside ul").append("<li>" + response[i].userNickname + "</li>");
		}
	});

	$.ajax({
		url: "../API/index.php?action=listMessages",
		type: "GET"
	}).done(function(responses){
		console.log(responses);
		
		$("#messageInside").empty();
		for (i=0; i < responses.length; i++)
		{
			$("#messageInside").prepend("<p>" + responses[i].messageValue + " : " +responses[i].messageDate + " : " + responses[i].userId + "</p>");
		}
		refresh();
	})
}


function userConnect()
{
	$.ajax({
		url: 'localhost/tchat/APP/index.php',
		type: 'GET',
		data:{
			$userNickname: $('#connecting').val()
		},
		statusCode:{
				201: function(response)
				{
					userId = response.userId;
					('.loginBlock').hide(2000, easeOutQuint);
					refresh();
					console.log('contact créé');
				},
				208: function(response)
				{
					refresh();
					console.log('existe déjà');
				}
			}
	})
}

/*
$('#connecting').keypress(function(eventObject)
{
	if (eventObject.which == 13) 
	{
		userConnect();
	};
});

refresh('#userInside ul');
refresh('#messageInside');
*/
