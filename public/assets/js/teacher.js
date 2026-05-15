/**
 * Teacher Dashboard Scripts
 */

document.addEventListener('DOMContentLoaded', () => {
    
    // Quick Attendance Toggle
    const attendanceRadios = document.querySelectorAll('.attendance-radio');
    attendanceRadios.forEach(radio => {
        radio.addEventListener('change', (e) => {
            const row = e.target.closest('tr');
            if(e.target.value === 'absent') {
                row.style.backgroundColor = 'rgba(255, 0, 0, 0.05)';
            } else if (e.target.value === 'present') {
                row.style.backgroundColor = 'rgba(0, 255, 0, 0.05)';
            } else {
                row.style.backgroundColor = 'transparent';
            }
        });
    });

});
