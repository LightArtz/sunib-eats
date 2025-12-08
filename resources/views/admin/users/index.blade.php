@extends('layouts.admin')

@section('header')
    Users
@endsection

@section('content')

    <div class="min-h-screen bg-slate-50 p-6" x-data="userTable()">
        <div class="max-w-7xl mx-auto">
            
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-slate-900">Users</h1>
                    <p class="text-slate-600 mt-1">Manage all admin and regular users</p>
                </div>
                <a href="{{ route('admin.users.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg transition">
                    + Add New User
                </a>
            </div>

            <div class="mb-6">
                <form action="{{ route('admin.users.index') }}" method="GET">
                    <input 
                        type="text" 
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search by name or email..." 
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                    />
                </form>
            </div>

            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-slate-200">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-slate-50 border-b border-slate-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-700">Avatar</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-700">Name</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-700">Email</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-700">Role</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-700">Phone</th>
                                <th class="px-6 py-3 text-center text-sm font-semibold text-slate-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr class="border-b border-slate-200 hover:bg-slate-50 transition">
                                    <td class="px-6 py-4">
                                        @if($user->profile_picture)
                                            <img src="{{ Storage::url($user->profile_picture) }}" alt="Avatar" class="w-10 h-10 rounded-full object-cover">
                                        @else
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random" alt="Avatar" class="w-10 h-10 rounded-full">
                                        @endif
                                    </td>
                                    
                                    <td class="px-6 py-4 text-slate-900 font-medium">{{ $user->name }}</td>
                                    <td class="px-6 py-4 text-slate-600">{{ $user->email }}</td>
                                    
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $user->role === 'admin' ? 'bg-indigo-100 text-indigo-700' : 'bg-gray-100 text-gray-700' }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    
                                    <td class="px-6 py-4 text-slate-600">{{ $user->phone_number ?? '-' }}</td>
                                    
                                    <td class="px-6 py-4 text-center flex justify-center gap-4">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="text-indigo-600 hover:text-indigo-700">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        
                                        <button 
                                            @click="deleteConfirm('{{ route('admin.users.destroy', $user) }}', '{{ $user->name }}')"
                                            class="text-red-600 hover:text-red-700"
                                        >
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-slate-500">
                                        No users found matching your search.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6">
                {{ $users->links('pagination.admin') }}  
            </div>
        </div>
    <div 
        x-show="showDeleteModal" 
        @click.self="showDeleteModal = false"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
        style="display: none;"
        x-transition
    >
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full mx-4">
            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full mb-4">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-slate-900 text-center mb-2">Delete User?</h3>
            <p class="text-slate-600 text-center text-sm mb-6">
                Are you sure you want to delete "<span x-text="deleteItemName" class="font-medium"></span>"? This action cannot be undone.
            </p>
            <div class="flex gap-3">
                <button 
                    @click="showDeleteModal = false"
                    class="flex-1 px-4 py-2 border border-slate-300 rounded-lg text-slate-700 font-medium hover:bg-slate-50 transition"
                >
                    Cancel
                </button>
                
                <form :action="deleteUrl" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
    </div>

    <script>
        function userTable() {
            return {
                showDeleteModal: false,
                deleteUrl: '',
                deleteItemName: '',

                deleteConfirm(url, name) {
                    this.deleteUrl = url;
                    this.deleteItemName = name;
                    this.showDeleteModal = true;
                }
            }
        }
    </script>
@endsection 