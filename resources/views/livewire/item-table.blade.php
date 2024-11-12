<div>
    <!-- resources/views/livewire/item-table.blade.php -->

  <!-- resources/views/livewire/item-table.blade.php -->

<div class="container mx-auto px-4 py-6">
    <!-- Center the heading -->
    <h2 class="text-2xl font-bold mb-4 text-center text-white">Item Management</h2>

    <!-- Display success message with theme color -->
    @if (session()->has('message'))
        <div class="bg-green-600 text-green-100 px-4 py-2 rounded mb-4 text-center">
            {{ session('message') }}
        </div>
    @endif

    <!-- Position button to the right -->
    <div class="flex justify-end mb-4">
        <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add New Item
        </button>
    </div>

    <!-- Dark themed data table -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-gray-800 text-gray-200 border border-gray-700 rounded-lg shadow-md">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b border-gray-700 text-center font-semibold text-gray-300">ID</th>
                    <th class="px-6 py-3 border-b border-gray-700 text-left font-semibold text-gray-300">Name</th>
                    <th class="px-6 py-3 border-b border-gray-700 text-left font-semibold text-gray-300">Organization</th>
                    <th class="px-6 py-3 border-b border-gray-700 text-left font-semibold text-gray-300">Department</th>
                    <th class="px-6 py-3 border-b border-gray-700 text-center font-semibold text-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr class="hover:bg-gray-700">
                        <td class="px-6 py-4 border-b border-gray-700 text-center">{{ $item->id }}</td>
                        <td class="px-6 py-4 border-b border-gray-700 text-left">{{ $item->name }}</td>
                        <td class="px-6 py-4 border-b border-gray-700 text-left">{{ $item->organization }}</td>
                        <td class="px-6 py-4 border-b border-gray-700 text-left">{{ $item->department }}</td>
                        <td class="px-6 py-4 border-b border-gray-700 text-center">
                            <button wire:click="edit({{ $item->id }})"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded text-sm">
                                Edit
                            </button>
                            <button wire:click="delete({{ $item->id }})"
                                    class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded text-sm">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


        <!-- Modal for Adding/Editing Item -->
        @if($isOpen)
            <div class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
                <div class="bg-gray-800 text-white w-full max-w-lg p-6 rounded-lg shadow-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold">{{ $item_id ? 'Edit Item' : 'Add New Item' }}</h3>
                        <button wire:click="closeModal()" class="text-gray-400 hover:text-gray-100">✖</button>
                    </div>

                    <form>
                        <div class="mb-4">
                            <label for="name" class="block text-gray-300">Name</label>
                            <input type="text" wire:model="name" id="name"
                                class="w-full px-4 py-2 mt-2 bg-gray-700 border border-gray-600 rounded-lg focus:outline-none focus:ring focus:ring-blue-500">
                            @error('name') <span class="text-red-400">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="organization" class="block text-gray-300">Organization</label>
                            <select wire:model="selectedOrganization" id="organization"
                                class="w-full px-4 py-2 mt-2 bg-gray-700 border border-gray-600 rounded-lg focus:outline-none focus:ring focus:ring-blue-500">
                                <option value="" disabled selected>Select Organization</option>
                                @foreach($organizations as $organization)
                                    <option value="{{ $organization['name'] }}">{{ $organization['name'] }}</option>
                                @endforeach
                            </select>
                            @error('selectedOrganization') <span class="text-red-400">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="department" class="block text-gray-300">Department</label>
                            <select wire:model="selectedDepartment" id="department"
                                class="w-full px-4 py-2 mt-2 bg-gray-700 border border-gray-600 rounded-lg focus:outline-none focus:ring focus:ring-blue-500">
                                <option value="" disabled selected>Select Department</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department['name'] }}">{{ $department['name'] }}</option>
                                @endforeach
                            </select>
                            @error('selectedDepartment') <span class="text-red-400">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex justify-end">
                            <button type="button" wire:click="closeModal()"
                                class="bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded mr-2">Cancel</button>

                            <!-- Add @click.prevent to prevent default form submission -->
                            <button type="button" wire:click.prevent="store()"
                                class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                                {{ $item_id ? 'Update' : 'Save' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>

</div>