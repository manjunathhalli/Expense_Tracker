<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-lg font-semibold mb-4">Edit Expense</h2>
                    <form action="{{ route('expenses.update', $expense->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div class="flex flex-col">
                            <label for="description" class="font-medium text-gray-700">Description:</label>
                            <input type="text" id="description" name="description" value="{{ $expense->description }}" class="mt-1 form-input block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div class="flex flex-col">
                            <label for="amount" class="font-medium text-gray-700">Amount:</label>
                            <input type="number" id="amount" name="amount" value="{{ $expense->amount }}" class="mt-1 form-input block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div class="flex flex-col">
                            <label for="date" class="font-medium text-gray-700">Date:</label>
                            <input type="date" id="date" name="date" value="{{ $expense->date }}" class="mt-1 form-input block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div class="flex flex-col">
                            <label for="category" class="font-medium text-gray-700">Category:</label>
                            <select id="category" name="category_id" class="mt-1 form-select block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $expense->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                            <br><button type="submit" style="background-color: #007bff; color: #fff; border: none; padding: 8px 16px; border-radius: 4px;">Update</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
