document.addEventListener("DOMContentLoaded", function() {
  const analyticsCard = document.getElementById("analyticsCard");
  const analyticsPanel = document.getElementById("analyticsPanel");

  // Scroll to the analytics panel on card click
  analyticsCard.addEventListener("click", function() {
      analyticsPanel.scrollIntoView({ behavior: 'smooth' });
  });

  // Retrieve the data attributes
  const analyticsData = JSON.parse(analyticsPanel.getAttribute('data-analytics'));
  const feedbackData = JSON.parse(analyticsPanel.getAttribute('data-feedback'));

  const requestLabels = Object.keys(analyticsData);
  const requestCounts = Object.values(analyticsData);
  const feedbackLabels = Object.keys(feedbackData);
  const feedbackCounts = Object.values(feedbackData);

  // Create the analytics chart
  const ctx = document.getElementById('analyticsChart').getContext('2d');
  const analyticsChart = new Chart(ctx, {
      type: 'pie',
      data: {
          labels: requestLabels.concat(feedbackLabels),
          datasets: [{
              label: 'Requests and Feedbacks',
              data: requestCounts.concat(feedbackCounts),
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(255, 159, 64, 0.2)',
              ],
              borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255, 159, 64, 1)',
              ],
              borderWidth: 1
          }]
      },
      options: {
          responsive: true,
          plugins: {
              legend: {
                  position: 'top',
              },
              title: {
                  display: true,
                  text: 'Analytics of Requests and Feedbacks'
              }
          }
      }
  });
});
