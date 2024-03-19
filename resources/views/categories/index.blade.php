<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('categories.create') }}" style="color: rgb(30, 202, 30); border: 2px solid #333; padding: 5px 10px; border-radius: 20px;">Add Category</a>
                    <br> </br>
                    <h2 class="text-lg font-semibold mb-3"> Category List</h2>
                    
                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">category name</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($categories as $category)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap text-center">{{ $category->name }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap ">
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary btn-sm" style="background-color: #007bff; color: #fff; border: none; padding: 8px 16px; border-radius: 4px;">Edit</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap ">
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?')" style="background-color: red; color: #fff; border: none; padding: 8px 16px; border-radius: 4px;"">Delete</button>
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
