(function (window) {
	$(() => {
		//get count of the active task
		$.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type:'GET',
			url:"http://127.0.0.1:8000/api/countTask/task_is_active",
			data:{},
			success:function(data){
				let count_active = data.data.count
				$("#item-left").html(count_active)
			}
		});

		$("#new-todo").on("keypress", (e) => {
			var key = e.which;

			// the enter key code
			if (key == 13) {
				$.ajax({
					headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					type:'POST',
					url:"http://127.0.0.1:8000/api/createTask",
					data:{ task_desc: $("#new-todo").val() },
					success:function(data){
						window.location.reload()
					}
				});
			}
		});

		$.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type:'GET',
			url:"http://127.0.0.1:8000/api/task",
			data:{},
			success:function(data){
				const task_data = data.data
				
				task_data.forEach(function(item) {
					$("#destroy_" + item.id).on("click", () => {
						$.ajax({
							headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
							type:'DELETE',
							url:"http://127.0.0.1:8000/api/deleteTask/"+item.id,
							data:{},
							success:function(data){
								window.location.reload()
							}
						});
					})
				});
			}
		});
	})
})(window);
