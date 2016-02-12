<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>

<script>
$(document).ready(function() {

	$('#widget_table').DataTable({
		select: true,
		"ajax": {
			"url": "/api/widget",
			"type": "POST",
			"headers": {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		},
		"columns": [
			{"data": "id"},
			{
				"data": "widget_name",
				"render": function(data, type, row, meta) {
					return '<a href="/widget/' + row.id + '">' + data + '</a>';
				}
			}, {
				"data": "created_at",
				"render": function(data, type, row, meta) {
					var d = moment(data);
					return d.day() + "/" + d.month() + 1 + "/" + d.year();
				}
			}, {
				"defaultContent": "null", "render": function(data, type, row, meta) {
					return '<a href="/widget/' + row.id + '/edit" class="btn btn-default">Edit</a>';
				} 
			}
		]
	});
});
</script>