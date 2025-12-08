@extends('layouts.admin')

@section('header')
    Create User
@endsection

@section('content')

    <div class="min-h-screen bg-slate-50 p-6">
        <div class="max-w-2xl mx-auto">
            
            <div class="mb-8">
                <a href="{{ route('admin.users.index') }}" class="text-indigo-600 hover:text-indigo-700 text-sm font-semibold flex items-center gap-1 mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    Back to Users
                </a>
                <h1 class="text-3xl font-bold text-slate-900">Add New User</h1>
                <p class="text-slate-600 mt-1">Create a new admin or regular user account</p>
            </div>

            <div class="bg-white rounded-lg shadow-md p-8">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-slate-900 mb-2">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter user's full name" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" required />
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-slate-900 mb-2">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="user@sunib.com" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" required />
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-slate-900 mb-2">Phone Number</label>
                        <input type="tel" name="phone_number" value="{{ old('phone_number') }}" placeholder="+1 (555) 123-4567" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" />
                        @error('phone_number') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-slate-900 mb-2">Role</label>
                        <select name="role" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" required>
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        @error('role') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-slate-900 mb-2">Password</label>
                        <input type="password" name="password" placeholder="Enter a secure password" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" required />
                        <p class="text-xs text-slate-600 mt-1">Password must be at least 8 characters</p>
                        @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-8">
                        <label class="block text-sm font-semibold text-slate-900 mb-2">Confirm Password</label>
                        <input type="password" name="password_confirmation" placeholder="Confirm password" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" required />
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg transition">Create User</button>
                        <a href="{{ route('admin.users.index') }}" class="flex-1 bg-slate-200 hover:bg-slate-300 text-slate-900 font-semibold py-2 px-6 rounded-lg text-center transition">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection