function updateDateTime() {
    const now = new Date();
    const dateString = now.toLocaleDateString();
    const timeString = now.toLocaleTimeString();

    if (document.getElementById('current-date-time') === null) {
        return;
    }
    
    document.getElementById('current-date-time').textContent = `📅 ${dateString} ⏲️ ${timeString}`;
}

document.addEventListener('DOMContentLoaded', function () {
    updateDateTime();
    setInterval(updateDateTime, 1000);
});