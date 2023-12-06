<script>
     $(document).ready(function() {
            $('#myTable').DataTable();
        });
    // search class attendane based on month and year
        $(document).on('click', '#find-attendanceButton', function(e) {
            e.preventDefault();
            const monthValue = $('#month').val();
            const yearValue = $('#year').val();
            if ($.trim(monthValue).length === 0 || $.trim(yearValue).length === 0) {
                    toastr.error('Please make sure month and year is selected');     
            } else {
                // fetch class
                $.ajax({
                    type: "GET",
                    url: "{{ route('get_classAttendance') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Laravel CSRF token
                    }, data: {
                        'month' : monthValue,
                        'year' : yearValue
                    },
                    success: function (response) {
                        if (response.status == 200) {
                            // appending table
                                const classesTable = $('#classes-table');
                                classesTable.html(' ');
                                response.data.forEach((element, index) => {
                                    const newRow = $('<tr>');
                                    const classCount = $('<td>');
                                    classCount.text(`${ (index) + 1 }`);
                                    newRow.append(classCount);

                                    const className = $('<td>');
                                    className.text(`${ element.name }`);
                                    newRow.append(className);

                                    const btnContainer = $('<td>');
                                    const button = $('<a>', {
                                        class : 'btn btn-primary',
                                        text : 'View',
                                        id : 'view-attendance',
                                        'data-id' : element.id
                                    });
                                    btnContainer.append(button);
                                    newRow.append(btnContainer);
                                    classesTable.append(newRow);

                                });        
                                
                        } 
                        if(response.status == 400) {
                            toastr.error(response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle any errors that occur during the request
                        toastr.error('Cannot fetch classes (Error: 500)');
                    }
                });
            }
        });
    // view student attendance
        $(document).on('click', '#view-attendance', function(e) {
            e.preventDefault();
            $.ajax({
                type: "GET",
                url: "{{ route('view_classAttendance') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Laravel CSRF token
                }, data: {
                    'class_id' : $(this).data('id')
                },
                success: function (response) {
                    if (response.status == 200) {
                        var countPresent = 0;
                        var countLate = 0;
                        var countAbsent = 0;
                        var attendanceRemarks = [
                            'Absent',
                            'Present', 
                            'Late'
                        ];
                        const attendanceTable = $('#attendance-table');
                        attendanceTable.html(' ');
                        response.data.forEach((element, index) => {
                            const newRow = $('<tr>');
                            const indexing = $('<td>');
                            indexing.text(`${ (index) + 1 }`);
                            newRow.append(indexing);

                            const studentName = $('<td>');
                            studentName.text(`${ element.first_name } ${ element.last_name }`);
                            newRow.append(studentName);
                            
                            // count the number of present, absent and late
                            switch (element.remarks) {
                                case 0:
                                    countAbsent++;
                                    break;
                                case 1:
                                    countPresent++;
                                    break;
                                case 2:
                                    countLate++;
                                    break;
                                default:
                                    countAbsent++; 
                                    break;
                            }

                            const remark = $('<td>');
                            remark.text(`${ attendanceRemarks[element.remarks] }`)
                            newRow.append(remark);

                            const date = $('<td>');
                            date.text(`${ element.formatted_created_at }`)
                            newRow.append(date);
                            attendanceTable.append(newRow);
                        });

                        $('#num-present').text(countPresent);
                        $('#num-absent').text(countAbsent);
                        $('#num-late').text(countLate);
                    } 
                    if(response.status == 400) {
                        toastr.error(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    // Handle any errors that occur during the request
                    toastr.error('Cannot fetch attendance (Error: 500)');
                }
            });
        });
</script>