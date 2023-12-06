<script>
    // creating realtime clock
        function updateClock() {
            const now = new Date();
            const hours = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');
            const seconds = now.getSeconds().toString().padStart(2, '0');
            const timeString = `${hours}:${minutes}:${seconds}`;

            const clock = $('#clock');
            clock.text(timeString);
        }
        // Update the clock every second (1000 milliseconds)
        setInterval(updateClock, 1000);
        // Initialize the clock when the page loads
        updateClock();
    // end realtime clock
    // class with no teacher notification button
        $(document).on('click', '#no-teacherClass', function(e) {
            e.preventDefault();
            toastr.error('You cannot select classes with no teacher');
        });
    // end
    // fetch student of specified class
       $(document).on('click', '#select-class', function(e) {
            e.preventDefault();
            const classId = $(this).data('id');
            $.ajax({
                type: "GET",
                url: "{{ route('fetch_classStudents') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Laravel CSRF token
                }, data: {
                    'class_id' : $(this).data('id') 
                },
                success: function (response) {
                    if (response.status == 200) {
                        var attendanceRemarks = [
                            'Absent',
                            'Present', 
                            'Late'
                        ];
                        const attedanceButtonContainer = $('#attendance-btn-container');
                        attedanceButtonContainer.addClass('p-1');
                        attedanceButtonContainer.html(' ');

                        const confirmAttendanceButton = $('<a>', {
                            href : '#',
                            class : 'd-none d-sm-inline-block btn btn-sm btn-primary shadow-sm',
                            text: 'Confirm Attendance',
                            id: 'confirm-attendance'
                        });
                        attedanceButtonContainer.append(confirmAttendanceButton);
                        const studentTable = $('#student-table');
                        studentTable.html(' ');
                    
                        const studentIdContainer = $('#student-id-container'); 
                        studentIdContainer.html(' ')
                        // looping thru students of class
                            response.data.forEach((element, index) => {
                                $('#class-id').val(classId);
                                // creating container for student ids
                                    
                                    const studentId = $('<input>', {
                                        value : element.id,
                                        name: 'student_id[]',
                                        class : 'd-none form-control'
                                    });
                                    studentIdContainer.append(studentId);
                                // appending studnts to table
                                    const newRow = $('<tr>');
                                    const dataIndex = $('<td>');
                                    dataIndex.text(`${(index) + 1}`);
                                    newRow.append(dataIndex);
                                    const studentName = $('<td>');
                                    studentName.text(`${element.first_name} ${element.last_name}`);
                                    newRow.append(studentName);
                                    var selectElement = $('<select>', {
                                        id: 'attendanceStatus',
                                        name : 'remarks[]',
                                        class : 'form-control'
                                    });
                                    // appending attendance remarks
                                    attendanceRemarks.forEach((element, index) => {
                                        selectElement.append($('<option>', {
                                            value: `${index}`,
                                            text: `${element}`
                                        }));
                                    });
                                    newRow.append(selectElement)

                                    studentTable.append(newRow);
                            });
                    } 
                    if(response.status == 400) {
                        $('#class-id').val('');
                        const studentIdContainer = $('#student-id-container'); 
                        studentIdContainer.html(' ')
                        const attedanceButtonContainer = $('#attendance-btn-container');
                        attedanceButtonContainer.addClass('p-1');
                        attedanceButtonContainer.html(' ');
                        const studentTable = $('#student-table');
                        studentTable.html(' ');
                        toastr.error(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    // Handle any errors that occur during the request
                    toastr.error('You cannot select classes with no teacher');
                }
            });
       }); 
    // end
    // set student attendance
        $(document).on('click', '#confirm-attendance', function(e) {
            e.preventDefault();
            $('#attendance-form').submit();
        });
    // end
</script>