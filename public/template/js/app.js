(function (window) {
	$(() => {
		//get count of the active task
		var url = $(location).attr('href')
		const split_url = url.split('/')

		if (split_url[(split_url.length - 1)] === 'active') {
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
		} else if (split_url[(split_url.length - 1)] === 'complete') {
			$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type:'GET',
				url:"http://127.0.0.1:8000/api/countTask/task_is_completed",
				data:{},
				success:function(data){
					let count_active = data.data.count
					$("#item-left").html(count_active)
				}
			});
		} else {
			$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type:'GET',
				url:"http://127.0.0.1:8000/api/countAllTask",
				data:{},
				success:function(data){
					let count_active = data.data.count
					$("#item-left").html(count_active)
				}
			});
		}

		//action for make a new task
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

		//get all task data
		$.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type:'GET',
			url:"http://127.0.0.1:8000/api/task",
			data:{},
			success:function(data){
				const task_data = data.data
				//looping all task data
				task_data.forEach(function(item) {
					//set function if destroy button clicked
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

					//set function if complete button clicked
					$("#set-complete_" + item.id).on("click", () => {
						$.ajax({
							headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
							type:'PUT',
							url:"http://127.0.0.1:8000/api/setTaskToComplete/"+item.id,
							data:{},
							success:function(data){
								window.location.reload()
							}
						});
					})

					//set function if active button clicked
					$("#set-active_" + item.id).on("click", () => {
						$.ajax({
							headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
							type:'PUT',
							url:"http://127.0.0.1:8000/api/setTaskToActive/"+item.id,
							data:{},
							success:function(data){
								window.location.reload()
							}
						});
					})
				});
			}
		});

		//set function if clear completed button clicked
		$("#clear-completed").on("click", () => {
			if (confirm('Are you sure to delete all task in complete list?')) {
				$.ajax({
					headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					type:'DELETE',
					url:"http://127.0.0.1:8000/api/deleteAllCompleteTask",
					data:{},
					success:function(data){
						window.location.reload();
					}
				});	
			}
		});

		//set function if clear active button clicked
		$("#clear-active").on("click", () => {
			if (confirm('Are you sure to mark all active task to complete task list?')) {
				$.ajax({
					headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					type:'PUT',
					url:"http://127.0.0.1:8000/api/setAllTaskToComplete",
					data:{},
					success:function(data){
						window.location.reload();
					}
				});	
			}
		});
	})
})(window);
