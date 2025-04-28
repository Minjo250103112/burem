@extends('layouts.app')
@section('content')
<x-app-layout>
    <div class="flex min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Sidebar -->
        <aside class="w-64 bg-white dark:bg-gray-800 shadow-lg">
            <div class="p-6">
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('path-ke-logo.png') }}" alt="Logo" class="h-10">
                    <span class="text-xl font-bold text-gray-800 dark:text-white">Dashboard</span>
                </div>
            </div>
            <nav class="mt-8">
                <ul>
                    <li class="mb-4">
                        <a href="/dashboard" class="flex items-center p-2 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700 rounded">
                            🏠 Dashboard
                        </a>
                    </li>
                    <li class="mb-4">
                        <a href="/profile" class="flex items-center p-2 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700 rounded">
                            👤 Profile
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center p-2 w-full text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700 rounded">
                                🚪 Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <!-- Header -->
            <div class="mb-8">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-white leading-tight">
                    {{ __('Dashboard') }}
                </h2>
            </div>

            <!-- Statistic Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 text-center">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white">Users</h3>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">25</p>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 text-center">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white">Posts</h3>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">7</p>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 text-center">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white">Comments</h3>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">10</p>
                </div>
            </div>

            <!-- Welcome Message -->
            <div class="mt-8">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <p class="text-gray-800 dark:text-gray-200 text-lg">
                        {{ __("You're logged in!") }}
                    </p>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
@endsection