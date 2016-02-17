<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script>
$(document).ready(function() {
	$('#user_table').DataTable({
		select: false,
		"ajax": {
			"url": "/api/user",
			"type": "post",
			"headers": {
				"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
			}
		},
		"columns": [
			{"data": "id"},
			{
				"data": "name",
				"render": function (data, type, row, meta) {
					return '<a href="/user/' + row.id + '">' + data + '</a>';
				}
			}, {
				"data": "email"
			}, {
				"data": "is_subscribed",
				"render": function(data, type, full, meta) {
					return data == 1 ? 'Yes' : 'No';
				}
			}, {
				"data": "is_admin",
				"render": function(data, type, full, meta) {
					return data == 1 ? 'Yes' : 'No';
				}
			}, {
				"data": "user_type_id",
				"render": function(data, type, full, meta) {
					return data == 10 ? 'Free' : 'Paid';
				}
			}, {
				"data": "status_id",
				"render": function(data, type, full, meta) {
					return data == 10 ? 'Active' : 'Inactive'
				}
			}, {
				"data": "created_at",
				"render": function(data, type, full, meta) {
					var d = moment(data);
					return d.day() + "/" + (d.month() + 1) + "/" + d.year();
				}
			}, {
				"defaultContent": "null", 
				"render": function(data, type, row, meta) {
					return '<a href="/user/' + row.id + '/edit" class="btn btn-default">Edit</a>'; 
				}
			}
		]
	});
});
</script>