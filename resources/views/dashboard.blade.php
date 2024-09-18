<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold mb-5 dark:text-white text-black text-center">Welcome Back {{auth()->user()->name}}</h1>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                    
                    <!-- Chart Container -->
                    <div class="mt-6">
                        <canvas id="myChart"></canvas>
                    </div>
                    
                    <!-- Open Project in GitHub Codespaces Button -->
                    <div class="mt-6 text-center">
                        <a href="https://github.com/zobirofkir/cmssourcedart" target="_blank" class="bg-blue-500 text-white px-4 py-2 rounded">
                            Open Project in GitHub Codespaces
                        </a>
                    </div>
                    
                    <!-- Open Local Project Button -->
                    <div class="mt-6 text-center">
                        <a href="{{ url('/project/index.html') }}" target="_blank" class="bg-green-500 text-white px-4 py-2 rounded">
                            Open Local Project
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Chart.js configuration
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar', // You can change the chart type here (e.g., 'line', 'pie', 'doughnut')
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'], // X-axis labels
                datasets: [{
                    label: 'Monthly Sales',
                    data: [12, 19, 3, 5, 2, 3, 7], // Data points
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-app-layout>
