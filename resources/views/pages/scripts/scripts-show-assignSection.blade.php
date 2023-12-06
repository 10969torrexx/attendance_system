<script>
    // setting table as data table
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    
    // assign section on button click
        $(document).on('click', '#select-teacher' ,function(e) {
            e.preventDefault();

            $('#teacher-id').val($(this).data('id'));

            $.ajax({
                type: "GET",
                url: "{{ route('fetch_teacher') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Laravel CSRF token
                },
                data: {
                    'id' : $(this).data('id')
                },
                success: function (response) {
                    if (response.status == 200) {
                        const teacherDetails = $('#teacher-details');
                        teacherDetails.html(' ');

                        const fullNameLable = $('<p>');
                        fullNameLable.addClass('default');
                        fullNameLable.text(`Full name:`);
                        teacherDetails.append(fullNameLable);

                        const teacherFullName = $('<strong>')
                        teacherFullName.addClass('default');
                        teacherFullName.text(`${response.data.first_name}  ${response.data.last_name}`);
                        teacherDetails.append(teacherFullName);

                    }
                },
                error: function (xhr, status, error) {
                    // Handle any errors that occur during the request
                    console.error(error);
                }
            });
            
        });

</script>
