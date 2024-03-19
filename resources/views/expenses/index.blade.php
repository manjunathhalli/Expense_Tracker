
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('expenses.index') }}" method="GET">
                       <div class="p-6 bg-white border-b border-gray-200">
                        <a href="{{ route('expenses.create') }}"  style="color: rgb(30, 202, 30); border: 2px solid #333; padding: 5px 10px; border-radius: 20px;">Add Expense</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         
                        <button title="filter expenses by category and date range." type="button" id="showFilterBtn" style="background-color: rgb(129, 126, 117); color: #fff; border: none; padding: 8px 16px; border-radius: 4px;">Filter</button>
                        <br> </br>
                        <div id="filterModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 1000;">
                            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; padding: 20px; border-radius: 5px;">
                                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; padding: 20px; border-radius: 5px;">              
                                    <h2>Filter Options</h2>
                                    <label for="category" class="block font-medium text-sm text-gray-700">Category:</label>
                                    <select class="form-select mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="category" name="category">
                                        <option value="">All Categories</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $selectedCategory == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="start_date" class="block font-medium text-sm text-gray-700">Start Date:</label>
                                    
                                    <input type="date" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="start_date" name="start_date" value="{{ $startDate }}">
                                    <label for="end_date" class="block font-medium text-sm text-gray-700">End Date:</label>
                                   
                                    <input type="date" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="end_date" name="end_date" value="{{ $endDate }}">
                    
                                    <div class="mt-4">
                                        <button type="submit" id="applyFilterBtn" style="background-color: rgb(176, 134, 7); color: #fff; border: none; padding: 8px 16px; border-radius: 4px;">Filter</button>
                                        <a href="{{ route('expenses.index') }}" id="clearFilterBtn" style="background-color: rgb(102, 125, 58); color: #fff; border: none; padding: 8px 16px; border-radius: 4px;">Refresh</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                    <h2 class="text-lg font-semibold mb-3">Expenses List</h2>

                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($expenses as $expense)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap text-center">{{ $expense->description }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-center">{{ $expense->amount }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-center">{{ $expense->date }}</td>
                                    @php
                                        $expense_name = \DB::table('categories')
                                                        ->where('id', $expense->category_id)
                                                        ->select('name')
                                                        ->first();
                                    @endphp
                                    <td class="px-6 py-4 whitespace-no-wrap text-center">
                                        @if ($expense_name)
                                            {{ $expense_name->name }}
                                        @else
                                            No category found
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-center">
                                        <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-primary btn-sm" style="background-color: #007bff; color: #fff; border: none; padding: 8px 16px; border-radius: 4px;">Edit</a>

                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-center">
                                <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" style="background-color: red; color: #fff; border: none; padding: 8px 16px; border-radius: 4px;" onclick="return confirm('Are you sure you want to delete this excpense?')">Delete</button>
                                </form>
                            </td>
                                </tr>
                            @endforeach
                        </tbody>  
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function(){
        $("#showFilterBtn").click(function(){
            $("#filterModal").show();
        });

        $("#applyFilterBtn").click(function(){
            $("#filterModal").hide();
        });

        $("#clearFilterBtn").click(function(){
            $("#filterModal").hide();
        });
    });
</script>
