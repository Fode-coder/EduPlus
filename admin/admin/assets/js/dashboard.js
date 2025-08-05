// Chart.js Initialization
document.addEventListener('DOMContentLoaded', function () {
    // Activity Chart
    const ctx1 = document.getElementById('activityChart').getContext('2d');
    new Chart(ctx1, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Activité',
                data: [12, 19, 3, 5, 2, 3],
                borderColor: '#f5a623',
                tension: 0.4
            }]
        }
    });

    // Load Activity Feed via AJAX
    fetch('../api/activity.php')
        .then(response => response.json())
        .then(data => {
            const feed = document.getElementById('activityFeed');
            data.forEach(item => {
                feed.innerHTML += `
                <div class="activity-item">
                    <i class="fas fa-${getActivityIcon(item.type)}"></i>
                    <div>
                        <p>${item.description}</p>
                        <small>${new Date(item.date).toLocaleString()}</small>
                    </div>
                </div>`;
            });
        });
});

function getActivityIcon(type) {
    const icons = {
        'cours': 'book',
        'fascicules': 'file-alt',
        'user': 'user-plus'
    };
    return icons[type] || 'bell';
}