<x-app-layout>
    <div class="container mt-5 p-4 bg-white shadow rounded">
        <h2 class="text-center mb-4" style="color: #4a47a3; font-weight: bold;">プロフィール編集</h2>

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label for="name" class="form-label">名前</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">メールアドレス</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">更新</button>
        </form>

        <hr class="my-4">

        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger">退会する</button>
        </form>
    </div>
</x-app-layout>
