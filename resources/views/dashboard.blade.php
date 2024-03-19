<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{-- You're logged in! --}}
                    <div style="width: 50%;">
                        <canvas id="myBarChart"></canvas>
                    </div>

                    <br>
                    <a href="{{ route('expenses.index') }}" style="font-family: Arial, sans-serif; font-size: 16px; color: #333; text-decoration: none; background-color: #00b3ff; padding: 10px 20px; border-radius: 5px; display: inline-block;">Go To Expense List</a><br>

                    
                    <br><a href="{{ route('categories.index') }}"style="font-family: Arial, sans-serif; font-size: 16px; color: #333; text-decoration: none; background-color:#00b3ff;; padding: 10px 20px; border-radius: 5px; display: inline-block;">Go To Categories List</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: '/expenses-by-category',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                   // console.log(data);
                    var ctx = document.getElementById('myBarChart').getContext('2d');
                    var myBarChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: 'Analytics section expenses by category',
                                data: data.data,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.5)',
                                    'rgba(54, 162, 235, 0.5)',
                                    'rgba(255, 206, 86, 0.5)',
                                    'rgba(75, 192, 192, 0.5)',
                                    'rgba(153, 102, 255, 0.5)',
                                    'rgba(255, 159, 64, 0.5)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        });
    </script>
</body>