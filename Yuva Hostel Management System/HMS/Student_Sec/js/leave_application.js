document.getElementById('leave-type').addEventListener('change', function() {
    var reasonField = document.getElementById('reason');
    var uploadField = document.getElementById('upload');
    var medicalField = document.getElementById('uploaddo');
    var startDateField = document.getElementById('start-date');
    var endDateField = document.getElementById('end-date');

   
    if (reasonField) reasonField.classList.add('hidden');
    if (uploadField) uploadField.classList.add('hidden');
    if (medicalField) medicalField.classList.add('hidden');

   
    if (this.value === 'weekend') {
       
        startDateField.addEventListener('change', validateWeekend);
        endDateField.addEventListener('change', validateWeekend);
    } else {
        startDateField.removeEventListener('change', validateWeekend);
        endDateField.removeEventListener('change', validateWeekend);
    }

    if (this.value === 'holiday') {
       
    } else if (this.value === 'other') {
        if (reasonField) reasonField.classList.remove('hidden');
        if (uploadField) uploadField.classList.remove('hidden');
    } else if (this.value === 'medical') {
        if (medicalField) medicalField.classList.remove('hidden');
    } else if (this.value === 'personal') {
        if (uploadField) uploadField.classList.remove('hidden');


    }

});

function validateWeekend(event) {
    var date = new Date(event.target.value);
    var day = date.getDay();
    if (day !== 0 && day !== 6) { // 0 = Sunday, 6 = Saturday
        alert('Please select a weekend date (Saturday or Sunday).');
        event.target.value = '';
    }
}