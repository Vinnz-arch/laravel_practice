<x-layouts.app :title="__('Trash')">
    <div class="p-8">
        <h1 class="text-2xl font-bold text-gray-700 mb-6">🗑️ Recycle Bin</h1>

        <div class="shadow rounded-lg p-6">
            <table class="w-full mt-4 border border-gray-200 rounded-lg">
                <thead class="">
                    <tr>
                        <th class="p-2 text-left">#</th>
                        <th class="p-2 text-left">Name</th>
                        <th class="p-2 text-left">Email</th>
                        <th class="p-2 text-left">Phone</th>
                        <th class="p-2 text-left">Address</th>
                        <th class="p-2 text-left">Deleted At</th>
                        <th class="p-2 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mens as $men)
                        <tr class="border-t ">
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="p-2">{{ $men->name }}</td>
                            <td class="p-2">{{ $men->email }}</td>
                            <td class="p-2">{{ $men->phone }}</td>
                            <td class="p-2">{{ $men->address }}</td>
                            <td class="p-2">{{ $men->deleted_at }}</td>
                            <td class="p-2 text-center">
                                <form action="{{ route('mens.restore', $men->id) }}" method="POST">
                                    @csrf
                                    <button class="text-green-600 hover:text-green-800">Restore</button>
                                </form>
                                <form action="{{ route('mens.forceDelete', $men->id) }}" method="POST" onsubmit="return confirm('Delete permanently?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:text-red-800 ml-4">Delete Permanently</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
