<x-layouts.app :title="__('Trash')">
    <div class="p-8">

        <h1 class="text-2xl font-bold text-gray-700 mb-6">🗑️ Recycle Bin</h1>
        {{-- success message --}}
        @if (session('success'))
            <div id="success-message" class="rounded-lg bg-green-100 p-4 text-sm text-green-800 dark:bg-green-900/30 dark:text-green-400">
                {{ session('success') }}
            </div>

            <script>
                setTimeout(() => {
                    const msg = document.getElementById('success-message');
                    if (msg) {
                        msg.classList.add('opacity-0');
                        setTimeout(() => msg.remove(), 500);
                    }
                }, 3000);
            </script>
        @endif

        <div class="relative h-full flex-1 overflow-hidden border dark:border-neutral-700 dark:bg-neutral-800 mt-6">
            <table class="w-full min-w-full">
                <thead class="">
                    <tr class="border-b border-neutral-200 bg-neutral-50 dark:border-neutral-700 dark:bg-neutral-900/50">
                        <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">#</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Name</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Email</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Phone</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Address</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Deleted At</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                    @foreach($mens as $men)
                        <tr class="btransition-colors hover:bg-neutral-50 dark:hover:bg-neutral-800/50">
                            <td class="px-4 py-3 text-sm text-neutral-600 dark:text-neutral-400">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 text-sm text-neutral-600 dark:text-neutral-400">{{ $men->name }}</td>
                            <td class="px-4 py-3 text-sm text-neutral-600 dark:text-neutral-400">{{ $men->email }}</td>
                            <td class="px-4 py-3 text-sm text-neutral-600 dark:text-neutral-400">{{ $men->phone }}</td>
                            <td class="px-4 py-3 text-sm text-neutral-600 dark:text-neutral-400">{{ $men->address }}</td>
                            <td class="px-4 py-3 text-sm text-neutral-600 dark:text-neutral-400">{{ $men->deleted_at }}</td>
                            <td class="p-2">
                                <form action="{{ route('mens.restore', $men->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button class="text-green-600 hover:text-green-800 cursor-pointer">Restore</button>
                                </form>
                                <span class="mx-1 text-neutral-400">|</span>
                                <form action="{{ route('mens.forceDelete', $men->id) }}" method="POST" onsubmit="return confirm('Delete permanently?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:text-red-800 cursor-pointer">Delete Permanently</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
