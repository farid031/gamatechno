(function (window) {
	$(() => {
		$("#new-todo").on('keypress', (e) => {
			var key = e.which;
			if (key == 13) // the enter key code
			{
				console.log('enter pressed')
			}
		});
	})
})(window);
