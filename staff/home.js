// Function to update statistics from the backend
function updateStatisticsFromBackend() {
    fetch('https://your-backend-api.com/statistics')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Assuming your backend returns an object with keys for each statistic
            let residentCount = data.residentCount;
            let maintenanceCount = data.maintenanceCount;
            let eventCount = data.eventCount;
            let taskCount = data.taskCount;

            // Update the DOM elements with the new values
            document.getElementById('residentCount').innerText = `Residents Count: ${residentCount}`;
            document.getElementById('maintenanceCount').innerText = `Maintenance Count: ${maintenanceCount}`;
            document.getElementById('eventCount').innerText = `Events Count: ${eventCount}`;
            document.getElementById('taskCount').innerText = `Task count: ${taskCount}`;
        })
        .catch(error => {
            console.error('There was a problem fetching the data:', error);
        });
}

// Call the updateStatisticsFromBackend function initially
updateStatisticsFromBackend();

// Update statistics from the backend every 5 seconds
setInterval(updateStatisticsFromBackend, 5000);
