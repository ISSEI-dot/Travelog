<x-app-layout>
    <x-slot name="header">
        <!-- カスタムヘッダー -->
        <div class="d-flex align-items-center">
            <i class="fas fa-tachometer-alt me-2" style="color: #4a47a3;"></i>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <!-- メインコンテンツ -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                    <!-- アイコン付きメッセージ -->
                    <i class="fas fa-smile-beam me-2" style="color: #4a47a3; font-size: 2rem;"></i>
                    <p class="mt-4" style="font-size: 1.2rem; font-weight: bold;">
                        {{ __("You're logged in!") }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
